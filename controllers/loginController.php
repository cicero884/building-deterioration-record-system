<?php
require_once("controllers/controller.php");
require_once("models/login.php");
class loginController extends Controller{
	private $models;
	public $errMsg='';
	public function __construct(){
		$this->models['login']=new ModuleLogin();
	}
	public function login(){
		$this->errMsg=$this->models['login']->login();
		echo $this->errMsg;
	}
	public function logout(){
		if(session_destroy()){
			$this->redirect('login');
		}
	}
}
