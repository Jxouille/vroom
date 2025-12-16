<?php
require_once __DIR__ . '/../Modele/messages.php';
require_once __DIR__ . '/../Modele/conversations.php';

class c_messages {

    public function liste(int $id_conversation = null): void {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=connexion");
            exit;
        }

        if ($id_conversation) {
            $messages = Messages::getByConversation($id_conversation);
        } else {
            $messages = Messages::allForUser($_SESSION['user_id']);
        }

        $title = "Messages";
        $css = "messages.css";

        require __DIR__ . '/../Vue/head.php';
        require __DIR__ . '/../Vue/header.php';
        require __DIR__ . '/../Vue/pages/v_messages.php';
        require __DIR__ . '/../Vue/footer.php';
    }

    public function envoyer(): void {
        if (!isset($_SESSION['user_id'], $_POST['id_destinataire'], $_POST['contenu'])) {
            header("Location: index.php?page=messages&error=missing");
            exit;
        }

        Messages::envoyer($_SESSION['user_id'], $_POST['id_destinataire'], $_POST['contenu']);
        header("Location: index.php?page=messages&id_conversation=" . $_POST['id_conversation']);
        exit;
    }
}
?>