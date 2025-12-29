<?php
require_once __DIR__ . '/../Modele/annonces.php';
require_once __DIR__ . '/../Modele/paiements.php';
require_once __DIR__ . '/../Modele/reservations.php';

class c_paiement {

    public function afficher(): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }
        // 1. On récupère la réservation via l'ID passé en URL
        #$id_res = $_GET['id_annonce'] ?? null;
        #$reservation = Reservations::get((int)$id_res);

        $title = "Paiement sécurisé";
        $css = "paiement.css";

        // Chargement de la vue
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_paiement.php'; // La vue avec le formulaire
        require __DIR__ . '/../Vue/footer.php';
    }

    public function payer(): void {
        $annonce_info = Annonces::get((int)$_GET['id_annonce']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            // Simulation des données de paiement
            $data = [
                'id_annonce' => $_GET['id_annonce'],
                'moyen_paiement' => 'carte',
                'montant'        => $annonce_info['prix'], // Récupéré de l'annonce
                'statut'         => 'valide',
                'devise'         => 'EUR',
                'transaction_id' => 'TX-' . uniqid(),
                'date_paiement'  => date('Y-m-d H:i:s')
            ];

            // Insertion en BDD
            Paiements::creer($data);

            // Mise à jour du statut de la réservation
            Reservations::update((int)$_GET['id_annonce'], ['statut' => 'acceptee', 'prix_total' => $annonce_info['prix']]);

            header("Location: index.php?page=mes_trajets&success=1");
            exit;
        }
    }

}