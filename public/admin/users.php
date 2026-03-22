<?php
declare(strict_types=1);

$title = "Admin - Utilisateurs";
require_once __DIR__ . '/../../templates/layout/header.php';
require_admin($pdo);

if (is_post() && isset($_POST['delete'])) {
    $id = (int)($_POST['delete'] ?? 0);
    if ($id > 0 && $id !== (int)$u['id']) {
        $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
        flash_set('ok', "Utilisateur supprimé.");
    } else {
        flash_set('err', "Vous ne pouvez pas supprimer votre propre compte.");
    }
    redirect('/public/admin/users.php');
}

$stmt  = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();

require_once __DIR__ . '/../../templates/pages/admin/users.php';
require_once __DIR__ . '/../../templates/layout/footer.php';