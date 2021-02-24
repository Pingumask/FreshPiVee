<?php
require_once("./model/comment.class.php");
require_once("./model/session.php");
if(!isset($_SESSION['user'])){
    header("location:./connect.php");
    exit();
}

if(!(isset($_POST['id_upload']) && isset($_POST['comment_content']))){
    $_SESSION['error']="Wrong comment format";
    header("location:./");
}

$newComment=Comment::create($_SESSION['user']->id_user,intval($_POST['id_upload']),$_POST['comment_content']);
$newComment->save();
header("location:./view.php?id=".$_POST['id_upload']);