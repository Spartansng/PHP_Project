<?php
declare(strict_types=1);

$title = "Profil";
require_once __DIR__ . '/../templates/layout/header.php';
require_login();

$stmt = $pdo->prepare("
    SELECT g.*, ug.play_time_minutes
    FROM user_games ug
    JOIN games g ON g.id = ug.game_id
    WHERE ug.user_id = ?
");
$stmt->execute([$u['id']]);
$userGames = $stmt->fetchAll();

$stmt = $pdo->prepare("
    SELECT a.name
    FROM user_achievements ua
    JOIN achievements a ON a.id = ua.achievement_id
    WHERE ua.user_id = ?
");
$stmt->execute([$u['id']]);
$achievements = $stmt->fetchAll(PDO::FETCH_COLUMN);

require_once __DIR__ . '/../templates/pages/profile.php';
require_once __DIR__ . '/../templates/layout/footer.php';