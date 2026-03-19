<section class="hero">
    <h1>Arcade Universe</h1>
</section>

<section class="slider-section">
    <div class="slider">
        <?php foreach ($sliderGames as $i => $game): ?>
            <img
                class="slide <?= $i === 0 ? 'active' : '' ?>"
                src="<?= e($game['image_url']) ?>"
                alt="<?= e($game['title']) ?>"
            >
        <?php endforeach; ?>
    </div>
    <p>Bienvenue sur Arcade Universe. Découvre les jeux les plus populaires et explore le catalogue.</p>
</section>

<section class="catalog">
    <h2 class="section-title">Jeux populaires</h2>
    <div class="grid">
        <?php foreach ($games as $game): ?>
            <div class="card">
                <img src="<?= e($game['image_url']) ?>" alt="<?= e($game['title']) ?>">
                <h3><?= e($game['title']) ?></h3>
                <p><?= e($game['genre'] ?? '') ?></p>
                <a href="/game.php?id=<?= e($game['id']) ?>">
                    <button>Voir le jeu</button>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>