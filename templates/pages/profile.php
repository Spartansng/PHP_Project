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

                <div class="playtime-display" id="display-<?= $game['id'] ?>">
                    <span class="playtime-icon">⏱</span>
                    <span class="playtime-value"><?= (int)($game['play_time_minutes'] ?? 0) ?> min</span>
                    <button type="button" class="btn-edit" onclick="toggleEdit(<?= $game['id'] ?>)">✏️</button>
                </div>

                <form method="POST" action="/update_playtime.php" class="playtime-form" id="form-<?= $game['id'] ?>" style="display:none">
                    <input type="hidden" name="game_id" value="<?= e($game['id']) ?>">
                    <input type="number" name="play_time" value="<?= (int)($game['play_time_minutes'] ?? 0) ?>" min="0" class="playtime-input">
                    <div class="playtime-actions">
                        <button type="submit" class="btn-save">Sauver</button>
                        <button type="button" class="btn-cancel" onclick="toggleEdit(<?= $game['id'] ?>)">Annuler</button>
                    </div>
                </form>

                <div class="actions">
                    <a href="/game.php?id=<?= e($game['id']) ?>">
                        <button>Voir le jeu</button>
                    </a>
                    <form method="POST" action="/remove_game.php">
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

<script>
function toggleEdit(id) {
    const display = document.getElementById('display-' + id);
    const form    = document.getElementById('form-' + id);
    const isHidden = form.style.display === 'none';
    display.style.display = isHidden ? 'none' : 'flex';
    form.style.display    = isHidden ? 'block' : 'none';
}
</script>