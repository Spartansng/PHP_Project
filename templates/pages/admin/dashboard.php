<div class="page-header">
    <div>
        <div class="admin-tag">Panel Admin</div>
        <h1>Espace Administrateur</h1>
    </div>
</div>

<div class="grid">
    <div class="stat-box">
        <div class="stat-value"><?= (int)$userCount ?></div>
        <div class="stat-label">Utilisateurs</div>
    </div>
    <div class="stat-box">
        <div class="stat-value"><?= (int)$gameCount ?></div>
        <div class="stat-label">Jeux</div>
    </div>
</div>

<div class="grid">
    <a href="/admin/users.php" class="card">
        <h3>Gerer les utilisateurs</h3>
        <p>Roles, suppressions, liste complete</p>
    </a>
    <a href="/admin/games.php" class="card">
        <h3>Gerer les jeux</h3>
        <p>Ajout, edition, suppression de jeux</p>
    </a>
</div>