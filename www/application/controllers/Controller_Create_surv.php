<?php
class Controller_Create_surv extends Controller{
	function __construct(){
		//вызываем конструктор суперкласса, в котором создаестя экземпляр класса View
		parent:: __construct();
		//создаем экземпляр класса Model_Find
		$this->model=new Model_Create_surv();
	}
	function action_index(){
		$data['center_header'] = "Create a new survey";
		$this->view->generate('create_surv_select_param.php',$data);
	}
	function action_edit(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if(isset($_POST['layout'],$_POST['type_form'],$_POST['name'])){
				//if(!empty($_POST['layout']) && !empty($_POST['type_form']) && !empty($_POST['name'])){
					$id = $this->model->create_survey($_POST['name'],$_POST['layout'],$_POST['type_form']);
				//}
				$layout=$_POST['layout'];
				$type_form = $_POST['type_form'];
				if(!$file=ViewSelecter::getFileName($type_form,$layout))
					die('Я умер, потому как не смог сгенерировать файл для этого типа формы и вариантов ответа!');
				// echo "Идентификатор - ".$id;
				// echo "</br>file-".$file."</br>";
				$data['id_sur']= $id;
				$data['name']= $_POST['name'];
				$this->view->generate(null,$data,$file);
			}
		}
		
	}
	function action_edit_surv(){
		if($_SERVER['REQUEST_METHOD']=='GET'){
			if(isset($_GET['id'])){
				// получаем данные для опроса
				$sur = $this->model->getDataSur($_GET['id']);
				if(!$sur){
					die('Ошибка получения информации из БД');
				}
				$layout=$sur['sur'][0]['layout'];
				$type_form = $sur['sur'][0]['type_of_select'];
				$back_color = $sur['sur'][0]['back_color'];
				$script=null;
				if(!$file=ViewSelecter::getFileName($type_form,$layout))
					die('Я умер, потому как не смог сгенерировать файл для этого типа формы и вариантов ответа!');
				if($type_form!='2'){
					// если это не дропдаун
					$script = "<script type='text/javascript'>\n";
					if($sur['sur'][0]['size_but']==0){
						$size = 1;
					}else{
						$size = $sur['sur'][0]['size_but'];
					}
					// добавляем размер радиобаттона
					$script.="document.getElementsByClassName('num').item(0).innerHTML='".$size."';";
					// заполняем данными вопросы
					// $script.="var q = ".$sur['questions']."; ";
					$script.= "var quest = JSON.parse('".addslashes(json_encode($sur['questions']))."');";
					$script.= "var answer_s = JSON.parse('".addslashes(json_encode($sur['answers']))."');";
					$script.="var h = p.headers.item(0);
						if(quest){
							h.innerHTML = quest[0]['text_quest'];
							h.parentNode.firstChild.value=quest[0]['id'];
						
							var len = answer_s.length;
							if(len>1){
								for(var j=0;j<(len-1);j++){
									addAnsw();
								}
							}
							
							p.init(p);
							var l = p.answers.length;
							for(var i=0;i<l;i++){
								p.answers.item(i).innerHTML = answer_s[i]['text_answer'];
								p.answers.item(i).parentNode.firstChild.value=answer_s[i]['id'];
							}
						}
						";
					$script.="</script>";
				}else{
					// если имеем дело с дропдауном
					echo "<pre>";
					print_r($sur);
					echo "</pre>";
					// die('для дропдауна еще не написано кода!');
				}
				$data['d_size']=null;
				$data['back_color']=$back_color;
				$data['script']=$script;
				$data['id_sur']= $sur['sur'][0]['id'];
				$data['name']= $sur['sur'][0]['name'];
				$this->view->generate(null,$data,$file);
			}
		}
	}
}