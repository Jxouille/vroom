<?php
require_once __DIR__ . '/../modele/utilisateur.php';

class c_connexion {

    public function afficher() {
        include __DIR__ . '/../vue/header.php';
        include __DIR__ . '/../vue/pages/connexion.php';
        include __DIR__ . '/../vue/footer.php';
    }

    public function verifier() {
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
    }
}
