<?php
require_once __DIR__ . '/../Modele/utilisateur.php';
require_once __DIR__ . '/../Modele/vehicules.php';
require_once __DIR__ . '/../Modele/messages.php';
require_once __DIR__ . '/../Modele/conversations.php';
require_once __DIR__ . '/../Modele/favoris.php';
require_once __DIR__ . '/../Modele/paiements.php';
require_once __DIR__ . '/../Modele/reservations.php';
require_once __DIR__ . '/../Modele/annonces.php';
require_once __DIR__ . '/../Modele/documents.php';
require_once __DIR__ . '/../Modele/contact.php';
require_once __DIR__ . '/../Modele/faq.php';

class c_admin {

    // Affichage du profil
    public function afficher(?int $id_utilisateur = null) {

       
        // Récupération de la page demandée
        $admin_page = $_GET['admin_page'] ?? 'utilisateurs';

        // Sécurité : pages autorisées
        $pages_autorisees = ['utilisateurs', 'annonces', 'reservations', 'paiements', 'documents', 'demande_contact', 'faq', 'historique' ];

        if (!in_array($admin_page, $pages_autorisees, true)) {
            $admin_page = 'utilisateurs';
        }

        // Chargement des données selon la page
        switch ($admin_page) {

            case 'utilisateurs':
                $titre_colone = ['id', 'nom', 'prenom', 'email', 'telephone', 'date_creation'];
                $valeurs = Utilisateur::all();
                break;

            case 'annonces':
                $titre_colone = [
                    'id', 'id_conducteur', 'id_vehicule',
                    'id_ville_depart', 'id_ville_arrivee',
                    'date_depart', 'prix_par_personne',
                    'places_disponibles', 'statut', 'date_creation'
                ];
                $valeurs = Annonces::all();
                break;

            case 'reservations':
                $titre_colone = ['id', 'id_annonce', 'id_passager', 'prix_total', 'statut', 'date_creation'];
                $valeurs = Reservations::all();
                break;
            case 'paiements':
                $titre_colone = ['id', 'id_reservation', 'moyen_paiement', 'montant', 'statut', 'date_paiement'];
                $valeurs = Paiements::all();
                break;
            case 'documents':
                $titre_colone = ['id', 'id_utilisateur', 'type_document', 'chemin_fichier', 'date_upload'];
                $valeurs = Documents::all();
                break;
            case 'demande_contact':
                $titre_colone = ['id', 'nom', 'email', 'message', 'date_envoi'];
                $valeurs = Contact::all();
                break;
            case 'faq':
                $titre_colone = ['id', 'question', 'reponse', 'statut', 'date_creation', 'nom_theme'];
                $valeurs = FAQ::all();
                break;
            case 'historique':
                $titre_colone = ['id', 'id_annonce', 'id_passager', 'prix_total', 'statut', 'date_creation'];
                $valeurs = Reservations::all();
                break;
        }

        // Inclusion de la vue
        require __DIR__ . '/../Vue/admin/index_admin.php';

    }

    // Modification d'un champ
    public function modifier() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            echo 'Non autorisé';
            exit;
        }

        $id_utilisateur = $_GET['user_id'];

        if (!isset($_POST['field'], $_POST['value'])) {
            http_response_code(400);
            echo 'Données manquantes';
            exit;
        }

        $field = $_POST['field'];
        $value = trim($_POST['value']);

        // Champs autorisés
        $champs_valides = ['prenom', 'nom', 'email', 'telephone', 'biographie'];
        if (!in_array($field, $champs_valides)) {
            http_response_code(400);
            echo 'Champ non autorisé';
            exit;
        }

        // Mise à jour en base
        $success = Utilisateur::updateField($id_utilisateur, $field, $value);

        if ($success) {
            echo 'OK';
        } else {
            http_response_code(500);
            echo 'Erreur lors de la mise à jour';
        }
    }

    // Suppression du compte (optionnel)
    public function supprimer() {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            exit;
        }
        $id_utilisateur = $_SESSION['user_id'];
        $deleted = Utilisateur::delete($id_utilisateur);

        if ($deleted) {
            session_destroy();
            echo 'OK';
        } else {
            http_response_code(500);
            echo 'Erreur suppression';
        }
    }
  

   
}