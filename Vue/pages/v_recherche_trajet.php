<script>
function toggleFilters() {
    document.getElementById('filtersPanel').classList.toggle('open');
}
</script>
<body>
    <section class="search-container">
        <form class="search-box" action="index.php" method="GET">

            <!-- Page cible -->
            <input type="hidden" name="page" value="recherche_trajet">

            <div class="search-field">
                <div class="icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9" stroke-width="2" fill="none"/>
                    </svg>
                </div>
                <div class="field-content">
                    <label>Départ</label>
                    <input type="text" name="ville_depart" 
                    <?php if (!empty($_GET['ville_depart'])):?>
                        value="<?= htmlspecialchars($_GET['ville_depart']) ?>"
                    <?php else: ?>
                        placeholder="Ville de départ" 
                    <?php endif; ?> 
                    >
                </div>
            </div>

            <div class="divider"></div>

            <div class="search-field">
                <div class="icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7z"/>
                    </svg>
                </div>
                <div class="field-content">
                    <label>Destination</label>
                    <input type="text" name="ville_arrivee" 
                    <?php if (!empty($_GET['ville_arrivee'])): ?>
                        value="<?= htmlspecialchars($_GET['ville_arrivee']) ?>"
                    <?php else: ?>
                        placeholder="Ville d'arrivée" 
                    <?php endif; ?>
                    >
                </div>
            </div>

            <div class="divider"></div>

            <div class="search-field">
                <div class="icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 12h16m-6-6l6 6-6 6"/>
                    </svg>
                </div>
                <div class="field-content">
                    <label>Date</label>
                    <input type="date" 
                        name="date_depart"
                        min="<?= date('Y-m-d') ?>"
                        <?php if (!empty($_GET['date_depart'])): ?>
                            value="<?= htmlspecialchars($_GET['date_depart']) ?>"
                        <?php else: ?>
                            value="<?= date('Y-m-d') ?>"
                        <?php endif; ?>
                        >
                </div>
            </div>
            <button class="search-btn" type="submit" >Rechercher</button>
        </form>
    </section>
    <section>
        <button type="button" class="filter-btn" onclick="toggleFilters()"> ⚙️ Filtrer </button>
            <div class="filters-panel" id="filtersPanel">

                <div class="filter-group">
                    <label>Prix max ($)</label>
                    <input type="number" name="prix_max"
                        value="<?= htmlspecialchars($_GET['prix_max'] ?? '') ?>">
                </div>

                <div class="filter-group">
                    <label>Heure de départ après</label>
                    <input type="time" name="heure_min"
                        value="<?= htmlspecialchars($_GET['heure_min'] ?? '') ?>">
                </div>

                <div class="filter-group">
                    <label>Places minimum</label>
                    <input type="number" name="places_min" min="1"
                        value="<?= htmlspecialchars($_GET['places_min'] ?? '') ?>">
                </div>

            </div>
    </section>


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
                            
                            <div class="prix"><?= htmlspecialchars($trajet["prix_par_personne"] ?? '') ?> €</div>
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

<script>
document.querySelectorAll('.btn-favori').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        this.classList.toggle('active');

        // ID du trajet
        const trajetId = this.dataset.id;
        console.log("Favori cliqué pour trajet :", trajetId);

        // PLUS TARD :
        // fetch('index.php?page=favoris&action=toggle', {...}) 
    });
});
</script>