<?php
require_once __DIR__ . '/../Modele/annonces.php';
require_once __DIR__ . '/../Modele/paiements.php';
require_once __DIR__ . '/../Modele/reservations.php';

class c_paiement {

    public function afficher(): void {
        $title = "Paiement sécurisé";
        $css = "paiement.css";

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }
        
        $annonce_info = Annonces::get($_GET['id']); 
        $data = [
            'id_annonce' => (int) $_GET['id'],
            'id_passager' => $_SESSION['user_id'],
            'prix_total' => $annonce_info['prix_par_personne'] , 
            'uuid'=> uniqid('res_') ,
        ];
        $reservation = Reservations::creer($data);

        // Chargement de la vue
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_paiement.php'; // La vue avec le formulaire
        require __DIR__ . '/../Vue/footer.php';
    }


    public function payer(): void {
        $res_info = Reservations::get($_GET['id']);
        $data = [
            'id_annonce' => $_GET['id'],
            'moyen_paiement' => 'carte',
            'montant'        => $res_info['prix'], // Récupéré de l'annonce
            'statut'         => 'valide',
            'devise'         => 'EUR',
            'transaction_id' => 'TX-' . uniqid(),
            'date_paiement'  => date('Y-m-d H:i:s')
        ];

            // Insertion en BDD
            Paiements::creer($data);

            // Mise à jour du statut de la réservation
            Reservations::update($_GET['id_res'], ['statut' => 'acceptee']);

            header("Location: index.php?page=sucess");
            exit;
        }
    }
