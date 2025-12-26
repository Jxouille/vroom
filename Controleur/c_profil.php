<?php
require_once __DIR__ . '/../Modele/utilisateur.php';
require_once __DIR__ . '/../Modele/vehicules.php';
require_once __DIR__ . '/../Modele/messages.php';
require_once __DIR__ . '/../Modele/conversations.php';
require_once __DIR__ . '/../Modele/favoris.php';
require_once __DIR__ . '/../Modele/paiements.php';
require_once __DIR__ . '/../Modele/reservations.php';

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


class c_favoris {

    public function ajouter(): void {
        if (!isset($_SESSION['user_id'], $_GET['id_annonce']) || !ctype_digit($_GET['id_annonce'])) {
            header("Location: index.php?page=accueil");
            exit;
        }

        Favoris::ajouter((int)$_SESSION['user_id'], (int)$_GET['id_annonce']);
        header("Location: index.php?page=annonce&id=" . (int)$_GET['id_annonce']);
        exit;
    }

    public function supprimer(): void {
        if (!isset($_SESSION['user_id'], $_GET['id_annonce']) || !ctype_digit($_GET['id_annonce'])) {
            header("Location: index.php?page=accueil");
            exit;
        }

        Favoris::supprimer((int)$_SESSION['user_id'], (int)$_GET['id_annonce']);
        header("Location: index.php?page=annonce&id=" . (int)$_GET['id_annonce']);
        exit;
    }

    public function liste(): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $favoris = Favoris::liste((int)$_SESSION['user_id']);

        $title = "Mes favoris";
        $css = "favoris.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/favoris.php';
        require __DIR__ . '/../Vue/footer.php';
    }
}



class c_paiement {

    public function afficher(int $id_reservation): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $reservation = Reservations::get($id_reservation);
        if (!$reservation) {
            header("Location: index.php?page=mes_reservations");
            exit;
        }

        $title = "Paiement";
        $css = "paiement.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_paiement.php';
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
class c_mes_trajets {
    public function afficher(int $id): void {
        #if (!$resa) {
        #    header("Location: index.php?page=accueil");
        #    exit;
        #}
        $title = "Mes trajets";
        $css = "mes_trajets.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_mes_trajets.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function creer(array $data): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $data['id_passager'] = (int)$_SESSION['user_id'];
        Reservations::creer($data);

        header("Location: index.php?page=mes_reservations");
        exit;
    }
}
class c_reservation {
    public function afficher(?string $id): void {
        // Sécurité : vérifier l'ID
        if ($id === null || !ctype_digit($id)) {
            header("Location: index.php?page=accueil");
            exit;
        }

        $reservation = Reservations::get((int) $id);

        if (!$reservation) {
            header("Location: index.php?page=accueil");
            exit;
        }

        // Variables pour head.php
        $title = "Détail de la réservation";
        $css   = "detail_reservation.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_detail_reservation.php';
        require __DIR__ . '/../Vue/footer.php';
    }
}

?>