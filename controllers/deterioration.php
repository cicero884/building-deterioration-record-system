<?php
require_once("models/deterioration.php");

class DeteriorationController {
    public $modelDeterioration = NULL;

    public function __constructor() {
        $this->modelDeterioration = new ModelDeterioration();
    }

    public function insertDeterioration() {

        // unfinished
        $deterioration = array(
            ':floorId'      => $_POST['floorId'], 
            ':column'       => $_POST['column'], 
            ':beam'         => $_POST['beam'], 
            ':wall'         => 0, 
            ':hole'         => 0, 
            ':floor'        => 0, 
            ':rebarExposed' => $_POST['RC'], 
            ':addOn'        => $_POST['addOn'],
            ':exfoliation'  => 1, 
            ':exfoliationDepth' => 0, 
            ':exfoliationScrap' => 1, 
            ':crack'       => 1, 
            ':crackLength' => 1, 
            ':crackWidth'  => 1, 
            ':ps'          => '噗疵'
        );
        $this->modelDeterioration->insertFloorInfo( $floorInfo );
    }
}

?>