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

        $user = Utilisateur::connexion(
            trim($_POST['email']),
            $_POST['mot_de_passe']
        );

        if (!$user) {
            header("Location: index.php?page=connexion&error=invalid");
            exit;
        }

        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_email'] = $user['email'];

        header("Location: index.php?page=accueil");
        exit;
    }

    public function deconnexion(): void {
        session_destroy();
        header("Location: index.php?page=accueil");
        exit;
    }
}

class c_mdp_oblie {
    public function afficher(): void {
        $title = "Mot de passe oublié";
        $css = "mdp_oblie.css";
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_mdp_oblie.php';
        require __DIR__ . '/../Vue/footer.php';
    }
}
?>