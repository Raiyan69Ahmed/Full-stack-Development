<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/db.php';

session_start();


$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = trim($_POST['username_or_email']);
    $password = trim($_POST['password']);

    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('login.twig', ['error' => $error]);
