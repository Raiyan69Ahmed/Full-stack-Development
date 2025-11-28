<?php
require_once __DIR__ . '/../src/db.php';

header('Content-Type: application/json');

$title  = trim(filter_input(INPUT_GET, 'title',  FILTER_SANITIZE_STRING) ?? '');
$artist = trim(filter_input(INPUT_GET, 'artist', FILTER_SANITIZE_STRING) ?? '');

$pdo = getPDO();

$sql = "SELECT id, title, artist, album, genre, year, duration FROM songs WHERE 1=1";
$params = [];

if ($title !== '') {
    $sql .= " AND title LIKE ?";
    $params[] = "%$title%";
}
if ($artist !== '') {
    $sql .= " AND artist LIKE ?";
    $params[] = "%$artist%";
}

$sql .= " ORDER BY created_at DESC LIMIT 50";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

echo json_encode($stmt->fetchAll());
