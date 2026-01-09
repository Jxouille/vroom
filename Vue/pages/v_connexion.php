<body class="login-body">

    <section class="login-container">

        <section class="titre">
            <h2>Bienvenue sur <span>VROOM</span></h2>
            <p>Connectez-vous pour continuer votre voyage écologique</p>
        </section>

        <div class="login-card">
            <form action="index.php?page=connexion&action=verifier" method="POST">

                <div class="login-intro">
                    <h3>Connexion</h3>
                    <p>Entrez vos identifiants pour accéder à votre compte</p>
                </div>

                <!-- Messages d'erreur -->
                <?php if (isset($_GET['error'])): ?>
                    <div class="error-message">
                        <?php if ($_GET['error'] === 'missing'): ?>
                            Veuillez remplir tous les champs.
                        <?php elseif ($_GET['error'] === 'invalid'): ?>
                            Identifiants incorrects.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="mot_de_passe">
                        Mot de passe
                        <a href="index.php?page=mdp_oblie" class="forgot-password">Mot de passe oublié ?</a>
                    </label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                </div>

                <button type="submit" class="btn-primary">
                    → Se connecter
                </button>

                <div class="signup-link">
                    Pas encore de compte ?
                    <a href="index.php?page=inscription">Inscrivez-vous</a>
                </div>

            </form>
        </div>

        <div class="back-home">
            <a href="index.php?page=accueil">← Retour à l'accueil</a>
        </div>

    </section>

</body>
