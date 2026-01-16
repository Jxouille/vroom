<?php require "header.php"; ?>
<?php require "sidebar.php"; ?>

<div class="container-fluid">
    <h3>All Users</h3>
    <table class="table table-hover" id="datatable">
        <thead>
            <tr>
                <?php foreach ($titre_colone as $colonne): ?>
                    <th><?= htmlspecialchars($colonne) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($valeurs as $v): ?>
                <tr>
                    <?php foreach ($titre_colone as $colonne): ?>
                        <td><?= htmlspecialchars($v[$colonne] ?? '') ?></td>
                        
                    <?php endforeach; ?>
                    <td>
                        <a href="/admin/users/edit/<?= $v['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="/admin/users/delete/<?= $v['id'] ?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete user?')" >Delete</a>    
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require "footer.php"; ?>
