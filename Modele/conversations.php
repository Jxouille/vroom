<?php
require_once __DIR__ . '/bd_connection.php';

class Conversations
{
    /**
     * Récupérer une conversation entre deux utilisateurs
     * ou la créer si elle n'existe pas
     */
    public static function getOrCreate(int $user1, int $user2): array
    {
        $db = dbConnect();

        // Toujours stocker user1 < user2 (évite les doublons)
        if ($user1 > $user2) {
            [$user1, $user2] = [$user2, $user1];
        }

        $stmt = $db->prepare(
            "SELECT * FROM conversations 
             WHERE user1_id = ? AND user2_id = ?"
        );
        $stmt->execute([$user1, $user2]);
        $conv = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($conv) {
            return $conv;
        }

        $stmt = $db->prepare(
            "INSERT INTO conversations (user1_id, user2_id, date_creation)
             VALUES (?, ?, NOW())"
        );
        $stmt->execute([$user1, $user2]);

        return [
            'id'         => (int)$db->lastInsertId(),
            'user1_id'   => $user1,
            'user2_id'   => $user2,
            'date_creation' => date('Y-m-d H:i:s')
        ];
    }

    /**
     * Récupérer une conversation par ID
     */
    public static function getById(int $id): ?array
    {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM conversations WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Liste des conversations d'un utilisateur
     * avec dernier message + infos interlocuteur
     */
    public static function getForUser(int $user_id): array
    {
        $db = dbConnect();

        $sql = "
        SELECT 
            c.id,
            c.date_creation,
            u.id AS interlocuteur_id,
            u.prenom,
            u.nom,
            u.photo_profil,
            m.contenu AS dernier_message,
            m.date_creation AS date_dernier_message
        FROM conversations c
        JOIN utilisateurs u 
            ON u.id = IF(c.user1_id = ?, c.user2_id, c.user1_id)
        LEFT JOIN messages m 
            ON m.id = (
                SELECT id FROM messages
                WHERE id_conversation = c.id
                ORDER BY date_creation DESC
                LIMIT 1
            )
        WHERE c.user1_id = ? OR c.user2_id = ?
        ORDER BY m.date_creation DESC
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute([$user_id, $user_id, $user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Vérifie si un utilisateur fait partie de la conversation
     */
    public static function utilisateurAutorise(int $conversation_id, int $user_id): bool
    {
        $db = dbConnect();
        $stmt = $db->prepare(
            "SELECT 1 FROM conversations 
             WHERE id = ? AND (user1_id = ? OR user2_id = ?)"
        );
        $stmt->execute([$conversation_id, $user_id, $user_id]);
        return (bool)$stmt->fetchColumn();
    }
}
?>