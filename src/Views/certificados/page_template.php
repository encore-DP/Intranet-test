<?php
/**
 * Variables disponibles:
 * $code, $alumno (nombre, apellido), $curso (nombre, descripcion),
 * $pdfUrl (absoluta), $hostAbs (http(s)://host), $certBase (/CERT-FILES),
 * $fecha (YYYY-MM-DD), $qrUrl (opcional si lo quieres mostrar).
 *
 * Preview: por defecto usamos /CERT-FILES/i/CODIGO.png
 * Si decides generar JPG en /CERT-FILES/img/CODIGO.jpg, cambia la línea $previewAbs.
 */
$cssAbs     = $hostAbs . $certBase . '/css/style.css';
$previewAbs = $hostAbs . $certBase . '/img/' . $code . '.png';         // PNG por defecto
// $previewAbs = $hostAbs . $certBase . '/img/' . $code . '.jpg';    // <- usa esta si grabas JPG
$nombreCompleto = trim(($alumno['nombre'] ?? '') . ' ' . ($alumno['apellido'] ?? ''));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Certificado - <?= htmlspecialchars($nombreCompleto) ?></title>
    <link rel="stylesheet" href="<?= htmlspecialchars($cssAbs) ?>" />
</head>
<body>
<div class="contenedor">
    <h1>Certificado de Finalización</h1>

    <p class="mensaje">Este certificado acredita que:</p>
    <h2><?= htmlspecialchars($nombreCompleto) ?></h2>

    <p>Ha completado satisfactoriamente el curso de:</p>
    <h3><?= htmlspecialchars($curso['nombre'] ?? '') ?></h3>

    <p class="autentico">✅ Este certificado es auténtico y puede verificarse digitalmente.</p>

    <div class="certificado-imagen">
        <img src="<?= htmlspecialchars($previewAbs) ?>" alt="Certificado" />
    </div>

    <a href="<?= htmlspecialchars($pdfUrl) ?>" class="boton-descargar" download>
        Descargar Certificado (PDF)
    </a>
</div>
</body>
</html>
