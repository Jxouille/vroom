<?php
require_once  __DIR__ . '/bd_connection.php';

Class Villes {

    public static function getAll(): array {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM ville ORDER BY nom ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     public static function getId(string $nomVille): ?int {
        $db = dbConnect();
        $sql = "SELECT id FROM ville WHERE LOWER(nom) = LOWER(:nom) LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute([':nom' => trim($nomVille)]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? (int) $row['id'] : null;
    }


    public static function trouveroucreer(string $nomVille): int
    {
        // Connexion à la base (supposons $db est ton PDO)
        $db = dbConnect();

        // On cherche si le lieu existe déjà
        $stmt = $db->prepare("SELECT id FROM ville WHERE nom = :nom LIMIT 1");
        $stmt->execute([':nom' => $nomVille]);
        $lieu = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($lieu) {
            return (int)$lieu['id'];
        }

        // Si le lieu n'existe pas, on le crée
        $stmt = $db->prepare("INSERT INTO ville (nom) VALUES (:nom)");
        $stmt->execute([':nom' => $nomVille]);

        return (int)$db->lastInsertId();
    }

}