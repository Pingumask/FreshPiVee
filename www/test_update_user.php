<?php
require_once("./model/user.class.php");

$user= User::loadById(5);
$user->setPassword("zozo");
$user->save();

header("location:./test_recup_user.php?user=5");