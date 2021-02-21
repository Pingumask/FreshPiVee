<?php
require_once("./model/comment.class.php");


$newComment=Comment::create(1, 1,"Nice picture");
$newComment->save();

header("location:./test_recup_comment.php?comment=".$newComment->id_comment);