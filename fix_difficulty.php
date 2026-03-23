<?php
$db = new PDO("sqlite:" . __DIR__ . "/database.sqlite");

$games = $db->query("SELECT id FROM games")->fetchAll(PDO::FETCH_COLUMN);

$stmt = $db->prepare("UPDATE games SET difficulty = ? WHERE id = ?");

foreach ($games as $id) {
    $stmt->execute([rand(1, 3), $id]);
}

echo "Difficultés mises à jour sur " . count($games) . " jeux.\n";