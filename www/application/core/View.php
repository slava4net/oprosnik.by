<?php
class View{
	//общий вид по умолчанию.
    private $template_view="template_view.php";
	//метод будет принимать на вход страницу, на которой будут отображаться данные, передаваемые вторым параметром
    function generate($content_view=null, $data = null,$template_view = null){
		if($template_view){
			$this->template_view = $template_view;
		}
		if(file_exists("application/views/".$this->template_view))
			include "application/views/".$this->template_view;
    }
}
?>