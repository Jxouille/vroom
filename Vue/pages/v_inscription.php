<body>

    <div class="conteneur-formulaire">
        <h2 class="titre-formulaire">Inscription</h2>

        <form class="formulaire-inscription"
              action="index.php?page=inscription&action=enregistrer"
              method="POST">

            <!-- NOM / PRÉNOM -->
            <div class="ligne-champs">
                <div class="groupe-champ">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required placeholder="Nom">
                </div>

                <div class="groupe-champ">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" required placeholder="Prénom">
                </div>
            </div>

            <!-- EMAIL -->
            <div class="groupe-champ">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required
                       placeholder="adresse@mail.com">
            </div>

            <?php if (isset($_GET['error']) && $_GET['error'] === "exists"):?>
                <p class="message-erreur">
                    L'adress email est déjàs utilisé ! 
                </p>
            <?php endif; ?>

            <!-- MOT DE PASSE -->
            <div class="groupe-champ">
                <label for="mdp">Mot de passe</label>
                <input type="password" id="mdp" name="mdp" placeholder="Mot de passe"
                 required minlength="6">
            </div>

            <div class="groupe-champ">
                <label for="mdp_confirm">Confirmer le mot de passe</label>
                <input type="password" id="mdp_confirm" name="mdp_confirm" required>
            </div>
            <?php if (isset($_GET['error']) && $_GET['error'] === "password"):?>
                <p class="message-erreur">
                    Les mots de passe ne correspondent pas !
                </p>
            <?php endif; ?>

            <!-- CAPTCHA -->
            <div class="bloc-captcha">
                <?php
                    $n1 = rand(1, 10);
                    $n2 = rand(1, 10);
                    $_SESSION['captcha_secret'] = $n1 + $n2;
                ?>
                <label class="titre-captcha">Question de sécurité</label>
                <p class="question-captcha">
                    Combien font <strong><?= "$n1 + $n2" ?></strong> ?
                </p>
                <input type="number" name="captcha_reponse"
                       required placeholder="Entrez le résultat">
            </div>

            <?php if (isset($_GET['error']) && $_GET['error'] === 'captcha'): ?>
                <p class="message-erreur">Captcha incorrect. Veuillez réessayer.</p>
            <?php endif; ?>

            <div class="rgpd-checkbox">
                <label>
                    <input type="checkbox" required>
                    J’accepte la
                    <a href="index?page=rgdp" target="_blank">
                        politique de confidentialité
                    </a>
                </label>
            </div>


            <button type="submit" class="bouton-principal">
                S'inscrire
            </button>
            <p class="small-note">J'ai déjà un compte : <a href="index.php?page=connexion">Se connecter</a></p>
        </form>
    </div>
</body>
