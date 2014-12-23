<?php
class ViewSelecter{
	// возвращает имя файла, который необходимо подключать в вид, исходя из типа вариантов ответа и расположения
	static function getFileName($type_form,$layout){
		$file ='';
		switch($type_form){
			case 0: $file='radiobutton_'; break; // radiobutton
			case 1: $file='checkbox_'; break; // checkbox
			case 2: $file='drop-down_'; break; // drop-down menu
			default: return null; break;// я х.з.
		}
		switch($layout){
			case 0: $file .= 'w1080h1920.php'; break; //portrait
			case 1: $file .= 'w1920h1080.php'; break; //landscope
			default: return null; break;
		}
		return $file;
	}
}
?>