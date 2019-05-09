<?php
    session_start();
    require "../models/login.php";

    $model = new ModelLogin();

    $account  = $_POST['account'];
    $password = $_POST['password'];
    $result = $model->login($account, $password);
    if( $result == '' ) {
        $_SESSION['userId'] = '';
        echo "false";
    }
    else {
        $_SESSION['userId'] = $result[0];
        // echo "success";
        echo $result[0];
    }
?>
