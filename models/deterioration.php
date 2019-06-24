<?php
require_once("config.php");

class ModelDeterioration {
    public function insertDeterioration( $deterioration ) {
        $sql = "INSERT INTO deterioration
                ( floorId, `column`, beam, wall, hole, `floor`, 
                  rebarExposed, addOn,
                  exfoliation, exfoliationDepth, exfoliationScrap, 
                  crack, crackLength, crackWidth, ps, x, y)
                VALUES
                ( :floorId, :column, :beam, :wall, :hole, :floor, 
                  :rebarExposed, :addOn,
                  :exfoliation, :exfoliationDepth, :exfoliationScrap, 
                  :crack, :crackLength, :crackWidth, :ps, :x, :y); ";
        $insert = $GLOBALS['conn']->prepare( $sql ); 
        $insert->bindValue(':wall', $deterioration[':wall'] , PDO::PARAM_INT );
        $insert->bindValue(':column', $deterioration[':column'] , PDO::PARAM_INT );
        $insert->bindValue(':beam', $deterioration[':beam'] , PDO::PARAM_INT );
        $insert->bindValue(':hole', $deterioration[':hole'] , PDO::PARAM_INT );
        $insert->bindValue(':rebarExposed', $deterioration[':rebarExposed'] , PDO::PARAM_INT );
        $insert->bindValue(':addOn', $deterioration[':addOn'] , PDO::PARAM_INT );
        $insert->bindValue(':exfoliation', $deterioration[':exfoliation'] , PDO::PARAM_INT );
        $insert->bindValue(':exfoliationDepth', $deterioration[':exfoliationDepth'] , PDO::PARAM_INT );
        $insert->bindValue(':exfoliationScrap', $deterioration[':exfoliationScrap'] , PDO::PARAM_INT );
        $insert->bindValue(':crack', $deterioration[':crack'] , PDO::PARAM_INT );
        $insert->bindValue(':crackLength', $deterioration[':crackLength'] , PDO::PARAM_INT );
        $insert->bindValue(':crackWidth', $deterioration[':crackWidth'] , PDO::PARAM_INT );
        $insert->execute( $deterioration );
    }

    public function getLastestDeteriorationId() {
        $sql = "SELECT MAX( deteriorationId ) FROM deterioration";
        
        $search = $GLOBALS['conn']->prepare( $sql ); 
        $search->execute();
        $row=$search->fetch(PDO::FETCH_OBJ);

        return $search->deteriorationId;
    }

    // item is an array with the information need to select
    // return selected id
    public function selectDeterioration( $item ) {
        $condition = "";
        $floorIds = array();
        $sql = "";

        if( empty($item) ) {
            $sql = "SELECT floorId
                    FROM   deterioration";
        }
        else {
            foreach( $item as $n ) {
                if( $condition == "" )
                    $condition = $n;
                else
                    $condition .= " OR ".$n;
            }
            $sql = "SELECT floorId 
            FROM   deterioration 
            WHERE ". $condition ;
        }

        $select = $GLOBALS['conn']->prepare( $sql ); 
        $select->execute();

        while( $row=$select->fetch(PDO::FETCH_OBJ) ){
            if( !in_array( $row->floorId, $floorIds) ) {
                array_push( $floorIds, $row->floorId);
            }
        }

        // use floorId to search building
        $buildingIds = array();
        foreach( $floorIds as $n ) {
            $sql = "SELECT buildingId 
                    FROM   `floor`
                    WHERE floorId=". $n ;
            $select = $GLOBALS['conn']->prepare( $sql ); 
            $select->execute();
            $row=$select->fetch(PDO::FETCH_OBJ);
            if( !in_array( $row->buildingId, $buildingIds) ) {
                array_push( $buildingIds, $row->buildingId);
            }
        }
        return $buildingIds;
    }

    public function getDeteriorationInfosByFloorId( $floorId ) {
        $deteriorationInfos = array();
        $count = 0;
        $sql = "SELECT *
                FROM deterioration
                WHERE floorId=".$floorId ;
        $select = $GLOBALS['conn']->prepare( $sql );
        $select->execute();

        while( $row=$select->fetch(PDO::FETCH_OBJ) ){    
            $deteriorationInfos[$count] = array(
                'deteriorationId' => $row->deteriorationId,
                'floorId' => $row->floorId,
                'column'  => $row->column,
                'beam'    => $row->beam, 
                'wall'    => $row->wall,
                'hole'    => $row->hole, 
                'floor'   => $row->floor, 
                'RC'      => $row->rebarExposed, 
                'addOn'   => $row->addOn,
                'flake'   => $row->exfoliation, 
                'flakeDepth' => $row->exfoliationDepth, 
                'flakeScrap' => $row->exfoliationScrap, 
                'crack'      => $row->crack, 
                'crackLength' => $row->crackLength, 
                'crackWidth'  => $row->crackWidth, 
                'ps'          => $row->ps, 
                'locationX'   => $row->x, 
                'locationY'   => $row->y,
                'image1'      => $row->image1,
                'image2'      => $row->image2,
                'image3'      => $row->image3,
                'image4'      => $row->image4 
            );
            $count += 1;
        }

        return  $deteriorationInfos;        
    }
}
?>