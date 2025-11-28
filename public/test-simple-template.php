<?php
// public/test-simple-template.php

echo "<h1>🧪 Testing Simple Template System</h1>";

try {
    require_once __DIR__ . '/../src/bootstrap.php';
    echo "✅ Bootstrap loaded successfully!<br>";
    
    $template = TemplateEngine::getTemplate();
    echo "✅ Template engine loaded successfully!<br>";
    
    $output = $template->render('test.php', [
        'title' => 'Test Page',
        'message' => 'Hello from Simple Template!',
        'username' => 'Test User'
    ]);
    
    echo "✅ Template rendered successfully!<br>";
    echo "<h2>Output Preview:</h2>";
    echo "<div style='border: 1px solid #ccc; padding: 10px; background: #f9f9f9;'>";
    echo $output;
    echo "</div>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}