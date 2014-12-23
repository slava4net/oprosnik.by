<!DOCTYPE html> 
<html>
	<head>
	<title>TITLE</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="javascript" type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
	<script language="javascript" type="text/javascript" src="../../js/jquery.colorPicker.js"/></script>
	<script language="javascript" type="text/javascript" src="../../js/js.js"/></script>
	<script language="javascript" type="text/javascript" src="../../js/change_sizeDD.js"/></script>
	<script language="javascript" type="text/javascript" src="../../js/save_draft_dd.js"/></script>
	
	<!--     <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css' /> -->
	<!-- <script type="text/javascript" src="js/modernizr.custom.79639.js"></script>  -->
	<!-- <noscript><link rel="stylesheet" type="text/css" href="css/noJS.css" /></noscript> -->

	<link href="../../css/one.css" type="text/css" rel="stylesheet" title="style" media="all" />
	<link href="../../css/colorPicker.css" type="text/css" rel="stylesheet" title="style" media="all" />
	<link href="../../css/dropdown.css"  rel="stylesheet" type="text/css" />
	</head>
	<body>
		<script type='text/javascript'>
			var dd_sizer = new change_sizeDD(<?php if(isset($data['d_size'])) echo $data['d_size']; else echo 1; ?>);
			function del_answer(elem){
				var ul = elem.parentNode.parentNode;
				// отсекаем текстовые узлы
				var count = ul.childNodes.length;
				var arr = new Array();
				var counter = 0;
				for(var i=0;i<count;i++){
					if(ul.childNodes.item(i).toString() == '[object HTMLLIElement]')
						arr[counter++]=ul.childNodes.item(i);
				}
				alert(arr.length);
				if(arr.length>2){
					ul.removeChild(elem.parentNode);
					p.init(p);
				}else{
					ul.removeChild(elem.parentNode);
					add_answer(arr[1].firstChild);
				}
				p.init(p);
			}
			function add_answer(elem){
				ul = elem.parentNode.parentNode;
				var li = document.createElement('li');
				ul.insertBefore(li,elem.parentNode);
				var span = document.createElement('span');
				span.className = "del";
				span.onclick = function(){del_answer(this);}
				li.appendChild(span);
				var img = document.createElement('img');
				img.src = "../../images/del.png";
				span.appendChild(img);
				var div_ed = document.createElement('div');
				div_ed.contentEditable = 'true';
				div_ed.className = 'answ';
				li.appendChild(div_ed);
				// new DropDown( $('.wrapper-dropdown') );
				p.init(p);
			}
			function del_quest(elem){
				elem.parentNode.parentNode.removeChild(elem.parentNode);
				if(document.getElementsByClassName('answer').length==0){
					add_quest();
				}else{
					// var dd1 = new DropDown( $('.wrapper-dropdown') );
				}
				autoMargin(".answers-drop", ".answer");
				p.init(p);
			}
			function add_quest(){
				var parent = document.getElementsByClassName('answers-drop').item(0);
				var divansw = document.createElement('div');
				divansw.className = 'answer';
				parent.appendChild(divansw);
				// -- del --
				var divdel = document.createElement('div');
				divdel.className = 'del';
				divdel.onclick= function(){del_quest(this)};
				var img = document.createElement('img');
				img.src = "../../images/del.png";
				divdel.appendChild(img);
				divansw.appendChild(divdel);
				// -- quest --
				var divdrop_q = document.createElement('div');
				divdrop_q.className = 'drop-question';
				var divqchild = document.createElement('div');
				divqchild.className = 'qchild';
				divqchild.contentEditable = 'true';
				divdrop_q.appendChild(divqchild);
				divansw.appendChild(divdrop_q);
				// ---answ---
				var divdrop_answ = document.createElement('div');
				divdrop_answ.className = "drop-answers";
				divansw.appendChild(divdrop_answ);
				var divwraper_down = document.createElement('div');
				// divwraper_down.id = "dd-1";
				divwraper_down.className = "wrapper-dropdown";
				divdrop_answ.appendChild(divwraper_down);
				var text_n = document.createTextNode("Please click to add question(s)");
				divwraper_down.appendChild(text_n);
				var ul = document.createElement('ul');
				ul.className = "dropdown";
				divwraper_down.appendChild(ul);
				var li = document.createElement('li');
				ul.appendChild(li);
				var span = document.createElement('span');
				span.className = "del";
				span.onclick = function(){del_answer(this);}
				li.appendChild(span);
				var img = document.createElement('img');
				img.src = "../../images/del.png";
				span.appendChild(img);
				var div_ed = document.createElement('div');
				div_ed.contentEditable = 'true';
				div_ed.className = 'answ';
				li.appendChild(div_ed);
				// --- textnode type here to add a new answer
				var li = document.createElement('li');
				ul.appendChild(li);
				var div_add = document.createElement('div');
				div_add.className = 'add-new-answer';
				div_add.onclick = function(){add_answer(this);};
				div_add.innerHTML = 'type here to add a new answer ';
				li.appendChild(div_add);
				var div_clear = document.createElement('div');
				div_clear.className = 'clear';
				divdrop_answ.appendChild(div_clear);
				autoMargin(".answers-drop", ".answer");
				addEvent(divwraper_down);
				p.init(p);
			}
		</script>
		<div class="main">
			<div class="header">
				<div class="preview"><a href="#">Preview fullsize (1080x1920)</a></div>
				<div class="title">Create a new surwey</div>
				<div class="authorisation"><div class="name"><?php if(isset($_SESSION['user_name'])) echo $_SESSION['user_name'];?></div><a href="/auth/logout">Logout</a><div class="clear"></div></div>
				<div class="clear"></div>
			</div>
			
			<div class="left">
				<div class="surwey">
					<div class="workspace">
						<div class="answers-drop">
 								<div class="answer">
									<div class="del" onclick='del_quest(this);'><img src="../../images/del.png"></div>
									<div class="drop-question"><div class="qchild" contenteditable="true"></div></div>
									<div class="drop-answers">
										<div id="dd-1" class="wrapper-dropdown">				
												Please click to add question(s)
												<ul class="dropdown">
													<li><span class="del" onclick='del_answer(this);'><img src="../../images/del.png"></span><div contenteditable="true" class='answ'></div></li>
													<li><div class="add-new-answer" onclick = 'add_answer(this);'>type here to add a new answer </div></li>
												</ul>
										</div>
										<div class="clear"></div>	
									</div>
								</div>						
						</div>
					</div>
					<div class="submit">SUBMIT</div>
				</div>
			</div>
			<div class="right">
				<div class="control-panel">
					<div class="block">
						<div class="sname">Name: <span contenteditable="true"><?php if($data['name']) echo $data['name'];?></span></div>
					</div>
					
					<div class="block">
						<div class="title">Select background</div>
						<div class="colorpicker"><input id="color" type="text" name="color" value="#333399" /></div>
							<div class="wrapfile">
								<div class="btnfile">Browse</div>
								<input type="file" name="file" id="file" size="1">
							</div>
							<div class="clear"></div>
					</div>
					
					<div>
						
					</div>
					
					<div class="block">
						<div class="title">Dropdown size</div>
						<div class="elmsize"><img src="../../images/drop.png"></div>
							<div class="number">							
							<div class="num"><?php if(isset($data['d_size'])) echo $data['d_size']; else echo '1';?></div>
								<div id='sizeup' onclick='dd_sizer.size_up();'><img src="../../images/arrowup.gif"></div>
								<div id='sizedown' onclick='dd_sizer.size_down();'><img src="../../images/arrowdown.gif"></div>
							<div class="clear"></div>
							</div>
							<div class="clear"></div>
					</div>
					
					<div class="block">
						<div class="add" onclick="add_quest();"><a href="#"><img src="../../images/plus.png"><span>Add a new question</span></a></div>
					</div>
					
					<div class="block">
						<img src="../../images/editor.png">
						<div id='buttons'></div>
					</div>
					
					<div class="block">
						<div class="thank"><a href="/edit_thank"><img src="../../images/shake.png"><span>Edit thank you page</span></a></div>
					</div>
					
					<div class="save-panel">
						<div class="draft" onclick='save_draft_dd();'><a href="#"><img src="../../images/floppy1.png">Save draft</a></div>
						<div class="finish"><a class="save-finish" href="#">Finish</a></div>
						<div class="clear"></div>
					</div>
			
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</body>
	<script type='text/javascript'>
		var classname = {};
		classname.quest = 'qchild';
		classname.answers = 'answ';
	</script>
	<script language="javascript" type="text/javascript" src="../../js/editor.js"/></script>
	<script language="javascript" type="text/javascript" src="../../js/xmlhttp.js"/></script>
	<script language="javascript" type="text/javascript" src="../../js/run.js"/></script>
</html>