<?php
// public/test-complete.php

echo "<h1>Complete System Test</h1>";

// Test 1: Session
echo "<h2>Test 1: Session</h2>";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['test'] = 'session_works';
echo "✅ Session started<br>";

// Test 2: Autoloader
echo "<h2>Test 2: Autoloader</h2>";
require_once __DIR__ . '/../vendor/autoload.php';
echo "✅ Autoloader loaded<br>";

// Test 3: Database
echo "<h2>Test 3: Database</h2>";
require_once __DIR__ . '/../src/db.php';
try {
    $db_test = testDatabaseConnection();
    echo $db_test . "<br>";
} catch (Exception $e) {
    echo "❌ Database test failed: " . $e->getMessage() . "<br>";
}

// Test 4: Twig
echo "<h2>Test 4: Twig</h2>";
require_once __DIR__ . '/../src/bootstrap.php';
try {
    $twig = TwigEnvironment::getTwig();
    echo "✅ Twig loaded successfully!<br>";
    
    // Test template
    $result = $twig->render('test.twig', [
        'title' => 'System Test',
        'message' => 'All systems working!',
        'is_logged_in' => true,
        'username' => 'Test User'
    ]);
    echo "✅ Template rendered successfully!<br>";
    
} catch (Exception $e) {
    echo "❌ Twig test failed: " . $e->getMessage() . "<br>";
}

// Test 5: Database Setup (Optional)
echo "<h2>Test 5: Database Setup</h2>";
echo "<p><a href='setup.php'>Click here to setup database</a> (run this once)</p>";

echo "<h2 style='color: green;'>All tests completed!</h2>";