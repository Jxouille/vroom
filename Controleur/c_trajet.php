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
        $js    = "trajet.js";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_publie_trajet.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    /**
     * Publie une nouvelle annonce
     */
    public function publier(): void
{
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $id_conducteur = $_SESSION['user_id'];

        // Vérification minimale des champs requis
        $required = ['ville_depart', 'ville_arrivee', 'date_depart', 'heure_depart', 'heure_arrivee', 'distance', 'duree_minutes', 'route_index', 'prix', 'places', 'description'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                die("Le champ $field est requis.");
            }
        }

        // Création ou récupération des lieux
        $id_lieu_depart  = Annonces::trouverOuCreerLieu($_POST['ville_depart']);
        $id_lieu_arrivee = Annonces::trouverOuCreerLieu($_POST['ville_arrivee']);

        // Récupération du véhicule
        $vehicule = Vehicules::getByUser($id_conducteur);
        if (!$vehicule) die("Aucun véhicule associé à votre compte.");

        // Préparation des données
        $data = [
            'id_conducteur'      => $id_conducteur,
            'id_vehicule'        => $vehicule['id'],
            'date_depart'        => $_POST['date_depart'],
            'heure_depart'       => $_POST['heure_depart'],
            'date_arrivee'       => $_POST['date_depart'], // peut-être $_POST['date_arrivee'] si différent
            'heure_arrivee'      => $_POST['heure_arrivee'],
            'distance_km'        => $_POST['distance'],
            'duree_minutes'      => $_POST['duree_minutes'],
            'route_index'        => $_POST['route_index'],
            'prix_par_personne'  => $_POST['prix'],
            'places_disponibles' => $_POST['places'],
            'description'        => $_POST['description'],
            'id_lieu_depart'     => $id_lieu_depart,
            'id_lieu_arrivee'    => $id_lieu_arrivee
        ];

        // Création de l'annonce
        if (!Annonces::creer($data)) {
            die("Erreur lors de la création de l'annonce.");
        }
        header("Location: index.php?page=mes_annonces");
        exit;
            }
        }
?>
