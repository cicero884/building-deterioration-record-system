<?php 
require_once("config.php");

class ModelBuilding {

    // build a nested array with buildingId, address, image
    // ex. the third house's address => $buildingInfo[2]['address']
    public function latestThreeBuildings( $userId, array & $buildingInfo ) {
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
    }

    // insert building information to the database
    public function insertBuildingInfo( $buildingInfo ) {
        $sql = "INSERT INTO building
                    ( userId, address, ownerName, ownerPhone, used, recordDate,
                    type, floorUpper, floorDown, structure, image)
                VALUES
                    ( :userId, :address, :ownerName, :ownerPhone, :used, NOW(),
                    :type ,:floorUpper , :floorDown, :structure, :image ); ";
        $insert = $GLOBALS['conn']->prepare( $sql ); 
        $insert->execute( $buildingInfo );
    }
}
?>