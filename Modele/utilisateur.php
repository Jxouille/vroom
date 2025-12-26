<?php
require_once __DIR__ . '/bd_connection.php';

class Utilisateur {

    /* =========================
       RÉCUPÉRER PAR EMAIL
    ========================= */
    public static function getByEmail(string $email): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /* =========================
       CONNEXION
    ========================= */
    public static function connexion(string $email, string $mot_de_passe): ?array {
        $user = self::getByEmail($email);

        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user;
        }
        return null;
    }

    /* =========================
       CRÉATION COMPTE
    ========================= */
    public static function creer(array $data): bool {
        $db = dbConnect();

        // email déjà utilisé
        if (self::getByEmail($data['email'])) {
            return false;
        }

        $stmt = $db->prepare("
            INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe)
            VALUES (:nom, :prenom, :email, :telephone, :mdp)
        ");

        return $stmt->execute([
            'nom'       => $data['nom'],
            'prenom'    => $data['prenom'],
            'email'     => $data['email'],
            'telephone' => $data['telephone'] ?? null,
            'mdp'       => $data['mdp']
        ]);
    }
}
?>