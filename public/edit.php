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
$error = '';
$success = '';

$stmt = $pdo->prepare("SELECT * FROM music_library WHERE id = ?");
$stmt->execute([$id]);
$song = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$song) {
    die("Song not found!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title'] ?? '');
    $artist = trim($_POST['artist'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $year = trim($_POST['year'] ?? '');

    if (!$title || !$artist || !$genre || !$year) {
        $error = "All fields are required!";
    } else {
        $stmt = $pdo->prepare("UPDATE music_library SET title=?, artist=?, genre=?, year=? WHERE id=?");
        $stmt->execute([$title, $artist, $genre, $year, $id]);
        $success = "Song updated successfully!";
    }
}

echo $twig->render('edit.twig', [
    'song' => $song,
    'error' => $error,
    'success' => $success
]);
?>
