<?php
    session_start();
    require "../models/login.php";

    $model = new ModuleLogin();

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
        echo "main_app.php";
    }
?>
