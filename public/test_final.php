<?php
// public/test-final.php

echo "<h1>🧪 Final Twig Test</h1>";

try {
    require_once __DIR__ . '/../src/bootstrap.php';
    
    $twig = TwigEnvironment::getTwig();
    echo "✅ Twig loaded successfully!<br>";
    
    // Simple test data
    $testData = [
        'songs' => [
            ['id' => 1, 'title' => 'Test Song 1', 'artist' => 'Artist 1', 'genre' => 'Pop', 'year' => 2023],
            ['id' => 2, 'title' => 'Test Song 2', 'artist' => 'Artist 2', 'genre' => 'Rock', 'year' => 2022]
        ],
        'title' => 'Test Page',
        'is_logged_in' => true,
        'username' => 'testuser',
        'site_name' => 'Music Library',
        'current_page' => 'test.php'
    ];
    
    $output = $twig->render('index.twig', $testData);
    echo "✅ Template rendered successfully!<br>";
    
    echo "<h2>Output Preview:</h2>";
    echo "<div style='border: 1px solid green; padding: 10px; background: #f0f8f0;'>";
    echo $output;
    echo "</div>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
    echo "<pre>Stack trace:\n" . $e->getTraceAsString() . "</pre>";
}