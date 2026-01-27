<body>
    <section class="trajets-container">
        <!-- Trajets à venir -->
        <h2>Trajets à venir</h2>
        <?php if (!empty($trajets_avenir)): ?>
            <?php foreach ($trajets_avenir as $trajet): ?>

                <div class="trajet-ligne">
                    <!-- Conducteur -->
                    <div class="col-driver">
                        <div class="avatar"><?= htmlspecialchars($trajet["chemin_avatar"] ?? '') ?></div>
                        <div>
                            <div class="driver-name"><?= htmlspecialchars($trajet["conducteur_nom"] ?? '') ?></div>
                            <div class="driver-stars">⭐ <?= htmlspecialchars($trajet["conducteur_note"] ?? 0) ?></div>
                            <div class="driver-details">
                                <p>Véhicule : <?= htmlspecialchars($trajet["marque"] ?? '') ?> <?= htmlspecialchars($trajet["modele"] ?? '') ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Horaires -->
                    <div class="col-horaires">
                        <div class="time-block">
                            <span class="heure"><?= htmlspecialchars($trajet["heure_depart"]) ?></span>
                            <span class="duree"><?= htmlspecialchars($trajet["date_depart"]) ?></span>
                        </div>
                        <div>
                            <span class="dot"></span>
                            <div class="bar"></div>
                            <span class="dot"></span>
                        </div>
                    </div>

                    <!-- Villes -->
                    <div class="col-villes">
                        <div class="ville">
                            <h4><?= htmlspecialchars($trajet["lieu_depart"] ?? '') ?></h4>
                        </div>
                        <div class="ville">
                            <h4><?= htmlspecialchars($trajet["lieu_arrivee"] ?? '') ?></h4>
                        </div>
                    </div>

                    <!-- Prix & places -->
                    <div class="col-prix">
                        <div class="prix"><?= htmlspecialchars($trajet["prix_par_personne"] ?? '') ?> $</div>
                        <div class="prix-info"><?= htmlspecialchars($trajet["places_disponibles"] ?? '') ?> places</div>
                        <button class="btn-reserver"
                            onclick="window.location.href='index.php?page=detail_trajet&id=<?= htmlspecialchars($trajet['id_annonce']) ?>'">
                            Voir le trajet
                        </button>
                    </div>
                </div>

                <!-- Statut et date réservation -->
                <div class="trajet-ligne infos">
                    <p><strong>Status réservation :</strong> <?= htmlspecialchars($trajet["statut"] ?? '') ?></p>
                    <p><strong>Date réservation :</strong> <?= htmlspecialchars($trajet["date_creation"] ?? '') ?></p>
                    <p><strong>Description :</strong> <?= htmlspecialchars($trajet["description"] ?? '') ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun trajet à venir</p>
        <?php endif; ?>

        <!-- Trajets effectués -->
        <h2>Trajets effectués</h2>
        <?php if (!empty($trajets_effectues)): ?>
            <?php foreach ($trajets_effectues as $trajet): ?>

                <div class="trajet-ligne" style="opacity: 0.7;">
                    <!-- Conducteur -->
                    <div class="col-driver">
                        <div class="avatar"><?= htmlspecialchars($trajet["avatar"] ?? '') ?></div>
                        <div>
                            <div class="driver-name"><?= htmlspecialchars($trajet["conducteur_nom"] ?? '') ?></div>
                            <div class="driver-stars">⭐ <?= htmlspecialchars($trajet["conducteur_note"] ?? 0) ?></div>
                            <div class="driver-details">
                                <p>Véhicule : <?= htmlspecialchars($trajet["marque"] ?? '') ?> <?= htmlspecialchars($trajet["modele"] ?? '') ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Horaires -->
                    <div class="col-horaires">
                        <div class="time-block">
                            <span class="heure"><?= htmlspecialchars($trajet["heure_depart"]) ?></span>
                            <span class="duree"><?= htmlspecialchars($trajet["date_depart"]) ?></span>
                        </div>
                    </div>

                    <!-- Villes -->
                    <div class="col-villes">
                        <div class="ville">
                            <h4><?= htmlspecialchars($trajet["lieu_depart"] ?? '') ?></h4>
                        </div>
                        <div class="ville">
                            <h4><?= htmlspecialchars($trajet["lieu_arrivee"] ?? '') ?></h4>
                        </div>
                    </div>

                    <!-- Prix -->
                    <div class="col-prix">
                        <div class="prix"><?= htmlspecialchars($trajet["prix_par_personne"] ?? '') ?> $</div>
                    </div>
                </div>

                <!-- Statut et date réservation -->
                <div class="trajet-ligne effectue">
                    <p><strong>Status réservation :</strong> <?= htmlspecialchars($trajet["reservation_status"] ?? '') ?></p>
                    <p><strong>Date réservation :</strong> <?= htmlspecialchars($trajet["date_reservation"] ?? '') ?></p>
                    <p><strong>Description :</strong> <?= htmlspecialchars($trajet["description"] ?? '') ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun trajet effectué</p>
        <?php endif; ?>
    </section>


</body>
    