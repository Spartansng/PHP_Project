<?php

$db = new PDO("sqlite:" . __DIR__ . "/database.sqlite");

$env = parse_ini_file(__DIR__ . '/.env');
$apiKey = $env['RAWG_API_KEY'] ?? '';

if (empty($apiKey)) {
    die("Erreur : clé API manquante dans le fichier .env\n");
}

for ($page = 1; $page <= 5; $page++) {

    $url  = "https://api.rawg.io/api/games?key=$apiKey&page=$page&page_size=40";
    $data = json_decode(file_get_contents($url), true);

    if (!isset($data['results'])) {
        echo "Erreur API\n";
        break;
    }

    foreach ($data['results'] as $game) {

        $title       = $game['name']             ?? '';
        $rating      = round($game['rating']     ?? rand(6, 10));
        $image       = $game['background_image'] ?? '';
        $date        = $game['released']         ?? '';
        $genre       = 'Unknown';
        $description = $game['slug']             ?? 'Jeu populaire RAWG';

        if (!empty($game['genres'])) {
            $genre = $game['genres'][0]['name'];
        }

        $stmt = $db->prepare("
            INSERT INTO games
                (title, description, genre, rating, image_url, release_date)
            VALUES
                (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $title,
            $description,
            $genre,
            $rating,
            $image,
            $date
        ]);

        echo "Ajout : $title\n";
    }
}

echo "\nImport terminé\n";