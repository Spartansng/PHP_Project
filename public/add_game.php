<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
require_login();

if (!is_post()) {
    redirect('/games.php');
}

$gameId = (int)($_POST['game_id'] ?? 0);
$userId = (int)$u['id'];

if ($gameId <= 0) {
    redirect('/games.php');
}

$stmt = $pdo->prepare("SELECT id FROM user_games WHERE user_id = ? AND game_id = ?");
$stmt->execute([$userId, $gameId]);
if ($stmt->fetch()) {
    redirect('/profile.php');
}

$stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
$stmt->execute([$gameId]);
$game = $stmt->fetch();

if (!$game) {
    redirect('/games.php');
}

$stmt = $pdo->prepare("
    INSERT INTO user_games (user_id, game_id, play_time_minutes)
    VALUES (?, ?, ?)
");
$stmt->execute([$userId, $gameId, rand(10, 300)]);

$stmt = $pdo->prepare("SELECT COUNT(*) FROM user_games WHERE user_id = ?");
$stmt->execute([$userId]);
$totalGames = (int)$stmt->fetchColumn();

$newAchievements = [];

if ($totalGames === 1) $newAchievements[] = 1;
if ($totalGames === 5) $newAchievements[] = 2;
if ($totalGames === 10) $newAchievements[] = 3;
if ((int)($game['difficulty'] ?? 0) === 3) $newAchievements[] = 4;

foreach ($newAchievements as $achievementId) {
    $stmt = $pdo->prepare("
        SELECT id FROM user_achievements
        WHERE user_id = ? AND achievement_id = ?
    ");
    $stmt->execute([$userId, $achievementId]);

    if (!$stmt->fetch()) {
        $pdo->prepare("
            INSERT INTO user_achievements (user_id, achievement_id)
            VALUES (?, ?)
        ")->execute([$userId, $achievementId]);

        $stmt = $pdo->prepare("SELECT name FROM achievements WHERE id = ?");
        $stmt->execute([$achievementId]);
        $_SESSION['achievement_popup'] = $stmt->fetchColumn();
    }
}

redirect('/profile.php');