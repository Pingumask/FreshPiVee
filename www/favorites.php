<?php
require_once("./model/upload.class.php");
require_once("./model/session.php");

if(!isset($_SESSION['user'])){
    header("location:./connect.php");
    exit();
}

$medias = $_SESSION['user']->getFavorites();

$currentPage="favorites";
require_once("view/template.php");