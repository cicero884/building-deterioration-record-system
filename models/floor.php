<?php
require_once("config.php");

class ModelFloor {
        // insert building information to the database
        public function insertFloorInfo( $floorInfo ) {
            $sql = "INSERT INTO floor ( buildingId, floor, floorPlan )
                    VALUES ( :buildingId, :floor, :floorPlan ); ";
            $insert = $GLOBALS['conn']->prepare( $sql ); 
            $insert->execute( $floorInfo );
        }
}
?>