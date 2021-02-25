<?php
require_once("./model/session.php");
require_once("./model/follow.class.php");

if(!isset($_SESSION['user'])){
    header('location:./connect.php');
    exit();
}

if(!isset($_POST['id_upload']) || !isset($_POST['id_followed'])){
    $_SESSION['error']="Missing data";
    header('location:./');
};

$newFollow = Follow::toggle($_SESSION['user']->id_user,intval($_POST['id_followed']));

header("location:./view.php?id=".$_POST['id_upload']);