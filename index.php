<?php 
session_start();

include("Controllers/controller.php");

$action = !empty($_GET["action"]) ? $_GET["action"] : "actionIndex";
$action();

?>