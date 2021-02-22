<?php
require_once("./model/session.php");

if(isset($_SESSION['user'])){
    $currentPage="member";
    require_once("./view/template.php");
}
else{
    header('location:./connect.php');
}