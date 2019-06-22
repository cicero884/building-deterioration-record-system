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

    public function insertData() {
        $deteriorationId = $this->models[ 'deterioration' ]->getLastestDeteriorationId() + 1;
        for($n = 1; $n <= 4; $n += 1) {
            $imageUpload = $this->controllers['image']->imageUpload( "image".$n, $_POST['buildingId'], $_SESSION['floorId'], $deteriorationId, $n );
        }

        $deterioration = array(
            ':floorId'          => $_SESSION['floorId'],
            ':x'                => $_POST['x'],
            ':y'                => $_POST['y'],
            ':column'           => ( isset($_POST['position'][0])? 1 : 0 ), 
            ':beam'             => ( isset($_POST['position'][1])? 1 : 0 ),
            ':wall'             => ( isset($_POST['position'][2])? 1 : 0 ),
            ':floor'            => ( isset($_POST['position'][3])? 1 : 0 ),
            ':hole'             => ( isset($_POST['position'][4])? 1 : 0 ),
            ':rebarExposed'     => ( isset($_POST['RC'])? 1 : 0 ),
            ':addOn'            => ( isset($_POST['addOn'])? 1 : 0 ),
            ':exfoliation'      => ( isset($_POST['exfoliation'])? 1 : 0 ),
            ':exfoliationDepth' => ( isset($_POST['exfoliaitonDepth'])? 1 : 0 ),
            ':exfoliationScrap' => ( isset($_POST['exfoliationScrap'])? 1 : 0 ),
            ':crack'       => ( isset($_POST['crack'])? 1 : 0 ), 
            ':crackLength' => ( isset($_POST['crackLength'])? 1 : 0 ),
            ':crackWidth'  => ( isset($_POST['crackWidth'])? 1 : 0 ),
            ':ps'          => $_POST['ps']
        );
        $this->models['deterioration']->insertDeterioration( $deterioration );
    }

    public function deteriorationDetailForWebBuilding( $floorId ) {
        $deterioration = $this->models[ 'deterioration' ]->getDeteriorationInfosByFloorId( $floorId );

        return $deterioration;
    }
}

?>
