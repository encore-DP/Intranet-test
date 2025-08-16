DELIMITER $$
CREATE PROCEDURE listar_certificados()
BEGIN
    SELECT cert.id, cert.codigo_unico, cert.fecha_emision,
           a.nombre AS alumno_nombre, a.apellido AS alumno_apellido, a.dni,
           c.nombre AS curso_nombre, e.nombre AS empresa_nombre
    FROM certificados cert
    INNER JOIN alumnos a ON cert.alumno_id = a.alumno_id
    INNER JOIN cursos c ON cert.curso_id = c.curso_id
    INNER JOIN empresa e ON a.empresa_id = e.empresa_id
    ORDER BY cert.id DESC;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insertar_certificado(
    IN p_alumno_id INT,
    IN p_curso_id INT,
    IN p_codigo_unico VARCHAR(6),
    IN p_qr_url TEXT,
    IN p_qr_file TEXT,
    IN p_pdf_url TEXT,
    IN p_pdf_file TEXT,
    IN p_preview_url TEXT,
    IN p_preview_file TEXT,
    IN p_certificado_url TEXT,
    IN p_fecha_emision DATE
)
BEGIN
    INSERT INTO certificados (
        alumno_id, curso_id, codigo_unico,
        qr_url, qr_file, pdf_url, pdf_file,
        preview_url, preview_file, certificado_url, fecha_emision
    )
    VALUES (
        p_alumno_id, p_curso_id, p_codigo_unico,
        p_qr_url, p_qr_file, p_pdf_url, p_pdf_file,
        p_preview_url, p_preview_file, p_certificado_url, p_fecha_emision
    );
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE eliminar_certificado(IN p_id INT)
BEGIN
    DELETE FROM certificados WHERE id = p_id;
END$$
DELIMITER ;
