function save_draft_rb(flag){
	// ---------------------- заголовок ----------------------
	var tmp = p.headers.item(0);
	var question = {
		"type": "question",
		"id": tmp.parentNode.firstChild.value,
		"text": tmp.innerHTML,
		"textAlign": tmp.style.textAlign,
		"fontSize": tmp.style.fontSize
	}
	// -------------------------------- далее для ответов----------------------
	var counter = 0;
	var answ = p.answers;
	var answer_s = new Array();
	for(var i = 0; i<answ.length; i++){
		answer_s[counter++] = {
			"type": "answer",
			"id": answ.item(i).parentNode.firstChild.value,
			"text": answ.item(i).innerHTML,
			"textAlign": answ.item(i).style.textAlign,
			"fontSize": answ.item(i).style.fontSize
		}
	}
	// ------------------------ общие настройки
	var settings = {
		"type": "settings",
		"backgroundColor": document.getElementsByClassName('surwey').item(0).style.backgroundColor,
		"surname": document.getElementsByClassName('sname').item(0).childNodes.item(1).innerHTML,
		"surid": document.getElementById('surid').value,
		"size_but": document.getElementsByClassName('num').item(0).innerHTML
	}
	var question = JSON.stringify(question);
	var answer_s = JSON.stringify(answer_s);
	var settings = JSON.stringify(settings);
	var data = new Array();
	data[0] = {name: 'question',value: question};
	data[1] = {name: 'answer_s',value: answer_s};
	data[2] = {name: 'settings',value: settings};
	// alert(data[1]['value']);
	var url='/save/saverb_portrait';
	var func = function(request){
		// request = JSON.parse(request);
		//проверяем, если флаг(передаваемый параметр) true, тогда нажата кнопка финиш
		// после сохранения переадресовываем на метод, который будет делать активным наш опрос
		if(flag){
			window.location.href='/save/set_activeb_portrait?sur='+document.getElementById('surid').value;
		}
		var obj = JSON.parse(request);
		var question = obj['question'];
		var answers = obj['answers'];
		var answ = p.answers;
		for(var i=0;i<answ.length;i++){
			answ.item(i).parentNode.firstChild.value = answers[i]['id'];
		}
		p.headers.item(0).parentNode.firstChild.value = question['id'];
		// alert(request);
	}
	send_mydata(url,data,func)
	// var a = new Array();
	// a[0] = '0';
	// a[1] = '1';
	// send_mydata(JSON.stringify(a));
}
document.getElementsByClassName('draft').item(0).onclick = function(){save_draft_rb(false);};
document.getElementsByClassName('finish').item(0).onclick = finish;
function finish(){
	save_draft_rb(true);
}