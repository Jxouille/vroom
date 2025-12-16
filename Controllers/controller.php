<?php

require_once("models/userModel.php");

function actionIndex(){
	require("Views/vAccueil.php");
}


function actionInscriptionPage(){
    require "Views/vInscription.php";
}
function actionInscriptionTraitement(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $photoProfil = null; // a gerer si on accepte l'upload

        $result = inscrireUtilisateur($nom, $prenom, $email, $mdp, "Utilisateur", $photoProfil);

        if ($result['success']) {
            header("Location: index.php?action=actionConnexionPage");
            exit();
        } else {
            $_GET['erreur'] = $result['message'];
            require("Views/vInscription.php");
        }
    }
}

function actionConnexionPage(){
    require("Views/vConnexion.php");
}

function actionConnexionTraitement(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        $result = connecterUtilisateur($email, $mdp);

        if ($result['success']) {
            header("Location: index.php"); 
            exit();
        } else {
            $_GET['erreur'] = $result['message'];
            require("Views/vConnexion.php");
        }
    }
}

function actionDeconnexion() {
    session_unset();    
    session_destroy();  
    header('Location: index.php?action=actionConnexionPage');
}

function actionChercherTrajets(){
	require("Views/vTrajets.php");

}

?>