DELIMITER $$
CREATE PROCEDURE listar_empresas()
BEGIN
    SELECT * FROM empresa ORDER BY empresa_id DESC;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insertar_empresa(IN p_nombre VARCHAR(250), IN p_ruc VARCHAR(13))
BEGIN
    INSERT INTO empresa (nombre, RUC) VALUES (p_nombre, p_ruc);
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE editar_empresa(IN p_id INT, IN p_nombre VARCHAR(250), IN p_ruc VARCHAR(13))
BEGIN
    UPDATE empresa
    SET nombre = p_nombre, RUC = p_ruc
    WHERE empresa_id = p_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE eliminar_empresa(IN p_id INT)
BEGIN
    DELETE FROM empresa WHERE empresa_id = p_id;
END$$
DELIMITER ;
