<?php
require_once("./model/follow.class.php");

$newFollow=Follow::create(1 , 1);
$newFollow->save();

header("location:./test_recup_follow.php?follow=".$newFollow->id_follow);