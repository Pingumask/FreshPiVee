<?php
require_once("./model/user.class.php");

$user= User::loadById($_GET['id']);
$user->setPassword("zozo");
$user->save();

header("location:./test_recup_user.php?user=5");