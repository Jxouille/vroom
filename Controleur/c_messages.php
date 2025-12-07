<?php
require_once __DIR__ . '/../modele/messages.php';

class c_messages {

    public function afficher() {
        $messages = Messages::obtenirConversation($_GET['id']);

        include __DIR__ . '/../vue/header.php';
        include __DIR__ . '/../vue/pages/messages.php';
        include __DIR__ . '/../vue/footer.php';
    }

    public function envoyer() {
        Messages::envoyer($_POST);

        header("Location: index.php?page=messages&id=" . $_POST['id_conversation']);
    }
}
