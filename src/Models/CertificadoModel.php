<?php
declare(strict_types=1);

namespace App\Models;

use PDO;

require_once __DIR__ . '/../Utilities/Database.php';

class CertificadoModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = \getDB();
    }

    /** SP: listar_certificados() */
    public function listar(): array
    {
        $st = $this->db->prepare("CALL listar_certificados()");
        $st->execute();
        $rows = $st->fetchAll(PDO::FETCH_ASSOC);
        $st->closeCursor();
        return $rows;
    }

    /** SP: insertar_certificado(11 params) */
    public function insertar(
        int $alumnoId,
        int $cursoId,
        string $codigoUnico,
        string $qrUrl,
        string $qrFile,
        string $pdfUrl,
        string $pdfFile,
        ?string $previewUrl,
        ?string $previewFile,
        string $certificadoUrl,
        string $fechaEmision
    ): bool {
        $sql = "CALL insertar_certificado(?,?,?,?,?,?,?,?,?,?,?)";
        $st = $this->db->prepare($sql);
        $ok = $st->execute([
            $alumnoId, $cursoId, $codigoUnico,
            $qrUrl, $qrFile,
            $pdfUrl, $pdfFile,
            $previewUrl, $previewFile,
            $certificadoUrl, $fechaEmision
        ]);
        $st->closeCursor();
        return $ok;
    }

    /** SP: eliminar_certificado(id) */
    public function eliminar(int $id): bool
    {
        $st = $this->db->prepare("CALL eliminar_certificado(?)");
        $ok = $st->execute([$id]);
        $st->closeCursor();
        return $ok;
    }

    /** (opcional) validar código en BD si tienes UNIQUE */
    public function existeCodigo(string $codigo): bool
    {
        $st = $this->db->prepare("SELECT 1 FROM certificados WHERE codigo_unico = ? LIMIT 1");
        $st->execute([$codigo]);
        $exists = (bool)$st->fetchColumn();
        $st->closeCursor();
        return $exists;
    }
}
