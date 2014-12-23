<?php
class Controller_Auth extends Controller{
	function __construct(){
		//вызываем конструктор суперкласса, в котором создаестя экземпляр класса View
		parent:: __construct();
		//создаем экземпляр класса Model_Find
		$this->model=new Model_Auth();
	}
	function action_index(){
		$this->view->generate(null,null,'login.php');
	}
	function action_check(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if(isset($_POST['username'],$_POST['password'])){
				$this->model->is_auth_user($_POST['username'],$_POST['password']);
			}
		}
		header('Location: /');
		exit;
	}
	function action_logout(){
		$this->model->logout();
		header('Location: /');
		exit();
	}
}
