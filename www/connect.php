<?php
session_start();
if(isset($_SESSION['user'])){
    header('location:./');
    exit();
}
$currentPage="connect";
require_once("./view/template.php");