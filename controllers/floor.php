<?php
require_once("models/floor.php");

class FloorController {
    public $models;

    public function __construct() {
        $this->models['floor'] = new ModelFloor();
    }

    public function insertFloor() {
        $fileName = date_format(date_create(),"Y-m-d_H:i:s").".jpg";
        $file = "image/".$fileName;
        $img = str_replace('data:image/jpeg;base64,', '', $_POST['data']);
        $img = str_replace(' ', '+', $img);
        $res = file_put_contents( $file , base64_decode($img) );

        $floorInfo = array(
            ':buildingId' => htmlspecialchars( $_SESSION['buildingId'] ),
            ':floor'      => htmlspecialchars( $_POST['floor'] ),
            ':floorPlan'  => htmlspecialchars( $fileName ) 
        );
        $this->models['floor']->insertFloor( $floorInfo );
    }
}
?>