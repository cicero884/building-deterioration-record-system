<?php
session_start();
require_once("../models/loginCheck.php");

$model = new ModuleLoginCheck();
// if there is $_SESSION['userId'], go to next page
if( isset($_SESSION['userId']) and ($_SESSION['userId'] != '')) {
    $userId     = $_SESSION['userId'];
    echo $model->islogin( $userId );
}
else {
    echo "false";
}

?>