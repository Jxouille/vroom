<?php require "header.php"; ?>
<?php require "sidebar.php"; ?>

<div class="container-fluid">
    <h3><?= htmlspecialchars($titre)?></h3>
    <table class="table table-hover" id="datatable">
        <thead>
            <tr>
                <?php foreach ($titre_colone as $colonne): ?>
                    <th><?= htmlspecialchars($colonne) ?></th>
                <?php endforeach; ?>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($valeurs as $v): ?>
                <tr>
                    <?php foreach ($titre_colone as $colonne): ?>
                        <td><?= htmlspecialchars($v[$colonne] ?? '') ?></td>
                    <?php endforeach; ?>
                    <td>
                        <button type="button" 
                                class="btn btn-sm btn-primary editBtn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal"
                                <?php foreach ($v as $key => $val): ?>
                                    data-<?= htmlspecialchars($key) ?>="<?= htmlspecialchars($val) ?>"
                                <?php endforeach; ?>>
                            Modifier
                        </button>

                        <a href="index.php?page=admin&action=supprimer&id=<?= $v['id'] ?>" 
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>    
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="index.php?page=admin&action=modifier" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modifier l'enregistrement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="modal_id">

                    <?php foreach ($titre_colone as $colonne): ?>
                        <?php if (strtolower($colonne) !== 'id'): ?>
                            <div class="mb-3">
                                <label class="form-label"><?= htmlspecialchars($colonne) ?></label>
                                <input type="text" name="<?= htmlspecialchars($colonne) ?>" 
                                       id="modal_<?= htmlspecialchars($colonne) ?>" 
                                       class="form-control">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.editBtn');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            // On récupère toutes les données data- du bouton
            const data = this.dataset;

            // On remplit le champ ID
            document.getElementById('modal_id').value = data.id;

            // On boucle sur les données pour remplir les inputs correspondants
            Object.keys(data).forEach(key => {
                const input = document.getElementById('modal_' + key);
                if (input) {
                    input.value = data[key];
                }
            });
        });
    });
});
</script>