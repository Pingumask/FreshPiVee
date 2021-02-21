<?php
require_once('./model/user.class.php');
$user = User::loadById($_GET['user']);
var_dump($user);