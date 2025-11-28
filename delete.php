<?php
require_once __DIR__ . '/src/auth.php';
requireLogin();
require_once __DIR__ . '/src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if ($id) {
        $stmt = getPDO()->prepare('DELETE FROM music_library WHERE id = ?');
        $stmt->execute([$id]);
    }
}

header('Location: index.php');
exit;
