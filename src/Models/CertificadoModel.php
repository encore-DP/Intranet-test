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
    public function listar(): array {
        // 1) Intento con SP
        $rows = [];
        try {
            $stmt = $this->db->prepare("CALL listar_certificados()");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        
            // Drenar posibles result sets adicionales que a veces deja MySQL al usar CALL
            while ($stmt->nextRowset()) { /* no-op, solo drenar */ }
        
            $stmt->closeCursor();
        } catch (\PDOException $e) {
            // Si el SP fallara por cualquier razón, pasamos al fallback
            $rows = [];
        }
    
        // 2) Fallback directo si el SP devolvió vacío o falló
        if (empty($rows)) {
            $sql = "
                SELECT 
                    cert.id,
                    cert.codigo_unico,
                    cert.fecha_emision,
                    a.nombre AS alumno_nombre,
                    a.apellido AS alumno_apellido,
                    a.dni,
                    c.nombre AS curso_nombre,
                    e.nombre AS empresa_nombre,
                    cert.certificado_url
                FROM certificados cert
                INNER JOIN alumnos a ON cert.alumno_id = a.alumno_id
                INNER JOIN cursos  c ON cert.curso_id  = c.curso_id
                INNER JOIN empresa e ON a.empresa_id  = e.empresa_id
                ORDER BY cert.id DESC
            ";
            $q = $this->db->query($sql);
            $rows = $q->fetchAll(PDO::FETCH_ASSOC) ?: [];
            $q->closeCursor();
        }
    
        // 3) Normalización para la vista
        foreach ($rows as &$r) {
            $r['alumno_completo'] = trim(($r['alumno_nombre'] ?? '') . ' ' . ($r['alumno_apellido'] ?? ''));
        
            // Si tu SP/tabla no trae la URL, la reconstruimos
            if (empty($r['certificado_url']) && !empty($r['codigo_unico'])) {
                // Ajusta si tu carpeta pública es otra
                $r['certificado_url'] = '/CERTIF/' . $r['codigo_unico'] . '.html';
            }
        }
        unset($r);
    
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
