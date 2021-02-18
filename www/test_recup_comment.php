<?php
require_once('./model/comment.class.php');

$comment= Comment::loadById($_GET['comment']);
$comment->getUser();
$comment->getUpload();
$comment->getUpload()->getUploader();
var_dump($comment);