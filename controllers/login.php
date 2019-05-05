<?php
include("./config.php");

$account  = $_POST['account'];
$password = $_POST['password'];
$sqlSearch = 'SELECT userId FROM user WHERE account=:account AND password=:password';
$search     = $conn->prepare($sqlSearch);
$search->execute([':account'=>$account, ':password'=>$password]);
$result=$search->fetch();

if( $result == '' ) {
    echo "false";
}
else {
    echo $result[0];
}

?>