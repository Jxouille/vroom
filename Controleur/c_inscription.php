<?php

require_once __DIR__ . '/../Modele/Utilisateur.php';
class c_inscription {

    public function afficher(): void {
        $title = "Inscription";
        $css = "inscription.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_inscription.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function enregistrer(): void {

        if (!isset(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['mdp'],
            $_POST['mdp_confirm'],
            $_POST['captcha_reponse']
        )) {
            header("Location: index.php?page=inscription&error=missing");
            exit;
        }

        if ($_POST['mdp'] !== $_POST['mdp_confirm']) {
            header("Location: index.php?page=inscription&error=password");
            exit;
        }

        $reponse_client = (int) $_POST['captcha_reponse'];
        $resultat_attendu = $_SESSION['captcha_secret'] ?? null;

        if ($resultat_attendu === null || $reponse_client !== $resultat_attendu) {
            unset($_SESSION['captcha_secret']);
            header("Location: index.php?page=inscription&error=captcha");
            exit;
        }

        unset($_SESSION['captcha_secret']);



        $success = Utilisateur::creer([
            'nom'    => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email'  => $_POST['email'],
            'mdp'    => password_hash($_POST['mdp'], PASSWORD_DEFAULT)
        ]);


        if (!$success) {
            header("Location: index.php?page=inscription&error=exists");
            exit;
        }

        header("Location: index.php?page=connexion&success=registered");
        exit;
    }
}
