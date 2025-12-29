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