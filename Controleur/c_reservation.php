<?php
#require_once __DIR__ . '/../Model/reservations.php';

class c_reservation {

    public function afficher(int $id): void {
        #if (!$resa) {
        #    header("Location: index.php?page=accueil");
        #    exit;
        #}
        $title = "Réservation";
        $css = "reservation.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/reservation.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function creer(array $data): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $data['id_passager'] = (int)$_SESSION['user_id'];
        Reservations::creer($data);

        header("Location: index.php?page=mes_reservations");
        exit;
    }
}
