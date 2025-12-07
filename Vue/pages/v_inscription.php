<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Ressources/CSS/commun.css">
    <link rel="stylesheet" href="../../Ressources/CSS/inscription.css">
</head>

<?php include "../header.php";?>

<body>
    <div class="box1">
        <div class="form-container">
            <h2>Inscription</h2>
            <form action="" method="" onsubmit="">
                
                <div class="input-group">
                    <label for="nom">Nom</label>
                    <input type="name" id="nom" name="nom" required placeholder="Macron">
                </div>

                <div class="input-group">
                    <label for="fist-name">Prénom</label>
                    <input type="first-name" id="prenom" name="prenom" required placeholder="Emanuel">
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

                <p id="erreur-msg" style="color: red; display: none;">Les mots de passe ne correspondent pas !</p>

                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </div>
</body>
<?php include "../footer.php";?>
</html>


