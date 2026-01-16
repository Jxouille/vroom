
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
