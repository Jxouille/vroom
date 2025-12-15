<?php
require_once  __DIR__ . 'bd_connection.php';


class Favoris {

    public static function ajouter(int $user_id, int $id_annonce): bool {
        $db = dbConnect();
        $stmt = $db->prepare("INSERT IGNORE INTO favoris (id_utilisateur, id_annonce) VALUES (?, ?)");
        return $stmt->execute([$user_id, $id_annonce]);
    }

    public static function supprimer(int $user_id, int $id_annonce): bool {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM favoris WHERE id_utilisateur = ? AND id_annonce = ?");
        return $stmt->execute([$user_id, $id_annonce]);
    }

    public static function liste(int $user_id): array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT f.*, a.* FROM favoris f JOIN annonces a ON f.id_annonce = a.id WHERE f.id_utilisateur = ? ORDER BY f.date_creation DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
}
?>