<?php
declare(strict_types=1);

$title = "Inscription";
require_once __DIR__ . '/../templates/layout/header.php';

$error = '';

if (is_post()) {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (strlen($password) < 8) {
        $error = "Le mot de passe doit contenir au moins 8 caractères.";
    } else {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("
            INSERT INTO users (username, email, password_hash, role)
            VALUES (?, ?, ?, 'user')
        ");
        try {
            $stmt->execute([$username, $email, $passwordHash]);
            redirect('/public/login.php');
        } catch (PDOException $e) {
            $error = "Cet email ou nom d'utilisateur existe déjà.";
        }
    }
}

require_once __DIR__ . '/../templates/pages/register.php';
require_once __DIR__ . '/../templates/layout/footer.php';