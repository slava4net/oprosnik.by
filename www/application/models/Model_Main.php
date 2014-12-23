<?php
class Model_Main extends Model{
	function get_all_surveys(){
		if(isset($_SESSION['user_id'])){
			$id=$this->clean_query($_SESSION['user_id']);
			$query="SELECT id,name,type_of_select,active FROM surveys WHERE user_id = '$id'";
			$surveys = $this->get_dataAr($query);
			// получим массив идентификаторов опросов, которые будем отображать
	 		if($surveys){
				$sur;
				foreach($surveys as $s){
					$sur[]=$s['id'];
				}
				$sur_id = implode(',',$sur);
			}
			// здесь дальше будем вытягивать инфу о каждом опросе
			return $surveys;
		}
		return null;
	}
	function delete_surv($id){
		$this->connect();
		$id=$this->clean_query($id);
		// получаем идентификаторы вопросов для удаляемого опроса
		$query = "SELECT id FROM questions WHERE id_survey = '$id'";
		$res=$this->get_dataAr($query);
		if($res){
			$del;
			foreach($res as $r){
				$del[]=$r['id'];
			}
			$del_id = implode(',',$del);
			// удаляем вопросы 
			$query = "DELETE FROM questions WHERE id IN ($del_id)";
			$this->query_toDb($query);
			// удаляем ответы
			$query="DELETE FROM answers WHERE id_question IN ($del_id)";
			$this->query_toDb($query);
			// удаляем опросы
			$query="DELETE FROM surveys WHERE id IN ($id)";
			$this->query_toDb($query);
		}
		$this->disconnect();
	}
	// получает массив для отображения статистики
	function getData($id){
		$id=$this->clean_query($id);
		$query = "SELECT id,text_quest,position_num,id_survey FROM questions WHERE id_survey='$id'";
		$res=$this->get_dataAr($query);
		if($res){
			$data['questions'] = $res;
			$id_q;
			foreach($res as $r){
				$id_q[]=$r['id'];
			}
			$id_qStr = implode(',',$id_q);
			// получаем ответы для воросов
			$query = "SELECT id,text_answer,position_answ,id_question,select_count FROM answers WHERE id_question IN ($id_qStr)";
			$answ = $this->get_dataAr($query);
			if($answ){
				// формируем необходимый массив
				$data['answers'] = $answ;
				return $data;
			}
		}
		return false;
	}
}