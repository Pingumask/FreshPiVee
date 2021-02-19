<?php
require_once("./model/comment.class.php");

$newComment= new Comment();
$newComment->init(null,1, 1,"2021-02-18 10:33:31","Nice picture");
$newComment->save();

header("location:./test_recup_comment.php?comment=1");