<?php
require_once __DIR__ . '/../Modele/annonces.php';
require_once __DIR__ . '/../Modele/reservations.php';

class c_recherche_trajet {

    public function afficher(): void {
        $title = "Recherche de trajets";
        $css = "recherche_trajet.css";

        $annonces = Annonces::recherche_trajets();

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_recherche_trajet.php';
        require __DIR__ . '/../Vue/footer.php';
    }
}

class c_detail_trajet {
    public function afficher(): void {
        $title = "Détail du trajet";
        $css = "detail_trajet.css";

        $annonce = Annonces::detail_trajet($_GET['id']);

        if (!$annonce) {
            die("Annonce introuvable");
        }
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_detail_trajet.php';
        require __DIR__ . '/../Vue/footer.php';
    }
}

class c_publie_trajet {
    public function afficher(): void {
        // Sécurité : vérifier l'ID
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $title = "Publier un trajet";
        $css   = "publie_trajet.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_publie_trajet.php';
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

?>
