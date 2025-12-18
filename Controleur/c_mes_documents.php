<?php


class c_mes_documents {

    public function afficher(): void {
        $title = "Mes documents";
        $css = "mes_documents.css";

        #$annonces = Annonces::all();

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_mes_documents.php';
        require __DIR__ . '/../Vue/footer.php';
    }
}
