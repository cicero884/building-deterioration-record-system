<?php
require_once("controllers/building.php");
require_once("controllers/deterioration.php");
require_once("models/building.php");
require_once("models/deterioration.php");

$controllers['building'] = new BuildingController();
$models['building']      = new ModelBuilding();
$models['deterioration'] = new ModelDeterioration();

switch( $_POST['action'] ) {
    case 'select':
        $items = array();

        if( htmlspecialchars( $_POST['pc']) == 1 )
            array_push( $items, '(rebarExposed=1)' );
        if( htmlspecialchars( $_POST['crack']) == 1)
            array_push( $items, '(crackLength=1 AND crackWidth=1)');
        if( htmlspecialchars( $_POST['flake'] )== 1)
            array_push( $items, 'exfoliationDepth=1 AND exfoliationScrap=1');

        $buildingIds = $models['deterioration']->selectDeterioration( $items );
        $buildingInfo = $controllers['building']->buildingDetailForWebSum( $buildingIds, $_POST['date'] );
        // $buildingInfo = $models['building']->getBuildingInfos( $buildingIds, $_POST['date'] );
        echo json_encode($buildingInfo);

        break;
    default:
        echo $_POST[ 'action'];
}
?>