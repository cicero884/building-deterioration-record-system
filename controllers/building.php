<?php
require_once("models/building.php");
require_once("controllers/image.php");
require_once("models/floor.php");

class BuildingController {

    public $controllers = NULL;
    public $models = NULL;
    const  TYPE      = [ "透天", "公寓", "大廈", "三合院", "其他" ];
    const  USAGE     = [ "住家", "商店", "住商混合", "其他" ];
    const  STRUCTURE = [ "鋼筋混泥土", "鋼骨", "木造", "磚造", "其他" ];

    function __construct() {
        $this->controllers['image'] = new ImageController();
        $this->models['building'] = new ModelBuilding();
    }

    // call it to insert building information to the database
    public function insertData() {
        $imageUpload = $this->controllers['image']->imageUpload( "image", 0 );
        
        // upload Image sucess
        if( $imageUpload != false ) {
            $buildingInfo = array(
                ':userId'     => htmlspecialchars( $_SESSION['userId'] ),
                ':address'    => htmlspecialchars( $_POST['address'] ),
                ':ownerName'  => htmlspecialchars( $_POST['name'] ),
                ':ownerPhone' => htmlspecialchars( $_POST['phone'] ),
                ':type'       => htmlspecialchars( $_POST['type'] ),
                ':floorUpper' => htmlspecialchars( $_POST['scaleUp'] ),
                ':floorDown'  => htmlspecialchars( $_POST['scaleDown'] ),
                ':used'       => htmlspecialchars( $_POST['usage'] ),
                ':structure'  => htmlspecialchars( $_POST['structure'] ),
                ':image'      => htmlspecialchars( $imageUpload ) 
            );
            $this->models['building']->insertBuilding( $buildingInfo );
        }
        // false to upload image
        else {

        }
    }

    public function getBuildingDetail( $buildingId, $type=self::TYPE ) {
        $buildingDetail = $this->models['building']->getBuildingDetail( $buildingId );

        $buildingDetail['type']      = self::TYPE[ ( int )$buildingDetail[ 'type' ]  ];
        $buildingDetail['usage']     = self::USAGE[ (int)$buildingDetail['usage'] ];
        $buildingDetail['structure'] = self::STRUCTURE[ (int)$buildingDetail['structure'] ];
        
        return $buildingDetail;
    }
}
?>
