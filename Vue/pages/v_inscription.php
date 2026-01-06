<body>
    <div class="box1">
        <div class="form-container">
            <h2>Inscription</h2>

            <form action="index.php?page=inscription&action=enregistrer" method="POST">

                <div class="box-names">
            <div class="input-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required placeholder="Macron">
                </div>

                <div class="input-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" required placeholder="Emmanuel">
                </div>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="emanuel.macron@gouv.fr">
                </div>

                <div class="input-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" id="mdp" name="mdp" required minlength="6">
                </div>

                <div class="input-group">
                    <label for="mdp_confirm">Confirmer le mot de passe</label>
                    <input type="password" id="mdp_confirm" name="mdp_confirm" required>
                </div>

                <p id="erreur-msg" style="color: red; display: none;">
                    Les mots de passe ne correspondent pas !
                </p>


                <!-- CAPTCHA (OBLIGATOIREMENT DANS LE FORMULAIRE) -->
                <div>
                    <?php
                    $n1 = rand(1, 10);
                    $n2 = rand(1, 10);
                    $_SESSION['captcha_secret'] = $n1 + $n2;
                    ?>
                    <label>Question de sécurité :</label>
                    <p class="question">Combien font <strong><?= "$n1 + $n2" ?></strong> ?</p>
                    <input type="number"
                        name="captcha_reponse"
                        required
                        placeholder="Entrez le résultat">
                </div>

                <div class="captcha_err">
                <?php if (isset($_GET['error']) && $_GET['error'] === 'captcha'): ?>
                    <p>Captcha incorrect ! Veuillez réessayer.</p>
                <?php endif; ?>
                </div>


                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </div>
</body>
