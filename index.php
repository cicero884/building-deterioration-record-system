<?php
session_start()
if(!isset($_SESSION['controller'])){
	require 'controllers/controller.php';
	$_SESSION['controller']=new Controller();
	$_SESSION['controller']->redirect('login');
}
else{
	$_SESSION['controller']->redirect('app_main');
}
?>
