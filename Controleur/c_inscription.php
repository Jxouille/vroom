<?php
#require_once __DIR__ . '/../Modele/utilisateur.php';

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
        if (!isset($_POST['nom'], $_POST['telephone'], $_POST['mot_de_passe'])) {
            header("Location: index.php?page=inscription&error=missing");
            exit;
        }

        $success = Utilisateur::creer([
            'nom' => $_POST['nom'],
            'telephone' => $_POST['telephone'],
            'mot_de_passe' => $_POST['mot_de_passe']
        ]);

        if (!$success) {
            header("Location: index.php?page=inscription&error=exists");
            exit;
        }

        header("Location: index.php?page=connexion&success=registered");
        exit;
    }
}
?>