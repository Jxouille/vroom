<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Ressources/CSS/inscription.css">
</head>

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
</html>


@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

.box1 {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #EFEFEF; 
}

.box2{
    width: 30%;
    height: 80%;
    background-color: #FFFFFF; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    border-radius: 10px; 
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Style pour la boite blanche du formulaire */
.form-container {
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    width: 300px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    font-family: Arial, Helvetica, sans-serif
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
    font-family: Arial, Helvetica, sans-serif
}

/* Style des champs de saisie */
.input-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
    font-size: 0.9em;
    color: #555;
}

input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
}

/* Style du bouton */
button {
    background-color: #42D372; 
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: normal;
    width: 100%;
}

button:hover {
    background-color: #33a157ff; /* Un peu plus foncé au survol */
}