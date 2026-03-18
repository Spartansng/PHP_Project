<h1>Mon profil</h1>

<p>Connecte en tant que : <strong><?= e($u['username']) ?></strong></p>

<?php if (isset($_SESSION['achievement_popup'])): ?>
    <div id="achievement-popup">
        Succes debloque : <?= e($_SESSION['achievement_popup']) ?>
    </div>
    <?php unset($_SESSION['achievement_popup']); ?>
<?php endif; ?>

<h2 class="section-title">Mes jeux</h2>

<?php if (empty($userGames)): ?>
    <p>Aucun jeu dans votre collection.</p>
<?php else: ?>
    <div class="grid">
        <?php foreach ($userGames as $game): ?>
            <div class="card">
                <img src="<?= e($game['image_url']) ?>" alt="<?= e($game['title']) ?>">
                <h3><?= e($game['title']) ?></h3>
                <p><?= e($game['genre'] ?? '') ?></p>
                <div class="actions">
                    <a href="/public/game.php?id=<?= e($game['id']) ?>">
                        <button>Voir le jeu</button>
                    </a>
                    <form method="POST" action="/public/remove_game.php">
                        <input type="hidden" name="game_id" value="<?= e($game['id']) ?>">
                        <button class="btn-danger">Retirer de ma collection</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h2 class="section-title">Mes succes</h2>

<?php if (empty($achievements)): ?>
    <p>Aucun succes debloque.</p>
<?php else: ?>
    <div class="achievements">
        <?php foreach ($achievements as $achievement): ?>
            <div class="achievement">
                <?= e($achievement) ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>