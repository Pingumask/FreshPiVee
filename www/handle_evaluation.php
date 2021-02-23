<?php
require_once("./model/session.php");
require_once("./model/evaluation.class.php");

if(!isset($_SESSION['user'])){
    header("location:./connect.php");
    exit();
}

switch($_POST['type']){
    case "👍":
        $type="like";
        break;
    case "👎":
        $type="dislike";
        break;
    case "🎀":
        $type="favorite";
        break;
    default:
        $_SESSION['error']="Unexpected error";
        header("location:./");
        exit();
}

$newEvaluation = Evaluation::toggleEvaluation($_SESSION['user']->id_user,intval($_POST['upload_id']),$type);
header("location:./view.php?id=".$_POST['upload_id']);