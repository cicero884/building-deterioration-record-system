<?php
session_start();
require 'controllers/controller.php';
$controller=new Controller();
if(isset($_GET['action'])){
	switch($_GET['action']){
		case 'addHouse':
			$controller->load('view/app/house');
			break;
	}
}
elseif(!isset($_GET['page'])) {
	if($_SESSION['userType'] == 1)
		$controller->redirect('web_sum');
	else
		$controller->redirect('app_main');
}
else $controller->redirect($_GET['page']);
?>
