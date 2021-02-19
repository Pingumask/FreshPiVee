<?php
require_once("./model/follow.class.php");

$newFollow= new Follow();
$newFollow->init(null, 1 , 1);
$newFollow->save();

header("location:./test_recup_follow.php?follow=");