<?php
require_once("./model/session.php");
if(isset($_SESSION['dark'])){
    unset($_SESSION['dark']);
}
else{
    $_SESSION['dark']=true;
}

var_dump($_SESSION);
?>
