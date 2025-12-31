<body>

    <div class="main-wrapper">
        <div class="page-container">

            <div class="header-title">Mon profil</div>
            <div class="header-bandeau"></div>

            <div class="main-content">

                <!-- Profil résumé (lecture seule / modifiable) -->
                <div class="info-card profile-summary">
                    <div class="profile-header">
                        <div class="avatar large">
                            <?= strtoupper(substr($utilisateur['prenom'], 0, 1) . substr($utilisateur['nom'], 0, 1)) ?>
                        </div>
                        <div class="profile-meta">
                            <div class="profile-name"><?= htmlspecialchars($utilisateur['prenom'] . ' ' . $utilisateur['nom']) ?></div>
                            <?php if (!empty($vehicules[0])): ?>
                                <div class="profile-sub">
                                    <?= htmlspecialchars($vehicules[0]['marque'] . ' ' . $vehicules[0]['modele']) ?> • 
                                    <?= htmlspecialchars($vehicules[0]['places_disponibles'] ?? 3) ?> places • 
                                    <?= htmlspecialchars($vehicules[0]['couleur']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="profile-actions">
                            <a class="btn-link" href="index.php?page=mes_trajets">Mes trajets</a>
                        </div>
                    </div>

                    <div class="profile-fields">
                        <?php
                        $fields = ['prenom', 'nom', 'email', 'telephone', 'biographie'];
                        foreach ($fields as $field):
                        ?>
                        <div class="field-row">
                            <div class="field-label"><?= ucfirst($field) ?></div>
                            <div class="field-value" data-field="<?= $field ?>">
                                <?= htmlspecialchars($utilisateur[$field] ?? '') ?>
                            </div>
                            <button class="edit-btn" data-field="<?= $field ?>">Modifier</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Sécurité & actions -->
                <div class="info-card">
                    <h2 class="card-title">Sécurité & actions</h2>
                    <div class="info-item" style="border-top:none; align-items:center;">
                        <div style="flex:1">
                            <div class="regle">E‑mail vérifié</div>
                            <div class="description">Votre e‑mail est confirmé.</div>
                        </div>
                        <div>
                            <button class="save-btn" type="button" id="change-password">Changer le mot de passe</button>
                        </div>
                    </div>
                    <div class="info-item" style="border-top:1px solid #eee; align-items:center;">
                        <div style="flex:1">
                            <div class="regle">Téléphone vérifié</div>
                            <div class="description">Votre numéro est confirmé.</div>
                        </div>
                        <div>
                            <button class="save-btn" type="button">Vérifier / modifier</button>
                        </div>
                    </div>
                    <div class="info-item" style="border-top:1px solid #eee; align-items:center;">
                        <div style="flex:1">
                            <div class="danger-text">Supprimer le compte</div>
                            <div class="description">Cette action est irréversible. Toutes vos données seront supprimées.</div>
                        </div>
                        <div>
                            <button class="delete-btn" type="button" id="delete-account">Supprimer</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

        function createInput(value, field) {
            var input = document.createElement('input');
            input.type = (field === 'email') ? 'email' : 'text';
            input.className = 'inline-input';
            input.value = value;
            return input;
        }

        document.querySelectorAll('.edit-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var field = btn.dataset.field;
                var row = btn.closest('.field-row');
                var valueEl = row.querySelector('.field-value');
                var current = valueEl.textContent.trim();

                if (row.querySelector('.inline-input')) return;

                var input = createInput(current, field);
                row.replaceChild(input, valueEl);

                var save = document.createElement('button');
                save.className = 'save-small';
                save.textContent = 'Sauvegarder';
                var cancel = document.createElement('button');
                cancel.className = 'cancel-small';
                cancel.textContent = 'Annuler';

                btn.style.display = 'none';
                row.appendChild(save);
                row.appendChild(cancel);

                save.addEventListener('click', function() {
                    var newVal = input.value;

                    // Ajax call to update profile
                    fetch('index.php?page=profil&action=modifier', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        body: 'field=' + encodeURIComponent(field) + '&value=' + encodeURIComponent(newVal)
                    }).then(res => res.text()).then(data => {
                        var span = document.createElement('div');
                        span.className = 'field-value';
                        span.dataset.field = field;
                        span.textContent = newVal;
                        row.replaceChild(span, input);
                        save.remove(); cancel.remove(); btn.style.display = '';
                    }).catch(err => {
                        alert('Erreur lors de la mise à jour.');
                    });
                });

                cancel.addEventListener('click', function() {
                    var span = document.createElement('div');
                    span.className = 'field-value';
                    span.dataset.field = field;
                    span.textContent = current;
                    row.replaceChild(span, input);
                    save.remove(); cancel.remove(); btn.style.display = '';
                });
            });
        });

        // Delete confirmation
        var del = document.getElementById('delete-account');
        if (del) {
            del.addEventListener('click', function() {
                if (confirm('Voulez-vous vraiment supprimer votre compte ?')) {
                    fetch('index.php?page=profil&action=supprimer', { method: 'POST' })
                        .then(() => window.location.href = 'index.php?page=accueil');
                }
            });
        }
    });
    </script>

</body>
</html>
