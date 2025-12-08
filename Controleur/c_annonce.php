<?php
require_once __DIR__ . '/../modele/annonces.php';

class c_annonce {

    public function afficher() {
        $annonce = Annonces::get($_GET['id']);

        include __DIR__ . '/../vue/header.php';
        include __DIR__ . '/../vue/pages/annonce.php';
        include __DIR__ . '/../vue/footer.php';
    }

    public function publier() {
        Annonces::creer($_POST);

        header("Location: index.php?page=mes_annonces");
    }
}
