<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>THANK YOU</title>
		<meta charset="utf-8">    
		<link rel="stylesheet" type="text/css" href="../../css/css.css" media="all">
	</head>
<body <?php if(isset($data[0]['thank_back_color'])) echo ' style="background-color:'.$data[0]['thank_back_color'].'";'; ?>">
<div class="main">
	<div class="thank-page">
		<?php if(isset($data[0]['thank_page'])) echo $data[0]['thank_page']; ?>
	</div>
</div>

<script type="text/javascript">
	//AutoMargin width answer
	
		function autoMargin(parent, childs){
		
			var parentElement=document.querySelector(parent),
					elements=document.querySelectorAll(childs),
					elementsHeight=0,
					margin;
					
					if(parentElement !== null){
						if(elements !== null){
							allHeight = parentElement.offsetHeight;					
						}else{return false}
					}else{return false}
					//console.log('Высота родителя'+allHeight);

				for (i = 0; i < elements.length; i++) {
					elementsHeight += elements[i].offsetHeight;
					//console.log('Высота ребенка '+i + ' - ' + elements[i].offsetHeight);
				}
				//console.log('Высота элементов'+elementsHeight);
				margin =  ((allHeight - elementsHeight)/(elements.length+1)) ;
				
				for (i = 0; i < elements.length; i++) {
					elements[i].style.marginTop = margin+'px';
					elements[i].style.marginBottom = margin+'px';
				}

		}
		
		autoMargin('.main', '.thank-page');
</script>

</body>
</html>
