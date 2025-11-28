<?php
require_once __DIR__ . '/vendor/autoload.php';

echo "<pre>";

echo "Checking Environment: ";
echo class_exists('\Twig\Environment') ? "FOUND\n" : "NOT FOUND\n";

echo "Checking FilesystemLoader: ";
echo class_exists('\Twig\Loader\FilesystemLoader') ? "FOUND\n" : "NOT FOUND\n";
