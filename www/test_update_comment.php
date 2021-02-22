<?php
require_once("./model/comment.class.php");

$comment= Comment::loadById($_GET['id']);
$comment->comment_content="la vie est belle";
$comment->save();

header("location:./test_recup_comment.php?comment=1");