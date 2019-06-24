<?php
require_once("config.php");

class ModelFloor {
    public $floor = '';

    // insert building information to the database
    public function insertFloor( $floorInfo ) {
        $sql = "INSERT INTO floor ( buildingId, floor, floorPlan )
                VALUES ( :buildingId, :floor, :floorPlan ); ";
        $insert = $GLOBALS['conn']->prepare( $sql ); 
        $insert->execute( $floorInfo );
		return $this->getLastestFloorId();
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
    public function getFloorIdsByBuildingId( $buildingId ) {
        $floorIds = array();
        $sql = "SELECT floorId 
                FROM `floor`
                WHERE buildingId=:buildingId" ;
        $select = $GLOBALS['conn']->prepare( $sql );
        $select->execute([':buildingId'=>$buildingId]);

        while( $row=$select->fetch(PDO::FETCH_OBJ) ){    
            array_push( $floorIds, $row->floorId );
        }

        return  $floorIds;
    }

    public function getLastestFloorId() {
        $sql = "SELECT *
                FROM  `floor`
                WHERE floorId =( SELECT max(floorId) FROM `floor` )";
        $search = $GLOBALS['conn']->prepare( $sql ); 
        $search->execute();
        return $search->fetch(PDO::FETCH_OBJ)->floorId;
    }

    public function getFloorInfoById( $floorId ) {
        $sql = "SELECT *
                 FROM `floor`
                 WHERE floorId=".$floorId ;
        $select = $GLOBALS['conn']->prepare( $sql );
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $this->floor = array(
            'picture'    => $row->floorPlan,
            'floor'      => $row->floor,
            'floorId'    => $row->floorId 
        );
        return $this->floor;
    }
}
?>
