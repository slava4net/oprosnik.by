 // align_center - нужно добавить в див align='center'
var settings = {
	fontSize: '12px'
}
if(!classname){
	var classname = {};
	classname.quest = 'qchild';
	classname.answers = 'text';
}

var out = function(text){
	// var out = document.getElementById('out');
	// out.innerHTML+=text;
}

var buttons = function(){
	this.link;
	// get block, where has been shows buttons
	this.parent = document.getElementById('buttons');
	this.show_state = 0; //no show buttons
	this.clickBut = null;
	// func initialize button
	this.init_but = function(text,cssprop,cssval,command,anticss){
		var but = document.createElement('input');
		but.type = 'button';
		but.value = text;
		this.parent.appendChild(but);
		var obj = {};
		obj.name = 'but';
		obj.element = but;
		obj.cssProp = cssprop;
		obj.cssVal = cssval;
		obj.anticssVal = anticss;
		obj.command = command;
		return obj;
	}
	this.B = this.init_but('B','fontWeight','bold','bold','normal');
	this.U = this.init_but('U','textDecoration','underline','underline','inherit');
	this.I = this.init_but('I','fontStyle','italic','italic','normal');
	this.A_l = this.init_but('A_l','textAlign','left','justifyLeft','left');
	this.A_c = this.init_but('A_c','textAlign','center','justifyCenter','left');
	this.A_r = this.init_but('A_r','textAlign','right','justifyRight','left');
	this.Undo = this.init_but('Undo',null,null,'undo');
	this.Redo = this.init_but('Redo',null,null,'redo');
	// создает элемент select, который будет содержать в себе значения размера текста в пикс. 
	this.init_select = function(arr,cssprop,cssval,command){
		// создаем элемент select
		var sel = document.createElement('select');
		for(var i = 0; i<arr.length; i++){
			if(arr[i]!=undefined){
				var option = document.createElement('option');
				option.value = arr[i];
				option.innerHTML = arr[i];
				sel.appendChild(option);
			}
		}
		sel.value=cssval;
		this.parent.appendChild(sel);
		var obj = {};
		obj.name = 'select';
		obj.element = sel;
		obj.cssProp = cssprop;
		obj.cssVal = obj.element.value;
		obj.command = command;
		return obj;
	}
	// создает массив, который будет содержать значения в пикселях для select
	this.init_fontsizes = function(){
		var arr = new Array();
		var start = 1,end = 7;
		for(var i = start; i<=end; i++){
			arr[i] = i;
		}
		return this.init_select(arr,'fontSize',settings.fontSize,'fontSize');
	}
	// получаем объект для fontsize
	this.SelFS = this.init_fontsizes();
	// создает массив, который будет содержать значения шрифтов для select
	this.init_fontname = function(){
		var ar = new Array();
		// var ar = [['Arial','sans-serif'],['Times New Roman','serif']];
		var ar = ['Arial','Times New Roman'];
		var select = document.createElement('select');
		for(var i = 0; i<ar.length; i++){
			var option = document.createElement('option');
			option.value = ar[i];
			option.innerHTML = ar[i];
			select.appendChild(option);
		}
		this.parent.appendChild(select);
		var obj = {};
		obj.name = 'select';
		obj.element = select;
		obj.cssVal = obj.element.value;
		obj.command = 'fontName';
		return obj;
	}
	this.SelFN = this.init_fontname();
	// this.init_forecolor = function(){
		// var div = document.createElement('div');
		// div.style.width = '25px';
		// var input = document.createElement('input');
		// input.style.width = '25px';
		// input.type='text';
		// input.id = 'color-font';
		// input.name =  'color';
		// input.value = 'white';
		// input.onchange = function(){
			// this.style.backgroundColor = this.value;
			// p.buttons.SelFC.onchange();
		// }
		// div.appendChild(input);
		// this.parent.appendChild(div);
		// this.parent.appendChild(input);
		// var obj = {};
		// obj.name = 'select';
		// obj.element = input;
		// obj.cssVal = obj.element.value;
		// obj.command = 'foreColor';
		// return obj;
	// }
	// this.SelFC = this.init_forecolor();
	this.init_fcolor = function(){
		var col = ['#002211','#224455','#000000','#ffffff','#FFFF33'];
		var select = document.createElement('select');
		select.style.width = '100px';
		for(var i=0; i<col.length;i++){
			var option = document.createElement('option');
			var text = '<pre><div style="background-color: '+col[i]+'; width: 10px; height: 10px;"></div></pre>';
			option.value = col[i];
			// option.innerHTML = col[i];
			option.style.backgroundColor = col[i];
			select.appendChild(option);
		}
		select.onchange = function(){
			this.style.backgroundColor = this.value;
			//this.style.backgroundColor = this.value;
			p.buttons.SelFTest.onchange();
		}
		this.parent.appendChild(select);
		var obj = {};
		obj.name = 'select';
		obj.element = select;
		obj.cssVal = obj.element.value;
		obj.command = 'foreColor';
		return obj;
	}
	this.SelFTest = this.init_fcolor();
	// метод устанавливает активными все кнопки
	this.set_hide_none = function(){
		this.show_state = 2; 
		this.SelFS.element.removeAttribute('disabled');
		this.B.element.removeAttribute('disabled');
		this.U.element.removeAttribute('disabled');
		this.I.element.removeAttribute('disabled');
		this.A_l.element.removeAttribute('disabled');
		this.A_c.element.removeAttribute('disabled');
		this.A_r.element.removeAttribute('disabled');
		this.Undo.element.removeAttribute('disabled');
		this.Redo.element.removeAttribute('disabled');
	}
	// метод устанавливает все кноппки неактивными
	this.set_hide_all = function(){
		this.show_state = 0;
		this.SelFS.element.disabled='true';
		this.B.element.disabled='true';
		this.U.element.disabled='true';
		this.I.element.disabled='true';
		this.A_l.element.disabled='true';
		this.A_c.element.disabled='true';
		this.A_r.element.disabled='true';
		this.Undo.element.disabled='true';
		this.Redo.element.disabled='true';
	};
	// метод отображает только некоторые кнопки, необходимые при выборе куска текста
	this.set_hide_part = function(){
		this.set_hide_none();
		this.show_state = 1;
		this.A_l.element.disabled='true';
		this.A_c.element.disabled='true';
		this.A_r.element.disabled='true';
		// this.SelFS.element.disabled='true';
	};
};



