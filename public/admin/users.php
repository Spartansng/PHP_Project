<?php
declare(strict_types=1);

$title = "Admin - Utilisateurs";
require_once __DIR__ . '/../../templates/layout/header.php';
require_admin($pdo);

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if ($id === (int)$u['id']) {
        flash_set('err', "Vous ne pouvez pas supprimer votre propre compte.");
        redirect('/admin/users.php');
    }
    $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
    flash_set('ok', "Utilisateur supprime.");
    redirect('/admin/users.php');
}

$stmt  = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();

require_once __DIR__ . '/../../templates/pages/admin/users.php';
require_once __DIR__ . '/../../templates/layout/footer.php';