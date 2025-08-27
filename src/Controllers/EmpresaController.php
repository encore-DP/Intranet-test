<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\AlumnoModel;
use App\Models\CursoModel;

use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

require_once __DIR__ . '/../Utilities/Database.php';

class CertificadoController
{
    /* ================== CONFIG ==================
       AJUSTA rutas a la carpeta pública donde se guardan
       los certificados (HTML sueltos) y subcarpetas qrs/ pdfs/ i/ (preview)
    */
    private string $CERT_DIR; // ruta absoluta en el servidor
    private string $CERT_URL; // URL pública base a esa carpeta

    public function __construct()
    {
        // Puedes mover esto a config/certificados.php si prefieres
        $this->CERT_DIR = __DIR__ . '/../../public/CERTIFICADOS';   // <-- AJUSTA
        $this->CERT_URL = '/CERTIFICADOS';                          // <-- AJUSTA (o https://tu-dominio/CERTIFICADOS)

        // asegurar subcarpetas
        foreach (['qrs','pdfs','i'] as $d) {
            $path = $this->CERT_DIR . '/' . $d;
            if (!is_dir($path)) @mkdir($path, 0775, true);
        }
    }

    /* =============== VISTA: NUEVO ================= */
    // GET /certificados/nuevo
    public function nuevo(Request $request, Response $response): Response
    {
        // Cargar datos para el formulario (reusa tus modelos)
        $alumnos = (new AlumnoModel())->listar(); // asegúrate que exponga alumno_id, nombre, apellido, dni, empresa_nombre
        $cursos  = (new CursoModel())->listar();  // que exponga curso_id, nombre, categoria, modalidad, horas, descripcion

        ob_start();
        include __DIR__ . '/../Views/certificados/nuevo.php'; // tu formulario
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    /* ============== GUARDAR (POST) ================= */
    // POST /certificados
    public function guardar(Request $request, Response $response): Response
    {
        $p = (array)$request->getParsedBody();
        $alumnoId = (int)($p['alumno_id'] ?? 0);
        $cursoId  = (int)($p['curso_id'] ?? 0);
        $fecha    = trim($p['fecha'] ?? '');

        if ($alumnoId <= 0 || $cursoId <= 0 || $fecha === '') {
            $response->getBody()->write('Faltan datos obligatorios');
            return $response->withStatus(400);
        }

        // 1) Generar código único (6) no repetido en FS (y opcional en BD si tienes UNIQUE)
        $codigo = $this->uniqueCode6();

        // 2) Construir rutas/URLs según tu estructura
        $htmlFile = "{$codigo}.html";           // HTML suelto en la raíz
        $qrFile   = "qrs/{$codigo}.png";
        $pdfFile  = "pdfs/{$codigo}.pdf";
        $prevFile = "i/{$codigo}.png";         // preview opcional

        $htmlPath = "{$this->CERT_DIR}/{$htmlFile}";
        $qrPath   = "{$this->CERT_DIR}/{$qrFile}";
        $pdfPath  = "{$this->CERT_DIR}/{$pdfFile}";
        $prevPath = "{$this->CERT_DIR}/{$prevFile}";

        $certUrl  = rtrim($this->CERT_URL,'/') . "/{$htmlFile}";
        $qrUrl    = rtrim($this->CERT_URL,'/') . "/{$qrFile}";
        $pdfUrl   = rtrim($this->CERT_URL,'/') . "/{$pdfFile}";
        $prevUrl  = rtrim($this->CERT_URL,'/') . "/{$prevFile}";

        // 3) Generar QR apuntando al HTML público
        $qr = QrCode::create($certUrl)->setSize(300)->setMargin(10);
        (new PngWriter())->write($qr)->saveToFile($qrPath);

        // 4) Renderizar HTML con los datos (sencillo; cambia por tu plantilla real)
        $html = $this->renderHtml($codigo, $alumnoId, $cursoId, $fecha, $qrFile);
        file_put_contents($htmlPath, $html);

        // 5) Generar PDF (dompdf) a partir del mismo HTML
        $this->htmlToPdf($html, $pdfPath);

        // 6) (Opcional) generar una imagen preview
        $this->renderPreviewPng($codigo, $prevPath, $qrPath);

        // 7) Insertar en BD usando TU SP insertar_certificado(...)
        $db = \getDB();
        $stmt = $db->prepare("CALL insertar_certificado(?,?,?,?,?,?,?,?,?,?,?)");
        $ok = $stmt->execute([
            $alumnoId, $cursoId, $codigo,
            $qrUrl,  $qrFile,
            $pdfUrl, $pdfFile,
            $prevUrl, $prevFile,
            $certUrl, $fecha
        ]);
        $stmt->closeCursor();

        if (!$ok) {
            $response->getBody()->write('No se pudo registrar el certificado.');
            return $response->withStatus(500);
        }

        // 8) Redirigir al HTML público del certificado
        return $response->withHeader('Location', $certUrl)->withStatus(302);
    }

    /* =============== LISTA (opcional) =============== */
    // GET /certificados/lista
    public function lista(Request $request, Response $response): Response
    {
        $db = \getDB();
        $st = $db->prepare("CALL listar_certificados()");
        $st->execute();
        $rows = $st->fetchAll(\PDO::FETCH_ASSOC);
        $st->closeCursor();

        ob_start();
        include __DIR__ . '/../Views/certificados/lista.php'; // crea una tabla simple
        $html = ob_get_clean();

        $response->getBody()->write($html);
        return $response;
    }

    /* =============== ELIMINAR (opcional) =============== */
    // POST /certificados/{id}/eliminar
    public function eliminar(Request $request, Response $response, array $args): Response
    {
        $id = (int)($args['id'] ?? 0);
        if ($id <= 0) return $response->withStatus(400);

        $db = \getDB();
        $st = $db->prepare("CALL eliminar_certificado(?)");
        $ok = $st->execute([$id]);
        $st->closeCursor();

        if (!$ok) return $response->withStatus(500);

        return $response->withHeader('Location', '/certificados/lista')->withStatus(302);
    }

    /* ================== HELPERS ================== */

    private function randomCode6(): string {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // sin 0/1/O/I
        $out = '';
        for ($i=0; $i<6; $i++) $out .= $chars[random_int(0, strlen($chars)-1)];
        return $out;
    }

    private function uniqueCode6(int $tries=100): string {
        for ($i=0; $i<$tries; $i++) {
            $code = $this->randomCode6();
            if (!$this->existsInFS($code)) return $code;
        }
        throw new \RuntimeException('No se pudo generar código único');
    }

    private function existsInFS(string $code): bool {
        return file_exists("{$this->CERT_DIR}/{$code}.html")
            || file_exists("{$this->CERT_DIR}/qrs/{$code}.png")
            || file_exists("{$this->CERT_DIR}/pdfs/{$code}.pdf")
            || file_exists("{$this->CERT_DIR}/i/{$code}.png");
    }

    private function renderHtml(string $code, int $alumnoId, int $cursoId, string $fecha, string $qrRelative): string
    {
        $db = \getDB();

        // datos del alumno
        $sa = $db->prepare("SELECT nombre, apellido, dni, empresa_id FROM alumnos WHERE alumno_id=?");
        $sa->execute([$alumnoId]);
        $al = $sa->fetch(\PDO::FETCH_ASSOC) ?: ['nombre'=>'','apellido'=>'','dni'=>'','empresa_id'=>null];
        $sa->closeCursor();

        // nombre de empresa (tabla 'empresa' según tu SP)
        $empNombre = '';
        if (!empty($al['empresa_id'])) {
            $se = $db->prepare("SELECT nombre FROM empresa WHERE empresa_id=?");
            $se->execute([$al['empresa_id']]);
            $empNombre = (string)($se->fetchColumn() ?: '');
            $se->closeCursor();
        }

        // datos del curso
        $sc = $db->prepare("SELECT nombre, categoria, modalidad, horas, descripcion FROM cursos WHERE curso_id=?");
        $sc->execute([$cursoId]);
        $cu = $sc->fetch(\PDO::FETCH_ASSOC) ?: ['nombre'=>'','categoria'=>'','modalidad'=>'','horas'=>'','descripcion'=>''];
        $sc->closeCursor();

        // HTML muy simple; reemplaza por tu plantilla con estilos/imágenes
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
    <p>Otorgado a: <strong><?= htmlspecialchars(trim(($al['nombre']??'').' '.($al['apellido']??''))) ?></strong></p>
    <p>DNI: <?= htmlspecialchars($al['dni'] ?? '') ?> — Empresa: <?= htmlspecialchars($empNombre) ?></p>

    <p>Curso: <strong><?= htmlspecialchars($cu['nombre'] ?? '') ?></strong></p>
    <p>Categoría: <?= htmlspecialchars($cu['categoria'] ?? '') ?> |
       Modalidad: <?= htmlspecialchars($cu['modalidad'] ?? '') ?> |
       Horas: <?= htmlspecialchars($cu['horas'] ?? '') ?></p>

    <p>Descripción: <?= nl2br(htmlspecialchars($cu['descripcion'] ?? '')) ?></p>
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

    private function htmlToPdf(string $html, string $outPath): void
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        file_put_contents($outPath, $dompdf->output());
    }

    private function renderPreviewPng(string $code, string $outPath, string $qrPath): void
    {
        if (!function_exists('imagecreatetruecolor')) return; // si no tienes GD, se salta

        $w=1200; $h=850;
        $im = imagecreatetruecolor($w,$h);
        $white = imagecolorallocate($im,255,255,255);
        $black = imagecolorallocate($im,30,30,30);
        imagefilledrectangle($im,0,0,$w,$h,$white);
        imagestring($im,5,30,30,"Certificado {$code}", $black);

        if (is_file($qrPath)) {
            $qr = imagecreatefrompng($qrPath);
            imagecopyresampled($im,$qr,$w-330,$h-330,0,0,300,300,imagesx($qr),imagesy($qr));
            imagedestroy($qr);
        }
        imagepng($im,$outPath);
        imagedestroy($im);
    }
}
