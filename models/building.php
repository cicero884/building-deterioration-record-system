<?php 
require_once("config.php");

class buildingJson {
    public function test() {
        echo "hello";
    }
    public $address = null;
    public $name = null;
    public $phone = null;
    public $type = null;
    public $usage = null;
    public $scaleUp = null;
    public $scaleDown = null;
    public $image = array();
}

class ModelBuilding {
    public function latestThreeBuildings( $userId, & $buildingInfo ) {
        $count = 0;
        $sqlSearch  = "SELECT * FROM building WHERE userId=:userId ORDER BY recordDate DESC";
        $search     = $GLOBALS['conn']->prepare($sqlSearch);
        $search->execute([':userId'=>$userId]);

        while( $row=$search->fetch(PDO::FETCH_OBJ) and $count < 3 ){    
            //PDO::FETCH_OBJ 指定取出資料的型態
            $buildingInfo[$count] = new buildingJson();
            $buildingInfo[$count]->address = $row->address; 
            $buildingInfo[$count]->name = $row->ownerName;
            $buildingInfo[$count]->phone = $row->ownerPhone;
            $buildingInfo[$count]->type = $row->type;
            $buildingInfo[$count]->usage = $row->usage;
            $buildingInfo[$count]->scaleUp = $row->floorUpper;
            $buildingInfo[$count]->scaleDown = $row->floorDown;  
            $count = $count+1;
        }
    }
}
?>