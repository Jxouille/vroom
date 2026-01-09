<body>

    <div class="container-detail-paiement">

        <h1>Détails du paiement</h1>

        <?php if (!$paiement) : ?>
            <div class="paiement-introuvable">
                <p>Le paiement demandé est introuvable.</p>
                <a href="index.php?page=mes_paiements" class="btn-retour">
                    Retour à mes paiements
                </a>
            </div>
        <?php else : ?>

            <div class="carte-paiement">

                <div class="ligne">
                    <span class="label">Identifiant du paiement</span>
                    <span class="valeur">#<?= htmlspecialchars($paiement['id']) ?></span>
                </div>

                <div class="ligne">
                    <span class="label">Réservation</span>
                    <span class="valeur">#<?= htmlspecialchars($paiement['id_reservation']) ?></span>
                </div>

                <div class="ligne">
                    <span class="label">Moyen de paiement</span>
                    <span class="valeur">
                        <?= htmlspecialchars(ucfirst($paiement['moyen_paiement'])) ?>
                    </span>
                </div>

                <div class="ligne">
                    <span class="label">Montant</span>
                    <span class="valeur montant">
                        <?= number_format($paiement['montant'], 2, ',', ' ') ?>
                        <?= htmlspecialchars($paiement['devise'] ?? '€') ?>
                    </span>
                </div>

                <div class="ligne">
                    <span class="label">Statut</span>
                    <span class="statut <?= htmlspecialchars($paiement['statut']) ?>">
                        <?= htmlspecialchars(ucfirst($paiement['statut'])) ?>
                    </span>
                </div>

                <div class="ligne">
                    <span class="label">Transaction</span>
                    <span class="valeur">
                        <?= htmlspecialchars($paiement['transaction_id'] ?? '—') ?>
                    </span>
                </div>

                <div class="ligne">
                    <span class="label">Date du paiement</span>
                    <span class="valeur">
                        <?= date('d/m/Y à H:i', strtotime($paiement['date_paiement'] ?? $paiement['date_creation'])) ?>
                    </span>
                </div>

            </div>

            <div class="actions">
                <a href="index.php?page=mes_paiements" class="btn-retour">
                    ← Retour à mes paiements
                </a>

                <button onclick="window.print()" class="btn-imprimer">
                    Imprimer le reçu
                </button>
            </div>

        <?php endif; ?>

    </div>
</body>