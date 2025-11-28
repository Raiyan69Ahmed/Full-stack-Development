<?php
require_once __DIR__ . '/../src/bootstrap.php';

// PASS TEST DATA to verify rendering
echo $twig->render('index.twig', [
    'songs' => [
        [
            'id' => 1,
            'title' => 'Test Song',
            'artist' => 'Test Artist',
            'album' => 'Test Album',
            'genre' => 'Rock',
            'year' => '2024',
            'duration' => '03:45',
            'producer' => 'Producer Name',
            'spotify_streams' => '1000000',
            'youtube_views' => '5000000'
        ]
    ]
]);
