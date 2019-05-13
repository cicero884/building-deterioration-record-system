<?php
require_once("models/floor.php");

class FloorController {

    public $modelFloor = NULL;

    public function __constructor() {
        $this->modelFloor = new ModelFloor();
    }

    public function insertFloor() {
        $floorInfo = array(
            ':buildingId' => htmlspecialchars( $_SESSION['buildingId'] ),
            ':floor'      => htmlspecialchars( $_POST['floor'] ),
            ':image'      => htmlspecialchars( 'test.svg' ) 
        );
        $this->modelFloor->insertFloor( $floorInfo );
    }
}

?>