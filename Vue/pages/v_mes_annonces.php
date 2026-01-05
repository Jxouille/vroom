

    <section class="trajets-container">
    
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
                            <div >
                                <span class="dot"></span>
                                <div class="bar"></div>
                                <span class="dot"></span>
                            </div>
                        </div>

                        <div class="col-villes">
                            <div class="ville">
                                <h4><?= htmlspecialchars($trajet["lieu_depart"] ?? '') ?></h4>
                            </div>
                            <div class="ville">
                                <h4><?= htmlspecialchars($trajet["lieu_arrivee"] ?? '') ?></h4>
                            </div>
                        </div>

                        <div class="col-prix">
                            <div class="prix"><?= htmlspecialchars($trajet["prix_par_personne"] ?? '') ?> $</div>
                            <div class="prix-info"><?= htmlspecialchars($trajet["places_disponibles"] ?? '')?> places</div>
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
        
    </section>
</body>