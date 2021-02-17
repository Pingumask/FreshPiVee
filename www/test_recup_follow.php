<?php
require_once('./model/follow.class.php');
$follow = Follow::loadById($_GET['follow']);
$follow->getFollower();
$follow->getFollowed();
var_dump($follow);