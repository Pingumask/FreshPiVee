<?php
require_once("./model/upload.class.php");

$newUpload= new Upload();
$newUpload=Upload::create(1, "2021-02-18 10:29:52", "Hello", "azerty", "hello.mp4", "video");
var_dump($newUpload);
$newUpload->save();

header("location:./test_recup_upload.php?upload=".$newupload->id_upload);