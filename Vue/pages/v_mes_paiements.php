<?php
// $paiements est fourni par le contrôleur
?>

<div class="container-paiements">

    <h1>Mes paiements</h1>

    <?php if (empty($paiements)) : ?>
        <div class="paiement-vide">
            <p>Aucun paiement enregistré pour le moment.</p>
        </div>
    <?php else : ?>
        <table class="table-paiements">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Réservation</th>
                    <th>Moyen de paiement</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paiements as $paiement) : ?>
                    <tr>
                        <td>#<?= htmlspecialchars($paiement['id']) ?></td>
                        <td><?= htmlspecialchars($paiement['id_reservation']) ?></td>
                        <td><?= htmlspecialchars(ucfirst($paiement['moyen_paiement'])) ?></td>
                        <td>
                            <?= number_format($paiement['montant'], 2, ',', ' ') ?>
                            <?= htmlspecialchars($paiement['devise'] ?? '€') ?>
                        </td>
                        <td>
                            <span class="statut <?= htmlspecialchars($paiement['statut']) ?>">
                                <?= htmlspecialchars(ucfirst($paiement['statut'])) ?>
                            </span>
                        </td>
                        <td>
                            <?= date('d/m/Y', strtotime($paiement['date_paiement'] ?? $paiement['date_creation'])) ?>
                        </td>
                        <td>
                            <a class="btn-detail"
                               href="index.php?page=detail_paiement&id=<?= (int)$paiement['id'] ?>">
                                Voir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>
