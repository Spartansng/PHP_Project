<div class="admin-page-header">
    <div>
        <div class="admin-tag">Panel Admin</div>
        <h1>Gestion des utilisateurs</h1>
        <p><?= count($users) ?> utilisateur<?= count($users) > 1 ? 's' : '' ?> inscrits</p>
    </div>
    <a href="/public/admin/index.php">
        <button>Retour au dashboard</button>
    </a>
</div>

<div class="card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Role</th>
                <th>Inscrit le</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= str_pad((string)(int)$user['id'], 3, '0', STR_PAD_LEFT) ?></td>
                    <td><strong><?= e($user['username']) ?></strong></td>
                    <td><?= e($user['email']) ?></td>
                    <td>
                        <span class="badge-role <?= e($user['role']) ?>">
                            <?= e($user['role']) ?>
                        </span>
                    </td>
                    <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                    <td>
                        <?php if ($user['id'] != $u['id']): ?>
                        <form method="POST" action="/public/admin/users.php"
                              onsubmit="return confirm('Supprimer <?= e($user['username']) ?> ?')">
                            <input type="hidden" name="delete" value="<?= (int)$user['id'] ?>">
                            <button type="submit" class="btn-danger">Supprimer</button>
                        </form>
                        <?php else: ?>
                            <span class="badge-you">Vous</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>