<?php
require_once __DIR__ . '/../Modele/annonces.php';
require_once __DIR__ . '/../Modele/reservations.php';
require_once __DIR__ . '/../Modele/favoris.php';
require_once __DIR__ . '/../Modele/ville.php';
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
    public function recherche_trajets(): void {
    $title = "Recherche de trajets";
    $css = "recherche_trajet.css";

    if (!empty($_GET['prix_max'])) {
        $conditions[] = 'prix_par_personne <= :prix_max';
    }
    if (!empty($_GET['heure_min'])) {
        $conditions[] = 'heure_depart >= :heure_min';
    }
    if (!empty($_GET['places_min'])) {
        $conditions[] = 'places_disponibles >= :places_min';
    }


    $filters = [
        'depart'  => $_GET['ville_depart'],
        'arrivee' => $_GET['ville_arrivee'] ,
        'date_depart'   => $_GET['date_depart'],
    ];

    $annonces = Annonces::recherche_trajets($filters);

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
    public function publier(): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }
        $id_conducteur = $_SESSION['user_id'];

        // Création ou récupération des ville
        $id_ville_depart  = Villes::trouveroucreer($_POST['ville_depart']);
        $id_ville_arrivee = Villes::trouveroucreer($_POST['ville_arrivee']);

        // Récupération du véhicule
        $datetime_depart = $_POST['date_depart'] . ' ' . $_POST['heure_depart'];
        // Préparation des données
        $data = [
            'id_conducteur'       => $id_conducteur,

            'date_depart'         => $_POST['date_depart'],
            'heure_depart'        => $_POST['heure_depart'],
            'datetime_depart'     => $datetime_depart,

            'date_arrivee'        => $_POST['date_arrivee'] ?? null,
            'heure_arrivee'       => $_POST['heure_arrivee'] ?? null,

            'prix_par_personne'   => $_POST['prix'],
            'places_disponibles'  => $_POST['places'],
            'description'         => $_POST['description'] ?? null,

            'id_ville_depart'     => $id_ville_depart,
            'adresse_depart'      => $_POST['adresse_depart'],

            'id_ville_arrivee'    => $id_ville_arrivee,
            'adresse_arrivee'     => $_POST['adresse_arrivee'],
            'id_vehicule'         => 3,
        ];
        
        // Création de l'annonce
        if (!Annonces::creer($data)) {
            header("Location: index.php?page=mes_paiements");
            exit;
            /// die("Erreur lors de la création de l'annonce.");
        }
        header("Location: index.php?page=mes_annonces");
        exit;
            }
        }
?>
