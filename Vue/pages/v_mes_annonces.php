
<body>
    
    <section class="trajets-container">
    
            <?php if (!empty($annonces)): ?>
                <?php foreach ($annonces as $annonce): 
                    $trajet = Annonces::detail_trajet((int)$annonce['id']);
                    
                    if (!$trajet) continue;
                ?>
                    <div class="trajet-ligne">
                        <div class="col-driver">
                            
                            <div class="avatar">
                                <?php if (!empty($trajet["chemin_avatar"])): ?>
                                    <img src="<?= htmlspecialchars($trajet["chemin_avatar"]) ?>" alt="Avatar">
                                <?php else: ?>
                                    <img src="Ressources/Image/person_icon.png" alt="Avatar par défaut">
                                <?php endif; ?>
                            </div>
                            <div class="driver-name"><?= htmlspecialchars($trajet["conducteur_nom"] ?? '') ?></div>
                            <div class="driver-stars">⭐ <?= htmlspecialchars($trajet["conducteur_note"] ?? 0) ?></div>
                            <div class="driver-details">
                                <p><?= htmlspecialchars($trajet["marque"] ?? '') ?></p>
                                <p><?= htmlspecialchars($trajet["modele"] ?? '') ?></p>
                            </div>
                        </div>

                        <div class='col-date'>
                            <div class="date-trajet">
                                <?= htmlspecialchars(formatDateFr($trajet['date_depart'])) ?>
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
                            <div class="time-block">
                                <span class="heure"><?= htmlspecialchars($trajet["heure_arrivee"] ?? '') ?></span>
                            </div>
                        </div>

                        <div class="col-villes">
                            <div class="ville">
                                <h4><?= htmlspecialchars($trajet["ville_depart"] ?? '') ?></h4>
                            </div>
                            <div class="ville">
                                <h4><?= htmlspecialchars($trajet["ville_arrivee"] ?? '') ?></h4>
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
                        
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="col-favori">
                                <button class="btn-favori" action="index.php?page=recherche_trajetdata&action=favoris&id_favori="<?= $trajet['id'] ?>>♥</button>
                            </div>
                        <?php endif; ?>
                        
                       

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun trajet trouvé</p>
            <?php endif; ?>
        
    </section>

</body>