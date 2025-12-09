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
        <a href="v_accueil.php">Accueil</a>
        <a href="v_recherche_trajet.php">Réserver</a>
        <a href="v_publie_trajet.php">Publier</a>
        <a href="v_mes_trajets.php">Mes trajets</a>
        <a href="v_messagerie.php">Messagerie</a>
        <a href="v_profile.php">Profil</a>
        <a href="v_connection.php" class="button-header">Se connecter</a>
        <a href="v_inscription.php" class="button-header secondary">S'inscrire</a>
    </nav>
</header>

