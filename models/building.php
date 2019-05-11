<?php 
require_once("config.php");

class ModelBuilding {

    /*
        build a nested array with buildingId, address, image
        ex. the third house's address
        $buildingInfo[2]['address']
    */ 
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

/* just for test
$temp = [
    ':userId' => 4,
    ':address' => htmlspecialchars('<h1>台南市永康區中華東路一段124號</h1>'),
    ':ownerName' => '陳小美',
    ':ownerPhone' => '0910670487',
    ':type' => '3',
    ':floorUpper' => 2,
    ':floorDown' => 0,
    ':used' => '2',
    ':structure' => '0',
    ':image' => 'img9.jpg'
];
$haha = new ModelBuilding();
$haha->insertBuildingInfo($temp);
*/
?>