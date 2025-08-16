<?php
namespace App\Models;

require_once __DIR__ . '/../Utilities/Database.php';

class AlumnoModel {
    private $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function listar() {
        $stmt = $this->db->prepare("CALL listar_alumnos()");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertar($dni, $nombre, $apellido, $empresa_id) {
        $stmt = $this->db->prepare("CALL insertar_alumno(?, ?, ?, ?)");
        return $stmt->execute([$dni, $nombre, $apellido, $empresa_id]);
    }

    public function editar($id, $dni, $nombre, $apellido, $empresa_id) {
        $stmt = $this->db->prepare("CALL editar_alumno(?, ?, ?, ?, ?)");
        return $stmt->execute([$id, $dni, $nombre, $apellido, $empresa_id]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("CALL eliminar_alumno(?)");
        return $stmt->execute([$id]);
    }

    public function buscarPorId($id) {
    $stmt = $this->db->prepare("SELECT * FROM alumnos WHERE alumno_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}
