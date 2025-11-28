<?php
require_once __DIR__ . '/src/auth.php';
requireLogin();
require_once __DIR__ . '/src/db.php';
require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig   = new \Twig\Environment($loader);

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

$pdo = getPDO();
$stmt = $pdo->prepare('SELECT * FROM music_library WHERE id = ?');
$stmt->execute([$id]);
$song = $stmt->fetch();

if (!$song) {
    die('Song not found.');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title          = trim($_POST['title'] ?? '');
    $artist         = trim($_POST['artist'] ?? '');
    $album          = trim($_POST['album'] ?? '');
    $genre          = trim($_POST['genre'] ?? '');
    $year           = (int)($_POST['year'] ?? 0);
    $duration       = trim($_POST['duration'] ?? '');
    $bpm            = (int)($_POST['bpm'] ?? 0);
    $key_signature  = trim($_POST['key_signature'] ?? '');
    $record_label   = trim($_POST['record_label'] ?? '');
    $producer       = trim($_POST['producer'] ?? '');
    $spotify        = (int)($_POST['spotify_streams'] ?? 0);
    $youtube        = (int)($_POST['youtube_views'] ?? 0);

    $spotify_url    = trim($_POST['spotify_url'] ?? '');
    $youtube_url    = trim($_POST['youtube_url'] ?? '');

    if ($title === '' || $artist === '') {
        $errors[] = 'Title and Artist are required.';
    }

    if (!$errors) {
        $sql = "UPDATE music_library SET
                title=?, artist=?, album=?, genre=?, year=?, duration=?, bpm=?,
                key_signature=?, record_label=?, producer=?, 
                spotify_streams=?, youtube_views=?, spotify_url=?, youtube_url=?
                WHERE id=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $title, $artist, $album, $genre, $year, $duration, $bpm,
            $key_signature, $record_label, $producer,
            $spotify, $youtube,
            $spotify_url, $youtube_url,
            $id
        ]);

        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}

echo $twig->render('edit.twig', [
    'song'     => $song,
    'errors'   => $errors,
    'base_url' => BASE_URL
]);
