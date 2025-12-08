<?php
require_once __DIR__ . '/../modele/paiements.php';

class c_paiement {

    public function payer() {
        $result = Paiements::creer($_POST);

        include __DIR__ . '/../vue/header.php';
        include __DIR__ . '/../vue/pages/paiement_resultat.php';
        include __DIR__ . '/../vue/footer.php';
    }
}