var page = function(){
	// инициализатор класса кнопок
	this.createBut = function(){
		var b = new buttons();
		b.set_hide_all();
		b.link = b;
		return b;
	}
	// получаем объект для работы с кнопками
	this.buttons = this.createBut();
	this.sel_elem = null;
	// событие, вызываемое при отпускании кнопки клавиатуры либо мыши
	this.myEvent = function(thislink){
		if (window.getSelection){
			var obj1 = window.getSelection();
			//out('obj1.toString()-'+obj1.toString());
			// если выделен элемент
			var flag = true;
			if(obj1.toString() == ''){
				var parent = obj1.anchorNode;
				var size = '';
				while(parent.toString() != '[object HTMLDivElement]'){
					// если находим тег font с размером, получаем размер
					if(parent.tagName == 'font'){
						size=parent.size;
					}
					parent = parent.parentNode;
					if(parent == null){
						return 0;
					}
				}
				// сдесь нуно проверить, что это не див, который
				// задает text-align, сделаем пока проверкой класса
				// alert(classname.answers);
				while(parent.className!=classname.quest && parent.className!=classname.answers){
					// если находим тег font с размером, получаем размер
					// alert('loop-'+parent);
					if(parent == null){
						return 0;
					}
					if(parent.tagName == 'font'){
						size=parent.size;
					}
					parent = parent.parentNode;
					if(parent.className == null){
						break;
					}
				}
				// var size = document.queryCommandValue('fontSize');
				// if(size!=''){
					// this.buttons.SelFS.element.value = size;
				// }
				var color = document.queryCommandValue('foreColor');
				if(color!=''){
					this.buttons.SelFTest.element.style.backgroundColor = color;
				}
				thislink.sel_elem = parent;
				thislink.buttons.set_hide_none();
			// если выделена строка
			}else if(obj1.toString().length>0){
				thislink.buttons.set_hide_part();
				thislink.elem = obj1;
			// если ничего не выделено
			}else{
				thislink.elem = null;
				thislink.buttons.set_hide_all();
				flag = false;
			}
			if(flag){
				// out('parent-'+parent+' select-'+thislink.buttons.show_state);
				var fs = document.queryCommandValue('fontSize');
				// alert(this.buttons.SelFN.element.value);
				if(fs){
					this.buttons.SelFS.element.value = fs;
				}else{
					this.buttons.SelFS.element.value = 1;
				}
				var fn = document.queryCommandValue('fontName');
				// out(fn);
				if(fn){
					this.buttons.SelFN.element.value = fn;
				}else{
					this.buttons.SelFN.element.value = 'Times New Roman';
				}
				var color = document.queryCommandValue('foreColor');
				if(color!=''){
					this.buttons.SelFTest.element.style.backgroundColor = color;
				}
				// alert('Document.queryCommandValue(fontSize)-'+document.queryCommandValue('fontSize'));
			}
		}
	}
	// функция перебирает HTML коллекцию и задает для каждого объекта обработчик событий
	this.set_func_collect_onsel = function(htmlcol,thislink){
		for(var i = 0; i<htmlcol.length; i++){
			htmlcol.item(i).onmouseup = function(){thislink.myEvent(thislink);};
			htmlcol.item(i).onkeyup = function(){thislink.myEvent(thislink);};
		}
	}
	// задает элементы, на которые вешать обработчик событий
	this.init_ed = function(thislink){
		thislink.set_func_collect_onsel(thislink.headers,thislink);
		thislink.set_func_collect_onsel(thislink.answers,thislink);
		thislink.set_func_collect_onsel(thislink.body,thislink);
	}
	// инициализирует свойства объекта
	this.init = function(thislink){
		// находим поля вопросов
		thislink.headers = document.getElementsByClassName(classname.quest);
		// for(var i = 0; i<thislink.headers.length; i++) thislink.headers.item(i).style.fontSize = settings.fontSize;
		thislink.answers = document.getElementsByClassName(classname.answers);
		// for(var i = 0; i<thislink.answers.length; i++) thislink.answers.item(i).style.fontSize = settings.fontSize;
		thislink.body = document.getElementsByClassName('workspace');
		thislink.init_ed(thislink);
		
		// инициализация кнопок
		thislink.buttons.B.element.onclick = function(){thislink.onclick_some(thislink.buttons.B,thislink);};
		thislink.buttons.U.element.onclick = function(){thislink.onclick_some(thislink.buttons.U,thislink);};
		thislink.buttons.I.element.onclick = function(){thislink.onclick_some(thislink.buttons.I,thislink);};
		thislink.buttons.A_l.element.onclick = function(){thislink.onclick_some(thislink.buttons.A_l,thislink);}
		thislink.buttons.A_c.element.onclick = function(){thislink.onclick_some(thislink.buttons.A_c,thislink);};
		thislink.buttons.A_r.element.onclick = function(){thislink.onclick_some(thislink.buttons.A_r,thislink);};
		thislink.buttons.Undo.element.onclick = function(){thislink.onclick_some(thislink.buttons.Undo,thislink);};
		thislink.buttons.Redo.element.onclick = function(){thislink.onclick_some(thislink.buttons.Redo,thislink);};
		thislink.buttons.SelFS.element.onchange = function(){thislink.onclick_some(thislink.buttons.SelFS,thislink);};
		thislink.buttons.SelFN.element.onchange = function(){thislink.onclick_some(thislink.buttons.SelFN,thislink);};
		// thislink.buttons.SelFC.onchange = function(){thislink.onclick_some(thislink.buttons.SelFC,thislink);};
		thislink.buttons.SelFTest.onchange = function(){thislink.onclick_some(thislink.buttons.SelFTest,thislink);};
	}
	// функция, срабатывающая на события кнопок
	this.onclick_some = function(objButton,objthis){
		// alert('i am in switch');
		var state = this.buttons.show_state;
		// при выборе undo redo эти комманды вызываются без параметров
		if(objButton.command=='undo' || objButton.command=='redo'){
			state = 1;
		}
		switch(state){
			// не выбрано ничего
			case 0: out('0'); break;
			// выделена строка
			case 1:
				var param = null;
				if(objButton.command=='fontSize' || objButton.command=='foreColor' || objButton.command=='fontName'){
					param = objButton.element.value;
				}
				document.execCommand(objButton.command,false,param);
				// alert('1 objButton.command-'+objButton.command);
				break;
			// выбран элемент выделен div, строка не выделена
			case 2: 
				var elem;
				// запоминаем Range Объект для текущего выделения
				var sel = window.getSelection();
				var range_s = sel.getRangeAt(0);
				var clone_range = range_s.cloneRange();
				// определяем, с каким HTMLcollection будем работать
				if(objthis.sel_elem.className == classname.quest){
					elem = objthis.headers;
				}else if(objthis.sel_elem.className == classname.answers){
					elem = objthis.answers;
				}else{
					// alert('Блядь!-'+objthis.sel_elem.className);
					elem = null;
				}
				for(var i = 0;i<elem.length;i++){
					var r = document.createRange();
					r.selectNodeContents(elem.item(i));
					var sel = window.getSelection();
					sel.removeAllRanges();
					sel.addRange(r);
					var val;
					if(objButton.name = 'select'){	// если это селект
						val = objButton.element.value;
					}else{
						val = objButton.cssVal;
					}
					document.execCommand(objButton.command,false,val);
					sel.removeAllRanges();
				}
				var sel = window.getSelection();
				sel.removeAllRanges();
				sel.addRange(clone_range);
				break;
			default: alert('default'); break;
		};
	};
	
}


// создаем объект
var p = new page();
// инициализируем свойства объекта
p.init(p);
// p.addEvents(p);


