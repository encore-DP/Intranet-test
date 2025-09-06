<?php
namespace App\Models;

use PDO;

require_once __DIR__ . '/../Utilities/Database.php';

class EmpresaModel {
    private PDO $db;

    public function __construct() {
        $this->db = \getDB();
    }

    /** Devuelve solo lo necesario para poblar selects */
    public function listar(): array {
        $stmt = $this->db->prepare("CALL listar_empresas()");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); // IMPORTANTE cuando usas CALL
        return $rows;
    }

    public function insertar(string $nombre, ?string $ruc): bool {
        $stmt = $this->db->prepare("CALL insertar_empresa(?, ?)");
        $ok = $stmt->execute([$nombre, $ruc]);
        $stmt->closeCursor();
        return $ok;
    }
    

    public function editar(int $id, string $nombre, ?string $ruc): bool {
        $stmt = $this->db->prepare("CALL editar_empresa(?, ?, ?)");
        $ok = $stmt->execute([$id, $nombre, $ruc]);
        $stmt->closeCursor();
        return $ok;
    }

    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("CALL eliminar_empresa(?)");
        $ok = $stmt->execute([$id]);
        $stmt->closeCursor();
        return $ok;
    }

    public function buscarPorId(int $id): ?array {
        // Ojo: si tu tabla real es "empresas", cambia el nombre aquí
        $stmt = $this->db->prepare("SELECT empresa_id, nombre, RUC FROM empresas WHERE empresa_id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $row ?: null;
    }
}
