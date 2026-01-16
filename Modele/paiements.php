<?php
require_once  __DIR__ . '/bd_connection.php';

class Paiements {
    public static function all(): array {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM paiements ORDER BY date_creation DESC");
        return $stmt->fetchAll();
    }
    public static function mes_paiement(int $id_client): array {
        $db = dbConnect();

        $sql = "
            SELECT p.*
            FROM paiements p
            JOIN reservations r ON r.id = p.id_reservation
            WHERE r.id_passager = :id_client
            ORDER BY p.date_creation DESC
        ";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function get(int $id): ?array {
    $db = dbConnect();
    $stmt = $db->prepare("SELECT * FROM paiements WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
    }
    public static function creer(array $data): int {
        $db = dbConnect();
        $stmt = $db->prepare("INSERT INTO paiements (id_reservation, moyen_paiement, montant, statut, devise, transaction_id, date_paiement) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['id_reservation'],
            $data['moyen_paiement'],
            $data['montant'],
            $data['statut'],
            $data['devise'],
            $data['transaction_id'],
            $data['date_paiement']
        ]);
        return (int)$db->lastInsertId();
    }
}
?>