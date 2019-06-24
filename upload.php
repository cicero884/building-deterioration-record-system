<?php
require_once("controllers/building.php");
require_once("controllers/floor.php");
require_once("controllers/deterioration.php");
session_start();
if(isset($_POST['page'])){
	if(isset($_POST['action'])) $action=$_POST['action'];
	else $action="";
	switch($_POST['page']){
		case 'building':
			$controller=new BuildingController();
			$controller->insertData();
			break;
		case 'floor':
			$controller=new FloorController();
			if($action==='update') $controller;
			elseif($action==='insert') $controller;
			break;
		case 'deterioration':
			$controller=new DeteriorationController();
			if($action==='update') $controller;
			elseif($action==='insert') $controller;
			break;
	}
	$controller->insertData();
}
?>
