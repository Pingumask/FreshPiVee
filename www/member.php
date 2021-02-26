<?php
require_once("./model/follow.class.php");
require_once("./model/session.php");

if(isset($_GET['id'])){
    $member=User::loadById($_GET['id']);
}
else if(isset($_SESSION['user'])){
    $member=$_SESSION['user'];
    
}

if(isset($member)){
    $followed=false;
    if(isset($_SESSION['user'])){
        $followed=(Follow::getPrecise($_SESSION['user']->id_user,$member->id_user) instanceof Follow);     
    } 

    $currentPage="member";
    require_once("./view/template.php");
}
else{
    header('location:./connect.php');
}