<?php
require_once("./model/upload.class.php");

$newUpload= new Upload();
$newUpload=Upload::create(1, "Hello", "azerty", "hello.mp4", "video");
var_dump($newUpload);
$newUpload->save();

header("location:./test_recup_upload.php?id=".$newUpload->id_upload);