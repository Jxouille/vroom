<?php
require_once  __DIR__ . '/bd_connection.php';


class Avis {

    public static function getByReservation(int $id_reservation): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM avis WHERE id_reservation = ?");
        $stmt->execute([$id_reservation]);
        return $stmt->fetch() ?: null;
    }

    public static function creer(array $data): int {
        $db = dbConnect();
        $stmt = $db->prepare("INSERT INTO avis (id_reservation, id_expediteur, id_destinataire, note, commentaire) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['id_reservation'] ?? null,
            $data['id_expediteur'] ?? null,
            $data['id_destinataire'] ?? null,
            $data['note'],
            $data['commentaire'] ?? null
        ]);
        return (int)$db->lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        $db = dbConnect();
        $stmt = $db->prepare("UPDATE avis SET note = ?, commentaire = ? WHERE id = ?");
        return $stmt->execute([
            $data['note'],
            $data['commentaire'] ?? null,
            $id
        ]);
    }

    public static function delete(int $id): bool {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM avis WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function allByUser(int $user_id): array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM avis WHERE id_destinataire = ? ORDER BY date_creation DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
}
?>