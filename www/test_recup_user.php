<?php
require_once('./model/user.class.php');
$user = User::loadById($_GET['id']);
var_dump($user);