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
elseif(!isset($_GET['page'])) $controller->redirect('app_main');
else $controller->redirect($_GET['page']);
?>
