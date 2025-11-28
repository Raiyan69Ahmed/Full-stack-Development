<?php
// public/debug.php
require_once __DIR__ . '/../src/bootstrap.php';

try {
    $twig = TwigEnvironment::getTwig();
    echo "✅ Twig loaded successfully!<br>";
    
    // Test template rendering
    $testOutput = $twig->render('index.twig', [
        'title' => 'Debug Test',
        'music' => [],
        'is_logged_in' => false,
        'username' => '',
        'site_name' => 'Music Library',
        'current_page' => 'debug.php'
    ]);
    
    echo "✅ Template rendered successfully!<br>";
    echo "Twig object: " . get_class($twig) . "<br>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
    echo "Stack trace: " . $e->getTraceAsString() . "<br>";
}