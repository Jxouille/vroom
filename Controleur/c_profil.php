<?php
require_once __DIR__ . '/../Modele/utilisateur.php';
require_once __DIR__ . '/../Modele/vehicules.php';
require_once __DIR__ . '/../Modele/messages.php';
require_once __DIR__ . '/../Modele/conversations.php';
require_once __DIR__ . '/../Model/favoris.php';
require_once __DIR__ . '/../Model/paiements.php';
require_once __DIR__ . '/../Model/reservations.php';

class c_profil {

    public function afficher(int $id_utilisateur = null): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $id = $id_utilisateur ?? $_SESSION['user_id'];
        $utilisateur = Utilisateur::get($id);
        $vehicules = Vehicules::getByUtilisateur($id);

        $title = "Profil";
        $css = "profil.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_profil.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function modifier(): void {
        if (!isset($_SESSION['user_id'], $_POST['nom'], $_POST['telephone'])) {
            header("Location: index.php?page=profil&error=missing");
            exit;
        }

        Utilisateur::update($_SESSION['user_id'], [
            'nom' => $_POST['nom'],
            'telephone' => $_POST['telephone'],
            'biographie' => $_POST['biographie'] ?? null
        ]);

        header("Location: index.php?page=profil&success=updated");
        exit;
    }
}

class c_messages {

    public function liste(int $id_conversation = null): void {
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


?>