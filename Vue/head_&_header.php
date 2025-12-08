<?php
$nom_ce_fichier = substr(basename($_SERVER['PHP_SELF']), 2, -4);
$css_chemin  = "../../Ressources/CSS/" . $nom_ce_fichier . ".css";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vroom - <?php echo "Page " . $nom_ce_fichier; ?> </title>
    <link rel="stylesheet" href="../../Ressources/CSS/commun.css"> 
    <link rel="stylesheet" href="<?php echo $css_chemin; ?>">
</head>
<header>
    <nav>
        <img src="../../Ressources/Image/vroom_logo_sans_fond.png"  alt="Logo Vroom">
        <a href="#">Accueil</a>
        <a href="#">Réserver</a>
        <a href="#">Publier</a>
        <a href="#">À propos</a>
        <a href="#">Contact</a>
        <a href="connection.php" class="button-header">Se connecter</a>
    </nav>
</header>

