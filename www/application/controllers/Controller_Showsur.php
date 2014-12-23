<?php
class Controller_Showsur extends Controller{
	function __construct(){
		//вызываем конструктор суперкласса, в котором создаест€ экземпл€р класса View
		parent:: __construct();
		//создаем экземпл€р класса Model_Find
		$this->model=new Model_Showsur();
	}
	function action_index(){
		if($_SERVER['REQUEST_METHOD']=='GET'){
			if(isset($_GET['id'])){
				// $this->model->get_dataSur($_GET['id']);
			}
		}
	}
	function action_rb(){
		if($_SERVER['REQUEST_METHOD']=='GET'){
			if(isset($_GET['id'])){
				// вынимаем идентификатор пользователя, для показа thank page
				$data['id_for_thankpage'] = $_SESSION['user_id'];
				$data['res'] = $this->model->get_dataRb($_GET['id']);
				if(!$data['res']){
					Route::ErrorPage404();
				}
				$this->view->generate(null,$data,'radio.php');
			}
		}
	}
	function action_chb(){
		if($_SERVER['REQUEST_METHOD']=='GET'){
			if(isset($_GET['id'])){
				// вынимаем идентификатор пользователя, для показа thank page
				$data['id_for_thankpage'] = $_SESSION['user_id'];
				$data['res'] = $this->model->get_dataChb($_GET['id']);
				if(!$data['res']){
					Route::ErrorPage404();
				}
				$this->view->generate(null,$data,'check.php');
			}
		}
	}
}