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

	
				function addEvent(element){
					var mf = function(evnt){
							if(evnt.target.className=='wrapper-dropdown' || evnt.target.className=='wrapper-dropdown active'){
								if(this.className.indexOf('active')==-1){
									this.className+=' active';
								}else{
									this.className = 'wrapper-dropdown';
								}
							}
						}
					element.onclick = mf;
				}
				function initEvent() {
					// var obj = this;
					var elements = document.getElementsByClassName('wrapper-dropdown');
					for(var i=0;i<elements.length;i++){
						addEvent(elements.item(i));
					}
				}
	
	//Change color for surwey block
	//Line 285 in jquery.colorPicker.js  $(".surwey").css("background-color", value);