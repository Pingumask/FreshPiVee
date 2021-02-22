<?php
require_once("./model/session.php");
if(isset($_SESSION['user'])){
    header('location:./');
    exit();
}
$currentPage="connect";
require_once("./view/template.php");