<?php
require_once __DIR__ . '/../modele/reservations.php';

class c_reservation {

    public function reserver() {
        Reservations::creer($_POST);
        header("Location: index.php?page=mes_reservations");
    }

    public function afficher() {
        include __DIR__ . '/../vue/header.php';
        include __DIR__ . '/../vue/pages/reservation.php';
        include __DIR__ . '/../vue/footer.php';
    }
}
