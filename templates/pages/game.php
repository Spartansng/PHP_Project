<div class="game-detail">
    <img src="<?= e($game['image_url']) ?>" alt="<?= e($game['title']) ?>">

    <h1><?= e($game['title']) ?></h1>

    <p><?= e($game['genre'] ?? '') ?></p>

    <span class="level level<?= $level ?>">
        <?= $levelLabel[$level] ?>
    </span>

    <p><?= e($game['description'] ?? '') ?></p>

    <div class="game-info">
        <p>Note : <?= e($game['rating'] ?? 0) ?>/10</p>
        <p>Sortie : <?= e($game['release_date'] ?? '') ?></p>
        <p>Ajouté le : <?= e($game['created_at']) ?></p>
    </div>

    <div class="actions">
        <a href="/games.php">
            <button>Retour au catalogue</button>
        </a>

        <?php if ($u && !$alreadyOwned): ?>
            <form method="POST" action="/public/add_game.php">
                <input type="hidden" name="game_id" value="<?= e($game['id']) ?>">
                <button type="submit">Ajouter à ma collection</button>
            </form>
        <?php elseif ($u): ?>
            <span class="badge">Déjà dans votre collection</span>
        <?php endif; ?>
    </div>
</div>