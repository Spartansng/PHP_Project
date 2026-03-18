<div class="page-header">
    <h1>Gestion des jeux</h1>
    <p><?= count($games) ?> jeu<?= count($games) > 1 ? 'x' : '' ?> dans la base</p>
</div>

<h2 class="section-title">Ajouter un jeu</h2>
<div class="card">
    <form method="POST" action="/public/admin/game_edit.php">
        <input type="hidden" name="id" value="0">
        <div class="form-grid">
            <div>
                <label>Titre</label>
                <input name="title" placeholder="Ex: Space Invaders" required>
            </div>
            <div>
                <label>Genre</label>
                <input name="genre" placeholder="Ex: Action, RPG">
            </div>
            <div>
                <label>Note (0-10)</label>
                <input name="rating" type="number" min="0" max="10">
            </div>
            <div>
                <label>Date de sortie</label>
                <input name="release_date" type="date">
            </div>
        </div>
        <label>Description</label>
        <textarea name="description" rows="3" placeholder="Description du jeu..."></textarea>
        <button type="submit">Ajouter le jeu</button>
    </form>
</div>

<h2 class="section-title">Liste des jeux</h2>
<div class="card">
    <table style="width:100%; border-collapse:collapse">
        <thead>
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Genre</th>
            <th>Note</th>
            <th>Sortie</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($games as $g): ?>
            <tr>
                <td><?= str_pad((string)(int)$g['id'], 3, '0', STR_PAD_LEFT) ?></td>
                <td><strong><?= e($g['title']) ?></strong></td>
                <td><?= e($g['genre'] ?? '') ?></td>
                <td><?= e($g['rating'] ?? '') ?>/10</td>
                <td><?= e($g['release_date'] ?? '-') ?></td>
                <td>
                    <div class="actions">
                        <a href="/public/admin/game_edit.php?id=<?= (int)$g['id'] ?>">
                            <button>Modifier</button>
                        </a>
                        <a href="/public/admin/games.php?delete=<?= (int)$g['id'] ?>"
                           onclick="return confirm('Supprimer ce jeu ?')">
                            <button>Supprimer</button>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>