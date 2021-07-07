<?php
class ImageController {

    function imageUpload( $name, $page, $buildingId, $floorId = 0, $deteriorationId = 0, $num = 0 ) {
        $buildingId = 1;
        $target_dir  = "image/";
        $extension   =end(explode(".", $_FILES[$name]["name"]));
        $newfilename = "";

        // rename
        switch( $page ) {
            case 'building':
                $newfilename= $buildingId."-out.".$extension;
                break;
            case 'floor':
                $newfilename= $buildingId."_".$floorId."-plan.".$extension;
                break;
            case 'deterioration' :
                $newfilename= $buildingId."_".$floorId."_".$deteriorationId."-".$num.".".$extension;
                break;
        }

        $target_file = $target_dir . $newfilename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES[$name]["tmp_name"]);

        // Check if file already exists
        if (file_exists($target_file))
            unlink($target_file);

        if ( move_uploaded_file($_FILES[$name]["tmp_name"], $target_file )) {
            return $newfilename;
        } else {
            return $target_dir;
        }
    }
}
?>
