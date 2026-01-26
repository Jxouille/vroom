<?php
session_start();
require_once __DIR__ . '/Ressources/PHP/date_en_fr.php';


/**git
 * Page par défaut
 */

$_COOKIE['essenciel'] = $_GET['essenciel'] ?? 'true';  /** a verifier /*/
$_COOKIE['avancee'] = $_GET['cookie_avancee'] ?? 'false';  /** a verifier /*/

$page = $_GET['page'] ?? 'accueil';
$admin_page = $_GET['admin_page'] ?? 'utilisateurs';


$action = $_GET['action'] ?? null;
$error = $_GET['error'] ?? null;
$depart = $_GET['ville_depart'] ?? null;
$arrivee = $_GET['ville_arrivee'] ?? null;
$date = $_GET['date_depart'] ?? null;
$id_destinataire = $_GET['id_destinataire'] ?? null;


switch ($page) {

    case 'admin':
        require 'Controleur/c_admin.php';
        $controller = new c_admin();
        if ($action === 'modifier') {
             $controller->modifier();
        } else {
            $controller->afficher();
        }
        break;

    case 'accueil':
        require 'Controleur/c_accueil.php';
        $controller = new c_accueil();
        $controller->afficher();
        break;

    case 'recherche_trajet':
        require 'Controleur/c_trajet.php';
        $controller = new c_recherche_trajet();
        if (!$depart ==null || !$arrivee ==null || !$date ==null) {
            $controller->recherche_trajets();
        } else {
            $controller->afficher();
        }
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

    case 'annonce':
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

    case 'messagerie':
        require 'Controleur/c_profil.php';
        $controller = new c_messagerie();

        if ($action === 'envoyer') {
            $controller->envoyer();
        } else {
            $id_conversation = $_GET['id_conversation'] ?? null;
            $controller->afficher($id_conversation);
        }
        break;

    case 'mes_favoris':
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

    case 'inscription':
        require 'Controleur/c_auth.php';
        $controller = new c_inscription();
        if ($action === 'enregistrer') {
            $controller->enregistrer();
        } else {
            $controller->afficher();
        }
        break;

    case 'verifier_code':
        require 'Controleur/c_auth.php';
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

    case 'connexion':
        require 'Controleur/c_auth.php';
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

        case 'mdp_oblie':
        require 'Controleur/c_auth.php';
        $controller = new c_mdp_oblie();
        if ($action === 'envoyer'){
            $controller->envoyerLienReset();
            exit;
        } else {
            $controller->afficher();  
        }
        break;

    case 'paiement':
        require 'Controleur/c_paiement.php';
        $controller = new c_paiement();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->payer();
            exit;
        }if ($action === 'success'){
            $controller->paiemnetsucces();
            exit;
        } else {
            $controller->afficher();
        }
        break;

    case 'detail_paiement':
        require 'Controleur/c_paiement.php';
        $controller = new c_detail_paiement();
        $controller->detail_paiement();
        break;
    
    case 'mentions_legales':
        require 'Controleur/c_vroom.php';
        $controller = new c_mentions_legales();
        $controller->afficher();
        break;

    case 'faq':
        require 'Controleur/c_vroom.php';
        $controller = new c_faq();
        $controller->afficher();
        break;

    case 'contact':
        require 'Controleur/c_vroom.php';
        $controller = new c_contact();
        if ($action === 'envoyer'){
            $controller->envoyer();
        } else {
            $controller->afficher();  
        }
        break;

    case 'rgpd':
        require 'Controleur/c_vroom.php';
        $controller = new c_rgpd();
        $controller->afficher();
        break;

    case 'cgu':
        require 'Controleur/c_vroom.php';
        $controller = new c_cgu();
        $controller->afficher();
        break;
}
?>
