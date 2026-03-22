<?php
declare(strict_types=1);

$title = "Admin - Edition jeu";
require_once __DIR__ . '/../../templates/layout/header.php';
require_admin($pdo);

$error = '';

if (is_post()) {
    $id      = (int)($_POST['id']          ?? 0);
    $title_g = trim($_POST['title']        ?? '');
    $genre   = trim($_POST['genre']        ?? '');
    $rating  = (int)($_POST['rating']      ?? 0);
    $release = $_POST['release_date']      ?? '';
    $desc    = trim($_POST['description']  ?? '');

    if (empty($title_g)) {
        $error = "Le titre est obligatoire.";
    } elseif ($rating < 0 || $rating > 10) {
        $error = "La note doit être comprise entre 0 et 10.";
    }

    if (empty($error)) {
        if ($id > 0) {
            $pdo->prepare("
                UPDATE games SET title=?, genre=?, rating=?, release_date=?, description=?
                WHERE id=?
            ")->execute([$title_g, $genre, $rating, $release, $desc, $id]);
            flash_set('ok', "Jeu mis à jour.");
        } else {
            $pdo->prepare("
                INSERT INTO games (title, genre, rating, release_date, description)
                VALUES (?,?,?,?,?)
            ")->execute([$title_g, $genre, $rating, $release, $desc]);
            flash_set('ok', "Jeu ajouté.");
        }
        redirect('/public/admin/games.php');
    }
}

$game = null;
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
    $stmt->execute([(int)$_GET['id']]);
    $game = $stmt->fetch();
}

require_once __DIR__ . '/../../templates/pages/admin/game_edit.php';
require_once __DIR__ . '/../../templates/layout/footer.php';