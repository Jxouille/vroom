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
        $title = "Vérification du code";
        $css = "v_code.css";
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

class c_connexion {

    public function afficher(): void {
        $title = "Connexion";
        $css = "connexion.css";
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_connexion.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function verifier(): void {
    if (!isset($_POST['email'], $_POST['mot_de_passe'])) {
        header("Location: index.php?page=connexion&error=missing");
        exit;
    }

    $login = trim($_POST['email']); // email ou téléphone
    $mot_de_passe = $_POST['mot_de_passe'];

    // Récupérer l'utilisateur par email ou téléphone
    $user = Utilisateur::getByEmail($login);

    if (!$user) {
        header("Location: index.php?page=connexion&error=invalid");
        exit;
    }

    // Vérifier le mot de passe
    if (!password_verify($mot_de_passe, $user['mot_de_passe'])) {
        header("Location: index.php?page=connexion&error=invalid");
        exit;
    }
    $_SESSION['user_id'] = $user['id'];
    // Connexion réussie
    if (Utilisateur::isAdmin($user['id'])){
        header("Location: index.php?page=admin");
        exit;
    }else{
        header("Location: index.php?page=accueil");
        exit;
    }
}
    public function deconnexion(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION = [];     // clear session data
    session_destroy(); // destroy session

    header("Location: index.php?page=accueil");
    exit;
    }
}

class c_mdp_oblie {
    public function afficher(): void {
        $title = "Mot de passe oublié | VROOM";
        $css = "mdp_oblie.css";
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_mdp_oblie.php';
        require __DIR__ . '/../Vue/footer.php';
    }
    // Si l'Email n'et pas enregistrer dans la base des donnés
    public function envoyerLienReset(): void {
    if (!isset($_POST['email'])) {
        header("Location: index.php?page=mdp_oublie&error=missing");
        exit;
    }

    $email = $_POST['email'];
    $user = Utilisateur::getByEmail($email);

    if (!$user) {
        header("Location: index.php?page=mdp_oublie&error=invalid");
        // utilisateur introuvable ! veiller contacter administrateur
        exit;
    }
    // Sinon 
    $token = bin2hex(random_bytes(16));
    Utilisateur::updateField($user['id'], 'remember_token', $token);
    $resetLink = "https://yourdomain.com/index.php?page=reset_password&token=$token";

    sendEmail($email, $user['prenom'], "mdp_oblie_link", $resetLink);
    header("Location: index.php?page=mdp_oublie&success=sent");
    // if sent "Votre lien de reitialtion mdp a etet envoye dans votre boite mail !
    // page retialiser le mote de passe 
    exit;
    }
    
}
?>