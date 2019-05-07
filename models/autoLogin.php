<?php
session_start();
include("./config.php");

// if there is $_SESSION['userId'], go to next page
if( isset($_SESSION['userId']) and ($_SESSION['userId'] != '')) {
    $userId     = $_SESSION['userId'];
    $sqlSearch  = 'SELECT name FROM user WHERE userId=:userId';
    $search     = $conn->prepare($sqlSearch);
    $search->execute([':userId'=>$userId]);
    $result=$search->fetch();

    if( $result == '' ) {
        echo "false";
    }
    else {
        echo "success";
    }
}
else {
    echo "false";
}

?>