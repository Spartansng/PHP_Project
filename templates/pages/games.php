<h1>Catalogue de jeux</h1>

<form method="GET" action="/games.php" class="filters">
    <input
        type="text"
        name="search"
        placeholder="Rechercher un jeu..."
        value="<?= e($search) ?>"
    >

    <select name="genre">
        <option value="">Tous les genres</option>
        <?php foreach ($genres as $g): ?>
            <option value="<?= e($g) ?>" <?= $genre === $g ? 'selected' : '' ?>>
                <?= e($g) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="sort">
        <option value="date"   <?= $sort === 'date'   ? 'selected' : '' ?>>Nouveautés</option>
        <option value="rating" <?= $sort === 'rating' ? 'selected' : '' ?>>Note</option>
        <option value="title"  <?= $sort === 'title'  ? 'selected' : '' ?>>Titre</option>
    </select>

    <button type="submit">Filtrer</button>
</form>

<div class="grid">
    <?php foreach ($games as $game): ?>
        <?php $level = (int)($game['difficulty'] ?? 1); ?>
        <div class="card">
            <img src="<?= e($game['image_url']) ?>" alt="<?= e($game['title']) ?>">
            <h3><?= e($game['title']) ?></h3>
            <p><?= e($game['genre'] ?? '') ?></p>
            <span class="level level<?= $level ?>">
                <?= ['1' => 'Easy', '2' => 'Medium', '3' => 'Hard'][$level] ?? 'Easy' ?>
            </span>
            <p><?= e($game['description'] ?? '') ?></p>

            <div class="actions">
                <a href="/game.php?id=<?= e($game['id']) ?>">
                    <button>Voir le jeu</button>
                </a>

                <?php if ($u && !in_array($game['id'], $ownedGameIds)): ?>
                    <form method="POST" action="/add_game.php">
                        <input type="hidden" name="game_id" value="<?= e($game['id']) ?>">
                        <button type="submit">Ajouter à ma collection</button>
                    </form>
                <?php elseif ($u): ?>
                    <span class="badge">Déjà dans votre collection</span>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="pagination">
    <?php
    $range = 2;
    $start = max(1, $page - $range);
    $end   = min($totalPages, $page + $range);
    $qs    = http_build_query(['search' => $search, 'genre' => $genre, 'sort' => $sort]);

    if ($start > 1) {
        echo '<a href="?page=1&' . $qs . '">1</a>';
        if ($start > 2) echo '<span>...</span>';
    }

    for ($i = $start; $i <= $end; $i++):
    ?>
        <a href="?page=<?= $i ?>&<?= $qs ?>" class="<?= $i === $page ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor;

    if ($end < $totalPages) {
        if ($end < $totalPages - 1) echo '<span>...</span>';
        echo '<a href="?page=' . $totalPages . '&' . $qs . '">' . $totalPages . '</a>';
    }
    ?>
</div>