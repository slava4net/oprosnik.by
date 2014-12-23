<!DOCTYPE html> 
<html>
	<head>
	<title>TITLE</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="javascript" type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
	<script language="javascript" type="text/javascript" src="../../js/jquery.colorPicker.js"></script>
	<script language="javascript" type="text/javascript" src="../../js/js.js"></script>
	

	<link href="../../css/thank.css" type="text/css" rel="stylesheet" title="style" media="all" />
	<link href="../../css/colorPicker.css" type="text/css" rel="stylesheet" title="style" media="all" />
	
	</head>
	<body>
		<div class="main">
			<div class="header">
				<div class="preview"><a href="#">Preview fullsize (1080x1920)</a></div>
				<div class="title">Editing your thank page</div>
				<div class="authorisation"><div class="name"><?php if($_SESSION['user_name']) echo $_SESSION['user_name'];?></div><a href="/auth/logout">Logout</a><div class="clear"></div></div>
				<div class="clear"></div>
			</div>
			
			<div class="left">
				<div class="surwey" <?php if($data[0]['thank_back_color']) echo "style='background-color: ".$data[0]['thank_back_color'].";'"; ?>>
					<div class="workspace thank-height">					
					<!--
					<div class="thank-container">
						<div class="thank-text" contenteditable="true"   onkeydown="autoMargin('.thank-container', '.thank-text');"><?php if($data[0]['thank_page']) echo $data[0]['thank_page'];?>222</div>
					</div>
					-->
					
					<div class="question">
						<div class="qchild" contenteditable="true"   onkeydown="autoMargin('.question', '.qchild');"><?php if($data[0]['thank_page']) echo $data[0]['thank_page']; else echo "222";?></div>
						<form id='save_form' action='/edit_thank/save_page' method='POST'>
							<input type='hidden' name='backcolor' value='' id='backcol'/>
							<input type='hidden' name='content' id='hide_input' value='<?php if($data[0]['thank_page']) echo $data[0]['thank_page'];?>' /><!---->
						</form>
					</div>

					</div>
					<!-- <div class="submit">SUBMIT</div> -->
				</div>
			</div>
			<div class="right">
				<div class="control-panel">
			<!--	<input type='button' onclick='set_bg();' value='Установить картинку'/>-->
					<div class="block">
						<div class="title">Select background</div>
						<div class="colorpicker" <?php if($data[0]['thank_back_color']) echo "style='background-color: ".$data[0]['thank_back_color'].";'"; ?>><input id="color" type="text" name="color"  <?php if($data[0]['thank_back_color']) echo "value='".$data[0]['thank_back_color'].";'"; else echo "value='#333399'"; ?>/></div>
							<div class="wrapfile">
								<div class="btnfile">Browse</div>
								<input type="file" name="file" id="file" size="1">
							</div>
							<div class="clear"></div>
					</div>
	
					<div class="block">
						<img src="images/editor.png">
						<div id='buttons'></div>
					</div>
					<div class="save-panel"><!--
						<div class="draft"><a href="#"><img src="../../images/floppy1.png">Save draft</a></div>-->
						<div class="finish" onclick="saveThankPage();"><a class="save-finish" href="#">Finish</a></div>
						<div class="clear"></div>
					</div>
			
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</body>
	<script language="javascript" type="text/javascript" src="../../js/saveThankPage.js"></script>
	<script language="javascript" type="text/javascript" src="../../js/set_bg_file.js"></script>
	<script language="javascript" type="text/javascript" src="../../js/run.js"></script>
	<script language="javascript" type="text/javascript" src="../../js/editor.js"></script>
</html>