<?php
require_once("controllers/building.php");
require_once("controllers/floor.php");
require_once("controllers/deterioration.php");
require_once("models/building.php");
require_once("models/deterioration.php");

$controllers['building']      = new BuildingController();
$controllers['floor']         = new FloorController();
$controllers['deterioration'] = new DeteriorationController();
$models['building']      = new ModelBuilding();
$models['deterioration'] = new ModelDeterioration();

switch( $_POST['page'] ) {
    case 'sum':
        $items = array();

        if( htmlspecialchars( $_POST['pc']) == 1 )
            array_push( $items, '(rebarExposed=1)' );
        if( htmlspecialchars( $_POST['crack']) == 1)
            array_push( $items, '(crackLength=1 AND crackWidth=1)');
        if( htmlspecialchars( $_POST['flake'] )== 1)
            array_push( $items, 'exfoliationDepth=1 AND exfoliationScrap=1');

        $buildingIds = $models['deterioration']->selectDeterioration( $items );
        $buildingInfo = $controllers['building']->buildingDetailForWebSum( $buildingIds, $_POST['date'], $_POST['address'] );
        echo json_encode($buildingInfo);

        break;

    case 'building':
        switch( $_POST['action'] ) {
            case 'selectFloorInfo':
                $floorInfos = $controllers['floor']->floorDetailForWebBuilding( $_POST['buildingId'] );
                echo json_encode( $floorInfos );
                break;
            case 'selectDeteriorationInfo':
                $deteriorations = $controllers['deterioration']->deteriorationDetailForWebBuilding( $_POST['floorId'] );
                $deteriorationInfos = array();
                $count = 0;
                foreach( $deteriorations as $item ) {
                    // position
                    $positionString = "";
                    $positionString .= ( $item['column'] == 1 )? "柱 ": "";
                    $positionString .= ( $item['beam']   == 1 )? "樑 ": "";
                    $positionString .= ( $item['wall']   == 1 )? "牆 ": "";
                    $positionString .= ( $item['hole']   == 1 )? "開口 ": "";
                    $positionString .= ( $item['floor']  == 1 )? "樓板 ": "";
                    $positionString .= ( str_word_count( $positionString ) <= 1 )? "" : "接合處 ";

                    $deteriorationInfos[ $count ] = array(
                        'deteriorationId' => $item['deteriorationId'],
                        'position'        => $positionString,
                        'flakeDepth'      => $item['flakeDepth'],
                        'flakeScrap'      => $item['flakeScrap'],
                        'crackLength'     => $item['crackLength'],
                        'crackWidth'      => $item['crackWidth'],
                        'RC'              => $item['RC'],
                        'addOn'           => $item['addOn']
                    );
                    $count += 1;
                }
                echo json_encode( $deteriorationInfos );
                break;
        }
        break;

    default:
        echo $_POST[ 'action'];
}
?>