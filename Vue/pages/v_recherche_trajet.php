

<link rel="stylesheet" href="Ressources/Css/listeTrajets.css">


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
            <?php if (!empty($annonces)): ?>
                <?php foreach ($annonces as $annonce): 
                    $trajet = Annonces::detail_trajet((int)$annonce['id']);
                    
                    if (!$trajet) continue;
                ?>
                    <div class="trajet-ligne">
                        <div class="col-driver">
                            <div class="avatar"><?= htmlspecialchars($trajet["avatar"] ?? '') ?></div>
                            <div class="driver-name"><?= htmlspecialchars($trajet["conducteur_nom"] ?? '') ?></div>
                            <div class="driver-stars">⭐ <?= htmlspecialchars($trajet["conducteur_note"] ?? 0) ?></div>
                            <div class="driver-details">
                                <p><?= htmlspecialchars($trajet["marque"] ?? '') ?></p>
                                <p><?= htmlspecialchars($trajet["modele"] ?? '') ?></p>
                            </div>
                        </div>

                        <div class="col-horaires">
                            <div class="time-block">
                                <span class="heure"><?= htmlspecialchars($trajet["heure_depart"]) ?></span>
                            </div>
                            <div class="ligne-verte">
                                <span class="dot"></span>
                                <div class="bar"></div>
                                <span class="dot"></span>
                            </div>
                        </div>

                        <div class="col-villes">
                            <div class="ville">
                                <h4><?= htmlspecialchars($trajet["lieu_depart"]) ?></h4>
                            </div>
                            <div class="ville">
                                <h4><?= htmlspecialchars($trajet["lieu_arrivee"]) ?></h4>
                            </div>
                        </div>

                        <div class="col-prix">
                            <div class="prix"><?= htmlspecialchars($trajet["prix_par_personne"]) ?> MAD</div>
                            <span class="prix-info">Par personne<br><?= htmlspecialchars($trajet["places_disponibles"]) ?></span>
                            <button class="btn-reserver"
                                onclick="window.location.href='index.php?page=detail_trajet&id=<?= htmlspecialchars($trajet['id']) ?>'">
                                Réserver
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun trajet trouvé</p>
            <?php endif; ?>
        </div>
    </section>
