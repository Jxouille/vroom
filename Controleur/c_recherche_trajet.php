<?php
require_once __DIR__ . '/../modele/annonces.php';

class c_recherchetrajet {

    public function afficher() {
        include __DIR__ . '/../vue/header.php';
        include __DIR__ . '/../vue/pages/recherche_trajet.php';
        include __DIR__ . '/../vue/footer.php';
    }

    public function rechercher() {
        $trajets = Annonces::rechercher($_GET);

        include __DIR__ . '/../vue/header.php';
        include __DIR__ . '/../vue/pages/resultats_recherche.php';
        include __DIR__ . '/../vue/footer.php';
    }
}
