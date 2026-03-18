<?php
declare(strict_types=1);

$title = "Catalogue de jeux";
require_once __DIR__ . '/../templates/layout/header.php';

$search = trim($_GET['search'] ?? '');
$genre  = $_GET['genre'] ?? '';
$sort   = $_GET['sort']  ?? 'date';
$page   = max(1, (int)($_GET['page'] ?? 1));

$gamesPerPage = 12;
$offset       = ($page - 1) * $gamesPerPage;

$where  = [];
$params = [];

if ($search !== '') {
    $where[]  = "title LIKE ?";
    $params[] = "%$search%";
}

if ($genre !== '') {
    $where[]  = "genre = ?";
    $params[] = $genre;
}

$whereSQL = $where ? "WHERE " . implode(" AND ", $where) : "";

$order = match($sort) {
    'rating' => "rating DESC",
    'title'  => "title ASC",
    default  => "created_at DESC",
};

$stmtCount = $pdo->prepare("SELECT COUNT(*) FROM games $whereSQL");
$stmtCount->execute($params);
$totalGames = (int)$stmtCount->fetchColumn();
$totalPages = (int)ceil($totalGames / $gamesPerPage);

$stmt = $pdo->prepare("
    SELECT * FROM games
    $whereSQL
    ORDER BY $order
    LIMIT $gamesPerPage OFFSET $offset
");
$stmt->execute($params);
$games = $stmt->fetchAll();

$genres = $pdo->query("
    SELECT DISTINCT genre FROM games
    WHERE genre IS NOT NULL
    ORDER BY genre
")->fetchAll(PDO::FETCH_COLUMN);

$ownedGameIds = [];
if ($u) {
    $stmtOwned = $pdo->prepare("SELECT game_id FROM user_games WHERE user_id = ?");
    $stmtOwned->execute([(int)$u['id']]);
    $ownedGameIds = array_column($stmtOwned->fetchAll(), 'game_id');
}

require_once __DIR__ . '/../templates/pages/games.php';
require_once __DIR__ . '/../templates/layout/footer.php';