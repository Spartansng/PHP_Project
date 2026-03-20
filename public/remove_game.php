<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

$u = current_user($pdo);
require_login();

if (!is_post()) {
    redirect('/profile.php');
}

$gameId = (int)($_POST['game_id'] ?? 0);

if ($gameId <= 0) {
    flash_set('err', 'Jeu invalide.');
    redirect('/profile.php');
}

$pdo->prepare("
    DELETE FROM user_games
    WHERE user_id = ? AND game_id = ?
")->execute([(int)$u['id'], $gameId]);

flash_set('ok', 'Jeu retire de votre collection.');
redirect('/profile.php');