<?php
session_start();
require 'controllers/controller.php';
$controller=new Controller();
if(isset($_GET['type'])){
	switch($_GET['type']){
		case 'building':
			$controller->upload('/controller/building');
			break;
		case 'floor':
			$controller->upload('/controller/floor');
			break;
		case 'deterioration':
			$controller->upload('/controller/deterioration');
			break;
	}
}
?>
