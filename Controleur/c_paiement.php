<?php
require_once __DIR__ . '/../Model/paiements.php';
require_once __DIR__ . '/../Model/reservations.php';

class c_paiement {

    public function afficher(int $id_reservation): void {
        #if (!isset($_SESSION['user_id'])) {
        #    header("Location: index.php?page=connexion");
        #    exit;
        #}

        $reservation = Reservations::get($id_reservation);
        #if (!$reservation) {
        #    header("Location: index.php?page=mes_reservations");
        #    exit;
        #}

        $title = "Paiement";
        $css = "paiement.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_paiement.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function payer(): void {
        if (!isset($_SESSION['user_id'], $_POST['id_reservation'], $_POST['moyen_paiement'], $_POST['montant'])) {
            header("Location: index.php?page=paiement&error=missing");
            exit;
        }

        Paiements::creer([
            'id_reservation' => $_POST['id_reservation'],
            'moyen_paiement' => $_POST['moyen_paiement'],
            'montant' => $_POST['montant']
        ]);

        header("Location: index.php?page=mes_reservations&success=paid");
        exit;
    }
}
?>