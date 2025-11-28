<?php
require_once __DIR__ . '/../src/db.php';

$stmt = $pdo->query("SELECT * FROM music_library");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($data);
echo "</pre>";
?>
