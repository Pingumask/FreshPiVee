<?php
require_once('./model/user.class.php');
$user = User::loadById(1);
var_dump($user);