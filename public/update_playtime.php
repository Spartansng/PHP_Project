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

$gameId   = (int)($_POST['game_id']   ?? 0);
$playtime = (int)($_POST['play_time'] ?? 0);

if ($gameId <= 0) {
    redirect('/profile.php');
}

$pdo->prepare("
    UPDATE user_games SET play_time_minutes = ?
    WHERE user_id = ? AND game_id = ?
")->execute([$playtime, (int)$u['id'], $gameId]);

redirect('/profile.php');