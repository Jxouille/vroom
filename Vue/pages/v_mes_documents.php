<body>
        <div class="page-container">

            <div class="header-title">Mes documents</div>
            <div class="header-bandeau"></div>

            <div class="main-content">

                <div class="info-card">
                    <h2 class="card-title">Documents obligatoires pour devenir conducteur</h2>
                    <p class="help">Téléversez les documents suivants. Formats acceptés : <strong>JPG, PNG, PDF</strong>. Taille max par fichier : <strong>5 MB</strong>.</p>

                    <form id="documents-form" method="post" action="index.php?page=mes_documents&action=envoyer" enctype="multipart/form-data">
                        
                    <?php $doc = $documents['piece_identite'] ?? null; ?>
                        <div class="doc-item">
                            <div class="doc-label">Carte d'identité / Passeport</div>
                            <div class="doc-controls">
                                 <?php if($doc): ?>
                                    <div class="existing-doc">
                                        <a href="<?= htmlspecialchars($doc['chemin_fichier']) ?>" target="_blank"><?= htmlspecialchars($doc['nom_fichier']) ?></a>
                                    </div>
                                <?php endif; ?>
                                <input type="file" accept="image/*,.pdf" name="id_card" id="id_card" class="doc-input">
                                <button type="button" class="remove-doc" data-input="id_card" aria-label="Supprimer la carte d'identité">Supprimer</button>
                                <div class="doc-preview" id="preview_id_card">Aucun fichier</div>
                            </div>
                        </div>

                        <?php $doc = $documents['permis'] ?? null; ?>
                        <div class="doc-item">
                            <div class="doc-label">Permis de conduire</div>
                            <div class="doc-controls">
                                <?php if($doc): ?>
                                    <div class="existing-doc">
                                        <a href="<?= htmlspecialchars($doc['chemin_fichier']) ?>" target="_blank"><?= htmlspecialchars($doc['nom_fichier']) ?></a>
                                    </div>
                                <?php endif; ?>
                                <input type="file" accept="image/*,.pdf" name="driving_license" id="driving_license" class="doc-input">
                                <button type="button" class="remove-doc" data-input="driving_license" aria-label="Supprimer le permis">Supprimer</button>
                                <div class="doc-preview" id="preview_driving_license">Aucun fichier</div>
                            </div>
                        </div>

                        <?php $doc = $documents['carte_grise'] ?? null; ?>
                        <div class="doc-item">
                            <div class="doc-label">Carte grise (certificat d'immatriculation)</div>
                            <div class="doc-controls">
                                <?php if($doc): ?>
                                    <div class="existing-doc">
                                        <a href="<?= htmlspecialchars($doc['chemin_fichier']) ?>" target="_blank"><?= htmlspecialchars($doc['nom_fichier']) ?></a>
                                    </div>
                                <?php endif; ?>
                                <input type="file" accept="image/*,.pdf" name="vehicle_registration" id="vehicle_registration" class="doc-input">
                                <button type="button" class="remove-doc" data-input="vehicle_registration" aria-label="Supprimer la carte grise">Supprimer</button>
                                <div class="doc-preview" id="preview_vehicle_registration">Aucun fichier</div>
                            </div>
                        </div>

                        <?php $doc = $documents['assurance'] ?? null; ?>
                        <div class="doc-item">
                            <div class="doc-label">Attestation d'assurance</div>
                            <div class="doc-controls">
                                <?php if($doc): ?>
                                    <div class="existing-doc">
                                        <a href="<?= htmlspecialchars($doc['chemin_fichier']) ?>" target="_blank"><?= htmlspecialchars($doc['nom_fichier']) ?></a>
                                    </div>
                                <?php endif; ?>
                                <input type="file" accept="image/*,.pdf" name="insurance" id="insurance" class="doc-input">
                                <button type="button" class="remove-doc" data-input="insurance" aria-label="Supprimer l'attestation d'assurance">Supprimer</button>
                                <div class="doc-preview" id="preview_insurance">Aucun fichier</div>
                            </div>
                        </div>

                        <?php $doc = $documents['justificatif_domicile'] ?? null; ?>
                        <div class="doc-item">
                            <div class="doc-label">Justificatif de domicile</div>
                            <div class="doc-controls">
                                <?php if($doc): ?>
                                    <div class="existing-doc">
                                        <a href="<?= htmlspecialchars($doc['chemin_fichier']) ?>" target="_blank"><?= htmlspecialchars($doc['nom_fichier']) ?></a>
                                    </div>
                                <?php endif; ?>
                                <input type="file" accept="image/*,.pdf" name="proof_of_address" id="proof_of_address" class="doc-input">
                                <button type="button" class="remove-doc" data-input="proof_of_address" aria-label="Supprimer le justificatif de domicile">Supprimer</button>
                                <div class="doc-preview" id="preview_proof_of_address">Aucun fichier</div>
                            </div>
                        </div>

                        <?php $doc = $documents['avatar'] ?? null; ?>
                        <div class="doc-item">
                            <div class="doc-label">Photo de profil (optionnel)</div>
                            <div class="doc-controls">
                                <?php if($doc): ?>
                                    <div class="existing-doc">
                                        <a href="<?= htmlspecialchars($doc['chemin_fichier']) ?>" target="_blank"><?= htmlspecialchars($doc['nom_fichier']) ?></a>
                                    </div>
                                <?php endif; ?>
                                <input type="file" accept="image/*" name="profile_photo" id="profile_photo" class="doc-input">
                                <button type="button" class="remove-doc" data-input="profile_photo" aria-label="Supprimer la photo de profil">Supprimer</button>
                                <div class="doc-preview" id="preview_profile_photo">Aucun fichier</div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="save-btn" id="upload-docs">Enregistrer les documents</button>
                            <div class="form-actions">
                            <button type="button" class="cancel-small" onclick="if(confirm('Voulez-vous vraiment supprimer tous vos documents ?')) { window.location='index.php?page=mes_documents&action=supprimer_tous'; }">Réinitialiser</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
