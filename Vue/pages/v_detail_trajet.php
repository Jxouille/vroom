<?php require "../head_&_header.php";?>

<body>



    <div class="main-wrapper">
    <div class="page-container">
        
        <div class="header-title">Détail trajet</div>
        <div class="header-bandeau"></div>

        <div class="main-content">
            
            <!-- Détails conducteur (profil + note + prix) -->
            <div class="info-card">
                <div class="driver-card">
                    <div class="driver-left">
                        <div class="avatar">JD</div>
                        <div class="driver-info">
                            <div class="driver-name">Jean Dupont</div>
                            <div class="vehicle">Peugeot 308 • 3 places</div>
                            <div class="rating" title="Note 4.5 sur 5">
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star filled">★</span>
                                <span class="star">★</span>
                                <span style="margin-left:8px;color:#6c757d;font-weight:700;">4.5</span>
                            </div>
                        </div>
                    </div>
                    <div class="driver-right">
                        <div class="price">20€</div>
                        <button class="contact-small">Contacter</button>
                    </div>
                </div>
            </div>

            <!-- Date card (placed under driver details) -->
            <div class="info-card">
                <h2 class="card-title">Date</h2>

                <div class="trajet-detail">
                    <div class="heures">
                        <span class="heure-depart">14:59</span>
                        <span class="heure-arrivee">16:56</span>
                    </div>

                    <div class="separateur"></div>

                    <div class="gares-info">
                        <div class="gare depart">
                            <div class="ville">Paris</div>
                            <div class="detail-gare">Gare Montparnasse</div>
                        </div>
                        <div class="gare arrivee">
                            <div class="ville">Lyon</div>
                            <div class="detail-gare">Place Bellecour, 69002</div>
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

            <!-- Bouton centré et pleine largeur (séparé de la carte) -->
            <div class="button-row">
                <button class="confirm-btn" aria-label="Confirmer le trajet">Confirmer le trajet</button>
            </div>
        </div>
    </div>
</body>
</html>