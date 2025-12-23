<body>
    <section class="titre-login">
        <img src="Ressources/Image/FeuilleLogin2.png" alt="VROOM" class="icone">
        <h2>Bienvenue sur VROOM</h2>
        <h3>Connectez-vous pour continuer votre voyage écologique</h3>
    </section>
    <div class="form_position">
        <form action="index.php?page=connexion&action=verifier" method="POST">
            <div class="petit-texte">
                <p>Mot de passe oblier</p>
                <p>Entrez votre email pour rétialiser votre mot de passe</p>
            </div>
         <!-- Messages d'erreur -->
            <?php if (isset($_GET['error'])): ?>
                <div class="error">
                    <?php if ($_GET['error'] === 'missing'): ?>
                        <p>Veuillez remplir tous les champs.</p>
                    <?php elseif ($_GET['error'] === 'invalid'): ?>
                        <p>Identifiants incorrects.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div>
                <label for="telephone" class="id">Téléphone</label><br>
                <input type="text" id="telephone" name="telephone" required class="input-group"><br><br>
                <button type="submit" class="button">→ Envoyer</button>
            </div>
            <div class="creation-compte">
                <h3>Se connecter avec un autre compte ? <a href="index.php?page=connexion">Se connecter</a></h3>
            </div>
            <div class="creation-compte">
                <h3>Pas encore de compte ? <a href="index.php?page=inscription">Inscrivez-vous</a></h3>
            </div>
        </form>
    </div>
    <div class="retour-accueil">
        <h3><a href="index.php?page=accueil">← Retour à l'accueil</a></h3>
    </div>
</body>