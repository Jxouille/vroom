<?php require "../head_&_header.php";?>

<body>

    <style>
        /* Local layout fixes for this page only */
        body { display: flex; flex-direction: column; min-height: 100vh; }
        .main-wrapper { flex: 1; display: flex; justify-content: center; align-items: center; padding: 24px; box-sizing: border-box; }
        .page-container { width: 100%; max-width: 900px; }
    </style>

    <script>
        // Robustly ensure <header> is placed at the top of the body
        document.addEventListener('DOMContentLoaded', function () {
            function moveElementToBodyTop(el) {
                try {
                    // clone then remove original to avoid layout flicker
                    var clone = el.cloneNode(true);
                    // insert clone before main wrapper if present, otherwise at body start
                    var ref = document.querySelector('.main-wrapper') || document.body.firstChild;
                    document.body.insertBefore(clone, ref);
                    // remove the original from its old parent
                    if (el.parentElement) el.parentElement.removeChild(el);
                } catch (e) {
                    console.error('Error moving element to body top:', e);
                }
            }

            var headers = document.getElementsByTagName('header');
            for (var i = 0; i < headers.length; i++) {
                var h = headers[i];
                if (h.parentElement !== document.body) {
                    moveElementToBodyTop(h);
                    // break because live collection has changed
                    break;
                }
            }

            // Ensure footer is inside body at the end
            var footers = document.getElementsByTagName('footer');
            for (var j = 0; j < footers.length; j++) {
                var f = footers[j];
                if (f.parentElement !== document.body) {
                    try {
                        var fclone = f.cloneNode(true);
                        document.body.appendChild(fclone);
                        if (f.parentElement) f.parentElement.removeChild(f);
                    } catch (e) { console.error('Error moving footer:', e); }
                    break;
                }
            }
        });
    </script>

    <div class="main-wrapper">
    <div class="page-container">
        
        <div class="header-title">Détail trajet</div>
        <div class="header-bandeau"></div>

        <div class="main-content">
            
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
                            <div class="detail-gare">Gare de lyon - Hall 1 & 2</div>
                        </div>
                        <div class="gare arrivee">
                            <div class="ville">Lyon</div>
                            <div class="detail-gare">Gare à lyon</div>
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
                <!-- Bouton centré et pleine largeur -->
                
            </div>
            <div class="button-row">
                <button class="btn-fullwidth">Confirmer le trajet</button>
            </div>
        </div>
    </div>
    <?php include "../footer.php";?>
</body>
</html>