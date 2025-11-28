<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/auth.php';

// Protect page
requireLogin();

$pdo = getPDO();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM music_library WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>
