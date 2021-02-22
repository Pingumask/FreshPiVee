<?php
require_once('./model/comment.class.php');

$comment= Comment::loadById($_GET['id']);
$comment->getUser();
$comment->getUpload();
$comment->getUpload()->getUploader();
var_dump($comment);