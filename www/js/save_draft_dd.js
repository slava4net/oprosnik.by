function save_draft_dd(){
	//получаем все контейнеры, которые содержат вопросы с ответами
	var container = document.getElementsByClassName('answer');
	var count_quest = container.length;
	var arr_quest_answ = new Array();
	for(var i = 0;i<count_quest;i++){
		var ar = new Array();
		// получаем всех детей для этого элемента
		var childs = container.item(i).childNodes;
		// получаем вопрос
		ar['question'] = childs[1].firstChild.innerHTML;
		// получаем элемент, содержащий ответы и текстовые узлы
		var tmp = childs[2].firstChild;
		alert(childs[2]);
		// получаем детей этого элемента
		var ch_n = tmp.childNodes;
		// фильтруем - отсекаем элементы(текстовые узлы) оставляем ul
		var ul=null;
		for(var j=0;j<ch_n.length;j++){
			if(ch_n.item(j).toString() == '[object HTMLUListElement]'){
				ul=ch_n.item(j);
			}
		}
		// получаем детей для ul - li
		var a = new Array();
		var counter = 0;
		var tmp_li = ul.childNodes;
		for(var j = 0;j<tmp_li.length;j++){
			if(tmp_li.item(j).toString()=='[object HTMLLIElement]'){
				a[counter++]=tmp_li.lastChild.innerHTML;
			}
		}
		ar['answers']=a;
		arr_quest_answ[i] = ar;
	}
	alert(JSON.parse(arr_quest_answ));
}