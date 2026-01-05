<?php
require_once  __DIR__ . '/bd_connection.php';

class Conversations {

    // Create a new conversation
    public static function creer(): int {
        $db = dbConnect();
        $stmt = $db->prepare("INSERT INTO conversations () VALUES ()");
        $stmt->execute();
        return (int)$db->lastInsertId();
    }

    // Get a conversation by its ID
    public static function get(int $id): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM conversations WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    // Get all conversations for a specific user
    public static function getAllForUser(int $user_id): array {
        $db = dbConnect();
        $stmt = $db->prepare("
            SELECT c.id, c.date_creation
            FROM conversations c
            JOIN messages m ON m.id_conversation = c.id
            WHERE m.id_expediteur = ? OR m.id_destinataire = ?
            GROUP BY c.id
            ORDER BY c.date_creation DESC
        ");
        $stmt->execute([$user_id, $user_id]);
        return $stmt->fetchAll();
    }

    // Check if a conversation exists between two users
    public static function getBetweenUsers(int $user1, int $user2): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("
            SELECT c.id
            FROM conversations c
            JOIN messages m1 ON m1.id_conversation = c.id AND m1.id_expediteur = ?
            JOIN messages m2 ON m2.id_conversation = c.id AND m2.id_expediteur = ?
            LIMIT 1
        ");
        $stmt->execute([$user1, $user2]);
        return $stmt->fetch() ?: null;
    }
}
?>