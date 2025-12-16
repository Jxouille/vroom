<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Accueil - Covoiturage</title>


<link rel="stylesheet" href="Ressources/Css/accueil.css">
</head>
<body>


<?php include("Views/vHeader.php"); ?>


<div class="hero">
    <img src="Ressources/Images/img_kv_pc.jpg" alt="Voiture" class="hero-img">

   <section class="search-container">
    <form class="search-box" action="index.php" method="GET">

        <div class="search-field">
            <div class="icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9" stroke-width="2" fill="none"/>
                </svg>
            </div>
            <div class="field-content">
                <label>Départ</label>
                <input type="text" name="depart" placeholder="Ville de départ" >
            </div>
        </div>

        <div class="divider"></div>

        <div class="search-field">
            <div class="icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7z"/>
                </svg>
            </div>
            <div class="field-content">
                <label>Destination</label>
                <input type="text" name="destination" placeholder="Ville d'arrivée" >
            </div>
        </div>

        <div class="divider"></div>

        <div class="search-field">
            <div class="icon">
                <svg viewBox="0 0 24 24">
                    <path d="M4 12h16m-6-6l6 6-6 6"/>
                </svg>
            </div>
            <div class="field-content">
                <label>Date</label>
                <input type="date" name="date" >
            </div>
        </div>

        <button class="search-btn" type="submit" name="action" value="actionChercherTrajets">Rechercher</button>

    </form>
</section>
</div>


<div class="texte-intro">
    <h2>Pourquoi choisir VROOM ?</h2>
    <p>Le covoiturage qui fait du bien à votre portefeuille et à la planète</p>
</div>


<section class="avantages">

    <div class="avantages-item">
        <!-- Icône Écologique -->
        <svg class="avantage-icon" viewBox="0 0 24 24">
            <path d="M12 2a10 10 0 0 0-7 17l7-7V2zm2 2v7l7 7A10 10 0 0 0 14 4z"/>
        </svg>
        <h3>Écologique</h3>
        <p>Réduisez votre empreinte carbone jusqu'à 75% en partageant vos trajets</p>
    </div>

    <div class="avantages-item">
        <!-- Icône Economique -->
        <svg class="avantage-icon" viewBox="0 0 24 24">
            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 2.18l6 2.67v5.4c0 4.73-3 9.23-6 10.34-3-1.11-6-5.61-6-10.34v-5.4l6-2.67z"/>
        </svg>
        <h3>Économique</h3>
        <p>Divisez vos frais de route par le nombre de passagers et économisez</p>
    </div>

    <div class="avantages-item">
        <!-- Icône Convivial -->
        <svg class="avantage-icon" viewBox="0 0 24 24">
            <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5zm-8 9v-2c0-3.31 4.03-5 8-5s8 1.69 8 5v2"/>
        </svg>
        <h3>Convivial</h3>
        <p>Rencontrez de nouvelles personnes et partagez des moments agréables</p>
    </div>

    <div class="avantages-item">
        <!-- Icône Sécurité -->
        <svg class="avantage-icon" viewBox="0 0 24 24">
            <path d="M12 2l8 4v6c0 7-5.33 11-8 12-2.67-1-8-5-8-12V6l8-4zm0 5a3 3 0 0 0-3 3v2h6V10a3 3 0 0 0-3-3z"/>
        </svg>
        <h3>Sécurisé</h3>
        <p>Profils vérifiés et système de notation pour voyager en toute confiance</p>
    </div>

</section>

<!-- SECTION : Comment ça marche -->
<section class="how-it-works">
    <h2>Comment ça marche ?</h2>
    <p>Covoiturer n'a jamais été aussi simple</p>

    <div class="steps">
        <div class="step">
            <div class="step-icon"></div>
            <h3>Recherchez</h3>
            <p>Trouvez un trajet qui correspond à vos besoins parmi des milliers d’options</p>
        </div>

        <div class="step">
            <div class="step-icon"></div>
            <h3>Réservez</h3>
            <p>Contactez le conducteur et réservez votre place en quelques clics</p>
        </div>

        <div class="step">
            <div class="step-icon"></div>
            <h3>Voyagez</h3>
            <p>Profitez du trajet et payez directement le conducteur sur la plateforme</p>
        </div>
    </div>
</section>


<!-- SECTION : Trajets populaires -->
<section class="popular-rides">
    <h2>Trajets populaires</h2>
    <p>Découvrez les trajets les plus demandés cette semaine</p>

    <div class="rides-list">

        <!-- CARD 1 -->
        <div class="ride-card">
            <div class="ride-header">
                <div class="avatar">MD</div>
                <div>
                    <h4>Marie D.</h4>
                    <span> 4.9</span>
                </div>
                <span class="places">2 places</span>
            </div>

            <div class="ride-route">
                <p>Paris</p>
                <div class="line"></div>
                <p>Lyon</p>
            </div>

            <div class="ride-info">
                <p> Lundi 20 Oct • 14:00</p>
                <p class="price">25€/pers</p>
            </div>

            <button class="ride-btn">Réserver</button>
        </div>

        <!-- CARD 2 -->
        <div class="ride-card">
            <div class="ride-header">
                <div class="avatar">TL</div>
                <div>
                    <h4>Thomas L.</h4>
                    <span> 5.0</span>
                </div>
                <span class="places">3 places</span>
            </div>

            <div class="ride-route">
                <p>Marseille</p>
                <div class="line"></div>
                <p>Nice</p>
            </div>

            <div class="ride-info">
                <p> Mardi 21 Oct • 09:30</p>
                <p class="price">15€/pers</p>
            </div>

            <button class="ride-btn">Réserver</button>
        </div>

        <!-- CARD 3 -->
        <div class="ride-card">
            <div class="ride-header">
                <div class="avatar">SM</div>
                <div>
                    <h4>Sophie M.</h4>
                    <span> 4.8</span>
                </div>
                <span class="places">1 place</span>
            </div>

            <div class="ride-route">
                <p>Bordeaux</p>
                <div class="line"></div>
                <p>Toulouse</p>
            </div>

            <div class="ride-info">
                <p> Mercredi 22 Oct • 16:00</p>
                <p class="price">18€/pers</p>
            </div>

            <button class="ride-btn">Réserver</button>
        </div>

    </div>

    <button class="all-rides-btn" >Voir tous les trajets</button>
</section>

<?php include("Views/vFooter.php"); ?>