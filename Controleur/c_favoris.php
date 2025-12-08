<?php
require_once __DIR__ . '/../modele/m_favoris.php';

class c_favoris {

    public function ajouter() {
        Favoris::ajouter($_SESSION['user_id'], $_GET['id_annonce']);
        header("Location: index.php?page=annonce&id=" . $_GET['id_annonce']);
    }

    public function supprimer() {
        Favoris::supprimer($_SESSION['user_id'], $_GET['id_annonce']);
        header("Location: index.php?page=annonce&id=" . $_GET['id_annonce']);
    }

    public function liste() {
        $favoris = Favoris::liste($_SESSION['user_id']);

        include __DIR__ . '/../vue/header.php';
        include __DIR__ . '/../vue/pages/favoris.php';
        include __DIR__ . '/../vue/footer.php';
    }
}
