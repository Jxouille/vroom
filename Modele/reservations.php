<?php
require_once  __DIR__ . '/bd_connection.php';

class Reservations {

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
        $stmt = $db->prepare("UPDATE reservations SET donnees_passager = ?, statut = ?, prix_total = ? WHERE id = ?");
        return $stmt->execute([
            isset($data['donnees_passager']) ? json_encode($data['donnees_passager'], JSON_UNESCAPED_UNICODE) : null,
            $data['statut'] ?? 'en_attente',
            $data['prix_total'],
            $id
        ]);
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
}
