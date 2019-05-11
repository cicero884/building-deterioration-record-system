<?php
require_once("models/login.php");
class Building {
    function insertBuildingInfo() {
        $modelBuilding = new ModelBuilding(); 
        $buildingInfo = array(
            ':userId'     => htmlspecialchars($_POST['userId']),
            ':address'    => htmlspecialchars($_POST['address']),
            ':ownerName'  => htmlspecialchars($_POST['name']),
            ':ownerPhone' => htmlspecialchars($_POST['phone']),
            ':type'       => htmlspecialchars($_POST['type']),
            ':floorUpper' => htmlspecialchars($_POST['scaleUp']),
            ':floorDown'  => htmlspecialchars($_POST['scaleDown']),
            ':used'       => htmlspecialchars($_POST['usage']),
            ':structure'  => htmlspecialchars($_POST['structure']),
            ':image'      => htmlspecialchars($_POST['image']) 
        );
        $modelBuilding->insertBuildingInfo( $buildingInfo );
    }
}
?>