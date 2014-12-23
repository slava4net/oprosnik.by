<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Survey</title>
		<meta charset="utf-8">    
		
		<!--[if (gte IE 6)&(lte IE 8)]>
		  <script type="text/javascript" src="js/selectivizr.js"></script>
		<![endif]--> 

		<link rel="stylesheet" type="text/css" href="../../css/css.css" media="all">
		<style type="text/css">	
			/* картинки генерируем для каждого опроса отдельно */
			input[type=radio] + label > .img{
				background: url('../../images/rbtn<?php echo $data['res']['sur'][0]['size_but']; ?>_0.png')  right top no-repeat;	
			}

			input[type=radio]:checked + label > .img{  
				background: url('../../images/rbtn<?php echo $data['res']['sur'][0]['size_but']; ?>_1.png')  right top no-repeat; 
			}  
		</style>
	</head>
<body  style="<?php if($data['res']['sur'][0]['back_color']) echo 'background:'.$data['res']['sur'][0]['back_color'].';'; ?>">
<div class="main">
	<form id="form" action="/register/reg_rb"  method="POST">
		<input type='hidden' name='id' value='<?php echo $data['id_for_thankpage'];?>'/>
		<?php 
			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
		?>
		<div class="radio_group">
			<!-- 
			для показа как будет если скрыть заголовок
			<div class="header" style="display:none;"><span style="font-size:30px;">Please select an option <br>22<br>333<br>333<br>below.Tell us about you!</span></div> -->
			<div class="header"><?php if(isset($data['res']['quest'][0]['text_quest'])) echo $data['res']['quest'][0]['text_quest'];?></div>
				<?php
					if(isset($data['res']['answ'][0])){
						$counter = 0;
						foreach($data['res']['answ'] as $answ){
							echo '
							<div class="elm">
								<input type="radio" name="answ" id="'.$counter.'" value="'.$answ['id'].'">
								<label for="'.$counter.'">
									<div class="img"></div><div class="text">'.$answ['text_answer'].'</div><div cllass="clear"></div>
								</label>
							</div>
							';
							$counter++;
						}
					}
				?>
		</div> 
		
		
		<div  class="subm" onclick='document.getElementById("form").submit();'><div></div></div>	
		<input type="submit" value="ok" style="display:none">
	</form>

</div><script src="../../js/js1.js"></script>
</body>
</html>
