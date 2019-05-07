<?php
    session_start();
    include("./config.php");

    $account  = $_POST['account'];
    $password = $_POST['password'];
    $sqlSearch = 'SELECT userId FROM user WHERE account=:account AND password=:password';
    $search     = $conn->prepare($sqlSearch);
    $search->execute([':account'=>$account, ':password'=>$password]);
    $result=$search->fetch();
    if( $result == '' ) {
        $_SESSION['userId'] = '';
        echo "false";
    }
    else {
        $_SESSION['userId'] = $result[0];
        $_POST['userId'] = $result[0];
        echo "success";
    }

?>