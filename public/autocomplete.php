<?php
require_once __DIR__ . '/../src/db.php';

header('Content-Type: application/json');

$q = trim(filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING) ?? '');
$field = $_GET['field'] ?? 'title';

$allowed = ['title', 'artist', 'genre'];
if (!in_array($field, $allowed, true)) {
    $field = 'title';
}

if ($q === '') {
    echo json_encode([]);
    exit;
}

$pdo = getPDO();
$sql = "SELECT DISTINCT $field FROM songs WHERE $field LIKE ? LIMIT 10";
$stmt = $pdo->prepare($sql);
$stmt->execute(["%$q%"]);
$data = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($data);
