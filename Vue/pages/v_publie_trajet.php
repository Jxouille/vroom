
<body>
    <div class="page-container">
        <header class="page-header">
            <h2>Proposer un trajet</h2>
            <p>Remplissez les informations de votre trajet pour commencer à utiliser Vroom en toute simplicité.</p>
        </header>

        <form class="ride-form"
                action="index.php?page=publie_trajet&action=publier"
                method="POST" >

            <section class="form-section">
                <h3>Itinéraire</h3>
                <div class="grid-2-cols">
                    <label class="input-group">
                        <span class="label-text">Ville de départ</span>
                        <input type="text" placeholder="Paris" name="ville_depart" required>
                    </label>
                    <label class="input-group">
                        <span class="label-text">Adresse de départ (optionnel)</span>
                        <input type="text" name="adresse_depart" placeholder="22 Rue de Rivoli">
                    </label>
                    <label class="input-group">
                        <span class="label-text">Ville d'arrivée</span>
                        <input type="text" placeholder="Lyon" name="ville_arrivee" required>
                    </label>
                    <label class="input-group">
                        <span class="label-text">Adresse d'arrivée (optionnel)</span>
                        <input type="text" name="adresse_arrivee" placeholder="15 Place Bellecour">
                    </label>
                </div>
            </section>

            <section class="form-section">
                <h3>Date et Heure</h3>
                <div class="grid-2-cols">
                    <label class="input-group">
                        <span class="label-text">Date du trajet</span>
                        <input type="date" name="date_depart" required>
                    </label>
                    <label class="input-group">
                        <span class="label-text">Heure de départ</span>
                        <input type="time" name="heure_depart" required>
                    </label>
                </div>
            </section>
            <section class="form-section">
                <h3>Carte</h3>
                <h2>Trajet estimé</h2>
                <div id="map"></div>
                <div class="info">
                    Distance : <span id="distance">—</span> km<br>
                    Durée : <span id="duration">—</span> min<br>
                    Heure d’arrivée estimée : <span id="arrival">—</span>
                </div>
                <input type="hidden" id="distance_km" name="distance">
                <input type="hidden" id="duree_minutes" name="duree_minutes">
                <input type="hidden" id="route_index" name="route_index">
                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            </section>
            <section class="form-section">
                <h3>Détails du trajet</h3>
                <div class="grid-2-cols">
                    <label class="input-group">
                        <span class="label-text icon-label">Nombre de places disponibles</span>
                        <input type="number" placeholder="3" min="1" max="8" name="places" required>
                    </label>
                    <label class="input-group">
                        <span class="label-text icon-label">Prix par passager (€)</span>
                        <input type="number" placeholder="20" min="0" name="prix" required>
                    </label>
                    <label class="input-group">
                        <span class="label-text icon-label">Modèle de voiture</span>
                        <input type="text" placeholder="Renault Clio">
                    </label>
                    <label class="input-group">
                        <span class="label-text">Niveau de confort</span>
                        <select>
                            <option>Standard</option>
                            <option>Confort</option>
                            <option>Premium</option>
                        </select>
                    </label>
                </div>
            </section>
            <section class="form-section">
                <h3>Préférences</h3>
                <div class="toggle-group">
                    <span class="toggle-label">Fumeur autorisé</span>
                    <p class="toggle-description">Les passagers peuvent fumer pendant le trajet</p>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="toggle-group">
                    <span class="toggle-label">Musique</span>
                    <p class="toggle-description">Vous acceptez d'écouter de la musique pendant le trajet</p>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="toggle-group">
                    <span class="toggle-label">Bagages acceptés</span>
                    <p class="toggle-description">Les passagers peuvent apporter plusieurs bagages</p>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </section>
            <section class="form-section">
                <h3>Description</h3>
                <label class="input-group">
                    <span class="label-text">Informations complémentaires</span>
                    <textarea placeholder="Ajouter des détails sur votre trajet, les arrêts possible, etc." name="description"></textarea>
                </label>
            </section>
            <button type="submit" class="submit-button">
                Confirmer le trajet
            </button>
        </form>
    </div>
</body>


