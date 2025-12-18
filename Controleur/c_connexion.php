<?php
#require_once __DIR__ . '/../Model/utilisateur.php';

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
        if (!isset($_POST['telephone'], $_POST['mot_de_passe'])) {
            header("Location: index.php?page=connexion&error=missing");
            exit;
        }

        $user = Utilisateur::connexion($_POST['telephone'], $_POST['mot_de_passe']);

        if (!$user) {
            header("Location: index.php?page=connexion&error=invalid");
            exit;
        }

        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php?page=accueil");
        exit;
    }

    public function deconnexion(): void {
        session_destroy();
        header("Location: index.php?page=connexion");
        exit;
    }
}
?>