function saveThankPage(){
	// получаем контент и заталкиваем его в форму
	document.getElementById('hide_input').value=document.getElementsByClassName('qchild').item(0).innerHTML;
	// document.getElementById('file').files.item(0) - для получения файла
	// получаем фоновый цвет и передаем в форму
	document.getElementById('backcol').value=document.getElementsByClassName('surwey').item(0).style.backgroundColor;
	// отправляем форму
	document.getElementById('save_form').submit();
}