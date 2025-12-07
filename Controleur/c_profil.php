<?php
require_once __DIR__ . '/../modele/utilisateur.php';

class c_profil {

    public function afficher() {
        $user = Utilisateur::get($_SESSION['user_id']);

        include __DIR__ . '/../vue/header.php';
        include __DIR__ . '/../vue/pages/profil.php';
        include __DIR__ . '/../vue/footer.php';
    }
}
