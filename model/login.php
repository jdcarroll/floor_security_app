<?php  
require_once('db.php');
class UserLogin {
	public function check_login($user, $pass){
		$dbh = new DB();
		$check = $dbh->loginUser($user, $pass);
		if(!empty($check)){
			$result = $check;
			return $result;
		}else{
		}
	}
}
?>