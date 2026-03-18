<?php
declare(strict_types=1);

require_once __DIR__ . '/../templates/layout/header.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
$stmt->execute([$id]);
$game = $stmt->fetch();

if (!$game) {
    redirect('/public/games.php');
}

$title = $game['title'];

$level = (int)($game['difficulty'] ?? 1);
$levelLabel = [
    1 => 'Easy',
    2 => 'Medium',
    3 => 'Hard'
];

$alreadyOwned = false;
if ($u) {
    $stmt = $pdo->prepare("SELECT id FROM user_games WHERE user_id = ? AND game_id = ?");
    $stmt->execute([(int)$u['id'], $id]);
    $alreadyOwned = (bool)$stmt->fetch();
}

require_once __DIR__ . '/../templates/pages/game.php';
require_once __DIR__ . '/../templates/layout/footer.php';