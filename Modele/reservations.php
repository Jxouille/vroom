<?php
require_once  __DIR__ . '/bd_connection.php';

class Reservations {

    public static function all(): array {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM reservations ORDER BY date_creation DESC");
        return $stmt->fetchAll();
    }
    public static function get(int $id): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM reservations WHERE id = ?");
        $stmt->execute([$id]);
        $resa = $stmt->fetch();
        if ($resa && $resa['donnees_passager']) {
            $resa['donnees_passager'] = json_decode($resa['donnees_passager'], true);
        }
        return $resa ?: null;
    }

    public static function creer(array $data): int {
        $db = dbConnect();
        $stmt = $db->prepare("INSERT INTO reservations (uuid, id_annonce, donnees_passager, id_passager, statut, prix_total) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['uuid'],
            $data['id_annonce'],
            isset($data['donnees_passager']) ? json_encode($data['donnees_passager'], JSON_UNESCAPED_UNICODE) : null,
            $data['id_passager'] ?? null,
            $data['statut'] ?? 'en_attente',
            $data['prix_total']
        ]);
        return (int)$db->lastInsertId();
    }

    public static function update(int $id, array $data): bool {
    $db = dbConnect();

    $fields = [];
    $params = [':id' => $id];

    // Only update if the field exists in $data
    if (isset($data['donnees_passager'])) {
        $fields[] = "donnees_passager = :donnees_passager";
        $params[':donnees_passager'] = json_encode($data['donnees_passager'], JSON_UNESCAPED_UNICODE);
    }

    if (isset($data['statut'])) {
        $fields[] = "statut = :statut";
        $params[':statut'] = $data['statut'];
    }

    if (isset($data['prix_total'])) {
        $fields[] = "prix_total = :prix_total";
        $params[':prix_total'] = $data['prix_total'];
    }

    // Nothing to update
    if (empty($fields)) {
        return false;
    }

    $sql = "UPDATE reservations SET " . implode(', ', $fields) . " WHERE id = :id";
    $stmt = $db->prepare($sql);

    return $stmt->execute($params);
    }


    public static function delete(int $id): bool {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM reservations WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function allByUser(int $user_id): array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM reservations WHERE id_passager = ? ORDER BY date_creation DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
    public static function trajets_a_venir(int $id_client): ?array {
        $db = dbConnect();

        $sql = "
            SELECT *
            FROM reservations r
            JOIN annonces a ON r.id_annonce = a.id
            JOIN utilisateurs u ON a.id_conducteur = u.id
            JOIN vehicules v ON a.id_vehicule = v.id
            JOIN ville vd ON a.id_ville_depart = vd.id
            JOIN ville va ON a.id_ville_arrivee = va.id
            WHERE r.id_passager = :id_client
            AND r.statut = 'acceptee'
            AND a.date_depart >= CURDATE()
            ORDER BY a.date_depart ASC
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id_client' => $id_client]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }

    public static function trajets_effectue(int $id_client): ?array {
        $db = dbConnect();

        $sql = "
            SELECT *
            FROM reservations r
            JOIN annonces a ON r.id_annonce = a.id
            JOIN utilisateurs u ON a.id_conducteur = u.id
            JOIN vehicules v ON a.id_vehicule = v.id
            JOIN ville vd ON a.id_ville_depart = vd.id
            JOIN ville va ON a.id_ville_arrivee = va.id
            WHERE r.id_passager = :id_client
            AND a.date_depart < CURDATE()
            ORDER BY a.date_depart DESC
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id_client' => $id_client]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }


}
