<?php
require_once("config.php");

class ModuleLoginCheck {
    public function isLogin( $userId ) {
        $sqlSearch  = 'SELECT name FROM user WHERE userId=:userId';
        $search     = $GLOBALS['conn']->prepare($sqlSearch);
        $search->execute([':userId'=>$userId]);
        $result=$search->fetch();

        // if the session userId exist, 
        // means the user has login,
        // return true
        if( $result == '' ) {
            return "false";
        }
        else {
            return "true";
        }
    }
}
?>