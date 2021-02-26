<?php
require_once("./model/upload.class.php");
require_once("./model/session.php");// on va avoir besoin pour ouvrir la session

//Pour faire afficher un User parmi nos contacts, on va vérifier s'il est connecté

if (!isset($_SESSION["user"])){
    header("location:./connect.php");
    exit();
}

$medias = $_SESSION['user']->getUploadsFromFollowed();

$currentPage="contacts";
require_once("view/template.php");