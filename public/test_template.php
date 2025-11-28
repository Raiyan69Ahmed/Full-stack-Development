<?php
require_once __DIR__ . '/../src/bootstrap.php';

echo $twig->render('index.twig', ['songs' => []]);
