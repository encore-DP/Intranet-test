<?php
declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Routing\RouteContext;

use App\Models\AlumnoModel;
use App\Models\CursoModel;
use App\Models\CertificadoModel;

use Dompdf\Dompdf;
use Dompdf\Options;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;

require_once __DIR__ . '/../Utilities/Database.php';

class CertificadoController
{
    private string $certDir; // carpeta física donde se guardan archivos
    private string $certUrl; // URL pública base a esa carpeta

    public function __construct()
    {
        // ⚠️ Si quieres otro nombre/carpeta, cámbialo aquí
        $this->certDir = __DIR__ . '/../../public/CERTIF';
        $this->certUrl = '/CERTIF';

        foreach (['qrs','pdfs','i'] as $d) {
            @mkdir($this->certDir . "/{$d}", 0775, true);
        }
    }

    /** GET /certificados/nuevo */
    public function nuevo(Request $request, Response $response): Response
    {
        $alumnos = (new AlumnoModel())->listar();
        $cursos  = (new CursoModel())->listar();

        // Ruta nombrada en routes/web.php -> setName('certificados.guardar')
        $routeContext = RouteContext::fromRequest($request);
        $basePath     = $routeContext->getBasePath();
        $routeParser  = $routeContext->getRouteParser();
        $actionUrl    = $basePath . $routeParser->urlFor('certificados.guardar');

        // Normalizamos arrays para la vista
        $alumnosN = array_map(function ($a) {
            return [
                'id'      => $a['alumno_id'] ?? ($a['id'] ?? null),
                'nombre'  => trim(($a['nombre'] ?? '') . ' ' . ($a['apellido'] ?? '')),
                'dni'     => $a['dni'] ?? '',
                'empresa' => $a['empresa_nombre'] ?? ($a['empresa'] ?? ''),
            ];
        }, $alumnos ?? []);

        $cursosN = array_map(function ($c) {
            return [
                'id'          => $c['curso_id'] ?? ($c['id'] ?? null),
                'nombre'      => $c['nombre'] ?? '',
                'descripcion' => $c['descripcion'] ?? '',
                // si tu listar() trae modalidad/horas, también puedes mostrarlas en la vista
            ];
        }, $cursos ?? []);

        ob_start();
        include __DIR__ . '/../Views/certificados/nuevo.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    /** POST /certificados  (ruta nombrada: certificados.guardar) */
    public function guardar(Request $request, Response $response): Response
    {
        $p = (array)$request->getParsedBody();
        $alumnoId = (int)($p['alumno_id'] ?? 0);
        $cursoId  = (int)($p['curso_id']  ?? 0);
        $fecha    = trim($p['fecha']      ?? '');

        if ($alumnoId <= 0 || $cursoId <= 0 || $fecha === '') {
            $response->getBody()->write('Faltan datos obligatorios');
            return $response->withStatus(400);
        }

        // 1) Código único
        $code = $this->uniqueCode6();

        // 2) Nombres y paths
        $htmlFile = "{$code}.html";
        $qrFile   = "qrs/{$code}.png";     // si no hay GD, lo cambiamos a .svg
        $pdfFile  = "pdfs/{$code}.pdf";
        $prevFile = "img/{$code}.png";

        $htmlPath = "{$this->certDir}/{$htmlFile}";
        $qrPath   = "{$this->certDir}/{$qrFile}";
        $pdfPath  = "{$this->certDir}/{$pdfFile}";
        $prevPath = "{$this->certDir}/{$prevFile}";

        // 3) URLs absolutas
        $host = $request->getUri()->getScheme().'://'.$request->getUri()->getAuthority();
        $baseFilesUrl = rtrim($host . $this->certUrl, '/');
        $certUrl = "{$baseFilesUrl}/{$htmlFile}";
        $qrUrl   = "{$baseFilesUrl}/{$qrFile}";
        $pdfUrl  = "{$baseFilesUrl}/{$pdfFile}";
        $prevUrl = "{$baseFilesUrl}/{$prevFile}";

        // 4) QR (PNG si hay GD; si no, SVG)
        $qr = QrCode::create($certUrl)->setSize(300)->setMargin(10);
        if (extension_loaded('gd')) {
            (new PngWriter())->write($qr)->saveToFile($qrPath);
        } else {
            $qrFile = "qrs/{$code}.svg";
            $qrPath = "{$this->certDir}/{$qrFile}";
            $qrUrl  = "{$baseFilesUrl}/{$qrFile}";
            (new SvgWriter())->write($qr)->saveToFile($qrPath);
        }

        // 5) HTML (solo usa datos seguros de BD; no requiere 'categoria')
        $html = $this->renderHtmlStatic($code, $alumnoId, $cursoId, $fecha, $qrFile);
        file_put_contents($htmlPath, $html);

        // 6) PDF
        $opts = new Options();
        $opts->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($opts);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        file_put_contents($pdfPath, $dompdf->output());

        // 7) Preview opcional (solo si hay GD)
        if (extension_loaded('gd')) {
            $this->renderPreviewPng($code, $prevPath, $qrPath);
        } else {
            $prevUrl  = null;
            $prevFile = null;
        }

        // 8) Guardar en BD (SP insertar_certificado)
        $model = new CertificadoModel();
        $ok = $model->insertar(
            $alumnoId, $cursoId, $code,
            $qrUrl, $qrFile,
            $pdfUrl, $pdfFile,
            $prevUrl, $prevFile,
            $certUrl, $fecha
        );
        if (!$ok) {
            $response->getBody()->write('No se pudo registrar en BD');
            return $response->withStatus(500);
        }

        // 9) Redirigir al HTML público del certificado
        return $response->withHeader('Location', $certUrl)->withStatus(302);
    }

    /** (opcional) GET /certificados/lista */
    public function lista(Request $request, Response $response): Response
    {
        $rows = (new CertificadoModel())->listar();
        ob_start();
        include __DIR__ . '/../Views/certificados/lista.php';
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    /* ============ Helpers ============ */

    private function randomCode6(): string
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $out=''; for($i=0;$i<6;$i++) $out .= $chars[random_int(0, strlen($chars)-1)];
        return $out;
    }

    private function codeExistsInFs(string $code): bool
    {
        return file_exists("{$this->certDir}/{$code}.html")
            || file_exists("{$this->certDir}/qrs/{$code}.png")
            || file_exists("{$this->certDir}/qrs/{$code}.svg")
            || file_exists("{$this->certDir}/pdfs/{$code}.pdf")
            || file_exists("{$this->certDir}/img/{$code}.png");
    }

    private function uniqueCode6(int $maxTries=120): string
    {
        $m = new CertificadoModel();
        for ($i=0;$i<$maxTries;$i++) {
            $c = $this->randomCode6();
            if ($this->codeExistsInFs($c)) continue;
            // si tu columna codigo_unico tiene UNIQUE, puedes consultar a BD:
            // if ($m->existeCodigo($c)) continue;
            return $c;
        }
        throw new \RuntimeException('No se pudo generar código único');
    }

    private function renderHtmlStatic(string $code, int $alumnoId, int $cursoId, string $fecha, string $qrRelative): string
    {
        $db = \getDB();

        // Alumno: nombre + apellido + dni + empresa
        $sa = $db->prepare("
            SELECT a.nombre, a.apellido, a.dni, e.nombre AS empresa
            FROM alumnos a
            LEFT JOIN empresa e ON e.empresa_id = a.empresa_id
            WHERE a.alumno_id = ?
        ");
        $sa->execute([$alumnoId]);
        $al = $sa->fetch(\PDO::FETCH_ASSOC) ?: ['nombre'=>'','apellido'=>'','dni'=>'','empresa'=>''];
        $sa->closeCursor();

        // Curso: nombre + descripcion (sin 'categoria')
        $sc = $db->prepare("SELECT nombre, descripcion FROM cursos WHERE curso_id = ?");
        $sc->execute([$cursoId]);
        $cu = $sc->fetch(\PDO::FETCH_ASSOC) ?: ['nombre'=>'','descripcion'=>''];
        $sc->closeCursor();

        $alumnoNombre = trim(($al['nombre'] ?? '') . ' ' . ($al['apellido'] ?? ''));

        ob_start(); ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Certificado <?= htmlspecialchars($code) ?></title>
</head>
<body style="font-family:Arial, sans-serif;">
  <div style="border:4px solid #222;padding:32px;max-width:1000px;margin:0 auto;">
    <h1 style="text-align:center;">CERTIFICADO</h1>
    <p>Otorgado a: <strong><?= htmlspecialchars($alumnoNombre) ?></strong></p>
    <p>DNI: <?= htmlspecialchars($al['dni'] ?? '') ?> — Empresa: <?= htmlspecialchars($al['empresa'] ?? '') ?></p>

    <p>Curso: <strong><?= htmlspecialchars($cu['nombre'] ?? '') ?></strong></p>
    <?php if (!empty($cu['descripcion'])): ?>
      <p>Descripción: <?= nl2br(htmlspecialchars($cu['descripcion'])) ?></p>
    <?php endif; ?>

    <p>Fecha de emisión: <?= htmlspecialchars($fecha) ?></p>
    <p>Código: <strong><?= htmlspecialchars($code) ?></strong></p>

    <img src="<?= htmlspecialchars($qrRelative) ?>" alt="QR" style="width:180px;height:180px;">
  </div>

  <p style="text-align:center;margin-top:12px;">
    <a href="pdfs/<?= htmlspecialchars($code) ?>.pdf" target="_blank">Descargar PDF</a>
  </p>
</body>
</html>
<?php
        return ob_get_clean();
    }

    private function renderPreviewPng(string $code, string $outPath, string $qrPath): void
    {
        if (!extension_loaded('gd')) return;

        $w=1200; $h=850;
        $im = imagecreatetruecolor($w,$h);
        $white = imagecolorallocate($im,255,255,255);
        $txt   = imagecolorallocate($im,30,30,30);
        imagefilledrectangle($im,0,0,$w,$h,$white);
        imagestring($im,5,30,30,"Certificado {$code}", $txt);

        if (is_file($qrPath) && str_ends_with(strtolower($qrPath), '.png')) {
            $qr = @imagecreatefrompng($qrPath);
            if ($qr) {
                imagecopyresampled($im,$qr,$w-330,$h-330,0,0,300,300,imagesx($qr),imagesy($qr));
                imagedestroy($qr);
            }
        }
        imagepng($im,$outPath);
        imagedestroy($im);
    }
}
