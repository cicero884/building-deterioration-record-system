<?php
session_start();
require 'controllers/loginController.php';
$controller=new loginController();
if(isset($_POST['action'])){
	if($_POST['action']==='login') $controller->login();
	elseif($_POST['action']==='logout') $controller->logout();
}
