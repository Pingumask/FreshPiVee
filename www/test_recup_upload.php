<?php
require_once('./model/upload.class.php');

$upload = Upload::loadById($_GET['id']);
$upload->getUploader();
var_dump($upload);