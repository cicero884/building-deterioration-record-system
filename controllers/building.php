<?php
require_once("models/building.php");
require_once("controllers/image.php");
require_once("models/floor.php");

class BuildingController {

    public $controllers = NULL;
    public $models = NULL;
    const  TYPE      = [ "透天", "公寓", "大廈", "三合院", "其他" ];
    const  USAGE     = [ "住家", "商店", "住商混合", "其他" ];
    const  STRUCTURE = [ "鋼筋混泥土", "鋼骨", "木造", "磚造", "其他" ];

    function __construct() {
        $this->controllers['image'] = new ImageController();
        $this->models['building'] = new ModelBuilding();
    }

    // call it to insert building information to the database
    public function insertData() {
        $buildingId  = $this->models['building']->getLastestBuildingId() + 1;
        $imageUpload = $this->controllers['image']->imageUpload( "image", "building", $buildingId );
        
        // upload Image sucess
        if( $imageUpload != false ) {
            $buildingInfo = array(
                ':userId'     => htmlspecialchars( $_GET['userId'] ),
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

    public function buildingDetailForWebBuilding( $buildingId ) {
        $building =  $this->models['building']->generateBuildingSQLById( $buildingId )->executSQL();
        $buildingInfo = array(
            'name'       => $building['name'], 
            'phone'      => $building['phone'],
            'type'       => self::TYPE[ ( int )$building[ 'type' ]  ],
            'usage'      => self::USAGE[ (int)$building['usage'] ],
            'structure'  => self::STRUCTURE[ (int)$building['structure'] ],
            'floorUpper' => $building['floorUpper'], 
            'floorDown'  => $building['floorDown'],
            'buildingId' => $building['buildingId'],
            'address'    => $building['address'],
            'image'      => "image/".$building['image']
        );
        return $buildingInfo;
    }

    public function buildingDetailForWebSum( $buildingIds, $date, $address ) {
        $buildingInfo = array();
        $count = 0;
        foreach( $buildingIds as $id ) {
            $building = $this->models['building']->generateBuildingSQLById( $id )->selectByAddress( $address )->selectByDate( $date )->executSQL();
            if( $building['address'] != null ) {
                $buildingInfo[ $count ] = array(
                    'address'    => $building[ 'address' ],
                    'name'       => $building[ 'name' ],
                    'phone'      => $building[ 'phone' ],
                    'buildingId' => $building[ 'buildingId' ],
                    'date'       => $building[ 'date' ]
                );
                $count += 1;
            }
        }
        return $buildingInfo;
    }
}
?>
