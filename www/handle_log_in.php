<?php
session_start();

//Récupérer les informations du formulaire connect.php
if(isset($_POST['email'])) // 1;DROP DATABASE;--
if(isset($_POST['password']))

//On vérifie si ça correspond à un utilisateur de notre base de données
$foundUser = User::loadByEmailAndPassword($_POST['email'], $_POST['password']);

if($founduser!=new User()){
    $_SESSION['user'] = $foundUser;
    header("location:./");
    exit();
}
else{
    header("location:./connect.php");
}