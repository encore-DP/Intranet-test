-- Listar todos los alumnos con su empresa
DELIMITER $$
CREATE PROCEDURE listar_alumnos()
BEGIN
    SELECT a.alumno_id, a.dni, a.nombre, a.apellido, e.nombre AS empresa
    FROM alumnos a
    INNER JOIN empresa e ON a.empresa_id = e.empresa_id
    ORDER BY a.alumno_id DESC;
END$$
DELIMITER ;

-- Insertar nuevo alumno
DELIMITER $$
CREATE PROCEDURE insertar_alumno(
    IN p_dni VARCHAR(8),
    IN p_nombre VARCHAR(100),
    IN p_apellido VARCHAR(100),
    IN p_empresa_id INT
)
BEGIN
    INSERT INTO alumnos (dni, nombre, apellido, empresa_id)
    VALUES (p_dni, p_nombre, p_apellido, p_empresa_id);
END$$
DELIMITER ;

-- Editar alumno
DELIMITER $$
CREATE PROCEDURE editar_alumno(
    IN p_id INT,
    IN p_dni VARCHAR(8),
    IN p_nombre VARCHAR(100),
    IN p_apellido VARCHAR(100),
    IN p_empresa_id INT
)
BEGIN
    UPDATE alumnos
    SET dni = p_dni,
        nombre = p_nombre,
        apellido = p_apellido,
        empresa_id = p_empresa_id
    WHERE alumno_id = p_id;
END$$
DELIMITER ;

-- Eliminar alumno
DELIMITER $$
CREATE PROCEDURE eliminar_alumno(IN p_id INT)
BEGIN
    DELETE FROM alumnos WHERE alumno_id = p_id;
END$$
DELIMITER ;