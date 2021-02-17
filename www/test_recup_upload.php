<?php
require_once('./model/upload.class.php');

$upload = new Upload();
$upload->getUploadFromDb($_GET['upload']);
$upload->id_uploader;
var_dump($upload);
var_dump($upload->getUploader());
echo "<hr/>";
$upload2=new Upload();
var_dump($upload2);
var_dump($upload2->getUploader());