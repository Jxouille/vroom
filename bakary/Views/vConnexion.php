
<?php include 'Views/vHeader.php'; ?>

<link rel="stylesheet" href="Ressources/Css/connInscr.css">

<section class="auth-section">
    <div class="auth-container">

        <h2>Connexion</h2>
        <p>Ravi de vous revoir !</p>

        <?php if (!empty($_GET["error"])): ?>
            <div class="error-msg"><?= htmlspecialchars($_GET["error"]) ?></div>
        <?php endif; ?>

        <form action="traitement_connexion.php" method="POST" class="auth-form">

            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Mot de passe :</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="auth-btn">Se connecter</button>

            <p class="switch-link">
                Pas encore de compte ? <a href="index.php?action=actionInscription">Créer un compte</a>
            </p>
        </form>
    </div>
</section>

<?php include 'Views/vFooter.php'; ?>