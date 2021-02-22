<?php
require_once('./model/evaluation.class.php');

$eval = Evaluation::loadById($_GET['id']);
$eval->evaluation_type="like";
$eval->save();

header("location:./test_recup_evaluation.php?evaluation=1");