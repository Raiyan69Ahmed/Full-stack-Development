<?php
// public/setup.php

require_once __DIR__ . '/../src/setup_database.php';

echo "<h1>Database Setup</h1>";

echo "<h2>Step 1: Testing Database Connection</h2>";
echo testDatabaseConnection() . "<br>";

echo "<h2>Step 2: Creating Music Table</h2>";
echo createMusicTable() . "<br>";

echo "<h2>Step 3: Inserting Sample Data</h2>";
echo insertSampleData() . "<br>";

echo "<h2 style='color: green;'>Setup Complete!</h2>";
echo "<p><a href='index.php'>Go to Music Library</a></p>";