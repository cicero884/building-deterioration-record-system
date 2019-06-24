<?php
require_once("controller/building.php");
require_once("controller/floor.php");
require_once("controller/deterioration.php");
session_start();
if(isset($_GET['type'])){
	switch($_GET['type']){
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
	$controller->insertData();
}
?>
