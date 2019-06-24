<?php
require_once("models/deterioration.php");
require_once("controllers/image.php");

class DeteriorationController {
    public $models;
    public $controllers;

    public function __construct() {
        $this->models[ 'deterioration' ] = new ModelDeterioration();
        $this->controllers['image'] = new ImageController();
    }
    public function insertData(){
		echo $this->models['deterioration']->newDeterioration($_POST['floorID'],$_POST['x'],$_POST['y']);
	}

    public function updateData(){
        $deteriorationId=$_POST['deteriorationId'];

        /*
        $imageUpload = array();
        for($n = 1; $n <= 4; $n += 1) {
            array_push( $imageUpload, $this->controllers['image']->imageUpload( "image".$n, $_POST['buildingId'], $_SESSION['floorId'], $deteriorationId, $n ) );
        }
        */

        $imageUpload = ['test', 'test', 'test', 'test'];

        $deterioration = array(
            ':deteriorationId'  => $deteriorationId,
            ':ps'               => htmlspecialchars( "test" ),
            ':column'           => ( isset($_POST['column'])? '1' : '0' )
            //':beam'             => ( isset($_POST['beam'])? 1 : 0 ),
            // ':wall'             => ( isset($_POST['wall'])? 1 : 0 ),
            // ':floor'            => ( isset($_POST['floor'])? 1 : 0 ),
            // ':hole'             => ( isset($_POST['hole'])? 1 : 0 ),
            /*
            ':rebarExposed'     => ( ( isset($_POST['RCUncover']) && $_POST['RCUncover'] == "1" )? 1 : 0 ),
            ':addOn'            => ( ( isset($_POST['addOn']) && $_POST['addOn'] == "1" )? 1 : 0 ),
            ':exfoliation'      => ( ( isset($_POST['flake']) && $_POST['flake'] == "1" )? 1 : 0 ),
            ':exfoliationDepth' => ( ( isset($_POST['flake_depth']) && $_POST['flake_depth'] == "1")? 1 : 0 ),
            ':exfoliationScrap' => ( ( isset($_POST['flake_scrap']) && $_POST['flake_scrap'] == "1")? 1 : 0 ),
            ':crack'       => ( ( isset($_POST['crack']) && $_POST['crack'] == "1" )? 1 : 0 ), 
            ':crackLength' => ( ( isset($_POST['crack_length']) && $_POST['crack_length'] == "1")? 1 : 0 ),
            ':crackWidth'  => ( ( isset($_POST['crack_width']) && $_POST['crack_width'] == "1" )? 1 : 0 ),
            ':image1'           => $imageUpload[0],
            ':image2'           => $imageUpload[1],
            ':image3'           => $imageUpload[2],
            ':image4'           => $imageUpload[3]
            */
        );
        $this->models['deterioration']->updateDeterioration($deteriorationId, $deterioration );
    }

    public function deteriorationDetailForWebBuilding( $floorId ) {
        $deterioration = $this->models[ 'deterioration' ]->getDeteriorationInfosByFloorId( $floorId );

        return $deterioration;
    }
}

?>
