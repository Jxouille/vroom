<?php
// On suppose que $conversations contient toutes les conversations de l'utilisateur
// et $messages contient les messages de la conversation active (si sélectionnée)
// $conversation_active contient l'id de la conversation en cours

$interlocuteur = null;
if (!empty($conversation_active)) {
    foreach ($conversations as $c) {
        if ($c['id'] == $conversation_active) {
            $interlocuteur = $c;
            break;
        }
    }
}
?>

<body>
<section class="messagerie-container">

    <!-- Liste des conversations -->
    <aside class="conversation-list">
        <h3>Messages</h3>

        <?php foreach ($conversations as $c): 
            $dernier_message = $c['dernier_message'] ?? '';
            $active = ($conversation_active == $c['id']) ? 'active' : '';
        ?>
        <a href="index.php?page=messagerie&id_conversation=<?= $c['id'] ?>" class="conversation <?= $active ?>">
            <img src="<?= !empty($c['photo_profil']) ? htmlspecialchars($c['photo_profil']) : 'Ressources/Image/person_icon.png' ?>" alt="Profil">
            <div>
                <strong><?= htmlspecialchars($c['prenom'] ?? 'Utilisateur') ?></strong>
                <p><?= htmlspecialchars($dernier_message) ?></p>
            </div>
        </a>
        <?php endforeach; ?>
    </aside>

    <!-- Zone de discussion -->
    <div class="chat-box">

        <?php if ($interlocuteur): ?>
            <div class="chat-header">
                <img src="<?= !empty($interlocuteur['photo_profil']) ? htmlspecialchars($interlocuteur['photo_profil']) : 'Ressources/Image/person_icon.png' ?>" alt="Profil">
                <span><?= htmlspecialchars($interlocuteur['prenom'] ?? 'Utilisateur') ?></span>
            </div>

            <div class="messages">
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="message <?= ($message['id_expediteur'] == $_SESSION['user_id']) ? 'sent' : 'received' ?>">
                            <?= htmlspecialchars($message['contenu'] ?? '') ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="message info">Aucun message pour l'instant...</div>
                <?php endif; ?>
            </div>

            <form class="chat-input" method="post" action="index.php?page=messagerie&action=envoyer&id_conversation=<?= $conversation_active ?>&id_destinataire=<?= $interlocuteur['interlocuteur_id'] ?>">
                <input type="text" name="message" placeholder="Écrire un message..." required>
                <button type="submit">➤</button>
            </form>

        <?php else: ?>
            <div class="no-conversation">
                <p>Sélectionnez une conversation pour commencer à discuter.</p>
            </div>
        <?php endif; ?>

    </div>

</section>
</body>
