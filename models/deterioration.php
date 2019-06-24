<?php
require_once("config.php");

class ModelDeterioration {
    public function updateDeterioration($deteriorationId, $deterioration ) {
		$sql = 'UPDATE deterioration
				SET column=:column,
					beam=:beam,
					wall=:wall,
					hole=:hole,
					floor=:floor,
					length=:length,
					width=:width,
					exfoliation=:exfoliation,
					rebarExposed=:rebarExposed,
					addOn=:addOn,
					exfoliationDepth=:exfoliationDepth,
					exfoliationScrap=:exfoliationScrap,
					crack=:crack,
					crackLength=:crackLength,
					crackWidth=:crackWidth,
					ps=:ps,
					image1=:image1,
					image2=:image2,
					image3=:image3,
					image4=:image4
				WHERE deteriorationId=:deteriorationId';
        $update = $GLOBALS['conn']->prepare( $sql ); 
        $update->bindValue(':deteriorationId', $deteriorationId);
        $update->bindValue(':wall', $deterioration[':wall'] , PDO::PARAM_INT );
        $update->bindValue(':column', $deterioration[':column'] , PDO::PARAM_INT );
        $update->bindValue(':beam', $deterioration[':beam'] , PDO::PARAM_INT );
        $update->bindValue(':hole', $deterioration[':hole'] , PDO::PARAM_INT );
        $update->bindValue(':rebarExposed', $deterioration[':rebarExposed'] , PDO::PARAM_INT );
        $update->bindValue(':addOn', $deterioration[':addOn'] , PDO::PARAM_INT );
        $update->bindValue(':exfoliation', $deterioration[':exfoliation'] , PDO::PARAM_INT );
        $update->bindValue(':exfoliationDepth', $deterioration[':exfoliationDepth'] , PDO::PARAM_INT );
        $update->bindValue(':exfoliationScrap', $deterioration[':exfoliationScrap'] , PDO::PARAM_INT );
        $update->bindValue(':crack', $deterioration[':crack'] , PDO::PARAM_INT );
        $update->bindValue(':crackLength', $deterioration[':crackLength'] , PDO::PARAM_INT );
        $update->bindValue(':crackWidth', $deterioration[':crackWidth'] , PDO::PARAM_INT );
        $update->execute( $deterioration );
    }

	public function newDeterioration($floorId,$x,$y){
		$sql = "INSERT INTO deterioration
				( floorId, x, y)
				VALUES
				( :floorId, :x, :y);";
        $insert = $GLOBALS['conn']->prepare( $sql ); 
		$insert->execute([':floorId'=>$floorId,':x'=>$x,':y'=>$y]);
		return $this->getLastestDeteriorationId();
    }
    
    public function deleteDeterioration( $deteriorationId ) {
        $sql = "DELETE FROM deterioration
                WHERE deteriorationId=:deteriorationId";
        $delete = $GLOBALS['conn']->prepare( $sql ); 
        $delete->execute([':deteriorationId'=>$deteriorationId]);
    }

    public function getLastestDeteriorationId() {
        $sql = "SELECT *
                FROM  deterioration
                WHERE deteriorationId =( SELECT max(deteriorationId) FROM deterioration )";
        $search = $GLOBALS['conn']->prepare( $sql ); 
        $search->execute();
        return $search->fetch(PDO::FETCH_OBJ)->deteriorationId;
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
