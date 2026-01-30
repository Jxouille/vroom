<?php
require_once __DIR__ . '/bd_connection.php';

class Messages
{
    /**
     * Récupérer tous les messages d'une conversation
     */
    public static function getByConversation(int $conversation_id): array
    {
        $db = dbConnect();

        $stmt = $db->prepare(
            "SELECT id, id_conversation, id_expediteur, id_destinataire, contenu, date_creation
             FROM messages
             WHERE id_conversation = ?
             ORDER BY date_creation ASC"
        );
        $stmt->execute([$conversation_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Envoyer un message dans une conversation existante
     */
    public static function envoyer(
        int $conversation_id,
        int $id_expediteur,
        int $id_destinataire,
        string $contenu
    ): int {
        $db = dbConnect();

        $stmt = $db->prepare(
            "INSERT INTO messages (id_conversation, id_expediteur, id_destinataire, contenu, date_creation)
             VALUES (?, ?, ?, ?, NOW())"
        );
        $stmt->execute([$conversation_id, $id_expediteur, $id_destinataire, trim($contenu)]);

        return (int)$db->lastInsertId();
    }

    /**
     * Dernier message d'une conversation
     */
    public static function dernierMessage(int $conversation_id): ?array
    {
        $db = dbConnect();

        $stmt = $db->prepare(
            "SELECT id, id_expediteur, id_destinataire, contenu, date_creation
             FROM messages
             WHERE id_conversation = ?
             ORDER BY date_creation DESC
             LIMIT 1"
        );
        $stmt->execute([$conversation_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
?>