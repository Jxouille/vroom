<?php
require_once  __DIR__ . '/bd_connection.php';

class Paiements {

    public function payer() {
        // 1. Si le formulaire est soumis en POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Récupération de l'ID réservation (devrait être passé en session ou URL)
            $id_reservation = $_GET['res_id'] ?? 0; 
            
            // Préparation des données pour le modèle
            $data = [
                'id_reservation' => $id_reservation,
                'moyen_paiement' => 'Carte Bancaire',
                'montant'        => 50.00, // À récupérer dynamiquement selon le trajet
                'statut'         => 'complete',
                'devise'         => 'MAD',
                'transaction_id' => 'TX-' . time() . '-' . rand(100, 999),
                'date_paiement'  => date('Y-m-d H:i:s')
            ];

            // 2. Appel au Modèle pour insertion en BDD
            try {
                $insertId = Paiements::creer($data);
                
                if ($insertId) {
                    // Redirection ou message de succès
                    echo "Succès ! Le paiement n°$insertId a été enregistré.";
                    // header('Location: index.php?page=success');
                    exit;
                }
            } catch (Exception $e) {
                $error = "Erreur lors du paiement : " . $e->getMessage();
            }
        }

        // 3. Charger la vue
        require_once 'Vue/v_paiement.php';
    }
}
?>