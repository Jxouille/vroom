
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="tabs">
            <div class="tab active" onclick="switchTab('utilisateurs')">Utilisateurs</div>
            <div class="tab" onclick="switchTab('trajets')">Trajets</div>
        </div>

        <div id="utilisateurs" class="content-section active">
            <table>
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Inscrit le</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($utilisateurs)): ?>
                        <?php foreach ($utilisateurs as $u): ?>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="<?= !empty($u['avatar']) ? $u['avatar'] : 'https://i.pravatar.cc/150?u='.$u['id'] ?>" alt="avatar" class="avatar">
                                        <span>
                                            <?= htmlspecialchars($u["nom"] ?? '') ?> 
                                            <?= htmlspecialchars($u["prenom"] ?? '') ?>
                                        </span>
                                    </div>
                                </td>
                                <td>#<?= htmlspecialchars($u["id"] ?? '') ?></td>
                                <td><?= htmlspecialchars($u["email"] ?? '') ?></td>
                                <td><?= date('d/m/Y', strtotime($u["date_creation"])) ?></td>
                                <td><span class="status-badge">Actif</span></td>
                                <td class="actions">
                                    <a href="profil.php?id=<?= $u['id'] ?>"><i class="fa-regular fa-eye"></i></a>
                                    <i class="fa-regular fa-circle-xmark"></i>
                                    <i class="fa-regular fa-trash-can"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 20px;">Aucun utilisateur trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div id="trajets" class="content-section">
            <div class="empty-state">
                <i class="fa-solid fa-car-side fa-3x"></i>
                <p>La liste des trajets s'affichera ici via votre requête SQL.</p>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));

            event.currentTarget.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }
    </script>

</body>
