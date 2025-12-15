<?php
require_once  __DIR__ . '/bd_connection.php';


class Annonces {

    public static function get(int $id): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM annonces WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function all(): array {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM annonces ORDER BY date_depart ASC");
        return $stmt->fetchAll();
    }

    public static function creer(array $data): int {
        $db = dbConnect();
        $stmt = $db->prepare("INSERT INTO annonces (id_conducteur, id_vehicule, date_depart, heure_depart, prix_par_personne, places_disponibles, description, id_lieu_depart, id_lieu_arrivee, statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['id_conducteur'],
            $data['id_vehicule'],
            $data['date_depart'],
            $data['heure_depart'],
            $data['prix_par_personne'],
            $data['places_disponibles'],
            $data['description'],
            $data['id_lieu_depart'],
            $data['id_lieu_arrivee'],
            $data['statut'] ?? 'active'
        ]);
        return (int)$db->lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        $db = dbConnect();
        $stmt = $db->prepare("UPDATE annonces SET date_depart = ?, heure_depart = ?, prix_par_personne = ?, places_disponibles = ?, description = ?, statut = ? WHERE id = ?");
        return $stmt->execute([
            $data['date_depart'],
            $data['heure_depart'],
            $data['prix_par_personne'],
            $data['places_disponibles'],
            $data['description'],
            $data['statut'] ?? 'active',
            $id
        ]);
    }

    public static function delete(int $id): bool {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM annonces WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
