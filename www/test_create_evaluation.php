<?php
require_once("./model/evaluation.class.php");

$newEvaluation=Evaluation::create(1 , 1 , "favorite");
$newEvaluation->save();

header("location:./test_recup_evaluation.php?id=".$newEvaluation->id_evaluation);