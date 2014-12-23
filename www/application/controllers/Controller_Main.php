<?php
class Controller_Main extends Controller{
	function __construct(){
		//вызываем конструктор суперкласса, в котором создаестя экземпляр класса View
		parent:: __construct();
		//создаем экземпляр класса Model_Main
		$this->model=new Model_Main();
	}
	function action_index(){
		if($_SERVER['REQUEST_METHOD']=='GET'){
			$id;
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}
			$this->model->connect();
			$surveys = $this->model->get_all_surveys();
			// если опросы есть
			if($surveys){
				// если id не задан пользователем (метод GET)
				if(!$id)	// берем первый опрос в списке
					$id=$surveys[0]['id'];
				$sur;
				// находим опрос, для которого будем отображать статистику
				// для активного выставляем элемент ['active']=true, другим false
				// так же, расталкиваем идентификаторы в 3 массива, согласно содержимому
				// радиобаттоны ,чекбоксы, дропдауны
				$rb = array();
				$chb = array();
				$dd = array();
				foreach($surveys as &$s){
					switch($s['type_of_select']){
						case 0: $rb[]=$s['id']; break;
						case 1: $chb[]=$s['id']; break;
						case 2: $dd[]=$s['id']; break;
						default: break;
					}
					if($s['id']==$id)
						$s['activeb']=true;
					else
						$s['activeb']=false;
				}
				unset($s);
				$data['id_sel'] = $id;
				// убираем теги
				// передаем полученный массив опросов
				$data['surveys'] = $surveys;
				// получаем данные для отображения статистики
				$my_data=$this->model->getData($id);
				$color = array('#FF0F00', '#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#B0DE10','#B0DE11','#B0DE12','#FF6600','#FF9E01','#FCD202','#B0DE09','#FF0F00','#F8FF01', );
				if($my_data['questions'][0]){
					if($my_data['answers']){
						// получаем идентификатор для этого опроса
						$id_sur = $my_data['questions'][0]['id_survey'];
						// проверяем, в каком массиве идентификатор текущего опроса
						$prefix = '';
						if(in_array($id_sur,$rb)){
							$prefix = 'rb';
						}else if(in_array($id_sur,$chb)){
							$prefix = 'chb';	
						}else if(in_array($id_sur,$dd)){
							$prefix = 'dd';
						}
						$res;
						$i=0;
						foreach($my_data['answers'] as $answ){
							$tmp['answer']=addslashes($answ['text_answer']);
							$tmp['count']=$answ['select_count'];
							$tmp['color']=$color[$i++];
							$res[]=$tmp;
						}
						$data['surwey_link'] = 'http://'.$_SERVER['SERVER_NAME'].'/showsur/'.$prefix.'?id='.$data['id_sel'];
						// $res = json_encode($res);
						$data['answers']= $res;
					}
					$data['quest_text']=$my_data['questions'][0]['text_quest'];
				}
				$data['survey']=json_encode($res);
			}
			$this->model->disconnect();
			$this->view->generate(null,$data,'statistics.php');
		}
	}
	function action_delete(){
		if($_SERVER['REQUEST_METHOD']=='GET'){
			if(isset($_GET['del'])){
				$this->model->delete_surv($_GET['del']);
			}
		}
		header('Location: /main');
		exit;
	}
}
?>