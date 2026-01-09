<?php
require_once __DIR__ . '/../Modele/utilisateur.php';

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
    $user = Utilisateur::getByEmailOrTelephone($login);

    if (!$user) {
        header("Location: index.php?page=connexion&error=invalid");
        exit;
    }

    // Vérifier le mot de passe
    if (!password_verify($mot_de_passe, $user['mot_de_passe'])) {
        header("Location: index.php?page=connexion&error=invalid");
        exit;
    }

    // Connexion réussie
    $_SESSION['user_id'] = $user['id'];
    header("Location: index.php?page=accueil");
    exit;
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