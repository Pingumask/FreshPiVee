<?php
require_once("./model/upload.class.php");
require_once("./model/session.php");

//verifier si le user est connecté 
if(!isset($_SESSION['user'])){
    header("location:./connect.php");
    exit();
}

if(!(isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['upload']))){
    $_SESSION['error']="Missing data";
    header("location:./upload.php");
    exit();
}

switch($_FILES['upload']['type']){
    case "image/png":
    case "image/jpeg":
    case "image/bmp":
    case "image/gif":
    case "image/svg+xml":
    case "image/tiff":
    case "image/webp":
        $media_type="picture";
        break;
    case "video/x-msvideo":
    case "video/mpeg":
    case "video/ogg":
    case "video/webm":
    case "video/3gpp":
    case "video/3gpp2":
        $media_type="video";
        break;
    default:
        $_SESSION['error']="Unsupported file format";
        header("location:./upload.php");
        exit();
}

$upload = Upload::create($_SESSION['user']->id_user,$_POST['title'],$_POST['description'],"",$media_type);
$upload->save();//Crée l'upload dans la bdd pour qu'il ai un id
move_uploaded_file ( $_FILES['upload']['tmp_name'] , "./uploads/".$media_type."s/".$upload->id_upload."-".$_FILES['upload']['name'] ) ;//On détermine le path en fonction de l'id
$upload->path=$upload->id_upload."-".$_FILES['upload']['name'];
$upload->save();//On met à jour l'upload dans la bdd pour qu'il connaisse son path

header("location:./view.php?id=".$upload->id_upload);