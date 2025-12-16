<?php
require_once  __DIR__ . 'bd_connection.php';

class Utilisateur {

    /**
     * Connexion d'un utilisateur
     */
    public static function connexion(string $telephone, string $mot_de_passe) {
        $db = dbConnect();

        $sql = "SELECT * FROM utilisateurs WHERE telephone = :telephone LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'telephone' => $telephone
        ]);

        $user = $stmt->fetch();

        if (!$user) {
            return false;
        }

        // Vérification du mot de passe hashé
        if (!password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return false;
        }

        return $user;
    }
}
