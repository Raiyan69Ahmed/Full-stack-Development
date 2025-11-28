<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/db.php';

$songs = getAllSongs();

echo $twig->render('index.twig', [
    'songs' => $songs
]);
?>
