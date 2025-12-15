<?php
require_once __DIR__ . '/../Modele/annonces.php';

class c_annonce {

    /**
     * Affiche une annonce
     */
    public function afficher(): void {

        // Sécurité : vérifier l'ID
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            header("Location: index.php?page=accueil");
            exit;
        }

        $annonce = Annonces::get((int) $_GET['id']);

        if (!$annonce) {
            header("Location: index.php?page=accueil");
            exit;
        }

        // Variables pour head.php
        $title = "Annonce";
        $css   = "annonce.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_detail_trajet.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    /**
     * Publie une nouvelle annonce
     */
    public function publier(): void {

        // Protection basique
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?page=accueil");
            exit;
        }

        // Optionnel : protection si non connecté
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        Annonces::creer($_POST);

        header("Location: index.php?page=mes_annonces");
        exit;
    }
}
