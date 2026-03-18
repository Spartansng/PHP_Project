<h1><?= $game ? 'Modifier un jeu' : 'Ajouter un jeu' ?></h1>

<div class="card">
    <form method="POST">
        <input type="hidden" name="id" value="<?= (int)($game['id'] ?? 0) ?>">

        <label>Titre</label>
        <input name="title" value="<?= e($game['title'] ?? '') ?>" required>

        <label>Genre</label>
        <input name="genre" value="<?= e($game['genre'] ?? '') ?>">

        <label>Note (0-10)</label>
        <input type="number" name="rating" min="0" max="10" value="<?= e($game['rating'] ?? '') ?>">

        <label>Date de sortie</label>
        <input name="release_date" value="<?= e($game['release_date'] ?? '') ?>">

        <label>Description</label>
        <textarea name="description" rows="4"><?= e($game['description'] ?? '') ?></textarea>

        <button type="submit">Sauvegarder</button>
        <a href="/public/admin/games.php"><button type="button">Annuler</button></a>
    </form>
</div>