<?php
require_once("models/building.php");
require_once("controllers/image.php");
class BuildingController {

    public $imageController = NULL;
    public $modelBuilding = NULL;

    function __construct() {
        $this->imageController = new ImageController();
        $this->modelBuilding = new ModelBuilding();
    }

    // call it to insert building information to the database
    public function insertBuildingInfo() {
        $imageUpload = $this->imageController->imageUpload();
        
        // upload Image sucess
        if( $imageUpload != false ) {
            $buildingInfo = array(
                ':userId'     => htmlspecialchars( $_POST['userId'] ),
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
            $this->modelBuilding->insertBuildingInfo( $buildingInfo );
        }
        // false to upload image
        else {

        }
    }

    // call the building model
    public function getLatestThreeBuildings( $userId, array & $buildingInfo ) {
        $modelBuilding = new ModelBuilding(); 
        $modelBuilding->latestThreeBuildings( $userId, $buildingInfo );
    }
}
?>