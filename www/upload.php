<?php
require_once("./model/user.class.php");
require_once("./model/session.php");

//Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion

if(!isset($_SESSION['user'])){
    header("location:./connect.php");
    exit();
}

//Sinon, on affiche le formulaire d'upload
$currentPage="upload";
require_once("view/template.php");