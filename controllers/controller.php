<?php
class Controller{
	public function __construct(){
	
	}
	public function redirect($page='login'){
		$page_css=[];
		$page_html=[];
		$page_js=[];

		if($page=="login"){
		
		}
		elseif(substr($page,0,3)==='app'){
			//load basic element
			$page_css[]='utils/appBasic.css';
			$page_html[]='utils/upperBar/upperBar.php';
			$page_html[]='utils/leftBar/leftBar.php';
			$page_js[]='utils/background.js';
			
			//load page element
			if($page==="app_main"){
				$recentHouses=[];
				$page_html[]='main/main.php';
			}

			require realpath('view/app/utils/master.php');
		}
	}
	private function main_app(){
		
	}
}
