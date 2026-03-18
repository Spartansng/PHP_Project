<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function current_user(PDO $pdo): ?array
{
    $uid = $_SESSION['user_id'] ?? null;
    if (!$uid) return null;

    $stmt = $pdo->prepare("SELECT id, username, email, role, created_at FROM users WHERE id = ?");
    $stmt->execute([(int)$uid]);
    $u = $stmt->fetch();
    return $u ?: null;
}

function require_login(): void
{
    if (empty($_SESSION['user_id'])) {
        redirect('/public/login.php');
    }
}

function require_admin(PDO $pdo): void
{
    require_login();
    $u = current_user($pdo);
    if (!$u || $u['role'] !== 'admin') {
        http_response_code(403);
        echo "Accès interdit (admin).";
        exit;
    }
}