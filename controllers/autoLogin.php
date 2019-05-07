<?php
session_start();
include("./config.php");

$userId   = $_SESSION['userId']; 
$sqlSearch = 'SELECT name FROM user WHERE userId=: userId';
$search     = $conn->prepare($sqlSearch);
$search->execute([':userId'=>$userId]);
$result=$search->fetch();

if( $result == '' ) {
    echo "false";
}
else {
    echo "success";
}

?>