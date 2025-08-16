<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../models/empresasModel.php';

function listarEmpresas() {
    global $conn;
    $res = obtenerEmpresas($conn);
    if (!$res) {
        die("Error en la consulta de empresas");
    }
    return $res;
}
?>