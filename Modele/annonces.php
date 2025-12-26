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
        $sql = "DELETE FROM annonces WHERE id = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id]);
    }
    public static function recherche_trajets(array $filters = [], string $sort = 'date_desc'): array{
        $trajets = [];
        $db = dbConnect();

        $sql = "SELECT id
                FROM annonces
                WHERE 1=1"; // Dummy condition for easier appending

        $params = [];

        // Apply filters
        if (!empty($filters['depart'])) {
            $sql .= " AND depart LIKE :depart";
            $params[':depart'] = '%' . $filters['depart'] . '%';
        }
        if (!empty($filters['destination'])) {
            $sql .= " AND destination LIKE :destination";
            $params[':destination'] = '%' . $filters['destination'] . '%';
        }
        if (!empty($filters['date'])) {
            $sql .= " AND DATE(date_depart) = :date";
            $params[':date'] = $filters['date'];
        }

        // Apply sorting
        switch ($sort) {
            case 'date_asc':
                $sql .= " ORDER BY date_depart ASC";
                break;
            case 'prix_asc':
                $sql .= " ORDER BY prix ASC";
                break;
            case 'prix_desc':
                $sql .= " ORDER BY prix DESC";
                break;
            case 'date_desc':
            default:
                $sql .= " ORDER BY date_depart DESC";
                break;
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $trajets[] = [
                "id"=> (int) $row["id"],
            ];
        }
        return $trajets;
    }
    public static function detail_trajet(int $id): ?array
    {
        $db = dbConnect();// or your PDO instance

        $sql = "
        SELECT 
            a.id,
            a.date_depart,
            a.heure_depart,
            a.prix_par_personne,
            a.places_disponibles,
            a.description,

            u.nom AS conducteur_nom,
            u.note AS conducteur_note,
            u.avatar,

            v.marque,
            v.modele,

            ld.nom AS lieu_depart,
            la.nom AS lieu_arrivee

        FROM annonces a
        JOIN utilisateurs u ON a.id_conducteur = u.id
        JOIN vehicules v ON a.id_vehicule = v.id
        JOIN lieux ld ON a.id_lieu_depart = ld.id
        JOIN lieux la ON a.id_lieu_arrivee = la.id
        WHERE a.id = :id
        AND a.statut = 'active'
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);

        $annonce = $stmt->fetch(PDO::FETCH_ASSOC);

        return $annonce ?: null;
    }
}
