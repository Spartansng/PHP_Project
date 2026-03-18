<?php
declare(strict_types=1);

$title = "Admin - Edition jeu";
require_once __DIR__ . '/../../templates/layout/header.php';
require_admin($pdo);

if (is_post()) {
    $id      = (int)($_POST['id']          ?? 0);
    $title_g = $_POST['title']             ?? '';
    $genre   = $_POST['genre']             ?? '';
    $rating  = (int)($_POST['rating']      ?? 0);
    $release = $_POST['release_date']      ?? '';
    $desc    = $_POST['description']       ?? '';

    if ($id > 0) {
        $pdo->prepare("
            UPDATE games SET title=?, genre=?, rating=?, release_date=?, description=?
            WHERE id=?
        ")->execute([$title_g, $genre, $rating, $release, $desc, $id]);
        flash_set('ok', "Jeu mis a jour.");
    } else {
        $pdo->prepare("
            INSERT INTO games (title, genre, rating, release_date, description)
            VALUES (?,?,?,?,?)
        ")->execute([$title_g, $genre, $rating, $release, $desc]);
        flash_set('ok', "Jeu ajoute.");
    }
    redirect('/public/admin/games.php');
}

$game = null;
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
    $stmt->execute([(int)$_GET['id']]);
    $game = $stmt->fetch();
}

require_once __DIR__ . '/../../templates/pages/admin/game_edit.php';
require_once __DIR__ . '/../../templates/layout/footer.php';