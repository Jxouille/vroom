<?php
session_start();

/**git
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
        require 'Controleur/c_trajet.php';
        $controller = new c_recherche_trajet();
        $controller->afficher();
        break;

    case 'publie_trajet':
        require 'Controleur/c_trajet.php';
        $controller = new c_publie_trajet();
        if ($action === 'publier') {
            $controller->publier();
        } else {
            $controller->afficher();
        }
        break;
    case 'detail_trajet':
        require 'Controleur/c_trajet.php';
        $controller = new c_detail_trajet();
        $controller->afficher();
        break;

    case 'mes_annonces':
        require 'Controleur/c_profil.php';
        $controller = new c_mes_annonces();
        $controller->afficher();
        break;

    case 'mes_documents':
        require 'Controleur/c_profil.php';
        $controller = new c_mes_documents();
        if(isset($_GET['action']) && $_GET['action'] === 'supprimer_tous'){
            $controller->supprimerTous();
        } elseif ($action === 'envoyer') {
            $controller->envoyer();
        } else {
            $controller->afficher();
        }
        break;
    case 'mes_paiements':
        require 'Controleur/c_profil.php';
        $controller = new c_mes_paiements();
        $controller->afficher();
        break;
        
    // Connexion
    case 'connexion':
        require 'Controleur/c_connexion.php';
        $controller = new c_connexion();
        if ($action === 'verifier') {
            $controller->verifier();
        } 
        elseif ($action === 'deconnexion') {
            $controller->deconnexion();
            break;
        } else {
            $controller->afficher();
        }
        break;

    // Inscription
    case 'inscription':
        require 'Controleur/c_inscription.php';
        $controller = new c_inscription();
        if ($action === 'enregistrer') {
            $controller->enregistrer();
        } else {
            $controller->afficher();
        }
        break;

    case 'verifier_code':
        require 'Controleur/c_inscription.php';
        $controller = new c_verifier_code();
        if ($action === 'verifier') {
            $controller->verifier();
        } 
        elseif ($action == 'renvoyer'){
            $controller->renvoyer();
        }
        else {
            $controller->afficher();
        }
        break;

    // Profil
    case 'profil':
        require 'Controleur/c_profil.php';
        $controller = new c_profil();

        if ($action === 'modifier') {
            $controller->modifier();
        } else {
            $id = isset($_GET['id']) && ctype_digit($_GET['id']) ? (int)$_GET['id'] : null;
            $controller->afficher($id);
        }
        break;

    // Messages
    case 'messages':
        require 'Controleur/c_profil.php';
        $controller = new c_messages();
        if ($action === 'envoyer') {
            $controller->envoyer();
        } else {
            $id_conversation = $_GET['id_conversation'] ?? null;
            $controller->liste($id_conversation);
        }
        break;

    // Annonces
    case 'admin':
        require 'Controleur/c_admin.php';
        $controller = new c_admin();
        $controller->afficher();
        break;
    case 'annonce':
        require 'Controleur/c_trajet.php';
        $controller = new c_publie_trajet();
        if ($action === 'publier') {
            $controller->publier();
        } else {
            $controller->afficher();
        }
        break;

    // Favoris
    case 'favoris':
        require 'Controleur/c_profil.php';
        $controller = new c_mes_favoris();
        if ($action === 'ajouter') {
            $controller->ajouter();
        } elseif ($action === 'supprimer') {
            $controller->supprimer();
        } else {
            $controller->afficher();
        }
        break;

    case 'mes_reservations':
        require 'Controleur/c_profil.php';
        $controller = new c_mes_reservations();
        $controller->afficher();
        break;


    // Paiements
    case 'paiement':
        require 'Controleur/c_paiement.php';
        $controller = new c_paiement();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->payer();
            $controller->paiemnetsucces();
            exit;
        } else {
            $controller->afficher();
        }
        break;
    case 'success':
        require 'Controleur/c_paiement.php';
        $controller = new c_paiement();
        $controller->paiemnetsucces();
        break;
    case 'detail_paiement':
        require 'Controleur/c_paiement.php';
        $controller = new c_detail_paiement();
        $controller->detail_paiement();
        break;
}
?>