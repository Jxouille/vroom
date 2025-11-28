<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vroom - Covoiturage</title>
    <link rel="stylesheet" href="../../Ressources/CSS/commun.css"> 
    <link rel="stylesheet" href="../../Ressources/CSS/acceuil.css">
</head>
<?php require "../header.php";?>
<body>
    <section class="top-page">
        <div class="landing-content">
            <div class="intro-box">
                <h1>Voyagez ensemble, économisez et protégez la planète</h1>
                <p>VROOM rend le covoiturage simple, économique et écologique. Partagez vos trajets, réduisez votre empreinte carbone et voyagez pour moins cher.</p>
                <div class="buttons-container">
                    <a href="#" class="button button-primary">Trouver un trajet →</a>
                    <a href="#" class="button button-secondary">Proposer un trajet</a> 
                </div>
            </div>
            </div>

        <section class="search-trips">
            <div class="search-item">
                <img src="../../Ressources/Image/Date.png" alt="Date de départ">
                <input type="date" placeholder="jj/mm/aaaa">
            </div>
            <div class="search-item">
                <img src="../../Ressources/Image/position.png" alt="Lieu de départ">
                <input type="text" placeholder="Lieu de départ">
            </div>
            <div class="search-item">
                <img src="../../Ressources/Image/position.png" alt="Lieu d'arrivée">
                <input type="text" placeholder="Lieu d'arrivée">
            </div>
            <div class="search-item">
                <img src="../../Ressources/Image/nombre_de_personnes.png" alt="Nombre de personnes">
                <input type="number" min="1" placeholder="Nombre de personnes">
            </div>
            <button class="search-button">Rechercher</button>
        </section>
    </section>

    <div class="texte-intro">
        <h2>Pourquoi choisir VROOM ?</h2>
        <a>Le covoiturage qui fait du bien à votre portefeuile et à la planète</h3>
    </div>

    <section class = "avantages">
        <section class="avantages-item">
            <img src="../../Ressources/Image/feuille.png" alt="" class="icone">
            <h3>Écologique</h3>
            <p>Réduisez votre empreinte carbone jusqu'à 75% en partageant vos trajets</p>
        </section>

        <section class="avantages-item">
            <img src="../../Ressources/Image/portefeuille.png" alt="" class="icone">
            <h3>Économique</h3>
            <p>Divisez vos frais de route par le nombre de passagers et économisez</p>
        </section>

        <section class="avantages-item">
            <img src="../../Ressources/Image/gens.png" alt="" class="icone">
            <h3>Convivial</h3>
            <p>Rencontrez de nouvelles personnes et partagez des moments agréables</p>
        </section>

        <section class="avantages-item">
            <img src="../../Ressources/Image/bouclier.png" alt="" class="icone">
            <h3>Sécurisé</h3>
            <p>Profils vérifiés et système de notation pour voyager en toute confiance</p>
        </section>
    </section>

    <div class="texte-intro">
        <h2>Comment ça marche ?</h2>
        <a>Covoiturer n'a jamais été aussi simple</a>
    </div>
    <section class="fonctionnement">
        <section class="fonctionnement-item">
            <img src="../../Ressources/Image/rechercher.png" alt="" class="icone-fonctionnement">
            <h3>Recherchez</h3>
            <p>Trouvez un trajet qui correspond à vos besoins parmi des miliers d'options</p>
        </section>

        <section class="fonctionnement-item">
            <img src="../../Ressources/Image/message.png" alt="" class="icone-fonctionnement">
            <h3>Réservez</h3>
            <p>Contactez le conducteur et réserver votre place en quelques clics</p>
        </section>

        <section class="fonctionnement-item">
            <img src="../../Ressources/Image/voiture.png" alt="" class="icone-fonctionnement">
            <h3>Partagez</h3>
            <p>Profitez du trajet, faites des économies et réduisez votre impact environnemental</p>
        </section>
    </section>
        
    <section class="texte-intro">
            <h2>Trajets populaires</h2>
            <a>Découvrez les trajets les plus demandés cette semaine</a>
    </section>

    <section class="trajet-populaire">
        <section class="trajet-item">
            <div class="avatar">MD</div>
            <h3>Paris </h3>
            <h3>Lyon</h3>
            <p>Départ : 15 août 2024</p>
            <p>Prix : 20€</p>
        </section>

        <section class="trajet-item">
            <div class="avatar">TL</div>
            <h3>Bordeaux</h3>
            <h3>Toulouse</h3>
            <p>Départ : 22 août 2024</p>
            <p>Prix : 22€</p>
        </section>

        <section class="trajet-item">
            <div class="avatar">SM</div>
            <h3>Marseille</h3>
            <h3>Nice</h3>
            <p>Départ : 20 août 2024</p>
            <p>Prix : 18€</p>
        </section>
    </section>
<?php require "../footer.php";?>
</body>
</html>

