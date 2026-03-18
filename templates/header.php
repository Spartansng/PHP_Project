<?php
declare(strict_types=1);

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

$u = current_user($pdo);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? "Arcade Universe") ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header class="topbar">
    <div class="brand">
        <a href="/public/index.php">Arcade Universe</a>
    </div>
    <nav class="nav">
        <a href="/public/index.php">Accueil</a>
        <a href="/public/games.php">Jeux</a>
        <?php if ($u): ?>
            <a href="/public/profile.php">Profil</a>
            <?php if ($u['role'] === 'admin'): ?>
                <a href="/public/admin/index.php">Admin</a>
            <?php endif; ?>
            <a href="/public/logout.php">Déconnexion</a>
        <?php else: ?>
            <a href="/public/login.php">Connexion</a>
            <a href="/public/register.php">Inscription</a>
        <?php endif; ?>
    </nav>
</header>
<main class="container">