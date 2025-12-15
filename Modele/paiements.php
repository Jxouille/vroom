<?php
require_once  __DIR__ . '/bd_connection.php';

class Paiements {

    public static function get(int $id): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM paiements WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function creer(array $data): int {
        $db = dbConnect();
        $stmt = $db->prepare("INSERT INTO paiements (id_reservation, moyen_paiement, montant, statut, devise, transaction_id, receipt_url, date_paiement) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['id_reservation'],
            $data['moyen_paiement'],
            $data['montant'],
            $data['statut'] ?? 'en_attente',
            $data['devise'] ?? 'MAD',
            $data['transaction_id'] ?? null,
            $data['receipt_url'] ?? null,
            $data['date_paiement'] ?? null
        ]);
        return (int)$db->lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        $db = dbConnect();
        $stmt = $db->prepare("UPDATE paiements SET statut = ?, date_paiement = ? WHERE id = ?");
        return $stmt->execute([
            $data['statut'] ?? 'en_attente',
            $data['date_paiement'] ?? null,
            $id
        ]);
    }

    public static function delete(int $id): bool {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM paiements WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function allByReservation(int $id_reservation): array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM paiements WHERE id_reservation = ?");
        $stmt->execute([$id_reservation]);
        return $stmt->fetchAll();
    }
}
?>