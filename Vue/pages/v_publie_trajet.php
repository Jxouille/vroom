
<body>

    <div class="page-container">
        
        <header class="page-header">
            <h2>Proposer un trajet</h2>
            <p>Remplissez les informations de votre trajet pour commencer à utiliser Vroom en toute simplicité.</p>
        </header>

        <form class="ride-form">

            <section class="form-section">
                <h3>Itinéraire</h3>
                <div class="grid-2-cols">
                    <label class="input-group">
                        <span class="label-text">Ville de départ</span>
                        <input type="text" value="Paris">
                    </label>
                    <label class="input-group">
                        <span class="label-text">Adresse de départ (optionnel)</span>
                        <input type="text" value="22 Rue de Rivoli">
                    </label>
                    <label class="input-group">
                        <span class="label-text">Ville d'arrivée</span>
                        <input type="text" value="Lyon">
                    </label>
                    <label class="input-group">
                        <span class="label-text">Adresse d'arrivée (optionnel)</span>
                        <input type="text" value="15 Place Bellecour">
                    </label>
                </div>
            </section>

            <section class="form-section">
                <h3>Date et Heure</h3>
                <div class="grid-2-cols">
                    <label class="input-group">
                        <span class="label-text">Date du trajet</span>
                        <input type="text" placeholder="jj/mm/aaaa">
                    </label>
                    <label class="input-group">
                        <span class="label-text">Heure de départ</span>
                        <input type="text" placeholder="hh:mm">
                    </label>
                </div>
            </section>

            <section class="form-section">
                <h3>Détails du trajet</h3>
                <div class="grid-2-cols">
                    <label class="input-group">
                        <span class="label-text icon-label">Nombre de places disponibles</span>
                        <input type="number" value="3" min="1" max="8">
                    </label>
                    <label class="input-group">
                        <span class="label-text icon-label">Prix par passager (€)</span>
                        <input type="number" value="20" min="0">
                    </label>
                    <label class="input-group">
                        <span class="label-text icon-label">Modèle de voiture</span>
                        <input type="text" value="Renault Clio">
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
                    <textarea placeholder="Ajouter des détails sur votre trajet, les arrêts possible, etc."></textarea>
                </label>
            </section>

            <button type="submit" class="submit-button">Confirmer le trajet</button>

        </form>

    </div>

</body>


