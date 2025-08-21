<?php
namespace App\Models;

require_once __DIR__ . '/../Utilities/Database.php';

class EmpresaModel {
    private $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function listar() {
        $stmt = $this->db->prepare("CALL listar_empresas()");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertar($nombre, $ruc) {
        $stmt = $this->db->prepare("CALL insertar_empresa(?, ?)");
        return $stmt->execute([$nombre, $ruc]);
    }

    public function editar($id, $nombre, $ruc) {
        $stmt = $this->db->prepare("CALL editar_empresa(?, ?, ?)");
        return $stmt->execute([$id, $nombre, $ruc]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("CALL eliminar_empresa(?)");
        return $stmt->execute([$id]);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM empresa WHERE empresa_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}