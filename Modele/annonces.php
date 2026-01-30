<?php
require_once  __DIR__ . '/bd_connection.php';
require_once  __DIR__ . '/ville.php';


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

    public static function creer(array $data): void {
        $db = dbConnect();
        $stmt = $db->prepare("
            INSERT INTO annonces (
            id_conducteur,
            date_depart,
            heure_depart,
            datetime_depart,
            date_arrivee,
            heure_arrivee,
            id_vehicule,
            prix_par_personne,
            places_disponibles,
            description,
            id_ville_depart,
            adresse_depart,
            id_ville_arrivee,
            adresse_arrivee
            ) VALUES (
            :id_conducteur,
            :date_depart,
            :heure_depart,
            :datetime_depart,
            :date_arrivee,
            :heure_arrivee,
            :id_vehicule,
            :prix_par_personne,
            :places_disponibles,
            :description,
            :id_ville_depart,
            :adresse_depart,
            :id_ville_arrivee,
            :adresse_arrivee
            )
            ");

        $stmt->execute($data);
    }
    public static function update(int $id, array $data): bool {
        $db = dbConnect();
        $fields = [];
        $params = [':id' => $id];

        $date = $data['date_depart'] ?? null;
        $heure = $data['heure_depart'] ?? null;

        if ($date !== null && $date !== '') {
            $fields[] = "date_depart = :date_depart";
            $params[':date_depart'] = $date;
        }

        if ($heure !== null && $heure !== '') {
            $fields[] = "heure_depart = :heure_depart";
            $params[':heure_depart'] = $heure;
        }

        if ($date || $heure) {
            $stmt = $db->prepare("SELECT date_depart, heure_depart FROM annonces WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $current = $stmt->fetch(PDO::FETCH_ASSOC);

            $finalDate = $date ?? $current['date_depart'];
            $finalHeure = $heure ?? $current['heure_depart'];

            $fields[] = "datetime_depart = :datetime_depart";
            $params[':datetime_depart'] = "$finalDate $finalHeure";
        }

        $map = [
            'prix_par_personne',
            'places_disponibles',
            'description',
            'statut',
            'heure_arrivee',
            'date_arrivee',
            'id_vehicule'
        ];

        foreach ($map as $field) {
            if (isset($data[$field]) && $data[$field] !== '') {
                $fields[] = "$field = :$field";
                $params[":$field"] = $data[$field];
            }
        }

        if (empty($fields)) return false;

        $sql = "UPDATE annonces SET " . implode(', ', $fields) . " WHERE id = :id";
        return $db->prepare($sql)->execute($params);
    }



    public static function delete(int $id): bool {
        $db = dbConnect();
        $sql = "DELETE FROM annonces WHERE id = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id]);
    }
    public static function recherche_trajets(array $filters = [], string $sort = 'date_desc'): array {
        $trajets = [];
        $id_ville_depart = null;
        $id_ville_arrivee = null;
        $db = dbConnect();

        $sql = "SELECT id
                FROM annonces
                WHERE statut = :statut";

        $params = [
            ':statut' => 'active'
        ];
        // Apply filters
        if (!empty($filters['ville_depart'])) {
            $id_ville_depart = Villes::getId($filters['ville_depart']);
            $sql .= " AND id_ville_depart LIKE :id_ville_depart";
            $params[':id_ville_depart'] = $id_ville_depart;
        }

        if (!empty($filters['ville_arrivee'])) {
            $id_ville_arrivee = Villes::getId($filters['ville_arrivee']);
            $sql .= " AND id_ville_arrivee LIKE :id_ville_arrivee";
            $params[':ville_arrivee'] = $id_ville_arrivee ;
        }

        if (!empty($filters['date_depart'])) {
            $sql .= " AND DATE(date_depart) = :date_depart";
            $params[':date_depart'] = $filters['date_depart'];
        }

    // Apply sorting
        switch ($sort) {
            case 'date_asc':
                $sql .= " ORDER BY date_depart ASC";
                break;
            case 'prix_asc':
                $sql .= " ORDER BY prix_par_personne ASC";
                break;
            case 'prix_desc':
                $sql .= " ORDER BY prix_par_personne DESC";
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
                "id" => (int) $row["id"],
            ];
        }
        return $trajets;
    }

    public static function detail_trajet(int $id): ?array{
        $db = dbConnect();
        $sql = "
        SELECT 
            a.id,
            a.date_depart,
            DATE_FORMAT(a.heure_depart, '%H:%i') AS heure_depart,
            a.prix_par_personne,
            a.places_disponibles,
            a.description,
            a.adresse_depart,
            a.adresse_arrivee,
           
     

            u.id AS conducteur_id,
            u.nom AS conducteur_nom,
            u.note AS conducteur_note,
        

            v.marque,
            v.modele,

            vd.nom AS ville_depart,
            va.nom AS ville_arrivee,

            d.chemin_fichier AS chemin_avatar

        FROM annonces a
        JOIN utilisateurs u ON a.id_conducteur = u.id
        LEFT JOIN documents_utilisateur d 
            ON a.id_conducteur = d.id_utilisateur 
            AND d.type_document = 'avatar'
        JOIN vehicules v ON a.id_vehicule = v.id
        JOIN ville vd ON a.id_ville_depart = vd.id
        JOIN ville va ON a.id_ville_arrivee = va.id
        WHERE a.id = :id
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $annonce = $stmt->fetch(PDO::FETCH_ASSOC);
        return $annonce ?: null;
    }
  public static function get_annonces_conducteur(int $id_conducteur): ?array {
    $trajets = [];
    $db = dbConnect();
    $stmt = $db->prepare(
        "SELECT * FROM annonces WHERE id_conducteur = :id_conducteur"
    );
    $stmt->execute([
        ':id_conducteur' => $id_conducteur
    ]);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $trajets[] = [
            "id" => (int) $row["id"],
        ];
    }
    return $trajets;
    }
}
?>
