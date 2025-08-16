<?php
function obtenerEmpresas($conn) {
    $stmt = $conn->prepare("CALL listar_empresas()");
    if (!$stmt) {
        die("Error al preparar: " . $conn->error);
    }
    if (!$stmt->execute()) {
        die("Error al ejecutar: " . $stmt->error);
    }
    return $stmt->get_result();
}
?>