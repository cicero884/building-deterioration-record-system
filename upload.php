<?php
require_once("controller/building.php");
require_once("controller/floor.php");
require_once("controller/deterioration.php");
session_start();
if(isset($_GET['type'])){
	if(isset($_GET['action'])) $action=$_GET['action'];
	else $action="";
	switch($_GET['type']){
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
