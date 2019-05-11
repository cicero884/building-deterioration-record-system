<?php
session_start();
require 'controllers/controller.php';
$controller=new Controller();
if(!isset($_GET['page'])) $controller->redirect('app_main');
else $controller->redirect($_GET['page']);
?>
