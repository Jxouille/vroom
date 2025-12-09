<?php
require("Models/benj.php");

function actionIndex(){
	require("Views/vAccueil.php");
}

function actionConnexion(){
	require("Views/vConnexion.php");
}

function actionInscription(){
	require("Views/vInscription.php");
}

function actionChercherTrajets(){
	require("Views/vTrajets.php");

}

function actionBen(){
	$nom = monNom();
	require("Views/benj.php");
}

?>