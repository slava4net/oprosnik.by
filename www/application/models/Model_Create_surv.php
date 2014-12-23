<?php
class Model_Create_surv extends Model{
	function create_survey($name,$layout,$type_form){
		if(isset($_SESSION['user_id'])){
			$this->connect();
			$name = $this->clean_query($name);
			$type_form = $this->clean_query($type_form);
			$layout = $this->clean_query($layout);
			$query = "INSERT INTO surveys (user_id,name,type_of_select,layout,active) VALUES ('".$_SESSION['user_id']."','$name','$type_form','".$layout."','0')";
			$this->query_toDb($query);
			// echo $query; die();
			$query = "SELECT DISTINCT @@IDENTITY as id FROM surveys";
			$res = $this->get_dataAr($query);
			$this->disconnect();
			return $res[0]['id'];
		}
	}
	function getDataSur($id){
		$this->connect();
		$id=$this->clean_query($id);
		// получаем данные для опроса
		$query = "SELECT id,name,type_of_select,size_but,back_color,layout FROM surveys WHERE id='$id' LIMIT 1";
		$sur = $this->get_dataAr($query);
		// проверяем, что этот опрос не с радиобаттонами
		if($sur){
			// массив для хранения возвращаемого результата
			$data['sur']=$sur;
			$id_s = $this->clean_query($sur[0]['id']);
			$query = "SELECT id,id_survey,text_quest,position_num FROM questions WHERE id_survey='$id_s'";
			$questions = $this->get_dataAr($query);
			if($questions){
				$data['questions'] = $questions;
				// получим массив идентификаторов вопросов, для поиска ответов
				$quest;
				foreach($questions as $q){
					$quest[]=$q['id'];
				}
				$quest_id = implode(',',$quest);
				$query = "SELECT id,text_answer,position_answ,id_question FROM answers WHERE id_question IN ($quest_id) ORDER BY position_answ";
				$answers = $this->get_dataAr($query);
				if($answers){
					$data['answers'] = $answers;
				}
			}
			$this->disconnect();
			return $data;
		}else{
			$this->disconnect();
			return false;
		}
		return false;
	}
}