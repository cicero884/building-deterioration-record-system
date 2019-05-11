<?php 
require_once("config.php");

class ModelBuilding {

    /*
        build a nested array with buildingId, address, image
        ex. the thired house's address
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
        echo $buildingInfo."<br>";
        $sql = "INSERT INTO building
                    (userId, address, ownerName, ownerPhone, used, recordDate,
                    type, area, floorUpper, floorDown, structure, image)
                VALUES
                    (:userId, :address, :ownerName, :ownerPhone, :used, :recordDate,
                    :type,:area ,:floorUpper, :floorDown, :structure, :image); ";
        $insert = $GLOBALS['conn']->prepare( $sql ); 
        $insert->execute( $buildingInfo );
    }
}

// $hahaha = "2017-05-02 5:0:"->format('Y-m-d');

$temp = [
    ':userId' => 3,
    ':address' => '台中市大里區公益路174號',
    ':ownerName' => '林小美',
    ':ownerPhone' => '0910450487',
    ':recordDate' => '2018-05-02 10:10:45',
    ':type' => '3',
    ':floorUpper' => 4,
    ':floorDown' => 0,
    ':used' => '2',
    ':structure' => '0',
    ':area' => 40,
    ':image' => 'img7.jpg'
];
$haha = new ModelBuilding();
$haha->insertBuildingInfo($temp);

/*
$temp = array();
$haha = new ModelBuilding();
$haha->latestThreeBuildings(1, $temp);
echo $temp[1]['buildingId'];

                VALUES
                    ( :userId, :address, :ownerName, :ownerPhone, :recordDate,
                    :type, :floorUpper, :floorDown, :usage, :structure, :image); ";
*/

?>