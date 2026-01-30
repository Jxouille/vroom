<?php
require_once  __DIR__ . '/bd_connection.php';

class ContactMessage {
    public static function all(): array {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM messages_contact ORDER BY date_creation DESC");
        return $stmt->fetchAll();
    }
    public static function get(int $id): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM messages_contact WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
    public static function creer(array $data): int {
        $db = dbConnect();
        $stmt = $db->prepare("INSERT INTO messages_contact (nom, email, sujet, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['nom'],
            $data['email'],
            $data['sujet'],
            $data['message']
        ]);
        return (int)$db->lastInsertId();    
    }
    public static function supprimer(int $id): bool {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM messages_contact WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public static function update(int $id, array $data): bool {
        $db = dbConnect();
        $fields = [];
        $params = [':id' => $id];

        $map = [
            'statut',
            'reponse',
            'auteur_reponse',
            'date_reponse'
        ];

        foreach ($map as $field) {
            if (isset($data[$field]) && $data[$field] !== '') {
                $fields[] = "$field = :$field";
                $params[":$field"] = $data[$field];
            }
        }

        if (empty($fields)) return false;

        $sql = "UPDATE contact_messages SET " . implode(', ', $fields) . " WHERE id = :id";
        return $db->prepare($sql)->execute($params);
    }
}

?>