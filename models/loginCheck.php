<?php
require_once("../models/config.php");

class ModuleLoginCheck {
    public function isLogin( $userId ) {
        $sqlSearch  = 'SELECT name FROM user WHERE userId=:userId';
        $search     = $GLOBALS['conn']->prepare($sqlSearch);
        $search->execute([':userId'=>$userId]);
        $result=$search->fetch();

        if( $result == '' ) {
            return "false";
        }
        else {
            return "main_app.php";
        }
    }
}

?>