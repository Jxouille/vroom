
<body>

    <div class="payment-container">
        <form action="index.php?page=paiement&action=payer&id=<?=$reservation_id ?>" method="POST" class="payment-form">
            <div class="header">
                <span class="icon-card">💳</span>
                <h2>Informations de paiement</h2>
                <p class="subtitle">Paiement sécurisé par cryptage SSL</p>
            </div>

            <div class="form-group">
                <label for="card_number">Numéro de carte</label>
                <div class="input-container">
                    <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required maxlength="19">
                    <span class="card-icon">💳</span>
                </div>
            </div>

            <div class="form-group">
                <label for="holder_name">Nom du titulaire</label>
                <input type="text" id="holder_name" name="holder_name" placeholder="NOM" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="expiry">Date d'expiration</label>
                    <input type="text" id="expiry" name="expiry" placeholder="MM/AA" required maxlength="5">
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="123" required maxlength="3">
                </div>
            </div>

            <div class="security-footer">
                <div class="shield-icon">🛡️</div>
                <div class="security-text">
                    <strong>Paiement 100% sécurisé</strong>
                    <p>Vos informations bancaires sont cryptées et ne sont jamais stockées sur nos serveurs</p>
                </div>
            </div>

            <button type="submit" class="btn-submit">Valider le paiement</button>
        </form>
    </div>

</body>
