<?php 
require_once("config.php");

class ModelBuilding {

    public $sql      = '';
    public $building = '';
    
    // build a nested array with buildingId, address, image
    // ex. the third house's address => $buildingInfo[2]['address']
    public function getLatestThreeBuildings( $userId ) {
        $buildingInfo = array();
        $count = 0;
        $sqlSearch  = "SELECT address, buildingId, image
                        FROM building 
                        WHERE userId=:userId 
                        ORDER BY recordDate DESC";
        $search     = $GLOBALS['conn']->prepare( $sqlSearch );
        $search->execute([':userId'=>$userId]);

        while( $row=$search->fetch(PDO::FETCH_OBJ) and $count < 3 ){    
            $buildingInfo[$count] = array(
                'buildingId' => $row->buildingId,
                'address' => $row->address,
                'image' => 'image/'.$row->image
            );
            $count = $count + 1;
        }
        return $buildingInfo;
    }

    // insert building information to the database
    public function insertBuilding( $buildingInfo ) {
        $sql = "INSERT INTO building
                    ( userId, address, ownerName, ownerPhone, used, recordDate,
                    type, floorUpper, floorDown, structure, image)
                VALUES
                    ( :userId, :address, :ownerName, :ownerPhone, :used, NOW(),
                    :type ,:floorUpper , :floorDown, :structure, :image ); ";
        $insert = $GLOBALS['conn']->prepare( $sql ); 
        $insert->execute( $buildingInfo );
    }

    public function getLastestBuildingId() {
        $sql = "SELECT MAX(buildingId) FROM building";
        
        $search = $GLOBALS['conn']->prepare( $sql ); 
        $search->execute();
        return $search->fetch(PDO::FETCH_OBJ);
    }
	public function getBuildingInfoById($buildingId){
		$sql = "SELECT *
				FROM `building`
				WHERE buildingId=:buildingId";
		$select = $GLOBALS['conn']->prepare( $sql );
		$select->execute([':buildingId'=>$buildingId]);
		return $select->fetch(PDO::FETCH_OBJ);
	}

    public function generateBuildingSQLById( $buildingId ) {
        $this->sql = "SELECT *
                      FROM   building
                      WHERE  buildingId = ".$buildingId;
        return $this;
    }

    public function selectByDate( $date ) {
        switch( $date ){
            case 1:
                $this->sql = $this->sql." AND recordDate BETWEEN (CURRENT_DATE() - INTERVAL 1 MONTH) AND CURRENT_DATE();";
                break;
            case 2:
                $this->sql = $this->sql." AND recordDate BETWEEN (CURRENT_DATE() - INTERVAL 3 MONTH) AND CURRENT_DATE();";
                break;
            case 3:
                $this->sql = $this->sql." AND recordDate BETWEEN (CURRENT_DATE() - INTERVAL 6 MONTH) AND CURRENT_DATE();";
                break;
        }
        return $this;
    }

    public function selectByAddress( $address ) {
        if( $address != "" )
            $this->sql = $this->sql." AND `address` LIKE '%".$address."%'";
        return $this;
    }

    public function executSQL( ) {
        $search     = $GLOBALS['conn']->prepare( $this->sql );
        $search->execute();
        $row=$search->fetch(PDO::FETCH_OBJ);   
        $this->building = array(
            'name'       => $row->ownerName, 
            'phone'      => $row->ownerPhone, 
            'type'       => $row->type, 
            'usage'      => $row->used, 
            'structure'  => $row->structure, 
            'floorUpper' => $row->floorUpper, 
            'floorDown'  => $row->floorDown,
            'buildingId' => $row->buildingId,
            'address'    => $row->address,
            'date'       => $row->recordDate,
            'image'      => $row->image
        );
        return $this->building;
    }
}
?>
