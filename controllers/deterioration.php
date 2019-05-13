<?php
session_start();
require_once("models/deterioration.php");

class DeteriorationController {
    public $modelDeterioration = NULL;

    public function __constructor() {
        $this->modelDeterioration = new ModelDeterioration();
    }

    public function insertDeterioration() {

        $deterioration = array(
            ':floorId'      => $_SESSION['floorId'], 
            ':column'       => ( isset($_POST['position'][0])? 1 : 0 ), 
            ':beam'         => ( isset($_POST['position'][1])? 1 : 0 ),
            ':wall'         => ( isset($_POST['position'][2])? 1 : 0 ),
            ':floor'        => ( isset($_POST['position'][3])? 1 : 0 ),
            ':hole'         => ( isset($_POST['position'][4])? 1 : 0 ),
            ':rebarExposed' => ( isset($_POST['RC'])? 1 : 0 ),
            ':addOn'        => ( isset($_POST['addOn'])? 1 : 0 ),
            ':exfoliation'  => ( isset($_POST['exfoliation'])? 1 : 0 ),
            ':exfoliationDepth' => ( isset($_POST['exfoliaitonDepth'])? 1 : 0 ),
            ':exfoliationScrap' => ( isset($_POST['exfoliationScrap'])? 1 : 0 ),
            ':crack'       => ( isset($_POST['crack'])? 1 : 0 ), 
            ':crackLength' => ( isset($_POST['crackLength'])? 1 : 0 ),
            ':crackWidth'  => ( isset($_POST['crackWidth'])? 1 : 0 ),
            ':ps'          => $_POST['ps']
        );
        $this->modelDeterioration->insertFloorInfo( $floorInfo );
    }
}

?>