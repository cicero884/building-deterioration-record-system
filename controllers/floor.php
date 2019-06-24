<?php
require_once("models/floor.php");

class FloorController {
    public $models;
    public $floorDetail;

    public function __construct() {
        $this->models['floor'] = new ModelFloor();
    }

    public function insertData() {
        $floorId = $this->models['floor']->getLastestFloorId();
        $fileName = $_POST['buildingId']."_".$floorId."-plan.png";
        $file = "image/".$fileName;
        $img = str_replace('data:image/png;base64,', '', $_POST['floorPlan']);
        $img = str_replace(' ', '+', $img);
        $res = file_put_contents( $file , base64_decode($img) );

        $floorInfo = array(
            ':buildingId' => htmlspecialchars( $_POST['buildingId'] ),
            ':floor'      => htmlspecialchars( $_POST['floor'] ),
            ':floorPlan'  => htmlspecialchars( $fileName ) 
        );
        echo $this->models['floor']->insertFloor( $floorInfo );
    }

    public function updateData() {
		$floorId=$_POST['floorID'];
        $fileName = $_POST['buildingId']."_".$floorId."-plan.jpg";
        $file = "image/".$fileName;

        // Check if file already exists
        if (file_exists($file))
            unlink($file);

        $img = str_replace('data:image/jpeg;base64,', '', $_POST['floorPlan']);
        $img = str_replace(' ', '+', $img);
        $res = file_put_contents( $file , base64_decode($img) );

        $floorInfo = array(
            ':floorId'   => $floorId,
            ':floor'     => htmlspecialchars( $_POST['floor'] ),
            ':floorPlan' => htmlspecialchars( $fileName ) 
        );
    }

    public function floorDetailForWebBuilding( $buildingId ) {
        $floorInfo = array();
        $count = 0;
        $floorIds = $this->models[ 'floor' ]->getFloorIdsByBuildingId( $buildingId );

        foreach( $floorIds as $id ) {
            $floor = $this->models[ 'floor' ]->getFloorInfoById( $id );
            $floorInfo[ $count ] = array(
                'picture' => "image/".$floor[ 'picture' ],
                'floor'   => $floor[ 'floor' ],
                'floorId' => $floor[ 'floorId' ]
            );
            if( $floor['floor'] > 0 )
                $floorInfo[ $count ][ 'floor' ] = '地上'.$floor['floor'].'樓';
            else
                $floorInfo[ $count ][ 'floor' ] = '地下'.$floor['floor']*(-1).'樓';
            $count += 1;
        }
        
        return $floorInfo;
    }
}
?>
