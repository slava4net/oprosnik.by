<?php
class Controller_Edit_thank extends Controller{
	function __construct(){
		//вызываем конструктор суперкласса, в котором создаестя экземпляр класса View
		parent:: __construct();
		//создаем экземпляр класса Model_Main
		$this->model=new Model_Edit_thank();
	}
	function action_index(){
		// получаем данные для thank you page
		$thank_page = $this->model->get_data();
		$this->view->generate(null,$thank_page,'thankyou.php');
	}
	function action_save_page(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if(isset($_POST['content'])){
				$this->model->save_page($_POST['content'],$_POST['backcolor']);
				header('Location: /main');
				exit;
			}
		}
	}
}