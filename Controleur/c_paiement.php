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
        
        $reservation_id = Reservations::creer($data);

        // Chargement de la vue
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_paiement.php'; // La vue avec le formulaire
        require __DIR__ . '/../Vue/footer.php';
    }
    public function payer(): void {

        /// si paiement dejas fait il faut affiche "le paiement est dejas fait" car si non sur la bd va crere un paiement en attent en plus si on fait fait retour 
        
        $res_info = Reservations::get($_GET['id']);

        if ($res_info['statut'] === 'acceptee') {
            header("Location: index.php?page=success");
            exit;
        } else {
            $data = [
                'id_reservation' => $_GET['id'],
                'moyen_paiement' => 'carte',
                'montant'        => $res_info['prix_total'], // Récupéré de l'annonce
                'statut'         => 'valide',
                'devise'         => 'EUR',
                'transaction_id' => 'TX-' . uniqid(),
                'date_paiement'  => date('Y-m-d H:i:s')
            ];
            Paiements::creer($data);
            Reservations::update($_GET['id'], ['statut' => 'acceptee']);
            Annonces::update($res_info['id_annonce'], ['statut'=> 'complete'] );
            header("Location: index.php?page=paiement&action=success");
            exit;
        }
    }
    public function paiemnetsucces(): void {
        $title = "Paiement réussi";
        $css = "success.css";

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        // Chargement de la vue
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_success.php'; // La vue de succès
        require __DIR__ . '/../Vue/footer.php';
    }
}
class c_detail_paiement {
    public function detail_paiement(): void {
            $paiement = Paiements::get($_GET['id']);

            $title = "Détails du paiement";
            $css = "detail_paiement.css"; /// page à faire

            require __DIR__ . '/../Vue/head.php';
            require __DIR__ . '/../Vue/header.php';
            require __DIR__ . '/../Vue/pages/v_detail_paiement.php';
            require __DIR__ . '/../Vue/footer.php';
        }
}?>