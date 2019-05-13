<?php
require_once("config.php");

class ModelDeterioration {
    public function insertDeterioration( $deterioration ) {
        $sql = "INSERT INTO deterioration
                ( floorId, `column`, beam, wall, hole, `floor`, 
                  rebarExposed, addOn,
                  exfoliation, exfoliationDepth, exfoliationScrap, 
                  crack, crackLength, crackWidth, ps)
                VALUES
                ( :floorId, :column, :beam, :wall, :hole, :floor, 
                  :rebarExposed, :addOn,
                  :exfoliation, :exfoliationDepth, :exfoliationScrap, 
                  :crack, :crackLength, :crackWidth, :ps); ";
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
                    $condition = $n. "=1";
                else
                    $condition = $condition." and ".$n."=1";
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
}
?>