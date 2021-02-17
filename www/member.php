<?php
require_once('./model/user.class.php');

$currentPage="member";

$member = User::loadById(1);

require_once("./view/template.php");