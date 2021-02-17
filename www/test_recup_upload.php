<?php
require_once('./model/upload.class.php');

$upload = Upload::loadById($_GET['upload']);
$upload->getUploader();
var_dump($upload);