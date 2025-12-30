<header>
    <div class="header-content">  
        <img src="../../Ressources/Image/logo_ver2.png"  alt="Logo Vroom">
        <nav class="nav-main">
            <a href="index.php?page=accueil">Accueil</a>
            <a href="index.php?page=recherche_trajet">Chercher un trajet </a>
            <a href="index.php?page=publie_trajet">Publier</a>
        </nav>
        <nav class="nav-profile">
            <label for="show-menu" class="show-menu">Show Menu</label>
            <input type="checkbox" id="show-menu" role="button">
                <img src="../../Ressources/Image/person_icon.png"  alt="Logo Vroom">
                <ul classe="hidden">
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <li><a href="index.php?page=profil" class="button-header">Mon profil</a></li> 
                        <li><a href="index.php?page=mes_reservations" class="button-header">Mes réservations</a></li> 
                        <li><a href="index.php?page=mes_annonces" class="button-header">Mes annonces</a></li> 
                        <li><a href="index.php?page=mes_paiements" class="button-header">Mes paiements</a></li> 
                        <li><a href="index.php?page=mes_documents" class="button-header">Mes documents</a></li> 
                        <li><a href="index.php?page=favoris" class="button-header">Mes favoris</a></li> 
                        <li><a href="index.php?page=connexion&action=deconnexion" class="button-header">Se déconnecter</a></li>
                    <?php } else { ?>
                        <li><a href="index.php?page=connexion" class="button-header">Se connecter</a></li> 
                        <li><a href="index.php?page=inscription" class="button-header">S'inscrire</a></li> 
                    <?php } ?>
                </ul>
        </nav>
    </div>
</header>

