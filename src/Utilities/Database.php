<?php
function getDB() {
    $host = 'localhost';
    $db   = 'delcorbc_certiperu_intranet';
    $user = 'delcorbc_encore';
    $pass = 'EncoreDP2025$$';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}