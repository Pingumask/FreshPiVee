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
if(isset($_SESSION['user'])){$id_user=$_SESSION['user']->id_user;} 
else{$id_user=0;}
$liked=(Evaluation::getPrecise($id_user,$_GET['id'],'like') instanceof Evaluation);
$disliked=(Evaluation::getPrecise($id_user,$_GET['id'],'dislike') instanceof Evaluation);
$favorited=(Evaluation::getPrecise($id_user,$_GET['id'],'favorite') instanceof Evaluation);

require_once('./view/template.php');