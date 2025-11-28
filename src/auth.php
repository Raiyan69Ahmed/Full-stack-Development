<?php
session_start();
require_once __DIR__ . '/db.php';

function isLoggedIn(): bool {
    return isset($_SESSION['username']);
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function loginUser(string $username): void {
    session_regenerate_id(true);
    $_SESSION['username'] = $username;
}

function logoutUser(): void {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}
