<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/db.php';
require_once __DIR__ . '/src/auth.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pdo = getPDO();
$error = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $captcha_response = $_POST['g-recaptcha-response'] ?? '';

    
    if ($username === '' || $email === '' || $password === '') {
        $error = "All fields are required.";
    }

    
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    }

    
    else {
        $secretKey = "6LepSxksAAAAAC505oRAU0bFOS_oBHguT0vvSZcb";  

        $verify = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha_response}"
        );

        $captchaSuccess = json_decode($verify);

        if (!$captchaSuccess || !$captchaSuccess->success) {
            $error = "Captcha verification failed. Please try again.";
        }
    }

    
    if ($error === "") {

        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $error = "Username or email already exists.";
        } else {
            
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashedPassword]);

            
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['username'] = $username;

            
            header("Location: index.php");
            exit;
        }
    }
}


$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('register.twig', [
    'error' => $error
]);
