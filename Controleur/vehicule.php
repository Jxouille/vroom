<?php
require_once __DIR__ . '/../Model/vehicules.php';


class c_vehicule {

    public function afficher(int $id): void {
        $vehicule = Vehicules::get($id);
        if (!$vehicule) {
            header("Location: index.php?page=mes_vehicules");
            exit;
        }

        $photos = PhotosVehicule::getAll($id);

        $title = "Véhicule";
        $css = "vehicule.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/vehicule.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function ajouter(array $data): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        $data['id_utilisateur'] = (int)$_SESSION['user_id'];
        Vehicules::creer($data);

        header("Location: index.php?page=mes_vehicules");
        exit;
    }

    public function supprimer(int $id): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        Vehicules::delete($id);
        header("Location: index.php?page=mes_vehicules");
        exit;
    }
}
?>