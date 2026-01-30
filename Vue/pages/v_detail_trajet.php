<body>
<!-- POPUP CONTACT -->
<div class="modal-overlay" id="contactModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Contacter le conducteur</h3>
            <span class="modal-close" id="closeModal">&times;</span>
        </div>
        <div class="modal-body">
            <p>
                Votre message sera envoyé à
                <strong><?= htmlspecialchars($annonce['conducteur_nom']) ?></strong>
            </p>
            
            <form method="POST"
                action="index.php?page=messagerie&action=envoyer&id=<?= $annonce['conducteur_id'] ?>">

                <textarea id="messageContenu"
                        name="message"
                        placeholder="Écrivez votre message ici..."
                        rows="5"
                        required></textarea>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="cancelModal">Annuler</button>
                    <button type="submit" class="btn-send" id="">Envoyer</button>
                </div>
            </form>

        </div>
    </div>
</div>

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
                        <div class="avatar">
                            <?php if (!empty($annonce["chemin_avatar"])): ?>
                                <img src="<?= htmlspecialchars($annonce["chemin_avatar"]) ?>" alt="Avatar">
                            <?php else: ?>
                                <img src="Ressources/Image/person_icon.png" alt="Avatar par défaut">
                            <?php endif; ?>
                        </div>
                        <div class="driver-info">
                            <div class="driver-name"><?= htmlspecialchars($annonce['conducteur_nom']) ?></div>
                            <div class="vehicle"><?= htmlspecialchars($annonce['marque']) ?> • <?= htmlspecialchars($annonce['modele']) ?></div>
                            <div class="rating">
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star">★</span>
                                <span style="margin-left:8px;color:#6c757d;font-weight:700;">
                                    <?= $annonce['conducteur_note'] ?>/5
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="driver-right">
                        <div class="price"><?= htmlspecialchars($annonce['prix_par_personne']) ?> €</div>
                        <button class="btn-reserver" id="btnContacter">Contacter</button>


                    </div> <!-- pop up messagerie avec le conducteur en java script à faire -->
                </div> 
            </div>

            <!-- Date card (placed under driver details) -->
            <div class="info-card">
                <h2 class="card-title"><?= htmlspecialchars(formatDateFr($annonce['date_depart'])) ?></h2>

                <div class="trajet-detail">
                    <div class="heures">
                        <span class="heure-depart"><?= htmlspecialchars($annonce['heure_depart']) ?></span>
                        <span class="heure-arrivee"><?= htmlspecialchars($annonce['heure_arrivee']?? '') ?></span>
                    </div>

                    <div class="separateur"></div>

                    <div class="gares-info">
                        <div class="gare depart">
                            <div class="ville"><?= htmlspecialchars($annonce['ville_depart']) ?></div>
                            <div class="detail-gare"><?= htmlspecialchars($annonce['adresse_depart']) ?></div>
                        </div>
                        <div class="gare arrivee">
                            <div class="ville"><?= htmlspecialchars($annonce['ville_arrivee']) ?></div>
                            <div class="detail-gare"><?= htmlspecialchars($annonce['adresse_arrivee']) ?></div>
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
            <div class="rgpd-checkbox">
                <label>
                    <input type="checkbox" required>
                    J’accepte la
                    <a href="index?page=rgdp" target="_blank">
                        politique de confidentialité
                    </a>
                </label>
            </div>

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
<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('contactModal');
    const openBtn = document.getElementById('btnContacter');
    const closeBtn = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelModal');

    if (!modal || !openBtn) {
        console.error('Modal ou bouton introuvable');
        return;
    }

    openBtn.addEventListener('click', function () {
        modal.classList.add('active');
    });

    [closeBtn, cancelBtn].forEach(btn => {
        if (btn) {
            btn.addEventListener('click', () => {
                modal.classList.remove('active');
            });
        }
    });

    modal.addEventListener('click', e => {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });

});
</script>
