<?php
require_once("./model/upload.class.php");

$medias=Upload::getNewestMedias();

$currentPage="news";
require_once("./view/template.php");