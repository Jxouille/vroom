<?php
class c_accueil {

    public function afficher(): void {
        include __DIR__ . '/../vue/header.php';
        include __DIR__ . '/../vue/pages/v_accueil.php';
        include __DIR__ . '/../vue/footer.php';
    }
}
