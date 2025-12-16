<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage</title>

    
    <link rel="stylesheet" href="Ressources/Css/header.css">
</head>
<body>

<header class="header">
    
    <div class="logo">
        <img src="#" alt="Logo">
    </div>
    <nav class="nav">
        <a href="index.php">Accueil</a>
        <a href="#">Trajets</a>
        <a href="#">Proposer un trajet</a>
        <a href="#">Contact</a>
    </nav>

    <?php if (empty($_SESSION["user"]["idUser"])): ?>
        <div class="auth">
        <a href="index.php?action=actionConnexionPage" class="connexion">Se connecter</a>
        </div>
    <?php else: ?>
        <div class="auth">
        <a href="index.php?action=actionDeconnexion" class="deconnexion">Deconnexion</a>
        </div>
    <?php endif; ?>
    
</header>

</body>
</html>