<?php
class Model_Edit_thank extends Model{
	function get_data(){
		$user_id = $_SESSION['user_id'];
		$this->connect();
		$user_id = $this->clean_query($user_id);
		$query = "SELECT id,thank_page,thank_back_color FROM users WHERE active='1' AND id='".$user_id."'";
		$res=$this->get_dataAr($query);
		$this->disconnect();
		return $res;
	}
	function save_page($content,$backcolor){
		$this->connect();
		$content = $this->clean_query($content);
		$backcolor = $this->clean_query($backcolor);
		if(!$_SESSION['user_id']) die('У вас нет полномочий для выполнения операции');
		$id = $this->clean_query($_SESSION['user_id']);
		$query = "UPDATE users SET thank_page='$content',thank_back_color='".$backcolor."' WHERE id=$id";
		$this->query_toDb($query);
		$this->disconnect();
	}
}