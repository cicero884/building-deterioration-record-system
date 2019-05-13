<?php
require_once("models/building.php");
require_once("controllers/image.php");

class BuildingController {

    public $controllers = NULL;
    public $models = NULL;

    function __construct() {
        $this->controllers['image'] = new ImageController();
        $this->models['building'] = new ModelBuilding();
    }

    // call it to insert building information to the database
    public function insertBuilding() {
        $imageUpload = $this->controllers['image']->imageUpload();
        
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
            $this->models['building']->insertBuilding( $buildingInfo );
        }
        // false to upload image
        else {

        }
    }
}
?>