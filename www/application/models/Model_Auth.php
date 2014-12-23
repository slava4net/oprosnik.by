<?php
class Model_Auth extends Model{
	function is_auth_user($username,$password){
		$this->connect();
		$username = $this->clean_query($username);
		$pass = $this->clean_query($pass);
		$query = "SELECT id,name FROM users WHERE username='".$username."' AND password='".$password."' AND active='1' LIMIT 1";
		$result = $this->get_dataAr($query);
		$this->disconnect();	
		if($result){
			$_SESSION['user_name'] = $result[0]['name'];
			$_SESSION['user_id'] = $result[0]['id'];
		}
	}
	function logout(){
		if(isset($_SESSION['user_name'],$_SESSION['user_id'])){
			session_unset($_SESSION['user_name']);
			session_unset($_SESSION['user_id']);
			session_destroy();
		}
	}
}