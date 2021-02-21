<?php
require_once("./model/evaluation.class.php");

$newEvaluation=Evaluation::create(null, 1 , 1 , "favorite" , "2020-02-19 09:15:30");
$newEvaluation->save();

header("location:./test_recup_evaluation.php?evaluation=".$newEvaluation->id_evaluation);