<?php
require_once('./model/evaluation.class.php');

$eval = Evaluation::loadById(1);
$eval->evaluation_type="like";
$eval->save();

header("location:./test_recup_evaluation.php?evaluation=1");