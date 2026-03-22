<?php
declare(strict_types=1);

$title = "Admin - Jeux";
require_once __DIR__ . '/../../templates/layout/header.php';
require_admin($pdo);

if (is_post() && isset($_POST['delete'])) {
    $id = (int)($_POST['delete'] ?? 0);
    if ($id > 0) {
        $pdo->prepare("DELETE FROM games WHERE id = ?")->execute([$id]);
        flash_set('ok', "Jeu supprimé.");
    }
    redirect('/public/admin/games.php');
}

$stmt = $pdo->query("SELECT * FROM games ORDER BY id DESC");
$games = $stmt->fetchAll();

require_once __DIR__ . '/../../templates/pages/admin/games.php';
require_once __DIR__ . '/../../templates/layout/footer.php';