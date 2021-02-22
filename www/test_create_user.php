<?php
require_once("./model/user.class.php");

$newUser=User::create("Jojo", "jojo@jojo.jojo","zozo","2020-02-18");
$newUser->save();

header("location:./test_recup_user.php?id=".$newUser->id_user);