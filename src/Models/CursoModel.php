<?php
namespace App\Models;

require_once __DIR__ . '/../Utilities/Database.php';

class CursoModel {
    private $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function listar() {
        $stmt = $this->db->prepare("CALL listar_cursos()");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertar($categoria_id, $nombre, $modalidad, $horas, $descripcion) {
        $stmt = $this->db->prepare("CALL insertar_curso(?, ?, ?, ?, ?)");
        return $stmt->execute([$categoria_id, $nombre, $modalidad, $horas, $descripcion]);
    }

    public function editar($id, $categoria_id, $nombre, $modalidad, $horas, $descripcion) {
        $stmt = $this->db->prepare("CALL editar_curso(?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$id, $categoria_id, $nombre, $modalidad, $horas, $descripcion]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("CALL eliminar_curso(?)");
        return $stmt->execute([$id]);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM cursos WHERE curso_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
