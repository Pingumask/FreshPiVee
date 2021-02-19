<?php
require_once("./model/upload.class.php");

$upload= Upload::loadById(1);
$upload->path="toto.png";
$upload->save();

header("location:./test_recup_upload.php?upload=1");