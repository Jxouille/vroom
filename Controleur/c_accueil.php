<?php
require_once __DIR__ . '/../Modele/annonces.php';
require_once __DIR__ . '/../Modele/reservations.php';

class c_accueil {

    public function afficher(): void {
        $title = "Accueil";
        $css = "accueil.css";
        $annonces = Annonces::recherche_trajets();
        #$annonces = Annonces::all();

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_accueil.php';
        require __DIR__ . '/../Vue/footer.php';
    }
}
