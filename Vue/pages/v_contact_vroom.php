

<div class="container">
    <h1>Contactez-nous</h1>
    <p>Une question ? Un problème ? L’équipe Vroom vous répond rapidement.</p>

    <form action="index?page=demande_contact&action=envoyer" methode="POST">
        <input name="nom" type="text" placeholder="Nom complet" required>
        <input name="mail" type="email" placeholder="Email" required>
        <textarea name="contenu" rows="6" placeholder="Votre message" required></textarea>
        <div class="rgpd-checkbox">
            <label>
                <input type="checkbox" required>
                J’accepte la
                <a href="index?page=rgdp" target="_blank">
                    politique de confidentialité
                </a>
            </label>
        </div>
        <button type="submit">Envoyer</button>
    </form>

    <h2>Coordonnées</h2>
    <p>
        📍 10 rue de Vannes, 92130 Issy-les-Moulineaux<br>
        📧 contact@vroom.com<br>
        ⏰ Lundi – Vendredi : 8h00 à 18h00
    </p>
</div>
</body>
