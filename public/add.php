<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/auth.php';

// Protect page
requireLogin();

$pdo = getPDO();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title'] ?? '');
    $artist = trim($_POST['artist'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $year = trim($_POST['year'] ?? '');

    if (!$title || !$artist || !$genre || !$year) {
        $error = "All fields are required!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO music_library (title, artist, genre, year) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $artist, $genre, $year]);
        $success = "Song added successfully!";
    }
}

echo $twig->render('add.twig', [
    'error' => $error,
    'success' => $success
]);
?>
