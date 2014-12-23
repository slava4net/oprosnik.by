<?php
class Model_Register extends Model{
	function register_rb($id,$answ){
		$this->connect();
		$answ = $this->clean_query($answ);
		$query = "UPDATE answers SET select_count = select_count + 1 WHERE id='$answ'";
		$this->query_toDb($query);
		$id = $this->clean_query($id);
		$query = "SELECT thank_page,thank_back_color FROM users WHERE id='$id'";
		$res = $this->get_dataAr($query);
		$this->disconnect();
		return $res;
	}
	function register_chb($id,$ar_id_answ){
		$this->connect();
		if($ar_id_answ){
			foreach($ar_id_answ as &$el){ $el=$this->clean_query($el);}
			unset($el);
			$query = "UPDATE answers SET select_count = select_count + 1 WHERE id IN (".implode(',',$ar_id_answ).")";
			$this->query_toDb($query);
			// die($query);
		}
		$id = $this->clean_query($id);
		$query = "SELECT thank_page,thank_back_color FROM users WHERE id='$id'";
		$res = $this->get_dataAr($query);
		$this->disconnect();
		return $res;
	}
}
