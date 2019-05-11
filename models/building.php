<?php 
require_once("config.php");

class ModelBuilding {

    // build a nested array with buildingId, address, image
    // ex. the thired house's address
    // $buildingInfo[2]['address']
    public function latestThreeBuildings( $userId, & $buildingInfo ) {
        $count = 0;
        $sqlSearch  = "SELECT * FROM building WHERE userId=:userId ORDER BY recordDate DESC";
        $search     = $GLOBALS['conn']->prepare($sqlSearch);
        $search->execute([':userId'=>$userId]);

        while( $row=$search->fetch(PDO::FETCH_OBJ) and $count < 3 ){    
            //PDO::FETCH_OBJ 指定取出資料的型態
            $buildingInfo[$count] = array(
                'buildingId' => $row->buildingId,
                'address' => $row->address,
                'image' => $row->image
            );
            $count = $count + 1;
        }
    }
}
?>