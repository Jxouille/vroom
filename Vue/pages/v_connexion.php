<?php require "../head_&_header.php";?>
<body>
    <div class="pos">
        <section class="header-login">
            <img src="../../Ressources/Image/FeuilleLogin2.png" alt="" class="icone">
            <h2>Bienvenue sur VROOM</h2>
            <h3>Connectez-vous pour continuer votre voyage écologique</h3><br> 
        </section>

        <div class="form_position">
            <form action=# method=#>
                <div class="petit-texte">
                    <p>Connexion</p>
                    <p>Entrez vos identifiants pour accéder à votre compte</p>
                </div>
                <div>
                    <label for="email" class="id">E-mail</label><br>
                    <input type="text" id="email" name="email" required class="input-group"><br><br>
                    <label for="password" class="mdp">Mot de passe<a href="#" class="mdp-oublié">Mot de passe oublié ?</a></label><br> 
                    <input type="password" id="password" name="password" required class="input-group"><br><br>
                    <button type="submit" class="button">→] Se connecter</button>
                </div>
                <div class="creation-compte">
                    <h3>Pas encore de compte ? <a href="#">Inscrivez-vous</a></h3>
                </div>
            </form>
        </div>
    </div>
    <div class="retour-accueil">
        <h3><a href="v_accueil.php">← Retour à l'accueil</a></h3>
    </div>

    
</body>
<?php include "../footer.php";?>


<?php require __DIR__ . '/../header.php'; ?>

<body>
    <div class="pos">
        <section class="header-login">
            <img src="Ressources/Image/FeuilleLogin2.png" alt="VROOM" class="icone">
            <h2>Bienvenue sur VROOM</h2>
            <h3>Connectez-vous pour continuer votre voyage écologique</h3>
        </section>

        <div class="form_position">
            <form action="index.php?page=connexion&action=verifier" method="POST">

                <div class="petit-texte">
                    <p>Connexion</p>
                    <p>Entrez vos identifiants pour accéder à votre compte</p>
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

                    <label for="mot_de_passe" class="mdp">
                        Mot de passe
                        <a href="#" class="mdp-oublié">Mot de passe oublié ?</a>
                    </label><br>

                    <input type="password" id="mot_de_passe" name="mot_de_passe" required class="input-group"><br><br>

                    <button type="submit" class="button">→ Se connecter</button>
                </div>

                <div class="creation-compte">
                    <h3>Pas encore de compte ? <a href="index.php?page=inscription">Inscrivez-vous</a></h3>
                </div>

            </form>
        </div>
    </div>

    <div class="retour-accueil">
        <h3><a href="index.php?page=accueil">← Retour à l'accueil</a></h3>
    </div>
</body>

<?php require __DIR__ . '/../footer.php'; ?>
