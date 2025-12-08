<?php
require_once __DIR__ . '/../modele/utilisateur.php';

class c_inscription {

    public function afficher() {
        include __DIR__ . '/../vue/header.php';
        include __DIR__ . '/../vue/pages/inscription.php';
        include __DIR__ . '/../vue/footer.php';
    }

    public function enregistrer() {
        if (!isset($_POST['nom'], $_POST['telephone'], $_POST['mot_de_passe'])) {
            header("Location: index.php?page=inscription&error=missing");
            exit;
        }

        $result = Utilisateur::inscrire($_POST);

        if (!$result) {
            header("Location: index.php?page=inscription&error=exist");
            exit;
        }

        header("Location: index.php?page=connexion&success=1");
    }
}
