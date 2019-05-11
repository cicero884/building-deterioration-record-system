<?php
class ImageController {

    function imageUpload() {
        $target_dir = "../image/";

        // rename
        $extension=end(explode(".", $_FILES["image"]["name"]));
        $newfilename= date_format(date_create(),"Y-m-d_H:i:s") .".".$extension;
        $target_file = $target_dir . $newfilename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
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
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                return $newfilename;
            } else {
                return "false";
            }
        }
    }
}
?>