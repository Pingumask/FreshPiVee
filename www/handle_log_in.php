<?php
require_once("./model/session.php");

//Récupérer les informations du formulaire connect.php
//TODO Vérifier que le formulaire est complet

//On vérifie si ça correspond à un utilisateur de notre base de données
$foundUser = User::loadByEmailAndPassword($_POST['email'], $_POST['password']);

if($foundUser!=new User()){
    $_SESSION['user'] = $foundUser;
    header("location:./");
    exit();
}
else{
    $_SESSION['error']="Wrong mail or password";
    header("location:./connect.php");
}