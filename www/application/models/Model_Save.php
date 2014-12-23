<?php
class Model_Save extends Model{
	// сохраняет содрежимое опроса на радиобаттонах из редактора
	function saverb_portrait($question,$answer_s,$settings){
		// получаем вопрос для этой темы, если он есть
		// если в настройках не пришел идентификатор опроса, выбрасываем false
		if(!$settings['surid'])
			return false;
		// меняем name в опросе, который пришел в $settings
		$sur_name = $this->clean_query($settings['surname']);
		$sur_id = $this->clean_query($settings['surid']);
		$size_but = $this->clean_query($settings['size_but']);
		$backgroundColor = $this->clean_query($settings['backgroundColor']);
		$query = "UPDATE surveys SET name='$sur_name',size_but='".$size_but."',back_color='".$backgroundColor."' WHERE id = '$sur_id'";
		$this->query_toDb($query);
		$query = "SELECT id FROM questions WHERE id_survey='".$sur_id."' LIMIT 1";
		$id = $this->get_dataAr($query);
		// return $id.'-ответ';
		// флаг указывает, нужно ли добавлять новый вопрос, либо он уже существует, по умолчанию существует
		$add_newQ = false;
		// для хранения идентификатора вопроса
		$i_d;
		if(!$id){
			$add_newQ = true;
		}else{
			$i_d = $id[0]['id'];
		}
		$text_cont = $this->clean_query($question['text']);
		// здесь у вопроса позиция будет 0, потому как он один
		$pos = 0;
		if($add_newQ){
			$query = "INSERT INTO questions(id_survey,text_quest,position_num) VALUES ('".$sur_id."','".$text_cont."','".$pos."')";
			$res = $this->query_toDb($query);
			$query = "SELECT DISTINCT @@IDENTITY as id FROM surveys";
			$res = $this->get_dataAr($query);
			$i_d = $res[0]['id'];
		}
		// return $i_d;
		if(!$i_d)
			return false;
		// если не добавляли вопрос, изменяем данные
		if(!$add_newQ){
			$query = "UPDATE questions SET text_quest='".$text_cont."' WHERE id = '$i_d'";
			$this->query_toDb($query);
		}
		$question['id']=$i_d;
		// проверяем, пришли ли ответы
		if($answer_s){
			// теперь получаем все ответы для этого опроса
			$query = "SELECT id FROM answers WHERE id_question='".$i_d ."'";
			$answers = $this->get_dataAr($query);
			if(!$answers){
				// просто добавляем новые ответы
				$counter = 0;
				foreach($answer_s as &$answ){
					$text = $this->clean_query($answ['text']);
					$pos = $counter++;
					$answ['position_answ'] = $pos;
					$id = $this->clean_query($answ['id']);
					$query = "INSERT INTO answers (text_answer,position_answ,select_count,id_question) VALUES ('".$text."','".$pos."','0','".$i_d."')";
					$this->query_toDb($query);
					$query = "SELECT DISTINCT @@IDENTITY as id FROM answers";
					$res = $this->get_dataAr($query);
					$answ['id'] = $res[0]['id'];
				}
				unset($answ);
			}else{
				// иначе,если ответы есть
				// проиндексируем все элементы и зададим им идентификаторы позиций
				$c = count($answer_s);
				for($i=0; $i<$c; $i++){
					$answer_s[$i]['position_answ']=$i;
				}
				// сравниваем id ответов из базы с id ответов, которые пришли со страницы
				// ответы, взятые из базы, идентификаторов которых нет в присланных ответах, удаляем из базы
				// получаем массив идентификаторов, присланных страницей
				$page_id;
				foreach($answer_s as $a){
					if($a['id']){
						$page_id[]=$a['id'];
					}
				}
				// получаем массив идентификаторов ответов из базы
				$db_id;
				foreach($answers as $a){
					$db_id[]=$a['id'];
				}
				// вычисляем расхождение массивов
				if($db_id && $page_id){
					$del = array_diff($db_id,$page_id);
					if($del){
						// если найдены элементы, удаляем из базы неиспользуемые
						$del_str = implode(',',$del);
						$query = "DELETE FROM answers WHERE id IN (".$del_str.")";
						$this->query_toDb($query);
					}
				}else if($db_id && !$page_id){
					// если идентификаторы есть только у элементов из баы данных, удаляем все ответы из базы
					$del_str = implode(',',$db_id);
					$query = "DELETE FROM answers WHERE id IN (".$del_str.")";
					$this->query_toDb($query);
				}
				foreach($answer_s as &$answ){
					$text = $this->clean_query($answ['text']);
					$pos = $this->clean_query($answ['position_answ']);
					$id = $this->clean_query($answ['id']);
					// если идентификатор есть, делаем UPDATE существующей записи
					if($answ['id']){
						$query="UPDATE answers SET text_answer='".$text."',position_answ='".$pos."' WHERE id='".$id."'";
						$this->query_toDb($query);
					// иначе считаем, что нужно добавлять новые записи
					}else{
						$query = "INSERT INTO answers (text_answer,position_answ,select_count,id_question) VALUES ('".$text."','".$pos."','0','".$i_d."')";
						$this->query_toDb($query);
						$query = "SELECT DISTINCT @@IDENTITY as id FROM answers";
						$res = $this->get_dataAr($query);
						$answ['id'] = $res[0]['id'];
					}
				}
				unset($answ);
			}
			$result['question'] = $question;
			$result['answers'] = $answer_s;
			return $result;
		}
		return false;
	}
	function set_activeb_portrait($sur){
		$sur=$this->clean_query($sur);
		$query = "UPDATE surveys SET active='1' WHERE id='".$sur."'";
		return $this->query_toDb($query);
	}
}