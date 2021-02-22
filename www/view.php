<?php
require_once('./model/user.class.php');
require_once('./model/upload.class.php');
require_once('./model/comment.class.php');
require_once('./model/evaluation.class.php');
require_once('./model/follow.class.php');
require_once("./model/session.php");

$media = Upload::loadById($_GET['id']);

switch($media->media_type){
    case "video":
        $currentPage="video";
        break;
    case "picture":
        $currentPage="picture";
        break;
    default:
        $currentPage="noMedia";
}
require_once('./view/template.php');