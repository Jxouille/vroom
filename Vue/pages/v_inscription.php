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
                    <input type="text" id="nom" name="nom" required placeholder="Macron">
                </div>

                <div class="groupe-champ">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" required placeholder="Emmanuel">
                </div>
            </div>

            <!-- EMAIL -->
            <div class="groupe-champ">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required
                       placeholder="emmanuel.macron@gouv.fr">
            </div>

            <!-- MOT DE PASSE -->
            <div class="groupe-champ">
                <label for="mdp">Mot de passe</label>
                <input type="password" id="mdp" name="mdp" required minlength="6">
            </div>

            <div class="groupe-champ">
                <label for="mdp_confirm">Confirmer le mot de passe</label>
                <input type="password" id="mdp_confirm" name="mdp_confirm" required>
            </div>
            <p id="erreur-mdp" class="message-erreur">
                Les mots de passe ne correspondent pas !
            </p>

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

            <button type="submit" class="bouton-principal">
                S'inscrire
            </button>

        </form>
    </div>

</body>
