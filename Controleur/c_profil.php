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
    public function envoyer_photo_profil(): void {
    if (!isset($_SESSION['user_id'], $_FILES['photo_profil'])) {
        http_response_code(400);
        exit('Données manquantes');
    }

    $photo = $_FILES['photo_profil'];
    $types_autorises = ['image/jpeg', 'image/png'];

    if (!in_array($photo['type'], $types_autorises)) {
        exit('Format non autorisé');
    }

    if ($photo['size'] > 2 * 1024 * 1024) {
        exit('Image trop volumineuse');
    }

    $id_utilisateur = $_SESSION['user_id'];
    $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
    $nom_fichier = "profil_$id_utilisateur.$extension";
    $chemin = "uploads/photos_profils/$nom_fichier";

    move_uploaded_file(
        $photo['tmp_name'],
        __DIR__ . "/../../$chemin"
    );

    Utilisateur::updateField($id_utilisateur, 'photo_profil', $chemin);

    header("Location: index.php?page=profil&success=photo");
    exit;
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

        $id_utilisateur = $_SESSION['user_id'];
        // Get existing documents
        $documents = Documents::getByUser($id_utilisateur); 

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_mes_documents.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function envoyer(): void {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            exit('Non autorisé');
        }

        $id_utilisateur = (int)$_SESSION['user_id'];

        $mapping_documents = [
            'id_card'              => 'piece_identite',
            'driving_license'      => 'permis_conduire',
            'vehicle_registration' => 'carte_grise',
            'insurance'            => 'assurance',
            'proof_of_address'     => 'justificatif_domicile',
            'profile_photo'        => 'avatar',
        ];

        $types_fichiers_autorises = ['application/pdf', 'image/jpeg', 'image/png'];

        foreach ($mapping_documents as $champ_form => $type_document) {
            if (!isset($_FILES[$champ_form]) || $_FILES[$champ_form]['error'] === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            $fichier = $_FILES[$champ_form];

            if (!in_array($fichier['type'], $types_fichiers_autorises) || $fichier['size'] > 5 * 1024 * 1024) {
                continue;
            }

            // Supprimer ancien document
            $ancien = Documents::getByUserAndType($id_utilisateur, $type_document);
            if ($ancien && file_exists($ancien['chemin_fichier'])) {
                unlink($ancien['chemin_fichier']);
                Documents::supprimer($ancien['id']);
            }

            $dossier = "uploads/documents/user_$id_utilisateur/$type_document/";
            if (!is_dir($dossier)) mkdir($dossier, 0755, true);

            $extension = pathinfo($fichier['name'], PATHINFO_EXTENSION);
            $nom_fichier = uniqid($type_document . '_') . '.' . $extension;
            $chemin = $dossier . $nom_fichier;

            move_uploaded_file($fichier['tmp_name'], $chemin);

            Documents::ajouter(
                $id_utilisateur,
                $type_document,
                $fichier['name'],
                $chemin,
                $fichier['type'],
                $fichier['size']
            );
        }

        // Photo de profil optionnelle
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] !== UPLOAD_ERR_NO_FILE) {
            $photo = $_FILES['profile_photo'];
            $chemin_photo = "uploads/profiles/user_$id_utilisateur/";
            if (!is_dir($chemin_photo)) mkdir($chemin_photo, 0755, true);
            $nom_photo = uniqid('profile_') . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
            move_uploaded_file($photo['tmp_name'], $chemin_photo . $nom_photo);
            Utilisateur::updateField($id_utilisateur, 'photo_profil', $chemin_photo . $nom_photo);
        }

        header("Location: index.php?page=mes_documents&success=ok");
        exit;
    }
    public function supprimerTous(): void {
        $docs = Documents::obtenirDocumentsParUtilisateur($_SESSION['user_id']);
        foreach($docs as $doc){
            // Supprimer le fichier du serveur si nécessaire
            if(file_exists($doc['chemin_fichier'])) unlink($doc['chemin_fichier']);
            Documents::supprimer($doc['id']);
        }
        echo 'OK';
        exit;
}


}




class c_mes_favoris {
    public function afficher(): void {
        $title = "Mes favoris";
        $css = "mes_favoris.css";

        $favoris = Favoris::liste((int)$_SESSION['user_id']);

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_mes_favoris.php';
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
class c_mes_paiements {
    public function afficher(): void {

        $paiements = Paiements::mes_paiement((int)$_SESSION['user_id']);

        $title = "Mes Paiements";
        $css = "mes_paiements.css"; 

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_mes_paiements.php';
        require __DIR__ . '/../Vue/footer.php';
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
        require __DIR__ . '/../Vue/pages/v_mes_annonces.php';
        require __DIR__ . '/../Vue/footer.php';

    }

}

?>