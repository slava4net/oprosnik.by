<?php
class Controller_Register extends Controller{
	function __construct(){
		//вызываем конструктор суперкласса, в котором создаест¤ экземпл¤р класса View
		parent:: __construct();
		//создаем экземпл¤р класса Model_Find
		$this->model=new Model_Register();
	}
	function action_index(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if(isset($_GET['id'])){
				// $this->model->get_dataSur($_GET['id']);
			}
		}
	}
	function action_reg_rb(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if(isset($_POST['id'],$_POST['answ'])){
				$res=$this->model->register_rb($_POST['id'],$_POST['answ']);
				$this->view->generate(null,$res,'thankyou_show.php');
			}
		}
	}
	function action_reg_chb(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if(isset($_POST['id'])){
				$ar_id_answ;
				foreach($_POST as $key=>$val){
					// echo strpos($key,"answ");
					if(strpos($key,"answ")===0){
						// echo $key.' val-'.$val;
						$ar_id_answ[] = $val;
					}
				}
				// echo "<pre>"; print_r($_POST);
				// echo "</pre>";
				$res=$this->model->register_chb($_POST['id'],$ar_id_answ);
				$this->view->generate(null,$res,'thankyou_show.php');
			}
		}
	}
}