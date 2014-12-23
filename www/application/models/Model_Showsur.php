<?php
class Model_Showsur extends Model{
	function get_dataRb($id){
		$this->connect();
		$id = $this->clean_query($id);
		$query = "SELECT id,name,type_of_select,size_but,back_color,active FROM surveys WHERE type_of_select='0' AND id='$id' AND active='1' LIMIT 1";
		$res = $this->get_dataAr($query);
		if(!$res){
			$this->disconnect(); die($query);
			return false;
		}
		// получаем данные о вопросе из базы
		$query = "SELECT id,text_quest FROM questions WHERE id_survey='$id' LIMIT 1";
		$res_q = $this->get_dataAr($query);
		if(!$res_q){
			$this->disconnect();  die($query);
			return false;
		}
		// получаем данные об ответах
		$q_id = $res_q[0]['id'];
		$query = "SELECT id,text_answer,position_answ,select_count,id_question FROM answers WHERE id_question='$q_id'";
		$res_answ = $this->get_dataAr($query);
		if(!$res_answ){
			$this->disconnect();  die($query);
			return false;
		}
		$this->disconnect();
		$data['sur'] = $res;
		$data['quest'] = $res_q;
		$data['answ'] = $res_answ;
		return $data;
	}
	function get_dataChb($id){
		$this->connect();
		$id = $this->clean_query($id);
		$query = "SELECT id,name,type_of_select,size_but,back_color,active FROM surveys WHERE type_of_select='1' AND id='$id' AND active='1' LIMIT 1";
		$res = $this->get_dataAr($query);
		if(!$res){
			$this->disconnect(); die($query);
			return false;
		}
		// получаем данные о вопросе из базы
		$query = "SELECT id,text_quest FROM questions WHERE id_survey='$id' LIMIT 1";
		$res_q = $this->get_dataAr($query);
		if(!$res_q){
			$this->disconnect();  die($query);
			return false;
		}
		// получаем данные об ответах
		$q_id = $res_q[0]['id'];
		$query = "SELECT id,text_answer,position_answ,select_count,id_question FROM answers WHERE id_question='$q_id'";
		$res_answ = $this->get_dataAr($query);
		if(!$res_answ){
			$this->disconnect();  die($query);
			return false;
		}
		$this->disconnect();
		$data['sur'] = $res;
		$data['quest'] = $res_q;
		$data['answ'] = $res_answ;
		return $data;
	}
}