<!DOCTYPE html> 
<html>
	<head>
	<title>TITLE</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="javascript" type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
	<script language="javascript" type="text/javascript" src="../../js/jquery.colorPicker.js"/></script>
	<script language="javascript" type="text/javascript" src="../../js/js.js"/></script>
	

	<link href="../../css/one.css" type="text/css" rel="stylesheet" title="style" media="all" />
	<link href="../../css/colorPicker.css" type="text/css" rel="stylesheet" title="style" media="all" />
	</head>
	<body>
		<input type='hidden' id='surid' value='<?php if(isset($data['id_sur'])) echo $data['id_sur'];?>'>
		<script type='text/javascript'>
			var headers = document.getElementsByClassName('qchild');
			if(headers.length>0){
				for(var i=0;i<headers.length;i++){
					headers.item(i).onkeyup = function(){
						autoMargin(".question", ".qchild");
					}
				}
			}
			var addAnsw = function(){
				var container = document.getElementsByClassName('answers').item(0);
				var newansw = document.createElement('div');
				newansw.className = 'answer active';
				container.appendChild(newansw);
				var input = document.createElement('input');
				input.type='hidden';
				input.value = '';
				newansw.appendChild(input);
				var divdel = document.createElement('div');
				divdel.className = 'del';
				var img = document.createElement('img');
				img.src = '../../images/del.png';
				divdel.appendChild(img);
				divdel.onclick = function(){del(divdel);};
				newansw.appendChild(divdel);
				var divimg = document.createElement('div');
				divimg.className = 'elm';
				var img = document.createElement('img');
				img.src = '../../images/rb'+(15*document.getElementsByClassName('num').item(0).innerHTML)+'.png';
				divimg.appendChild(img);
				newansw.appendChild(divimg);
				var ed = document.createElement('div');
				ed.className = 'text';
				ed.contentEditable = 'true';
				ed.onkeydown = function(){autoMargin('.answers', '.answer');};
				newansw.appendChild(ed);
				var divclear = document.createElement('div');
				divclear.className = 'clear';
				newansw.appendChild(divclear);
				autoMargin('.answers', '.answer');
				p.init(p);
			}
			var del = function(elem){
				elem.parentNode.parentNode.removeChild(elem.parentNode);
				if(document.getElementsByClassName('answer').length == 0){
					addAnsw();
				}
				autoMargin('.answers', '.answer');
				p.init(p);
			}
		</script>
		<div class="main">
			<div class="header">
				<div class="preview"><a href="#">Preview fullsize (1080x1920)</a></div>
				<div class="title">Create a new surwey</div>
				<div class="authorisation"><div class="name"><?php if($_SESSION['user_name']) echo $_SESSION['user_name'];?></div><a href="/auth/logout">Logout</a><div class="clear"></div></div>
				<div class="clear"></div>
			</div>
			
			<div class="left">
				<div class="surwey" <?php if($data['back_color']) echo "style='background-color: ".$data['back_color'].";'";?>>
					<div class="workspace">
						<div class="question"><input type='hidden' value=''>
							<div class="qchild"  contenteditable="true" onkeydown="autoMargin('.question', '.qchild');">
								What features would you like to see here for Special Events?
							</div>
						</div>
						<div class="answers">
							<div class="answer active"><input type='hidden' value=''>
								<div class="del" onclick='del(this);'><img src="../../images/del.png"></div>
								<div class="elm"><img src="../../images/rb30.png"></div>
								<div class="text" contenteditable='true' onkeydown="autoMargin('.answers', '.answer');">ANSWER FOR THIS QUESTION  hjkhkjhkjhkhjk jhjhkhkjh hjkhkjh</div>
								<div class="clear"></div>
							</div>			
						</div>
					</div>
					<div class='submit'>SUBMIT</div>
				</div>
			</div>
			<div class="right">
				<div class="control-panel">
					<div class="block">
						<div class="sname">Name: <span contenteditable="true"><?php if($data['name']) echo $data['name'];?></span></div>
					</div>
					
					<div class="block">
						<div class="title">Select background</div>
						<div class="colorpicker"  <?php if($data['back_color']) echo "style='background-color: ".$data['back_color'].";'";?>><input id="color" type="text" name="color" value=" <?php if($data['back_color']) echo $data['back_color'];?>" /></div>
							<div class="wrapfile">
								<div class="btnfile">Browse</div>
								<input type="file" name="file" id="file" size="1">
							</div>
							<div class="clear"></div>
					</div>
					
					<div class="block">
						<div class="title">Radiobutton size</div>
						<div class="elmsize"><img src="../../images/rb30.png"></div>
						<div class="number">							
							<div class="num">2</div>
							<div id='sizeup'><img src="../../images/arrowup.gif"></div>
							<div id='sizedown'><img src="../../images/arrowdown.gif"></div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="block">
						<div class="add" onclick = 'addAnsw();'><a href="#"><img src="../../images/plus.png"><span>Add a new answer</span></a></div>
					</div>
					
					<div class="block">
						<img src="../../images/editor.png">
						<div id='buttons'></div>
					</div>
					
					<div class="block">
						<div class="thank"><a href="/edit_thank"><img src="../../images/shake.png"><span>Edit thank you page</span></a></div>
					</div>
					
					<div class="save-panel">
						<div class="draft"><a href="#"><img src="../../images/floppy1.png">Save draft</a></div>
						<div class="finish"><a class="save-finish" href="#">Finish</a></div>
						<div class="clear"></div>
					</div>
			
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<script language="javascript" type="text/javascript" src="../../js/editor.js"/></script>
		<script language="javascript" type="text/javascript" src="../../js/xmlhttp.js"/></script>
		<script language="javascript" type="text/javascript" src="../../js/save_draft_rb.js"/></script>
			<?php if(isset($data['script'])) echo $data['script'];?>
		<script language="javascript" type="text/javascript" src="../../js/rb_size.js"/></script>
	</body>
	<script language="javascript" type="text/javascript" src="../../js/run.js"/></script>
</html>