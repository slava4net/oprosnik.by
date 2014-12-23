		function autoMarginPreview(parent, childs, header){
		
			var allHeight=document.querySelector(parent).offsetHeight,
					elements=document.querySelectorAll(childs),
					elementsHeight=0,
					headerH=document.querySelector(header).offsetHeight,
					margin;
					//console.log('Высота родителя'+allHeight);

				for (i = 0; i < elements.length; i++) {
					elementsHeight += elements[i].offsetHeight;
					//console.log('Высота ребенка '+i + ' - ' + elements[i].offsetHeight);
				}
				//console.log('Высота элементов'+elementsHeight);
				margin =  ((allHeight - headerH - elementsHeight)/(elements.length+1)) ;
				
				for (i = 0; i < elements.length; i++) {
					elements[i].style.margin = margin+'px 0';
				}

		}
		
		
		autoMarginPreview(".radio_group", ".elm", ".header");