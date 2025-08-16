<?php
function getDB() {
    $host = 'localhost';
    $db   = 'delcorbc_certiperu_intranet';
    $user = 'delcorbc_encore';
    $pass = 'EncoreDP2025$$';

    // Charset recomendado
    $charset = 'utf8mb4';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        // Ayuda en algunos hosts antiguos
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset"
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        // Si el host no soporta utf8mb4 (MySQL/MariaDB muy antiguo), reintenta con utf8
        if ((int)$e->getCode() === 2019 || stripos($e->getMessage(), 'character set') !== false) {
            $charset = 'utf8';
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES $charset";
            return new PDO($dsn, $user, $pass, $options);
        }
        throw $e;
    }
}
