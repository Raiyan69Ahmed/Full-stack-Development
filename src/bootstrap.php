<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../vendor/Autoloader.php';


Twig_Autoloader::register();


$loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');


$twig = new Twig_Environment($loader, [
    'cache' => false, 
    'debug' => true
]);
?>
