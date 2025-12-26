<?php
require_once __DIR__ . '/bd_connection.php';

class Utilisateur {

    /* =========================
       RÉCUPÉRER PAR ID
    ========================= */
    public static function get(int $id): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    /* =========================
       RÉCUPÉRER PAR EMAIL
    ========================= */
    public static function getByEmail(string $email): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    /* =========================
       CONNEXION
    ========================= */
    public static function connexion(string $email, string $mdp): ?array {
        $user = self::getByEmail($email);

        if ($user && password_verify($mdp, $user['mdp'])) {
            return $user;
        }
        return null;
    }

    /* =========================
       CRÉATION COMPTE
    ========================= */
    public static function creer(array $data): bool {
        $db = dbConnect();

        // Vérifier si email existe déjà
        if (self::getByEmail($data['email'])) {
            return false;
        }

        $stmt = $db->prepare("
            INSERT INTO utilisateurs (nom, prenom, email, mdp)
            VALUES (:nom, :prenom, :email, :mdp)
        ");

        return $stmt->execute([
            'nom'    => $data['nom'],
            'prenom' => $data['prenom'],
            'email'  => $data['email'],
            'mdp'    => $data['mdp']
        ]);
    }

    /* =========================
       SUPPRESSION
    ========================= */
    public static function delete(int $id): bool {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM utilisateurs WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
