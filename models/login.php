<?php
require ("models/config.php");

class ModuleLogin 
{   
	public function login(){
		if(isset($_POST['account'])&&isset($_POST['password'])){
			$sqlSearch = 'SELECT userId, type FROM user WHERE account=:account AND password=:password';
			$search    = $GLOBALS['conn']->prepare($sqlSearch);
			$search->execute([':account'=>$_REQUEST['account'], ':password'=>$_REQUEST['password']]);
			$result = $select->fetch(PDO::FETCH_OBJ);
			if(empty($result)) return 'wrong account or password!';
			else{
				$_SESSION['userId']=$result->userId;
				$_SESSION['userType']=$result->type;
				return;
			}
		}
		return 'account or password can\'t be empty!';
	}
}

?>
