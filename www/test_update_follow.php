<?php
require_once('./model/follow.class.php');

$follow = Follow::loadById($_GET['id']);
$follow->id_follower=3;
$follow->save();

header("location:./test_recup_follow.php?follow=3");