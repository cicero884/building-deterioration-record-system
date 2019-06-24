<?php
require_once("controllers/building.php");
require_once("controllers/floor.php");
require_once("controllers/deterioration.php");
session_start();
if(isset($_POST['page'])){
	switch($_POST['page']){
		case 'building':
			$controller=new BuildingController();
			break;
		case 'floor':
			$controller=new FloorController();
			break;
		case 'deterioration':
			$controller=new DeteriorationController();
			break;
	}
}
if(isset($_POST['action'])){
	switch($_POST['action']){
		case 'update':
			$controller->updateData();
			break;
		case 'insert':
			$controller->insertData();
			break;
	}
}
?>
