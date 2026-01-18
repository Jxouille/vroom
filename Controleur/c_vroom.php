<?php
require_once __DIR__ . '/../Modele/contact.php';
require_once __DIR__ . '/../Modele/faq.php';


class c_faq {
    public function afficher(): void {
        $title = "FAQ - Foire aux questions";
        $css = "commun1.css";

        // Chargement de la vue
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_faq.php'; // La vue FAQ
        require __DIR__ . '/../Vue/footer.php';
    }
}

class c_mentions_legales {
    public function afficher(): void {
        $title = "Mentions Légales";
        $css = "commun1.css";

        // Chargement de la vue
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_mentions_legales.php'; // La vue Mentions Légales
        require __DIR__ . '/../Vue/footer.php';
    }
}

class c_rgpd {
    public function afficher(): void {
        $title = "RGPD - Protection des données";
        $css = "commun1.css";

        // Chargement de la vue
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_rgpd.php'; // La vue RGPD
        require __DIR__ . '/../Vue/footer.php';
    }
}
class c_cgu {
    public function afficher(): void {
        $title = "CGU - Conditions Générales d'Utilisation";
        $css = "commun1.css";

        // Chargement de la vue
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_cgu.php'; // La vue CGU
        require __DIR__ . '/../Vue/footer.php';
    }
}
class c_contact {
    public function afficher(): void {
        $title = "Contactez-nous";
        $css = "commun1.css";

        // Chargement de la vue
        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_contact_vroom.php'; // La vue Contact
        require __DIR__ . '/../Vue/footer.php';
    }

    public function envoyer(): void {
        // Logique pour envoyer le message de contact (ex: envoi d'email)
        // Pour l'instant, on redirige simplement vers une page de confirmation
        header("Location: index.php?page=contact&action=envoye");
        exit;
    }
}