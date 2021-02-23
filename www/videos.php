<?php
require_once("./model/upload.class.php");

$videos=Upload::getNewestVideos();

$currentPage="videos";
require_once("view/template.php");