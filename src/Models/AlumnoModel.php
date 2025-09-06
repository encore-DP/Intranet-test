<?php
namespace App\Models;

use PDO;

require_once __DIR__ . '/../Utilities/Database.php';

class AlumnoModel {
    private PDO $db;

    public function __construct() {
        $this->db = \getDB();
    }

    /** Listar alumnos con su empresa */
    public function listar(): array {
        $stmt = $this->db->prepare("CALL listar_alumnos()");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); // importante cuando usas CALL
        return $rows;
    }

    /** Buscar alumno por ID (para editar) */
    public function buscarPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT alumno_id, dni, nombre, apellido, empresa_id
                                    FROM alumnos
                                    WHERE alumno_id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $row ?: null;
    }

    /** Insertar nuevo alumno */
    public function insertar(string $dni, string $nombre, string $apellido, int $empresa_id): bool {
        $stmt = $this->db->prepare("CALL insertar_alumno(?, ?, ?, ?)");
        $ok = $stmt->execute([$dni, $nombre, $apellido, $empresa_id]);
        $stmt->closeCursor();
        return $ok;
    }

    /** Editar alumno */
    public function editar(int $id, string $dni, string $nombre, string $apellido, int $empresaId): bool {
        $stmt = $this->db->prepare("CALL editar_alumno(?, ?, ?, ?, ?)");
        $ok   = $stmt->execute([$id, $dni, $nombre, $apellido, $empresaId]);
        $stmt->closeCursor();
        return $ok;
    }

    /** Eliminar alumno */
    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("CALL eliminar_alumno(?)");
        $ok   = $stmt->execute([$id]);
        $stmt->closeCursor();
        return $ok;
    }
}
