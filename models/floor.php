<?php
require_once("config.php");

class ModelFloor {
    // insert building information to the database
    public function insertFloor( $floorInfo ) {
        $sql = "INSERT INTO floor ( buildingId, floor, floorPlan )
                VALUES ( :buildingId, :floor, :floorPlan ); ";
        $insert = $GLOBALS['conn']->prepare( $sql ); 
        $insert->execute( $floorInfo );
    }

    public function getFloorId( $buildingId, $floor ) {
        $sql = "SELECT floorId 
                FROM `floor`
                WHERE buildingId=:buildingId AND floor=:floor";
        $select = $GLOBALS['conn']->prepare( $sql );
        $select->execute([':buildingId'=>$buildingId, ':floor'=>$floor]);
        $result = $select->fetch(PDO::FETCH_OBJ);

        return  $result->floorId;
    }
}
?>