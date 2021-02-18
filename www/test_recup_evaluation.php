<?php
require_once('./model/evaluation.class.php');
$evaluation = Evaluation::loadById($_GET['evaluation']);
$evaluation->getUser();
$evaluation->getUpload();
$evaluation->getUpload()->getUploader();
var_dump($evaluation);