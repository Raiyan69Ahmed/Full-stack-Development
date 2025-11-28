<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../vendor/autoload.php';


$dsn = "mysql:host=mi-linux.wlv.ac.uk;dbname=db2414241;charset=utf8";


try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function getPDO() {
    global $pdo;
    return $pdo;
}
