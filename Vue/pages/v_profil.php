
<body>

    <div class="main-wrapper">
        <div class="page-container">

            <div class="header-title">Mon profil</div>
            <div class="header-bandeau"></div>

            <div class="main-content">

                <!-- Profil résumé (lecture seule) -->
                <div class="info-card profile-summary">
                    <div class="profile-header">
                        <div class="avatar large">JD</div>
                        <div class="profile-meta">
                            <div class="profile-name">Jean Dupont</div>
                            <div class="profile-sub">Peugeot 308 • 3 places • Bleu</div>
                        </div>
                        <div class="profile-actions">
                            <a class="btn-link" href="v_mes_trajets.php">Mes trajets</a>
                        </div>
                    </div>

                    <div class="profile-fields">
                        <div class="field-row">
                            <div class="field-label">Prénom</div>
                            <div class="field-value" data-field="prenom">Jean</div>
                            <button class="edit-btn" data-field="prenom">Modifier</button>
                        </div>

                        <div class="field-row">
                            <div class="field-label">Nom</div>
                            <div class="field-value" data-field="nom">Dupont</div>
                            <button class="edit-btn" data-field="nom">Modifier</button>
                        </div>

                        <div class="field-row">
                            <div class="field-label">Âge</div>
                            <div class="field-value" data-field="age">34</div>
                            <button class="edit-btn" data-field="age">Modifier</button>
                        </div>

                        <div class="field-row">
                            <div class="field-label">Adresse</div>
                            <div class="field-value" data-field="adresse">12 rue Exemple, 75000 Paris</div>
                            <button class="edit-btn" data-field="adresse">Modifier</button>
                        </div>

                        <div class="field-row">
                            <div class="field-label">E‑mail</div>
                            <div class="field-value" data-field="email">jean.dupont@example.com</div>
                            <button class="edit-btn" data-field="email">Modifier</button>
                        </div>

                        <div class="field-row">
                            <div class="field-label">Téléphone</div>
                            <div class="field-value" data-field="telephone">06 12 34 56 78</div>
                            <button class="edit-btn" data-field="telephone">Modifier</button>
                        </div>
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
    // Inline edit helper: toggles a field between display and edit mode
    document.addEventListener('DOMContentLoaded', function() {
        // trigger gentle animations
        var wrap = document.querySelector('.main-wrapper'); if (wrap) { wrap.classList.add('animate'); setTimeout(function(){ wrap.classList.add('show'); }, 50); }
        function createInput(value, field) {
            var input = document.createElement('input');
            input.type = (field === 'age') ? 'number' : 'text';
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

                // Prevent double-edit
                if (row.querySelector('.inline-input')) return;

                // Replace value with input
                var input = createInput(current, field);
                row.replaceChild(input, valueEl);

                // replace edit button with save/cancel
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
                    var span = document.createElement('div');
                    span.className = 'field-value';
                    span.dataset.field = field;
                    span.textContent = newVal;
                    row.replaceChild(span, input);
                    save.remove(); cancel.remove(); btn.style.display = '';
                    // TODO: send update to server via fetch/ajax
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
                if (confirm('Voulez-vous vraiment supprimer votre compte ? Cette action est irréversible.')) {
                    // TODO: post deletion to server
                    alert('Compte supprimé (simulation).');
                }
            });
        }
    });
    </script>

</body>
</html>