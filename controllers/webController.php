<?php
require_once("controllers/building.php");
require_once("controllers/deterioration.php");
require_once("models/building.php");
require_once("models/deterioration.php");

class WebController {
    protected $models = NULL;
    public function __constructor() {
        $this->models['building'] = new ModelBuilding();
        $this->models['deterioration'] = new ModelDeterioration();
    }

    public function selectBuilding() {
        switch( $_POST['action'] ) {
            case 'select':
                $items = array();

                if( $_POST['pc'] == 1 )
                    array_push( $items, 'rebarExposed' );
                if( $_POST['crack'] == 1)
                    array_push( $items, 'crackLength', 'crackWidth');
                if( $_POST['flake'] == 1)
                    array_push( $items, 'exfoliationDepth', 'exfoliationScrap');

                $buildingIds = $deteriorationModel->selectDeterioration( $items );
                $buildingInfo = $buildingModel->getBuildingInfos($buildingIds);
                echo json_encode($buildingInfo);
                break;
            default:
                echo $_POST['action'];
        }
    }
}

?>