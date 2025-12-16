<?php
require_once  __DIR__ . '/bd_connection.php';
class Utilisateur {

    public static function get(int $id): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function getByTelephone(string $telephone): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE telephone = ?");
        $stmt->execute([$telephone]);
        return $stmt->fetch() ?: null;
    }

    public static function connexion(string $telephone, string $mot_de_passe): ?array {
        $user = self::getByTelephone($telephone);
        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user;
        }
        return null;
    }

    public static function creer(array $data): int {
        $db = dbConnect();
        $stmt = $db->prepare("INSERT INTO utilisateurs (nom, telephone, mot_de_passe, avatar, biographie) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['nom'],
            $data['telephone'],
            password_hash($data['mot_de_passe'], PASSWORD_BCRYPT),
            $data['avatar'] ?? null,
            $data['biographie'] ?? null
        ]);
        return (int)$db->lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        $db = dbConnect();
        $stmt = $db->prepare("UPDATE utilisateurs SET nom = ?, telephone = ?, mot_de_passe = ?, avatar = ?, biographie = ? WHERE id = ?");
        return $stmt->execute([
            $data['nom'],
            $data['telephone'],
            isset($data['mot_de_passe']) ? password_hash($data['mot_de_passe'], PASSWORD_BCRYPT) : null,
            $data['avatar'] ?? null,
            $data['biographie'] ?? null,
            $id
        ]);
    }

    public static function delete(int $id): bool {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM utilisateurs WHERE id = ?");
        return $stmt->execute([$id]);
    }
}