<?php
require_once('./model/user.class.php');

$currentPage="member";

$member = new User();
$member->getUserFromDb(1);

require_once("./view/template.php");