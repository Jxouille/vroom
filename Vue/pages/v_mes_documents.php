<?php require "../head_&_header.php";?>

<body>

    <div class="main-wrapper">
        <div class="page-container">

            <div class="header-title">Mes documents</div>
            <div class="header-bandeau"></div>

            <div class="main-content">

                <div class="info-card">
                    <h2 class="card-title">Documents obligatoires pour devenir conducteur</h2>
                    <p class="help">Téléversez les documents suivants. Formats acceptés : <strong>JPG, PNG, PDF</strong>. Taille max par fichier : <strong>5 MB</strong>.</p>

                    <form id="documents-form" method="post" action="#" enctype="multipart/form-data">

                        <div class="doc-item">
                            <div class="doc-label">Carte d'identité / Passeport</div>
                            <div class="doc-controls">
                                <input type="file" accept="image/*,.pdf" name="id_card" id="id_card" class="doc-input">
                                <button type="button" class="remove-doc" data-input="id_card" aria-label="Supprimer la carte d'identité">Supprimer</button>
                                <div class="doc-preview" id="preview_id_card">Aucun fichier</div>
                            </div>
                        </div>

                        <div class="doc-item">
                            <div class="doc-label">Permis de conduire</div>
                            <div class="doc-controls">
                                <input type="file" accept="image/*,.pdf" name="driving_license" id="driving_license" class="doc-input">
                                <button type="button" class="remove-doc" data-input="driving_license" aria-label="Supprimer le permis">Supprimer</button>
                                <div class="doc-preview" id="preview_driving_license">Aucun fichier</div>
                            </div>
                        </div>

                        <div class="doc-item">
                            <div class="doc-label">Carte grise (certificat d'immatriculation)</div>
                            <div class="doc-controls">
                                <input type="file" accept="image/*,.pdf" name="vehicle_registration" id="vehicle_registration" class="doc-input">
                                <button type="button" class="remove-doc" data-input="vehicle_registration" aria-label="Supprimer la carte grise">Supprimer</button>
                                <div class="doc-preview" id="preview_vehicle_registration">Aucun fichier</div>
                            </div>
                        </div>

                        <div class="doc-item">
                            <div class="doc-label">Attestation d'assurance</div>
                            <div class="doc-controls">
                                <input type="file" accept="image/*,.pdf" name="insurance" id="insurance" class="doc-input">
                                <button type="button" class="remove-doc" data-input="insurance" aria-label="Supprimer l'attestation d'assurance">Supprimer</button>
                                <div class="doc-preview" id="preview_insurance">Aucun fichier</div>
                            </div>
                        </div>

                        <div class="doc-item">
                            <div class="doc-label">Justificatif de domicile</div>
                            <div class="doc-controls">
                                <input type="file" accept="image/*,.pdf" name="proof_of_address" id="proof_of_address" class="doc-input">
                                <button type="button" class="remove-doc" data-input="proof_of_address" aria-label="Supprimer le justificatif de domicile">Supprimer</button>
                                <div class="doc-preview" id="preview_proof_of_address">Aucun fichier</div>
                            </div>
                        </div>

                        <div class="doc-item">
                            <div class="doc-label">Photo de profil (optionnel)</div>
                            <div class="doc-controls">
                                <input type="file" accept="image/*" name="profile_photo" id="profile_photo" class="doc-input">
                                <button type="button" class="remove-doc" data-input="profile_photo" aria-label="Supprimer la photo de profil">Supprimer</button>
                                <div class="doc-preview" id="preview_profile_photo">Aucun fichier</div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="save-btn" id="upload-docs">Enregistrer les documents</button>
                            <button type="reset" class="cancel-small">Réinitialiser</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>


    <script>
    // Client-side previews and simple validation
    (function(){
        // trigger gentle animations for cards
        var wrap = document.querySelector('.main-wrapper'); if (wrap) { wrap.classList.add('animate'); setTimeout(function(){ wrap.classList.add('show'); }, 50); }
        var maxSize = 5 * 1024 * 1024; // 5MB

        function handleFileInput(input, previewEl) {
            input.addEventListener('change', function() {
                var file = input.files && input.files[0];
                if (!file) { previewEl.textContent = 'Aucun fichier'; return; }
                if (file.size > maxSize) {
                    alert('Fichier trop volumineux (max 5 MB)');
                    input.value = '';
                    previewEl.textContent = 'Aucun fichier';
                    return;
                }
                var name = file.name;
                var type = file.type;
                // show the corresponding remove button when a file is selected
                var removeBtn = document.querySelector('.remove-doc[data-input="' + input.id + '"]');
                if (removeBtn) removeBtn.style.display = '';

                if (type.startsWith('image/')) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        previewEl.innerHTML = '<img src="'+e.target.result+'" alt="aperçu" class="preview-img">';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewEl.textContent = name + ' (prévisualisation non disponible)';
                    if (removeBtn) removeBtn.style.display = '';
                }
            });
        }

        var ids = ['id_card','driving_license','vehicle_registration','insurance','proof_of_address','profile_photo'];
        ids.forEach(function(id){
            var input = document.getElementById(id);
            var preview = document.getElementById('preview_' + id);
            if (input && preview) handleFileInput(input, preview);
            // ensure remove button visibility matches current input state (in case files were set programmatically)
            var btn = document.querySelector('.remove-doc[data-input="' + id + '"]');
            if (btn) {
                try {
                    if (input.files && input.files.length) btn.style.display = '';
                    else btn.style.display = 'none';
                } catch (e) { btn.style.display = 'none'; }
            }
        });

        // Attach remove handlers for per-document delete buttons
        document.querySelectorAll('.remove-doc').forEach(function(btn){
            btn.style.display = 'none';
            btn.addEventListener('click', function(){
                var targetId = btn.dataset.input;
                var input = document.getElementById(targetId);
                var preview = document.getElementById('preview_' + targetId);
                if (!input) return;
                input.value = '';
                if (preview) preview.textContent = 'Aucun fichier';
                btn.style.display = 'none';
                // trigger any change listeners (optional)
                var ev = new Event('change');
                input.dispatchEvent(ev);
            });
        });

        // Hide remove buttons when the form is reset
        var form = document.getElementById('documents-form');
        if (form) {
            form.addEventListener('reset', function(){
                setTimeout(function(){
                    document.querySelectorAll('.remove-doc').forEach(function(b){ b.style.display = 'none'; });
                    // clear previews
                    ids.forEach(function(id){ var p = document.getElementById('preview_' + id); if(p) p.textContent = 'Aucun fichier'; });
                }, 10);
            });
        }

        document.getElementById('upload-docs').addEventListener('click', function(){
            // Build FormData and send to server (TODO: set correct endpoint)
            var form = document.getElementById('documents-form');
            var fd = new FormData(form);
            // TODO: replace '#' with your upload endpoint
            fetch('#', { method: 'POST', body: fd })
                .then(function(resp){
                    if (!resp.ok) throw new Error('Erreur serveur');
                    return resp.json();
                })
                .then(function(json){
                    alert('Documents envoyés (simulation)');
                })
                .catch(function(err){
                    console.warn(err);
                    alert('Envoi échoué (simulation).');
                });
        });
    })();
    </script>

</body>
</html>