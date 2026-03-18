<?php
declare(strict_types=1);

$title = "Connexion";
require_once __DIR__ . '/../templates/layout/header.php';

$error = '';

if (is_post()) {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        redirect('/public/index.php');
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}

require_once __DIR__ . '/../templates/pages/login.php';
require_once __DIR__ . '/../templates/layout/footer.php';