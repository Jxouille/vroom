<?php
require_once __DIR__ . '/../Modele/utilisateur.php';
require_once __DIR__ . '/envoye_mail.php';
require_once __DIR__ . '/../Modele/verification_code.php';
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

        // CAPTCHA
        $reponse_client = (int) $_POST['captcha_reponse'];
        $resultat_attendu = $_SESSION['captcha_secret'] ?? null;

        if ($resultat_attendu === null || $reponse_client !== $resultat_attendu) {
            unset($_SESSION['captcha_secret']);
            header("Location: index.php?page=inscription&error=captcha");
            exit;
        }
        unset($_SESSION['captcha_secret']);

        // Vérifier si email existe déjà
        if (Utilisateur::getByEmail($_POST['email'])) {
            header("Location: index.php?page=inscription&error=exists");
            exit;
        }
        // Sinon
        // Stockage temporaire
        $_SESSION['tmp_user'] = [
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'mdp' => password_hash($_POST['mdp'], PASSWORD_DEFAULT)
        ];

        // Génération du code
        $code = Authentification_code::generer($_POST['email']);

        // Envoi email
        sendEmail($_POST['email'], $_POST['prenom'],"auth_code", $code);

        // Page de validation du code
        header("Location: index.php?page=verifier_code");
        exit;
    }
}
class c_verifier_code {

    public function afficher(): void {
        require __DIR__ . '/../Vue/pages/v_verifier_code.php';
    }

    public function verifier(): void {
        if (!isset($_POST['code'], $_SESSION['tmp_user'])) {
            header("Location: index.php?page=inscription");
            exit;
        }

        $email = $_SESSION['tmp_user']['email'];
        $code = $_POST['code'];

        // Vérification du code
        if (!Authentification_code::verifier($email, $code)) {
            header("Location: index.php?page=verifier_code&error=invalid");
            exit;
        }
        else {
            //  Création définitive du compte
            Utilisateur::creer([
                'nom' => $_SESSION['tmp_user']['nom'],
                'prenom' => $_SESSION['tmp_user']['prenom'],
                'email' => $email,
                'mot_de_passe' => $_SESSION['tmp_user']['mdp']
            ]);
            unset($_SESSION['tmp_user']);
            header("Location: index.php?page=connexion&success=verified");
            exit;
        }
    }
    public function renvoyer(): void {
        if (!isset($_SESSION['tmp_user'])) {
            header("Location: index.php?page=inscription");
            exit;
        }

        $email = $_SESSION['tmp_user']['email'];
        $prenom = $_SESSION['tmp_user']['prenom'];

        // Générer un nouveau code
        $code = Authentification_code::generer($email);
        $sujet = "Nouveau code de vérification Vroom";
        $contenu = "<p>Bonjour $prenom,</p>
                     <p>Voici votre <strong>nouveau code</strong> :</p>
                     <h2>$code</h2>
                     <p>⏱️ Valide 2 minutes</p>";
        // Renvoyer l’email
        sendEmail($email, $prenom,"auth_code_again", $code);
        header("Location: index.php?page=verifier_code&resent=1");
        exit;
    }
}

