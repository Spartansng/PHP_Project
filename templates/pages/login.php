<div class="auth-container">
    <div class="auth-card">
        <h1>Connexion</h1>

        <?php if (!empty($error)): ?>
            <p style="color:red"><?= e($error) ?></p>
        <?php endif; ?>

        <form method="POST" class="auth-form">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>

        <div class="auth-link">
            Pas encore de compte ? <a href="/public/register.php">Créer un compte</a>
        </div>
    </div>
</div>