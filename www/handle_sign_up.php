<?php
session_start();
require_once("./model/user.class.php");

if((!isset($_POST['nickname']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['confirmPassword']) || !isset($_POST['birthday']))){
    $_SESSION['errors']=["Wrong data sent."];
    header('location:./connect.php');
    exit();
}

$newUser = new User();
$resultat = $newUser->createValidUser($_POST['nickname'],$_POST['email'],$_POST['password'],$_POST['confirmPassword'],$_POST['birthday']);//On demande au modèle de tenter de créer un nouvel utilisateur, si il réussit, il nous renvoit cet utilisateur, sinon, il nous renvoit un array qui liste les erreurs rencontrées.

if($resultat instanceof User){//si on a reçu un user : ecriture dans la base de données
    $resultat->save();
    $_SESSION['message']="Signed up successfully.";
}
else{//Si on a reçu une liste d'erreurs, on les donne à la session pour pouvoir les afficher sur une autre page.
    $_SESSION['errors']=$resultat;
}
header("location:./connect.php");//à la fin, on renvoit vers la page connect.php