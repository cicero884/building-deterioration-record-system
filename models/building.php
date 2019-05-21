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

    // get building information by buildingIds array
    public function getBuildingInfos( $buildingIds, $date ) {
        $items = array();
        $count = 0;
        foreach( $buildingIds as $n ) {
            $sql = "SELECT `address`, ownerName, ownerPhone, recordDate
                    FROM building
                    WHERE buildingId=".$n;
            switch( $date ){
                case 1:
                    $temp = " AND recordDate BETWEEN (CURRENT_DATE() - INTERVAL 1 MONTH) AND CURRENT_DATE();";
                    break;
                case 2:
                    $temp = " AND recordDate BETWEEN (CURRENT_DATE() - INTERVAL 3 MONTH) AND CURRENT_DATE();";
                    break;
                case 3:
                    $temp = " AND recordDate BETWEEN (CURRENT_DATE() - INTERVAL 6 MONTH) AND CURRENT_DATE();";
                    break;
            }
            $sql = $sql.$temp;
            $search = $GLOBALS['conn']->prepare( $sql );
            $search->execute();
            if( $row=$search->fetch(PDO::FETCH_OBJ) ) {
                $items[$count] = array(
                    'address' => $row->address,
                    'name'    => $row->ownerName,
                    'phone'   => $row->ownerPhone,
                    'date'    => $row->recordDate,
                    'buildingId' => $n
                );
                $count++;
            }
        }
        return $items;
    }

    public function getBuildingDetail( $buildingId ) {
        $sqlSearch = "SELECT `address`,  ownerName, ownerPhone, type, used, structure, image, floorUpper, floorDown
                      FROM   building
                      WHERE  buildingId = :buildingId";
        $search     = $GLOBALS['conn']->prepare( $sqlSearch );
        $search->execute([':buildingId'=>$buildingId]);
        $row=$search->fetch(PDO::FETCH_OBJ);   
        $buildingInfo = array(
            'name'       => $row->ownerName, 
            'phone'      => $row->ownerPhone, 
            'type'       => $row->type, 
            'usage'      => $row->used, 
            'structure'  => $row->structure, 
            'floorUpper' => $row->floorUpper, 
            'floorDown'  => $row->floorDown,
            'buildingId' => $row->buildingId,
            'address'    => $row->address,
            'image'      => "image/".$row->image
        );

        return $buildingInfo;
    }
}
?>