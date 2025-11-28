<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/auth.php';
require_once __DIR__ . '/src/db.php';


$pdo = getPDO();


$search_title = $_GET['title'] ?? '';
$search_artist = $_GET['artist'] ?? '';
$search_genre = $_GET['genre'] ?? '';
$search_year = $_GET['year'] ?? '';


$sql = "SELECT * FROM music_library WHERE 1=1";
$params = [];

if ($search_title !== '') {
    $sql .= " AND title LIKE ?";
    $params[] = "%$search_title%";
}
if ($search_artist !== '') {
    $sql .= " AND artist LIKE ?";
    $params[] = "%$search_artist%";
}
if ($search_genre !== '') {
    $sql .= " AND genre LIKE ?";
    $params[] = "%$search_genre%";
}
if ($search_year !== '') {
    $sql .= " AND year = ?";
    $params[] = $search_year;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$songs = $stmt->fetchAll(PDO::FETCH_ASSOC);


$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('index.twig', [
    'songs' => $songs,
    'loggedIn' => isset($_SESSION['user_id']),
    'username' => $_SESSION['username'] ?? '',
    'search_title' => $search_title,
    'search_artist' => $search_artist,
    'search_genre' => $search_genre,
    'search_year' => $search_year
]);
