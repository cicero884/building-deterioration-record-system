<?php
require_once("models/deterioration.php");

class Deterioration {
    public $modelDeterioration = NULL;

    public function __constructor() {
        $this->modelDeterioration = new ModelDeterioration();
    }

    public function insertDeterioration() {

        // unfinished
        $deterioration = array(
            ':floorId'      => $_POST['floorId'], 
            ':column'       => 0, 
            ':beam'         => 1, 
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

    public function selectDeterioration() {
        $items = array();
        if( $_POST['PC'] )
            array_push( $items, 'rebarExposed' );
        if( $_POST['crack'] )
            array_push( $items, 'crackLength', 'crackWidth');
        if( $_POST['exfoliation'] )
            array_push( $items, 'exfoliationDepth', 'exfoliationScrap');
        
        $this->modelDeterioration->selectDeterioration( $items );
    }
}

?>