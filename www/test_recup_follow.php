<?php
require_once('./model/follow.class.php');
$follow = new Follow();
$follow->getFollowFromDb($_GET['follow']);
$follow->getFollower();
$follow->getFollowed();
var_dump($follow);