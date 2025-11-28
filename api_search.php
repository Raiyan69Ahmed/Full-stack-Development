<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/db.php';

header('Content-Type: application/json');


$term = $_GET['term'] ?? '';

if (strlen($term) < 2) {
    echo json_encode([]);
    exit;
}


$query = $pdo->prepare("
    SELECT id, title, artist 
    FROM music_library 
    WHERE title LIKE :term OR artist LIKE :term 
    LIMIT 10
");
$query->execute(['term' => "%$term%"]);
$results = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
