<?php
require_once  __DIR__ . '/bd_connection.php';


class Vehicules {

    public static function get(int $id): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM vehicules WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    // renamed to match controller usage
    public static function getByUtilisateur(int $user_id): array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM vehicules WHERE id_utilisateur = ? ORDER BY date_creation DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public static function creer(array $data): int {
        $db = dbConnect();
        $stmt = $db->prepare(
            "INSERT INTO vehicules (id_utilisateur, marque, modele, annee, couleur, matricule) 
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $data['id_utilisateur'],
            $data['marque'],
            $data['modele'],
            $data['annee'],
            $data['couleur'],
            $data['matricule']
        ]);
        return (int)$db->lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        $db = dbConnect();
        $stmt = $db->prepare(
            "UPDATE vehicules SET marque = ?, modele = ?, annee = ?, couleur = ?, matricule = ? WHERE id = ?"
        );
        return $stmt->execute([
            $data['marque'],
            $data['modele'],
            $data['annee'],
            $data['couleur'],
            $data['matricule'],
            $id
        ]);
    }

    public static function delete(int $id): bool {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM vehicules WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

class PhotosVehicule {

    public static function getAll(int $vehicule_id): array {
        $db = dbConnect();
        $stmt = $db->prepare(
            "SELECT * FROM photos_vehicule WHERE id_vehicule = ? ORDER BY principale DESC, id ASC"
        );
        $stmt->execute([$vehicule_id]);
        return $stmt->fetchAll();
    }

    public static function add(int $vehicule_id, string $url_photo, bool $principale = false): int {
        $db = dbConnect();
        if ($principale) {
            // Reset other photos
            $db->prepare("UPDATE photos_vehicule SET principale = 0 WHERE id_vehicule = ?")->execute([$vehicule_id]);
        }
        $stmt = $db->prepare(
            "INSERT INTO photos_vehicule (id_vehicule, url_photo, principale) VALUES (?, ?, ?)"
        );
        $stmt->execute([$vehicule_id, $url_photo, $principale ? 1 : 0]);
        return (int)$db->lastInsertId();
    }

    public static function setPrincipale(int $id, int $vehicule_id): bool {
        $db = dbConnect();
        $db->prepare("UPDATE photos_vehicule SET principale = 0 WHERE id_vehicule = ?")->execute([$vehicule_id]);
        $stmt = $db->prepare("UPDATE photos_vehicule SET principale = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function delete(int $id): bool {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM photos_vehicule WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>