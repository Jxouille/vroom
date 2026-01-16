<header>
    <div class="header-content">  
        <img src="Ressources/Image/logo_ver2.png"  alt="Logo Vroom">
        <nav class="nav-main">
            <a href="index.php?page=accueil">Accueil</a>
            <a href="index.php?page=recherche_trajet">Chercher un trajet </a>
            <a href="index.php?page=publie_trajet">Publier</a>
        </nav>
        <nav class="nav-profile" aria-label="Menu profil">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="profile">
                    <a href="index.php?page=profil" class="profile-link">Mon profil</a>
                    <ul class="profile-menu" role="menu" aria-hidden="true">
                        <li role="menuitem"><a href="index.php?page=mes_reservations">Mes réservations</a></li>
                        <li role="menuitem"><a href="index.php?page=mes_annonces">Mes annonces</a></li>
                        <li role="menuitem"><a href="index.php?page=mes_paiements">Mes paiements</a></li>
                        <li role="menuitem"><a href="index.php?page=mes_documents">Mes documents</a></li>
                        <li role="menuitem"><a href="index.php?page=favoris">Mes favoris</a></li>
                        <li role="menuitem"><a href="index.php?page=connexion&action=deconnexion">Se déconnecter</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="profile">
                    <a href="index.php?page=connexion" class="profile-link">Se connecter</a>
                    <a href="index.php?page=inscription" class="profile-link profile-signup">S'inscrire</a>
                    <ul class="profile-menu-auth" role="menu" aria-hidden="true">
                        <li role="menuitem"><a href="index.php?page=connexion">Se connecter</a></li>
                        <li role="menuitem"><a href="index.php?page=inscription">S'inscrire</a></li>
                    </ul>
                </div>
            <?php endif; ?>
        </nav>
    </div>
</header>

