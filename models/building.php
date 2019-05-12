<?php 
require_once("config.php");

class ModelBuilding {
    
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
                'image' => $row->image
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

    // get building information by buildingIds array
    public function getBuildingInfos( $buildingIds ) {
        $items = array();
        $count = 0;
        foreach( $buildingIds as $n ) {
            $sql = "SELECT `address`, ownerName, ownerPhone, recordDate
                    FROM building
                    WHERE buildingId=".$n;
            $search = $GLOBALS['conn']->prepare( $sql );
            $search->execute();
            $row=$search->fetch(PDO::FETCH_OBJ);

            $items[$count] = array(
                'address' => $row->address,
                'name'    => $row->ownerName,
                'phone'   => $row->ownerPhone,
                'date'    => $row->recordDate
            );
            $count++;
        }
        return $items;
    }
}
?>