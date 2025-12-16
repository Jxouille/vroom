<?php
require_once __DIR__ . '/../Modele/utilisateur.php';
require_once __DIR__ . '/../Modele/vehicules.php';

class c_profil {

    public function afficher(int $id_utilisateur = null): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $id = $id_utilisateur ?? $_SESSION['user_id'];
        $utilisateur = Utilisateur::get($id);
        $vehicules = Vehicules::getByUtilisateur($id);

        $title = "Profil";
        $css = "profil.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_profil.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function modifier(): void {
        if (!isset($_SESSION['user_id'], $_POST['nom'], $_POST['telephone'])) {
            header("Location: index.php?page=profil&error=missing");
            exit;
        }

        Utilisateur::update($_SESSION['user_id'], [
            'nom' => $_POST['nom'],
            'telephone' => $_POST['telephone'],
            'biographie' => $_POST['biographie'] ?? null
        ]);

        header("Location: index.php?page=profil&success=updated");
        exit;
    }
}
?>