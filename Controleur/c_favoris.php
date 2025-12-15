<?php
require_once __DIR__ . '/../Model/favoris.php';

class c_favoris {

    public function ajouter(): void {
        if (!isset($_SESSION['user_id'], $_GET['id_annonce']) || !ctype_digit($_GET['id_annonce'])) {
            header("Location: index.php?page=accueil");
            exit;
        }

        Favoris::ajouter((int)$_SESSION['user_id'], (int)$_GET['id_annonce']);
        header("Location: index.php?page=annonce&id=" . (int)$_GET['id_annonce']);
        exit;
    }

    public function supprimer(): void {
        if (!isset($_SESSION['user_id'], $_GET['id_annonce']) || !ctype_digit($_GET['id_annonce'])) {
            header("Location: index.php?page=accueil");
            exit;
        }

        Favoris::supprimer((int)$_SESSION['user_id'], (int)$_GET['id_annonce']);
        header("Location: index.php?page=annonce&id=" . (int)$_GET['id_annonce']);
        exit;
    }

    public function liste(): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $favoris = Favoris::liste((int)$_SESSION['user_id']);

        $title = "Mes favoris";
        $css = "favoris.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/favoris.php';
        require __DIR__ . '/../Vue/footer.php';
    }
}
?>