<?php
class ImageController {

    function imageUpload( $name, $page, $buildingId = 0, $floorId = 0, $deteriorationId = 0, $num = 0 ) {
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
        if($check == false)
            $uploadOk = 0;

        // Check if file already exists
        if (file_exists($target_file))
            $uploadOk = 0;

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "false";
        // if everything is ok, try to upload file
        } else {
            if ( move_uploaded_file($_FILES[$name]["tmp_name"], $target_file )) {
                return $newfilename;
            } else {
                return "false";
            }
        }
    }
}
?>