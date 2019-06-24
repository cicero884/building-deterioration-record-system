<?php
session_start();
require 'controllers/router.php';
$router=new Router();

//put $_GET['page'] into redirect may have user permission bug(user can access other user type data) ,still thinking
//if(isset($_GET['page'])) $router->redirect($_GET['page']);
//else $router->redirect();
if($_SERVER['REQUEST_METHOD']==='POST'){
	$content=array(
		'page'=>(isset($_POST['page']))? $_POST['page']:'',
		'buildingID'=>(isset($_POST['buildingID']))? $_POST['buildingID']:'',
		'floorID'=>(isset($_POST['floorID']))? $_POST['floorID']:''
	);
	$router->load($content);
}
elseif($_SERVER['REQUEST_METHOD']==='GET'){
	$page=(isset($_GET['page']))? $_GET['page']:'';
	$buildingID=(isset($_GET['buildingID']))? $_GET['buildingID']:'';
	$floorID=(isset($_GET['floorID']))? $_GET['floorID']:'';

	$router->redirect($page,$buildingID,$floorID);
}
/*
if(isset($_GET['action'])){
	switch($_GET['action']){
		case 'addHouse':
			$router->load('view/app/house');
			break;
		case 'addDeterioration':
			$router->load('view/app/deterioration');
			break;
	}
}
elseif(!isset($_GET['page'])) {
	if($_SESSION['userType'] == 1)
		$router->redirect('web_sum');
	else
		$router->redirect('app_main');
}
else $router->redirect($_GET['page']);
 */
?>
