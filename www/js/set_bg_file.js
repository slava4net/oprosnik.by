// устанавливает бэкграундом файл
function set_bg_file(element,file){
	element.style.backgroundImage = 'url('+file+')';
}
// возвращает объект файл, если выбрано изображение
function get_objfile(input){
	if(input.files.length >= 1){
		return input.files.item(0);
	}
	return null;
}
function set_bg(){
	var sur = document.getElementsByClassName('surwey').item(0);
	var file = document.getElementById('file').files.item(0);
	alert(file);
	set_bg_file(sur,file);
}