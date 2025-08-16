DELIMITER $$
CREATE PROCEDURE listar_cursos()
BEGIN
    SELECT c.curso_id, c.nombre, c.modalidad, c.horas, c.descripcion, cat.nombre AS categoria
    FROM cursos c
    INNER JOIN categorias_cursos cat ON c.categoria_id = cat.categoria_id
    ORDER BY c.curso_id DESC;

END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insertar_curso(
    IN p_categoria_id INT,
    IN p_nombre VARCHAR(550),
    IN p_modalidad VARCHAR(50),
    IN p_horas INT,
    IN p_descripcion TEXT
)
BEGIN
    INSERT INTO cursos (categoria_id, nombre, modalidad, horas, descripcion)
    VALUES (p_categoria_id, p_nombre, p_modalidad, p_horas, p_descripcion);
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE editar_curso(
    IN p_id INT,
    IN p_categoria_id INT,
    IN p_nombre VARCHAR(550),
    IN p_modalidad VARCHAR(50),
    IN p_horas INT,
    IN p_descripcion TEXT
)
BEGIN
    UPDATE cursos
    SET categoria_id = p_categoria_id,
        nombre = p_nombre,
        modalidad = p_modalidad,
        horas = p_horas,
        descripcion = p_descripcion
    WHERE curso_id = p_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE eliminar_curso(IN p_id INT)
BEGIN
    DELETE FROM cursos WHERE curso_id = p_id;
END$$
DELIMITER ;
