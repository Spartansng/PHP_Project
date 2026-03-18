<?php
declare(strict_types=1);

$title = "Accueil";
require_once __DIR__ . '/../templates/layout/header.php';

$stmt = $pdo->query("
    SELECT * FROM games
    WHERE image_url LIKE 'https://media.rawg.io/%'
    ORDER BY rating DESC, created_at DESC
    LIMIT 8
");
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("
    SELECT * FROM games
    WHERE image_url LIKE 'https://media.rawg.io/%'
    ORDER BY rating DESC
    LIMIT 5
");
$sliderGames = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/../templates/pages/home.php';
require_once __DIR__ . '/../templates/layout/footer.php';