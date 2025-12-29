

<body>
    <div class="main-wrapper">
    <div class="page-container">
        
        <div class="header-title">Détail trajet</div>
        <div class="header-bandeau"></div>
        <?php if (!$annonce): ?>
            <p>Trajet introuvable</p>
        <?php return; endif; ?>

        <div class="main-content">
            
            <!-- Détails conducteur (profil + note + prix) -->
            <div class="info-card">
                <div class="driver-card">
                    <div class="driver-left">
                        <div class="avatar">JD</div>
                        <div class="driver-info">
                            <div class="driver-name"><?= htmlspecialchars($annonce['conducteur_nom']) ?></div>
                            <div class="vehicle"><?= htmlspecialchars($annonce['marque']) ?> • <?= htmlspecialchars($annonce['modele']) ?></div>
                            <div class="rating" title="Note 4.5 sur 5">
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star">★</span>
                                <span style="margin-left:8px;color:#6c757d;font-weight:700;">
                                    <?= $annonce['note_conducteur'] ?>/5
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="driver-right">
                        <div class="price"><?= htmlspecialchars($annonce['prix_par_personne']) ?></div>
                        <button class="contact-small">Contacter</button>
                    </div> <!-- pop up messagerie avec le conducteur en java script à faire -->
                </div> 
            </div>

            <!-- Date card (placed under driver details) -->
            <div class="info-card">
                <h2 class="card-title"><?= htmlspecialchars($annonce['date_depart']) ?></h2>

                <div class="trajet-detail">
                    <div class="heures">
                        <span class="heure-depart"><?= htmlspecialchars($annonce['heure_depart']) ?></span>
                        <span class="heure-arrivee"><?= htmlspecialchars($annonce['heure_depart']) ?></span>
                    </div>

                    <div class="separateur"></div>

                    <div class="gares-info">
                        <div class="gare depart">
                            <div class="ville"><?= htmlspecialchars($annonce['lieu_depart']) ?></div>
                            <div class="detail-gare"><?= htmlspecialchars($annonce['lieu_depart']) ?></div>
                        </div>
                        <div class="gare arrivee">
                            <div class="ville"><?= htmlspecialchars($annonce['lieu_arrivee']) ?></div>
                            <div class="detail-gare"><?= htmlspecialchars($annonce['lieu_arrivee']) ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-card" id="premiere-section-info">
                <h2 class="card-title">Information du trajet</h2>
                
                <div class="info-item">
                    <span class="info-icone">🚬</span> 
                    <div class="info-texte">
                        <div class="regle">Fumeur autorisé</div>
                        <div class="description">Les passagers peuvent fumer pendant le trajet</div>
                    </div>
                </div>

                <div class="info-item">
                    <span class="info-icone">🎵</span>
                    <div class="info-texte">
                        <div class="regle">Musique</div>
                        <div class="description">Musique autorisée pendant le trajet</div>
                    </div>
                </div>

                <div class="info-item">
                    <span class="info-icone">🛄</span>
                    <div class="info-texte">
                        <div class="regle">Bagages acceptés</div>
                        <div class="description">Les passagers peuvent apporter des bagages</div>
                    </div>
                </div>
            </div>
<!-- ON APPELERA ICI LA PAGE DE PAYEMENT FICTIF -->
            <!-- Bouton centré et pleine largeur (séparé de la carte) -->
            <div class="button-row">
                <a href="index.php?page=paiement&id=<?= $annonce['id'] ?>"
                class="confirm-btn"
                aria-label="Confirmer le trajet">
                Confirmer le trajet
                </a>
            </div>
        </div>
    </div>
</body>
</html>