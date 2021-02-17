<?php
require_once('./model/user.class.php');
$user = new User();
$user->getUserFromDb($_GET['user']);
var_dump($user);