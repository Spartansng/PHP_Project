<?php
declare(strict_types=1);

$title = "Admin";
require_once __DIR__ . '/../../templates/layout/header.php';
require_admin($pdo);

$userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$gameCount = $pdo->query("SELECT COUNT(*) FROM games")->fetchColumn();

require_once __DIR__ . '/../../templates/pages/admin/dashboard.php';
require_once __DIR__ . '/../../templates/layout/footer.php';