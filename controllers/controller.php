<?php
class Controller{
	public function __construct(){
	
	}
	protected $cur_path='view/';
	protected $page_css=[];
	protected $page_html=[];
	protected $page_js=[];
	public function redirect($page='login'){
		$this->cur_path='view/';
		$this->page_css=[];
		$this->page_html=[];
		$this->page_js=[];

		if($page=="login"){
			$this->cur_path.='app/';
			$this->importFolder($this->cur_path.'login/');
		}
		elseif(substr($page,0,3)==='app'){
			$this->cur_path.='app/';
			$this->page_css[]='utils/appBasic.css';
			$this->importFolder($this->cur_path.'utils/upperBar/');
			$this->importFolder($this->cur_path.'utils/leftBar/');
			$this->page_js[]=$this->cur_path.'utils/background.js';
			
			if($page==="app_main"){
				$recentHouses=[];
				$this->importFolder($cur_path.'main/');
			}
		}

		require realpath('view/structure.php');
	}
	private function importFolder($path){
		$this->page_html=array_merge($this->page_html,glob("$path{*.html,*.php}", GLOB_BRACE));
		$this->page_css =array_merge($this->page_css ,glob("$path{*.css}", GLOB_BRACE));
		$this->page_js  =array_merge($this->page_js  ,glob("$path{*.js}", GLOB_BRACE));

		$dirs = glob($path.'/*', GLOB_ONLYDIR);
		if (count($dirs) > 0) {
			foreach ($dirs as $dir) importFolder($path.$dir.'/');
		}
	}
}
