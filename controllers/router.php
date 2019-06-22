<?php
require_once('controllers/building.php');
require_once("models/login.php");
require_once("models/building.php");
require_once("models/floor.php");
class Router{
	protected $recentHouses=array();
	protected $floorInfo;
	protected $buildingDetail;
	protected $cur_path='view/';
	protected $page_css=array();
	protected $page_html=array();
	protected $contents=array();
	protected $page_js=array();
	private $models;
	private $controllers;
	public function __construct(){
		$this->models['login']=new ModuleLogin();
		$this->models['building']=new ModelBuilding();
		$this->models['floor']=new ModelFloor();
	}
	public function redirect($page='',$buildingID='',$floor=''){
		$this->page_css=array();
		$this->page_html=array();
		$contents=array();
		$this->page_js=array();

		if($page==='login'||!$this->models['login']->isLogin()){
			$this->getFiles('view/app/login/');
		}
		else{
			//default page
			if($page===''){
				if($_SESSION['userType'] == 1) $page='web_sum';
				else $page='app_main';
			}
			//load master page and put page content parameter
			if(substr($page,0,3)==='app'){
				$this->getFiles('view/app/utils');
				$this->contents[]=array(
					'page'=>$page,
					'buildingID'=>$buildingID,
					'floor'=>$floor
				);
			}
			elseif(substr($page,0,3)==='web') {
				if( $page==="web_sum" ) {
					$this->getFiles('view/web/web_sum');	
				}
				elseif( $page==="web_building" ) {
					$this->controllers['building']=new BuildingController();
					$this->buildingDetail = $this->controllers['building']->getBuildingDetail( $_GET['buildingId'] );
					$this->getFiles('view/web/web_building');
				}
			}
		}
		require realpath('view/structure.php');
	}
	public function load($content){
		if($this->models['login']->isLogin()){
			//load parameter
			$path='';
			if($content['page']===''){
				if($_SESSION['userType'] == 1) $content['page']='web_sum';
				else $content['page']='app_main';
			}
			if(substr($content['page'],0,3)==='app'){
				if($content['page']==="app_house"){
					$path='view/app/house';
				}
				elseif($content['page']==="app_floor" && $content['buildingID']!==''){
					$floorID=$this->models['floor']->getFloorId($content['buildingID'],$content['floor']);
					$this->floorInfo=$this->models['floor']->getInfo($floorID);
					//$this->houseInfo=$this->models['building']->
					$path='view/app/floor';
				}
				elseif($content['page']==="app_deterioration" && $buildingID!=='' && $floor!==''){
					$path='view/app/deterioration';
				}
				else{//app_main
					$this->recentHouses=$this->models['building']->getLatestThreeBuildings($_SESSION['userId']);
					$path='view/app/main';
				}
			}
			$content_html=array();
			$content_css=array();
			$content_js=array();
			$this->importFolder($path,$content_html,$content_css,$content_js);
			foreach($content_css as $css){
				echo "<link rel='stylesheet' type='text/css' href='$css'>\n";
			}
			foreach($content_html as $html){
				include "$html";
			}
			foreach($content_js as $js){
				echo "<script defer src='$js'></script>\n";
			}
		}
	}
	private function getFiles($path){
		if($path==='') return;
		$html=array();
		$css=array();
		$js=array();
		$this->importFolder($path,$html,$css,$js);
		$this->page_html=array_merge($this->page_html,$html);
		$this->page_css =array_merge($this->page_css,$css);
		$this->page_js  =array_merge($this->page_js,$js);
	}
	private function importFolder($path,&$html,&$css,&$js){
		if($path==='') return;
		$html=array_merge($html,glob("$path{/*.html,/*.php}", GLOB_BRACE));
		$css =array_merge($css ,glob("$path{/*.css}", GLOB_BRACE));
		$js  =array_merge($js  ,glob("$path{/*.js}", GLOB_BRACE));
		//foreach ($css as $h) echo "$h.<br/>";
		//echo $path."<br/>";
		$dirs = glob($path.'/*', GLOB_ONLYDIR);
		if (count($dirs) > 0) {
			foreach ($dirs as $dir) $this->importFolder($dir,$html,$css,$js);
		}
	}
}
?>
