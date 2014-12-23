<?php
class Controller_Export extends Controller{
	function __construct(){
		//вызываем конструктор суперкласса, в котором создаестя экземпляр класса View
		parent:: __construct();
		//создаем экземпляр класса Model_Main
		$this->model=new Model_Export();
	}
	function action_index(){
		if(isset($_POST['id']) AND $_POST['id'] != ''){
			$id = $_POST['id'];
			$ex = $this->model->get_survey($id);
		}else{return null;}
	}
	function action_delete(){
		echo 'del';
	}
}
?>