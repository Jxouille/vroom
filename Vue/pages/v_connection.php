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
        <h3><a href="acceuil.php">← Retour à l'accueil</a></h3>
    </div>

    
</body>
<?php include "../footer.php";?>
</html>