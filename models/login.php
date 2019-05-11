<?php
require ("models/config.php");

class ModuleLogin 
{   
	public function login(){
		if(isset($_POST['account'])&&isset($_POST['password'])){
			$sqlSearch = 'SELECT userId FROM user WHERE account=:account AND password=:password';
			$search    = $GLOBALS['conn']->prepare($sqlSearch);
			$search->execute([':account'=>$_REQUEST['account'], ':password'=>$_REQUEST['password']]);
			$result=$search->fetch();
			if(empty($result)) return 'wrong account or password!';
			else{
				$_SESSION['userId']=$result;
				return;
			}
		}
		return 'account or password can\'t be empty!';
	}
}

?>
