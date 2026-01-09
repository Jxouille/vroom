<div class="conteneur-favoris">
    <h2>❤️ Mes favoris</h2>

    <?php if (empty($favoris)): ?>
        <p class="vide">Vous n’avez aucun favori pour le moment.</p>
    <?php else: ?>
        <div class="grille-annonces">
            <?php foreach ($favoris as $annonce): ?>
                <div class="carte-annonce">
                    <h3><?= htmlspecialchars($annonce['titre']) ?></h3>
                    <p><?= htmlspecialchars($annonce['description']) ?></p>
                    <p><strong><?= $annonce['prix'] ?> €</strong></p>

                    <a href="index.php?page=mes_favoris&action=supprimer&id_annonce=<?= $annonce['id'] ?>"
                       class="retirer">
                        ❌ Retirer
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
