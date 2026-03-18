<div class="auth-container">
    <div class="auth-card">
        <h1>Créer un compte</h1>

        <?php if (!empty($error)): ?>
            <p style="color:red"><?= e($error) ?></p>
        <?php endif; ?>

        <form method="POST" class="auth-form">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe (min 8 caractères)" required>
            <button type="submit">Créer mon compte</button>
        </form>

        <div class="auth-link">
            Déjà un compte ? <a href="/public/login.php">Se connecter</a>
        </div>
    </div>
</div>