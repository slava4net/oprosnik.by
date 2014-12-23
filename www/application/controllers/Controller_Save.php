<?php
class Controller_Save extends Controller{
	function __construct(){
		//вызываем конструктор суперкласса, в котором создаестя экземпляр класса View
		parent:: __construct();
		//создаем экземпляр класса Model_Find
		$this->model=new Model_Save();
	}
	function action_index(){
		$data['center_header'] = "Create a new survey";
		$this->view->generate('create_surv_select_param.php',$data);
	}
	function action_saverb_portrait(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if(isset($_POST['question'],$_POST['answer_s'],$_POST['settings'])){
				$a='';
				$question = json_decode($_POST['question'],true);
				$answer_s = json_decode($_POST['answer_s'],true);
				$settings = json_decode($_POST['settings'],true);
				// print_r($question);
				// print_r($answer_s);
				// print_r($settings); die();
				$this->model->connect();
				if($res=$this->model->saverb_portrait($question,$answer_s,$settings)){
					$this->model->disconnect();
					echo json_encode($res);
				}else{
					$this->model->disconnect();
					echo 'false';
				}
			}else{
				echo 'data is not set!';
			}
		}
	}
	function action_set_activeb_portrait(){
		if($_SERVER['REQUEST_METHOD']=='GET'){
			if(isset($_GET['sur'])){
				if($_GET['sur']){
					$this->model->connect();
					$this->model->set_activeb_portrait($_GET['sur']);
					$this->model->disconnect();
				}
			}
		}
		header('Location: /main');
		exit;
	}
}