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
require_once __DIR__ . '/../Modele/messages_contact.php';

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
                $titre = "Utilisateurs";
                $titre_colone = ['id', 'nom', 'prenom', 'email', 'telephone', 'date_creation'];
                $valeurs = Utilisateur::all();
                break;

            case 'annonces':
                $titre = "Annonces";
                $titre_colone = [
                    'id', 'id_conducteur', 'id_vehicule',
                    'id_ville_depart', 'id_ville_arrivee',
                    'date_depart', 'prix_par_personne',
                    'places_disponibles', 'statut', 'date_creation'
                ];
                $valeurs = Annonces::all();
                break;
            case 'reservations':
                $titre = "Réservations";
                $titre_colone = ['id', 'id_annonce', 'id_passager', 'prix_total', 'statut', 'date_creation'];
                $valeurs = Reservations::all();
                break;
            case 'paiements':
                $titre = "Paiements";
                $titre_colone = ['id', 'id_reservation', 'moyen_paiement', 'montant', 'statut', 'date_paiement'];
                $valeurs = Paiements::all();
                break;
            case 'documents':
                $titre = "Documents";   
                $titre_colone = ['id', 'id_utilisateur', 'type_document', 'chemin_fichier', 'date_upload'];
                $valeurs = Documents::all();
                break;
            case 'demande_contact':
                $titre = "Demandes de contact";
                $titre_colone = ['id', 'nom', 'email', 'sujet', 'message', 'date_creation', 'statut', 'reponse', ];
                $valeurs = Contact::all();
                break;
            case 'faq':
                $titre = "FAQ";
                $titre_colone = ['id', 'question', 'reponse', 'statut', 'date_creation', 'nom_theme'];
                $valeurs = FAQ::all();
                break;
            case 'historique':
                $titre = "Historique des réservations";
                $titre_colone = ['id', 'id_annonce', 'id_passager', 'prix_total', 'statut', 'date_creation'];
                $valeurs = Reservations::all();
                break;
        }

        // Inclusion de la vue
        require __DIR__ . '/../Vue/admin/index_admin.php';

    }

    // Modification d'un champ
    public function modifier() {

        // 1️⃣ Vérifier l'ID envoyé par le formulaire
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            die('ID manquant');
        }

        $id = (int) $_POST['id'];

        // 2️⃣ Récupérer les données du formulaire
        $data = $_POST;
        unset($data['id']); // très important

        // 3️⃣ Savoir quelle page admin est utilisée
        if (!isset($_GET['admin_page'])) {
            die('admin_page manquant');
        }

        $adminPage = $_GET['admin_page'];

        // 4️⃣ Associer page admin → modèle
        $models = [
            'utilisateurs'      => 'Utilisateur',
            'annonces'          => 'Annonces',
            'reservations'      => 'Reservations',
            'paiements'         => 'Paiements',
            'documents'         => 'Documents',
            'demande_contact'   => 'ContactMessage',
            'faq'               => 'FAQ'
        ];

        if (!isset($models[$adminPage])) {
            die('Page admin invalide');
        }

        $model = $models[$adminPage];

        // 5️⃣ Nettoyer les valeurs
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
        }

        // 6️⃣ Mettre à jour
        if ($model::update($id, $data)) {
            header('Location: index.php?page=admin&admin_page=' . $adminPage . '&success=1');
            exit;
        }

        header('Location: index.php?page=admin&admin_page=' . $adminPage . '&error=1');
        exit;
    }
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