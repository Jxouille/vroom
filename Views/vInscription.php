<?php include 'Views/vHeader.php'; ?>

<link rel="stylesheet" href="Ressources/Css/connInscr.css">

<section class="auth-section">
    <div class="auth-container">

        <h2>Créer un compte</h2>
        <p>Rejoignez notre communauté de covoiturage</p>

        <?php if (!empty($_GET["erreur"])): ?>
            <div class="error-msg"><?= htmlspecialchars($_GET["erreur"]) ?></div>
        <?php endif; ?>

        <form action="index.php?action=actionInscriptionTraitement" method="POST" class="auth-form">
            <div class="form-row">
                <div class="form-group">
                    <label>Nom :</label>
                    <input type="text" name="nom" required>
                </div>

                <div class="form-group">
                    <label>Prénom :</label>
                    <input type="text" name="prenom" required>
                </div>
            </div>

            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Mot de passe :</label>
                <input type="password" name="mdp" required>
            </div>

            <div class="form-group">
                <label>Confirmer le mot de passe :</label>
                <input type="password" name="mdp_confirm" required>
            </div>

            <button type="submit" class="auth-btn">S'inscrire</button>

            <p class="switch-link">
                Déjà inscrit ? <a href="connexion.php">Se connecter</a>
            </p>
        </form>
    </div>
</section>

<?php include 'Views/vFooter.php'; ?>