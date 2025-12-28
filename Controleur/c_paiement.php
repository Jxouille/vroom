<?php
require_once __DIR__ . '/../Modele/reservations.php';
require_once __DIR__ . '/../Modele/paiements.php';

class c_paiement {

    public function afficher(): void {
        // 1. On récupère la réservation via l'ID passé en URL
        $id_res = $_GET['id_res'] ?? null;
        $reservation = Reservations::get((int)$id_res);

        if (!$reservation) {
            die("Réservation introuvable.");
        }

        $title = "Paiement sécurisé";
        $css = "paiement.css";

        // Chargement de la vue
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_paiement.php'; // Ta vue avec le formulaire
        require __DIR__ . '/../Vue/footer.php';
    }

    public function traiter(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_res = $_GET['id_res'];
            $res = Reservations::get((int)$id_res);

            // Simulation des données de paiement
            $data = [
                'id_reservation' => $id_res,
                'moyen_paiement' => 'carte',
                'montant'        => $res['prix_total'], // Récupéré de la réservation
                'statut'         => 'valide',
                'devise'         => 'MAD',
                'transaction_id' => 'TX-' . uniqid(),
                'date_paiement'  => date('Y-m-d H:i:s')
            ];

            // Insertion en BDD
            Paiements::creer($data);

            // Mise à jour du statut de la réservation
            Reservations::update((int)$id_res, ['statut' => 'acceptee', 'prix_total' => $res['prix_total']]);

            header("Location: index.php?page=mes_trajets&success=1");
            exit;
        }
    }
}