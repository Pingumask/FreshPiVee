<?php
require_once('./model/user.class.php');
$user = User::loadById(2);
var_dump($user);