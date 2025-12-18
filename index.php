
<?php
session_start();

/**
 * Page par défaut
 */
$page = $_GET['page'] ?? 'accueil';
$action = $_GET['action'] ?? null;

/**
 * Router MVC
 */
switch ($page) {

    // Accueil
    case 'accueil':
        require 'Controleur/c_accueil.php';
        $controller = new c_accueil();
        $controller->afficher();
        break;

    case 'recherche_trajet':
        require 'Controleur/c_recherche_trajet.php';
        $controller = new c_recherche_trajet();
        $controller->afficher();
        break;

    case 'publie_trajet':
        require 'Controleur/c_publie_trajet.php';
        $controller = new c_publie_trajet();
        if ($action === 'publier') {
            $controller->publier();
        } else {
            $controller->afficher();
        }
        break;
    case 'detail_trajet':
        require 'Controleur/c_detail_trajet.php';
        $controller = new c_detail_trajet();
        $controller->afficher();
        break;

    case 'reservation':
        require 'Controleur/c_reservation.php';
        $controller = new c_reservation();
        $id = $_GET['id'] ?? null;
        $controller->afficher($id);
        break;

    case 'mes_documents':
        require 'Controleur/c_mes_documents.php';
        $controller = new c_mes_documents();
        $controller->afficher();
        break;
        
    // Connexion
    case 'connexion':
        require 'Controleur/c_connexion.php';
        $controller = new c_connexion();
        if ($action === 'verifier') {
            $controller->verifier();
        } else {
            $controller->afficher();
        }
        break;

    // Inscription
    case 'inscription':
        require 'Controleur/c_inscription.php';
        $controller = new c_inscription();
        #if ($action === 'enregistrer') {
        #    $controller->enregistrer();
        #} else {
        #    $controller->afficher();
        #}
        $controller->afficher();
        break;

    // Profil
    case 'profil':
        require 'Controleur/c_profil.php';
        $controller = new c_profil();
        #if ($action === 'modifier') {
        #    $controller->modifier();
        #} else {
        #    $id = $_GET['id'] ?? null;
        #    $controller->afficher($id);
        #}
        $controller->afficher();
        break;

    // Messages
    case 'messages':
        require 'Controleur/c_messages.php';
        $controller = new c_messages();
        if ($action === 'envoyer') {
            $controller->envoyer();
        } else {
            $id_conversation = $_GET['id_conversation'] ?? null;
            $controller->liste($id_conversation);
        }
        break;

    // Annonces
    case 'annonce':
        require 'Controleur/c_annonce.php';
        $controller = new c_annonce();
        if ($action === 'publier') {
            $controller->publier();
        } else {
            $controller->afficher();
        }
        break;

    // Favoris
    case 'favoris':
        require 'Controleur/c_favoris.php';
        $controller = new c_favoris();
        if ($action === 'ajouter') {
            $controller->ajouter();
        } elseif ($action === 'supprimer') {
            $controller->supprimer();
        } else {
            $controller->liste();
        }
        break;

    // Paiements
    case 'paiement':
        require 'Controleur/c_paiement.php';
        $controller = new c_paiement();
        if ($action === 'payer') {
            $controller->payer();
        } else {
            $id_reservation = $_GET['id_reservation'] ?? null;
            $controller->afficher($id_reservation);
        }
        break;

    default:
        echo "<h1>404 - Page introuvable</h1>";
        break;
}
?>