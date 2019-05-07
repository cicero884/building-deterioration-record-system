<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="./login.css">
</head>
<body>
    <img/>
    <form>
        <section>
            <img/>
            <input type="text" name="account" id="login__account">
        </section>
        <section>
            <img/>
            <input type="password" name="password" id="login__password">
        </section>
        <button type="button" id="login__button">Login</button>
    </form>
    <button type="button">立即註冊</button>
    <p id="error__message" class="error__message">帳號或密碼錯誤</p>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="./login.js"></script>
</body>