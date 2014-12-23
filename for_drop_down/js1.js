		function autoMarginPreview(parent, childs, header){
		
			var allHeight=document.querySelector(parent).offsetHeight,
					elements=document.querySelectorAll(childs),
					elementsHeight=0,
					headerH=0,
					margin;
					
					if(header !== ""){
						headerH = document.querySelector(header).offsetHeight;
					}else{headerH=0;}
					//console.log('Высота родителя'+allHeight);

				for (i = 0; i < elements.length; i++) {
					elementsHeight += elements[i].offsetHeight;
					//console.log('Высота ребенка '+ i + ' - ' + elements[i].offsetHeight);
				}
				//console.log('Высота элементов'+elementsHeight);
				margin =  ((allHeight - headerH - elementsHeight)/(elements.length+1)) ;
				//console.log('Высота margin '+margin);
				for (i = 0; i < elements.length; i++) {
					elements[i].style.margin = margin+'px 0';
				}

		}
	
		autoMarginPreview(".radio_group", ".elm", ".header");
		autoMarginPreview(".radio_group", ".drop-block", "");