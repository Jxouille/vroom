

<link rel="stylesheet" href="Ressources/Css/listeTrajets.css">

<?php
/*   
htmlspecialchars() est une fonction PHP très importante pour la sécurité et l’affichage HTML.
Elle convertit les caractères spéciaux en entités HTML, pour que le navigateur ne les interprète pas comme du code HTML.
*/
// Tableau de trajets
$trajets = [
    [
        "prenom" => "Marie",
        "nom" => "D.",
        "avatar" => "MD",
        "note" => 4.9,
        "places" => 2,
        "depart" => "Paris",
        "destination" => "Lyon",
        "date" => "Lundi 20 Oct • 14:00",
        "prix" => 25
    ],
    [
        "prenom" => "Thomas",
        "nom" => "L.",
        "avatar" => "TL",
        "note" => 5.0,
        "places" => 3,
        "depart" => "Marseille",
        "destination" => "Nice",
        "date" => "Mardi 21 Oct • 09:30",
        "prix" => 15
    ],
    [
        "prenom" => "Sophie",
        "nom" => "M.",
        "avatar" => "SM",
        "note" => 4.8,
        "places" => 1,
        "depart" => "Bordeaux",
        "destination" => "Toulouse",
        "date" => "Mercredi 22 Oct • 16:00",
        "prix" => 18
    ],
];
?>
<body>

    <section class="search-container">
        <form class="search-box" action="index.php" method="GET">

            <div class="search-field">
                <div class="icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/></svg></div>
                <div class="field-content">
                    <label>Départ</label>
                    <input type="text" name="depart" placeholder="Ville de départ">
                </div>
            </div>

            <div class="divider"></div>

            <div class="search-field">
                <div class="icon"><svg viewBox="0 0 24 24"><path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7z"/></svg></div>
                <div class="field-content">
                    <label>Destination</label>
                    <input type="text" name="destination" placeholder="Ville d'arrivée">
                </div>
            </div>

            <div class="divider"></div>

            <div class="search-field">
                <div class="icon"><svg viewBox="0 0 24 24"><path d="M4 12h16m-6-6l6 6-6 6"/></svg></div>
                <div class="field-content">
                    <label>Date</label>
                    <input type="date" name="date">
                </div>
            </div>

            <button class="search-btn" type="submit" name="action" value="actionChercherTrajets">Rechercher</button>

        </form>
    </section>


    <section class="trajets-list-section">
        <div class="trajets-container">

            <?php foreach ($trajets as $t): ?>
            <div class="trajet-ligne">

                <!-- COLONNE 1 : AVATAR + NOM + OPTIONS -->
                <div class="col-driver">
                    <div class="avatar"><?= htmlspecialchars($t["avatar"]) ?></div>

                    <div class="driver-text">
                        <div class="driver-name">
                            <?= htmlspecialchars($t["prenom"]) ?> <?= htmlspecialchars($t["nom"]) ?>
                        </div>
                        <div class="driver-stars">
                            ⭐ <?= htmlspecialchars($t["note"]) ?>
                        </div>

                        <div class="driver-details">
                            <p>Type voiture</p>
                            <p>Options</p>
                        </div>
                    </div>
                </div>

                <!-- COLONNE 2 : HEURES + TRAJET VERT -->
                <div class="col-horaires">
                    <div class="time-block">
                        <span class="heure">14:59</span>
                        <span class="duree">1h57</span>
                        <span class="heure">16:56</span>
                    </div>

                    <div class="ligne-verte">
                        <span class="dot"></span>
                        <div class="bar"></div>
                        <span class="dot"></span>
                    </div>
                </div>

                <!-- COLONNE 3 : VILLES -->
                <div class="col-villes">
                    <div class="ville">
                        <h4><?= htmlspecialchars($t["depart"]) ?></h4>
                        <p>Gare de Lyon - Hall 1 & 2</p>
                    </div>

                    <div class="ville">
                        <h4><?= htmlspecialchars($t["destination"]) ?></h4>
                        <p>Gare de Lyon - Hall 1 & 2</p>
                    </div>
                </div>

                <!-- COLONNE 4 : PRIX + BOUTON -->
                <div class="col-prix">
                    <div class="prix"><?= htmlspecialchars($t["prix"]) ?> €</div>
                    <span class="prix-info">Par personne<br>2 places</span>

                    <button class="btn-reserver">Réserver</button>
                </div>

            </div>
            <?php endforeach; ?>

        </div>
    </section>
</body>
