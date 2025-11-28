<?php
require_once __DIR__ . '/../src/bootstrap.php';

echo $twig->render('test.twig', [
    'song' => [
        'title' => 'Bohemian Rhapsody',
        'artist' => 'Queen'
    ],
    'songs' => [
        ['title' => 'Song 1', 'artist' => 'Artist A'],
        ['title' => 'Song 2', 'artist' => 'Artist B'],
        ['title' => 'Song 3', 'artist' => 'Artist C']
    ]
]);
?>
