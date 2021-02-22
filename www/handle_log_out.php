<?php
require_once("./model/session.php");
session_destroy();
header("location:./");