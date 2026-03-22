<div class="admin-page-header">
    <div>
        <div class="admin-tag">Panel Admin</div>
        <h1>Gestion des jeux</h1>
    </div>
    <a href="/admin/index.php"><button>Retour au dashboard</button></a>
</div>

<h2 class="section-title">Ajouter un jeu</h2>
<div class="card admin-form-card">
    <form method="POST" action="/admin/game_edit.php">
        <input type="hidden" name="id" value="0">
        <div class="admin-form-grid">
            <div class="admin-form-field">
                <label>Titre</label>
                <input name="title" placeholder="Ex: Space Invaders" required>
            </div>
            <div class="admin-form-field">
                <label>Genre</label>
                <input name="genre" placeholder="Ex: Action, RPG">
            </div>
            <div class="admin-form-field">
                <label>Date de sortie</label>
                <input name="release_date" type="date">
            </div>
        </div>
        <div class="admin-form-field">
            <label>Description</label>
            <textarea name="description" rows="3" placeholder="Description du jeu..."></textarea>
        </div>
        <div style="margin-top:16px">
            <button type="submit">Ajouter le jeu</button>
        </div>
    </form>
</div>

<h2 class="section-title">Liste des jeux</h2>
<div class="card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Genre</th>
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
                            <a href="/admin/game_edit.php?id=<?= (int)$g['id'] ?>">
                                <button>Modifier</button>
                            </a>
                            <form method="POST" action="/admin/games.php"
                                onsubmit="return confirm('Supprimer ce jeu ?')">
                                <input type="hidden" name="delete" value="<?= (int)$g['id'] ?>">
                                <button type="submit" class="btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>