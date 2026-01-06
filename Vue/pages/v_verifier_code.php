<body>
    <h2>Vérification du compte</h2>

    <form method="POST" action="index.php?page=verifier_code&action=verifier">
        <label>Code reçu par email</label>
        <input type="text" name="code" required>
        <button type="submit">Valider</button>
    </form>

    <form method="POST" action="index.php?page=verifier_code&action=renvoyer">
        <button type="submit" style="margin-top:10px;">
            🔁 Renvoyer le code
        </button>
    </form>

    <?php if (isset($_GET['resent'])): ?>
        <p style="color: green;">✅ Un nouveau code a été envoyé</p>
    <?php endif; ?>

    <p>⏱️ Le code expire après 2 minutes</p>

</body>
