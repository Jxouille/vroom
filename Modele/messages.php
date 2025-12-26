<?php
require_once  __DIR__ . '/bd_connection.php';

class Messages {

    public static function getByConversation(int $id_conversation): array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM messages WHERE id_conversation = ? ORDER BY date_creation ASC");
        $stmt->execute([$id_conversation]);
        return $stmt->fetchAll();
    }

    public static function allForUser(int $user_id): array {
        $db = dbConnect();
        $stmt = $db->prepare("
            SELECT * 
            FROM messages 
            WHERE id_expediteur = ? OR id_destinataire = ?
            ORDER BY date_creation DESC
        ");
        $stmt->execute([$user_id, $user_id]);
        return $stmt->fetchAll();
    }

    public static function envoyer(int $expediteur, int $destinataire, string $contenu, ?int $conversation_id = null): int {
        $db = dbConnect();

        // Create conversation if not exists
        if (!$conversation_id) {
            $stmt = $db->prepare("INSERT INTO conversations () VALUES ()");
            $stmt->execute();
            $conversation_id = (int)$db->lastInsertId();
        }

        $stmt = $db->prepare("
            INSERT INTO messages (id_conversation, id_expediteur, id_destinataire, contenu) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$conversation_id, $expediteur, $destinataire, $contenu]);

        return (int)$db->lastInsertId();
    }
}
?>