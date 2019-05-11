<?php
require 'controllers/controller.php';
require 'models/login.php';
class loginController extends Controller{
	private $models;
	public $errMsg='';
	public function __construct(){
		$this->models['login']=new ModuleLogin();
	}
	public function login(){
		$this->errMsg=$this->models['login']->login();
		if(empty($this->errMsg)) $this->redirect('app_main');
		else $this->redirect('login');
	}
	public function logout(){
		if(session_destroy()){
			$this->redirect('login');
		}
	}
}
