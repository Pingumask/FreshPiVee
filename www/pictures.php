<?php
require_once("./model/upload.class.php");

$pictures=Upload::getNewestPictures();

$currentPage="pictures";
require_once("view/template.php");