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
    <img src="../../Ressources/Image/logo_ver2.png"  alt="Logo Vroom">
    <nav class="nav-main">
        <a href="v_accueil.php">Accueil</a>
        <a href="v_recherche_trajet.php">Réserver</a>
        <a href="v_publie_trajet.php">Publier</a>
    </nav>
    <nav class="nav-profile">
        <img src="../../Ressources/Image/person_icon.png"  alt="Logo Vroom">
        <ul>
            <li><a href="v_mes_trajets.php">Mes trajets"</a></li>
            <li> <a href="v_messagerie.php">Messagerie</a></li>
            <li><a href="v_profile.php">Profil</a></li> 
            <li><a href="v_connection.php" class="button-header">Se connecter</a></li> 
            <li><a href="v_inscription.php" class="button-header secondary">S'inscrire</a></li> 
        </ul>
        
    </nav>
</header>

