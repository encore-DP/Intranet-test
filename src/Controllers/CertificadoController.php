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
    private string $certDir; // carpeta física de archivos
    private string $certUrl; // URL pública base a esa carpeta

    public function __construct()
    {
        // Carpeta pública PARA ARCHIVOS (no chocar con rutas Slim)
        $this->certDir = __DIR__ . '/../../public/CERTIF';
        $this->certUrl = '/CERTIF';

        foreach (['qrs','pdfs','i','img','css'] as $d) {
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

        // Normalizar arrays para la vista del formulario
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

        // 2) Archivos y rutas
        $htmlFile = "{$code}.html";      // página pública
        $qrFile   = "qrs/{$code}.png";   // PNG requerido por FPDI
        $pdfFile  = "pdfs/{$code}.pdf";
        $prevFile = "img/{$code}.png";   // preview opcional

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

        // 4) Datos desde BD
        $db = \getDB();

        $sa = $db->prepare("
            SELECT a.nombre, a.apellido, a.dni, e.nombre AS empresa
            FROM alumnos a
            LEFT JOIN empresa e ON e.empresa_id = a.empresa_id
            WHERE a.alumno_id = ?
        ");
        $sa->execute([$alumnoId]);
        $al = $sa->fetch(\PDO::FETCH_ASSOC) ?: ['nombre'=>'','apellido'=>'','dni'=>'','empresa'=>''];
        $sa->closeCursor();

        $sc = $db->prepare("SELECT nombre, descripcion FROM cursos WHERE curso_id = ?");
        $sc->execute([$cursoId]);
        $cu = $sc->fetch(\PDO::FETCH_ASSOC) ?: ['nombre'=>'','descripcion'=>''];
        $sc->closeCursor();

        // 5) Generar QR (PNG). Si no hay GD, pasamos a SVG y usaremos DOMPDF como fallback.
        $qr = \Endroid\QrCode\QrCode::create($certUrl)->setSize(300)->setMargin(10);
        $qrIsPng = false;
        if (extension_loaded('gd')) {
            (new \Endroid\QrCode\Writer\PngWriter())->write($qr)->saveToFile($qrPath);
            $qrIsPng = true;
        } else {
            $qrFile = "qrs/{$code}.svg";
            $qrPath = "{$this->certDir}/{$qrFile}";
            $qrUrl  = "{$baseFilesUrl}/{$qrFile}";
            (new \Endroid\QrCode\Writer\SvgWriter())->write($qr)->saveToFile($qrPath);
        }

        // 6) Variables para plantillas
        $vars = [
            'code'     => $code,
            'fecha'    => $fecha,
            'qrFile'   => $qrFile,
            'qrUrl'    => $qrUrl,
            'pdfUrl'   => $pdfUrl,
            'certUrl'  => $certUrl,
            'alumno'   => $al,
            'curso'    => $cu,
            'hostAbs'  => $host,
            'certBase' => rtrim($this->certUrl,'/'), // /CERT-FILES
        ];

        // 7) Página pública (tu plantilla web)
        $htmlPage = $this->renderPageHtml($vars);
        file_put_contents($htmlPath, $htmlPage);

        // 8) PDF POR PLANTILLA (FPDI) — usa public/CERTIF/templates/certificado_template.pdf
        $templatePdf = __DIR__ . '/../../public/CERTIF/templates/certificado_template.pdf';
        if ($qrIsPng && is_file($templatePdf)) {
            // Requiere: composer require setasign/fpdf setasign/fpdi
            $data = [
                'nombre'      => trim(($al['nombre'] ?? '').' '.($al['apellido'] ?? '')),
                'curso'       => $cu['nombre'] ?? '',
                'descripcion' => $cu['descripcion'] ?? '',
                'fecha'       => $fecha,
                'codigo'      => $code,
                'qrAbsPath'   => $qrPath, // PNG
            ];
            $this->generarPdfDesdePlantilla($templatePdf, $pdfPath, $data);
        } else {
            // Fallback DOMPDF (si no hay GD o no hay plantilla)
            @set_time_limit(300);
            $htmlPdf = $this->renderPdfHtml($vars); // tu pdf_template.php
            $opts = new \Dompdf\Options();
            $opts->set('isRemoteEnabled', false);
            $opts->setChroot(realpath(__DIR__ . '/../../public'));
            $dompdf = new \Dompdf\Dompdf($opts);
            $dompdf->loadHtml($htmlPdf, 'UTF-8');
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            file_put_contents($pdfPath, $dompdf->output());
        }

        
        // 9) Preview sin Imagick: GD + plantilla JPG/PNG (no afecta al PDF)
        $tplImage = __DIR__ . '/../../public/CERTIF/templates/certificado_template.jpg'; // o .png

        $previewOk = $this->renderPreviewFromTemplateGD(
            $tplImage,
            $prevPath,
            [
                'nombre'      => trim(($al['nombre'] ?? '').' '.($al['apellido'] ?? '')),
                'curso'       => $cu['nombre'] ?? '',
                'descripcion' => $cu['descripcion'] ?? '',
                'fecha'       => $fecha,
                'codigo'      => $code,
                'qrAbsPath'   => $qrPath, // PNG generado arriba
            ]
        );

        if (!$previewOk || !is_file($prevPath)) {
            $prevUrl  = null;
            $prevFile = null;
        }


        // si no se creó el archivo por cualquier motivo, no guardes URLs inválidas
        if (!is_file($prevPath)) {
            $prevUrl  = null;
            $prevFile = null;
        }


        // 10) Guardar en BD (SP insertar_certificado)
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

        // 11) Redirigir al HTML público del certificado
        return $response->withHeader('Location', $certUrl)->withStatus(302);
    }

/*************************************************
 * PREVIEW PNG usando GD + plantilla de imagen  *
 * No requiere Imagick/Ghostscript               *
 *************************************************/
private function renderPreviewFromTemplateGD(string $bgPath, string $outPath, array $data): bool
{
    if (!extension_loaded('gd')) return false;
    if (!is_file($bgPath))      return false;

    // Cargar fondo (JPG o PNG)
    $ext = strtolower(pathinfo($bgPath, PATHINFO_EXTENSION));
    $im  = ($ext === 'png') ? @imagecreatefrompng($bgPath) : @imagecreatefromjpeg($bgPath);
    if (!$im) return false;

    $W = imagesx($im);
    $H = imagesy($im);

    // Colores
    $cMain = imagecolorallocate($im, 0x44, 0x39, 0x8D); // #44398d
    $cCode = imagecolorallocate($im, 0x1C, 0x29, 0x55); // #1C2955

    // Fuentes TTF (debes tener estos archivos en /public/fonts)
    $fontDir = __DIR__ . '/../../public/fonts/';
    $fReg    = $fontDir . 'Montserrat-Regular.ttf';
    $fMed    = $fontDir . 'Montserrat-Medium.ttf';
    $fBold   = $fontDir . 'Montserrat-Bold.ttf';
    foreach ([$fReg,$fMed,$fBold] as $f) {
        if (!is_file($f)) { imagedestroy($im); return false; }
    }

    // Referencia de tu maqueta 420×297 px (A4 landscape 297×210 mm)
    $PX_W = 420; $PX_H = 297; $MM_W = 297;
    $kx = $W / $PX_W;                   // escala X
    $ky = $H / $PX_H;                   // escala Y
    $pxX = fn($px) => $px * $kx;        // convierte px-maqueta → px reales
    $pxY = fn($px) => $px * $ky;

    // Posiciones coherentes con tu PDF (ajústalas si quieres)
    $NOMBRE_Y_PX   = 110;
    $CURSO_Y_PX    = 145;
    $DESC_Y_PX     = 160;
    $CITY_Y_PX     = 200;
    $MARGIN_SIDE_PX = 65;

    // Código: un poco a la derecha de la mitad y más abajo
    $CODE_OFFSET_RIGHT_PX = 12; // mueve a la derecha desde el centro

    // QR: tamaño exacto 26 mm
    $qrPx = (int) round($W * (26 / $MM_W)); // 26mm * (px/mm en ancho A4)
    $QR_RIGHT_MARGIN_PX  = 65;
    $QR_BOTTOM_MARGIN_PX = 30;

    // Datos
    $nombre = (string)($data['nombre'] ?? '');
    $curso  = (string)($data['curso'] ?? '');
    $desc   = (string)($data['descripcion'] ?? '');
    $codigo = (string)($data['codigo'] ?? '');
    $qrAbs  = (string)($data['qrAbsPath'] ?? '');
    $fecha  = (string)($data['fecha'] ?? '');

    // Fecha larga
    $meses = [1=>'enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
    try { $dt = new \DateTime($fecha);
          $fechaLarga = $dt->format('j').' de '.$meses[(int)$dt->format('n')].' del '.$dt->format('Y');
    } catch (\Throwable $e) { $fechaLarga = $fecha; }

    // Helpers de texto
    $centerLine = function($img, $txt, $size, $font, $y, $color) {
        $bb   = imagettfbbox($size, 0, $font, $txt);
        $tw   = abs($bb[2]-$bb[0]);
        $x    = (imagesx($img) - $tw) / 2;
        imagettftext($img, $size, 0, (int)$x, (int)$y, $color, $font, $txt);
    };
    $wrapCentered = function($img, $txt, $size, $font, $yStart, $lineH, $color, $maxW) {
        $words = preg_split('/\s+/', trim($txt));
        $line=''; $lines=[];
        foreach ($words as $w) {
            $test = trim($line===''? $w : "$line $w");
            $bb = imagettfbbox($size,0,$font,$test);
            if (abs($bb[2]-$bb[0]) <= $maxW) $line=$test;
            else { if($line!=='') $lines[]=$line; $line=$w; }
        }
        if ($line!=='') $lines[]=$line;
        $y=$yStart;
        foreach ($lines as $ln) {
            $bb=imagettfbbox($size,0,$font,$ln);
            $tw=abs($bb[2]-$bb[0]);
            $x=(imagesx($img)-$tw)/2;
            imagettftext($img,$size,0,(int)$x,(int)$y,$color,$font,$ln);
            $y+=$lineH;
        }
    };

    // Ancho de bloque centrado
    $maxBlockW = $W - 2 * $pxX($MARGIN_SIDE_PX);

    // NOMBRE
    $centerLine($im, $nombre, 22, $fMed,  (int)$pxY($NOMBRE_Y_PX), $cMain);

    // CURSO (multilínea)
    $wrapCentered($im, $curso, 24, $fBold, (int)$pxY($CURSO_Y_PX), (int)$pxY(10), $cMain, (int)$maxBlockW);

    // DESCRIPCIÓN
    if (trim($desc) !== '') {
        $wrapCentered($im, $desc, 11, $fReg, (int)$pxY($DESC_Y_PX), (int)$pxY(6),  $cMain, (int)$maxBlockW);
    }

    // “Miraflores, <fecha>”
    $centerLine($im, 'Miraflores, '.$fechaLarga, 12, $fMed, (int)$pxY($CITY_Y_PX), $cMain);

    // Código (ligeramente a la derecha y abajo)
    $codeX = (int) (($W/2) + $pxX($CODE_OFFSET_RIGHT_PX));
    $codeY = (int) ($pxY($CITY_Y_PX) + $pxY(26)); // usa 25.5 si quieres más fino
    imagettftext($im, 8, 0, $codeX, $codeY, $cCode, $fReg, $codigo);

    // QR (26mm x 26mm) esquina inferior derecha
    if (is_file($qrAbs)) {
        $qrImg = @imagecreatefrompng($qrAbs);
        if ($qrImg) {
            $qrX = (int) ($W - $pxX($QR_RIGHT_MARGIN_PX)  - $qrPx);
            $qrY = (int) ($H - $pxY($QR_BOTTOM_MARGIN_PX) - $qrPx);
            $dst = imagecreatetruecolor($qrPx, $qrPx);
            imagealphablending($dst, true);
            imagesavealpha($dst, true);
            imagecopyresampled($dst, $qrImg, 0,0, 0,0, $qrPx,$qrPx, imagesx($qrImg), imagesy($qrImg));
            imagecopy($im, $dst, $qrX, $qrY, 0,0, $qrPx, $qrPx);
            imagedestroy($dst);
            imagedestroy($qrImg);
        }
    }

    // Guardar PNG
    $ok = imagepng($im, $outPath, 6);
    imagedestroy($im);
    return (bool)$ok;
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

    private function generarPdfDesdePlantilla(string $templatePdfPath, string $outPdfPath, array $data): void
    {
        $pdf = new \setasign\Fpdi\Tfpdf\Fpdi('L','mm');

        $pdf->AddPage();
        $pdf->setSourceFile($templatePdfPath);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl, 0, 0, 297);
        // Opcional: evita saltos de página automáticos
        $pdf->SetAutoPageBreak(false);

        // Fuentes TTF (copiadas en vendor/setasign/tfpdf/font/unifont/)
        $pdf->AddFont('Montserrat',         '',  'Montserrat-Regular.ttf',  true);
        $pdf->AddFont('Montserrat',        'B',  'Montserrat-Bold.ttf',     true);
        $pdf->AddFont('Montserrat-Medium',  '',  'Montserrat-Medium.ttf',   true);

        $pdf->SetTextColor(34,34,34);

        // --- Conversión px→mm (maqueta 420×297 px; hoja A4 landscape 297×210 mm) ---
        $PX_W = 420; $PX_H = 297; $MM_W = 297; $MM_H = 210;
        $kx = $MM_W / $PX_W; $ky = $MM_H / $PX_H;
        $mmx = fn($px) => $px * $kx;
        $mmy = fn($px) => $px * $ky;

        // === NUEVAS POSICIONES (en PX de tu maqueta) PARA SUBIR EL CONTENIDO Y CENTRAR ===
        // Sube/baja rápido cambiando estos valores (en px)
        $NOMBRE_Y_PX = 100;  
        $CURSO_Y_PX  = 130; 
        $DESC_Y_PX   = 160; 
        $CITY_Y_PX   = 215; 
        $CITY_X_PX   = 0;   

        // Márgenes laterales para los bloques centrados
        $MARGIN_SIDE_PX = 65;   // margen izquierdo/derecho simétrico

        // === TAMAÑO QR EXACTO 26 mm ===
        $QR_W_MM = 26.0;               // 26 mm de ancho
        $QR_H_MM = 26.0;               // 26 mm de alto
        // *Equivalente aproximado en px sobre 420 px de ancho:* 1 mm ≈ 420/297 ≈ 1.414 px → 26 mm ≈ 36.8 px (~37 px)

        // Posición QR: conservamos tu esquina inferior derecha (ajústalo si deseas)
        $QR_RIGHT_MARGIN_PX  = 65;     // margen derecho
        $QR_BOTTOM_MARGIN_PX = 30;     // margen inferior

        // ---------------------- Datos ----------------------
        $nombre = (string)($data['nombre']      ?? '');
        $curso  = (string)($data['curso']       ?? '');
        $desc   = (string)($data['descripcion'] ?? '');
        $codigo = (string)($data['codigo']      ?? '');
        $qrAbs  = (string)($data['qrAbsPath']   ?? '');
        $fecha  = (string)($data['fecha']       ?? '');

        // Fecha larga en español
        $meses = [1=>'enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
        try {
            $dt = new \DateTime($fecha);
            $fechaLarga = $dt->format('j') . ' de ' . $meses[(int)$dt->format('n')] . ' del ' . $dt->format('Y');
        } catch (\Throwable $e) {
            $fechaLarga = $fecha;
        }

        // Anchos útiles centrados
        $anchoTextoMM = $MM_W - 2 * $mmx($MARGIN_SIDE_PX); // ancho del bloque centrado
        $xCentrado    = ($MM_W - $anchoTextoMM) / 2;       // X para centrar el bloque

        // Evita saltos de página automáticos
        $pdf->SetAutoPageBreak(false);

        // ---------------------- NOMBRE (centrado) ----------------------
        $pdf->SetFont('Montserrat-Medium','',22);
        $pdf->SetTextColor(68, 57, 141); // Color #44398d
        $pdf->SetXY($xCentrado, $mmy($NOMBRE_Y_PX));
        $pdf->Cell($anchoTextoMM, 10, $nombre, 0, 1, 'C');

        // ---------------------- CURSO (centrado) ----------------------
        $pdf->SetFont('Montserrat','B',24);
        $pdf->SetTextColor(68, 57, 141); // Color #44398d
        $pdf->SetXY($xCentrado, $mmy($CURSO_Y_PX));
        $pdf->MultiCell($anchoTextoMM, 10, $curso, 0, 'C');

        // ---------------------- DESCRIPCIÓN (centrado) ----------------------
        if (trim($desc) !== '') {
            $pdf->SetFont('Montserrat','',11);
            $pdf->SetTextColor(68, 57, 141); // Color #44398d
            $TAB_PX = 18;                             // ~1.8 cm de sangría aprox (con tu escala)
            $descX  = $xCentrado + $mmx($TAB_PX);     // desplazamos X hacia la derecha
            $descW  = $anchoTextoMM - $mmx($TAB_PX);  // reducimos el ancho disponible

            $pdf->SetXY($descX, $mmy($DESC_Y_PX));
            // Alineación a la izquierda para lectura tipo párrafo
            $pdf->MultiCell($descW, 6, $desc, 0, 'L');
        }

        // ---------------------- “Miraflores, <fecha>” (centrado) ----------------------
        $pdf->SetFont('Montserrat-Medium','',12);
        $pdf->SetTextColor(68, 57, 141); // Color #44398d
        $pdf->SetXY(0, $mmy($CITY_Y_PX));
        $pdf->Cell($MM_W, 6, 'Miraflores, ' . $fechaLarga, 0, 1, 'C');

        // ---------------------- Código (centrado) ----------------------
        $pdf->SetFont('Montserrat','',8);
        $pdf->SetTextColor(28, 41, 85); // Color #44398d
        $CODE_OFFSET_RIGHT_PX = 39;
        $codeX  = ($MM_W / 2) + $mmx($CODE_OFFSET_RIGHT_PX);  // empieza a la derecha de la mitad
        $codeY  = $mmy($CITY_Y_PX) + 25.5;                              // debajo de la fecha
        $codeW  = $MM_W - $codeX - $mmx(100);                         // deja 20px de margen derecho 
        $pdf->SetXY($codeX, $codeY);
        $pdf->Cell($codeW, 5, $codigo, 0, 1, 'L');

        // ---------------------- QR (26 mm × 26 mm) ----------------------
        if ($qrAbs !== '') {
            $qrPath = str_replace('\\','/',$qrAbs);
            if (is_file($qrPath)) {
                $qrX = $MM_W - $mmx($QR_RIGHT_MARGIN_PX) - $QR_W_MM;
                $qrY = $MM_H - $mmy($QR_BOTTOM_MARGIN_PX) - $QR_H_MM;
                $pdf->Image($qrPath, $qrX, $qrY, $QR_W_MM, $QR_H_MM);
            }
        }        $pdf->Output('F', $outPdfPath);
    }

 


    /* ===== Helpers ===== */

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
            || file_exists("{$this->certDir}/i/{$code}.png")
            || file_exists("{$this->certDir}/img/{$code}.jpg");
    }

    private function uniqueCode6(int $maxTries=120): string
    {
        $m = new CertificadoModel();
        for ($i=0;$i<$maxTries;$i++) {
            $c = $this->randomCode6();
            if ($this->codeExistsInFs($c)) continue;
            // si tienes UNIQUE en BD, también puedes consultar:
            // if ($m->existeCodigo($c)) continue;
            return $c;
        }
        throw new \RuntimeException('No se pudo generar código único');
    }

    /** Renderiza la página pública con tu plantilla */
    private function renderPageHtml(array $vars): string
    {
        extract($vars, EXTR_SKIP);
        ob_start();
        include __DIR__ . '/../Views/certificados/page_template.php';
        return ob_get_clean();
    }

    /** Render para PDF: reusa la misma plantilla o crea pdf_template.php */
    private function renderPdfHtml(array $vars): string
    {
        // Si ya creaste un template PDF con fondo/diseño: inclúyelo aquí
        // include __DIR__ . '/../Views/certificados/pdf_template.php';
        // De momento, reutilizamos la misma página pública
        return $this->renderPageHtml($vars);
    }

    private function renderPreviewFromPdf(string $pdfPath, string $outPath, int $width = 1024): bool
    {
        // Requiere la extensión php_imagick habilitada y Ghostscript instalado
        if (!class_exists(\Imagick::class)) {
            return false;
        }
        try {
            $im = new \Imagick();
            $im->setResolution(220, 220);        // nitidez
            $im->readImage($pdfPath . '[0]');    // 1ª página
            $im->setImageFormat('png');
            $im->resizeImage($width, 0, \Imagick::FILTER_LANCZOS, 1);
            $im->setImageBackgroundColor('white');
            $im = $im->mergeImageLayers(\Imagick::LAYERMETHOD_FLATTEN);
            $im->writeImage($outPath);
            $im->clear();
            $im->destroy();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function renderPreviewPng(string $code, string $outPath, string $qrPath): void
    {
        if (!extension_loaded('gd')) return;

        $w=1200; $h=850;
        $im = imagecreatetruecolor($w,$h);
        $white = imagecolorallocate($im,255,255,255);
        $txt   = imagecolorallocate($im,30,30,30);
        imagefilledrectangle($im,0,0,$w,$h,$white);
        imagestring($im,5,30,30,"Vista previa: {$code}", $txt);

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
