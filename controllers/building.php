<?php
require_once("models/building.php");
require_once("controllers/image.php");
require_once("models/floor.php");

class BuildingController {

    public $controllers = NULL;
    public $models = NULL;

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

    public function getBuildingDetail( $buildingId ) {
        $buildingDetail = $this->models['building']->getBuildingDetail( $buildingId );
        switch( $buildingDetail['type'] ) {
            case '0':
                $buildingDetail['type'] = "透天" ;
                break;
            case '1':
                $buildingDetail['type'] = "公寓" ;
                break;
            case '2':
                $buildingDetail['type'] = "大廈" ;
                break;
            case '3':
                $buildingDetail['type'] = "三合院" ;
                break;
            case '4':
                $buildingDetail['type'] = "其他" ;
                break;
        }
        switch( $buildingDetail['usage'] ) {
            case '0':
                $buildingDetail['usage'] = "住家" ;
                break;
            case '1':
                $buildingDetail['usage'] = "商店" ;
                break;
            case '2':
                $buildingDetail['usage'] = "住商混合" ;
                break;
            case '3':
                $buildingDetail['usage'] = "其他" ;
                break;
        }
        switch( $buildingDetail['structure'] ) {
            case '0':
                $buildingDetail['structure'] = "鋼筋混泥土" ;
                break;
            case '1':
                $buildingDetail['structure'] = "鋼骨" ;
                break;
            case '2':
                $buildingDetail['structure'] = "木造" ;
                break;
            case '3':
                $buildingDetail['structure'] = "磚造" ;
                break;
            case '4':
                $buildingDetail['structure'] = "其他" ;
                break;
        }
        
        return $buildingDetail;
    }
}
?>
