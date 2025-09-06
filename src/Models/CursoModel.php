<?php
namespace App\Models;

require_once __DIR__ . '/../Utilities/Database.php';

class CursoModel {
    private $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function listarCategorias(): array {
        $stmt = $this->db->query("SELECT categoria_id, nombre FROM categorias_cursos ORDER BY nombre");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function listar() {
        $stmt = $this->db->prepare("CALL listar_cursos()");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertar(int $categoriaId, string $nombre, string $modalidad, int $horas, string $descripcion): bool {
        $stmt = $this->db->prepare("CALL insertar_curso(?, ?, ?, ?, ?)");
        $ok = $stmt->execute([$categoriaId, $nombre, $modalidad, $horas, $descripcion]);
        while ($stmt->nextRowset()) { /* noop */ }
        $stmt->closeCursor();
        return $ok;
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
