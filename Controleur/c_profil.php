<?php
require_once __DIR__ . '/../Modele/utilisateur.php';
require_once __DIR__ . '/../Modele/vehicules.php';
require_once __DIR__ . '/../Modele/messages.php';
require_once __DIR__ . '/../Modele/conversations.php';
require_once __DIR__ . '/../Modele/favoris.php';
require_once __DIR__ . '/../Modele/paiements.php';
require_once __DIR__ . '/../Modele/reservations.php';
require_once __DIR__ . '/../Modele/annonces.php';

class c_profil {

    // Affichage du profil
    public function afficher(?int $id_utilisateur = null) {
        $id_utilisateur = $id_utilisateur ?? $_SESSION['user_id'];
        $utilisateur = Utilisateur::getById($id_utilisateur);
        $vehicules = Vehicules::getByUser($id_utilisateur);

        $title = "Profile de " . htmlspecialchars($utilisateur['prenom'] . ' ' . $utilisateur['nom']);
        $css = "profil.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_profil.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    // Modification d'un champ
    public function modifier() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            echo 'Non autorisé';
            exit;
        }

        $id_utilisateur = $_SESSION['user_id'];

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

class c_messages {

    public function liste(?int $id_conversation = null): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        if ($id_conversation) {
            $messages = Messages::getByConversation($id_conversation);
        } else {
            $messages = Messages::allForUser($_SESSION['user_id']);
        }

        $title = "Messages";
        $css = "messages.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_messages.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function envoyer(): void {
        if (!isset($_SESSION['user_id'], $_POST['id_destinataire'], $_POST['contenu'])) {
            header("Location: index.php?page=messages&error=missing");
            exit;
        }

        Messages::envoyer($_SESSION['user_id'], $_POST['id_destinataire'], $_POST['contenu']);
        header("Location: index.php?page=messages&id_conversation=" . $_POST['id_conversation']);
        exit;
    }
}
class c_mes_documents {

    public function afficher(): void {
        $title = "Mes documents";
        $css = "mes_documents.css";

        #$annonces = Annonces::all();

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_mes_documents.php';
        require __DIR__ . '/../Vue/footer.php';
    }
}


class c_mes_favoris {
    public function afficher(): void {
        $title = "Mes favoris";
        $css = "favoris.css";

        $favoris = Favoris::liste((int)$_SESSION['user_id']);

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_favoris.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function ajouter(): void {
        if (!isset($_SESSION['user_id']) ){
            header("Location: index.php?page=connexion");
            exit;
        }
        Favoris::ajouter((int)$_SESSION['user_id'], (int)$_GET['id_annonce']);
        exit;
    }
    public function supprimer(): void {
        if (!isset($_SESSION['user_id'], $_GET['id_annonce']) || !ctype_digit($_GET['id_annonce'])) {
            header("Location: index.php?page=accueil");
            exit;
        }
        Favoris::supprimer((int)$_SESSION['user_id'], (int)$_GET['id_annonce']);
        exit;
    }
}
class c_mes_paiement {
    public function afficher(int $id_reservation): void {

        $paiements = Paiements::mes_paiement((int)$_SESSION['user_id']);

        $title = "Mes Paiements";
        $css = "paiement.css"; /// page à faire

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_paiement.php';
        require __DIR__ . '/../Vue/footer.php';
    }
    
    public function details_paiement(int $id_paiement): void {
        $paiement = Paiements::get($id_paiement);

        $title = "Détails du paiement";
        $css = "detail_paiement.css"; /// page à faire

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_detail_paiement.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function payer(): void {
        if (!isset($_SESSION['user_id'], $_POST['id_reservation'], $_POST['moyen_paiement'], $_POST['montant'])) {
            header("Location: index.php?page=paiement&error=missing");
            exit;
        }

        Paiements::creer([
            'id_reservation' => $_POST['id_reservation'],
            'moyen_paiement' => $_POST['moyen_paiement'],
            'montant' => $_POST['montant']
        ]);

        header("Location: index.php?page=mes_reservations&success=paid");
        exit;
    }
}
class c_mes_reservations {

    # il faut peut etre faire les trajet desjat effectue et trajet à venir 

    public function afficher(): void {
    $title = "Mes réservations";
    $css = "mes_reservations.css";

    $id_client = $_SESSION['user_id'];
    $trajets_avenir = Reservations::trajets_a_venir($id_client);
    $trajets_effectues = Reservations::trajets_effectue($id_client);

    require __DIR__ . '/../Vue/head.php';
    require __DIR__ . '/../Vue/header.php';
    require __DIR__ . '/../Vue/pages/v_mes_reservations.php';
    require __DIR__ . '/../Vue/footer.php';
}

    
}

class c_mes_annonces {
    public function afficher(): void {

        $title = "Mes annonces";
        $css = "mes_annonces.css"; 
        $annonces = Annonces::get_annonces_conducteur($_SESSION['user_id']);

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_mes_trajets.php';
        require __DIR__ . '/../Vue/footer.php';

    }

}
        

?>