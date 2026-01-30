<?php
require_once __DIR__ . '/bd_connection.php'; // Fichier de connexion PDO

class Contact {

    // Récupérer tous les messages
    public static function all(): array {
        $pdo = dbConnect();
        $stmt = $pdo->query("SELECT * FROM contact_messages ORDER BY date_creation DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un message par ID
    public static function getById(int $id): ?array {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Ajouter un message
    public static function ajouter(string $nom, string $email, string $sujet, string $message): bool {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("INSERT INTO contact_messages (nom, email, sujet, message) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nom, $email, $sujet, $message]);
    }

    // Mettre à jour un message (réponse, statut)
    public static function repondre(int $id, string $reponse, string $auteur): bool {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("
            UPDATE contact_messages 
            SET reponse = ?, auteur_reponse = ?, statut = 'resolu', date_reponse = NOW(), date_modification = NOW() 
            WHERE id = ?
        ");
        return $stmt->execute([$reponse, $auteur, $id]);
    }

    // Modifier le statut (nouveau, en_cours, resolu)
    public static function changerStatut(int $id, string $statut): bool {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("UPDATE contact_messages SET statut = ?, date_modification = NOW() WHERE id = ?");
        return $stmt->execute([$statut, $id]);
    }

    // Supprimer un message
    public static function supprimer(int $id): bool {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
