	//Run the code when document ready
		$(function() { 

	// Colorpicker		
			$('#color').colorPicker({showHexField: false}); 
			
			
			// DropDown
			initEvent();
			// var dd1 = new DropDown();
			// var dd1 = new DropDown( $('[id *= dd-]') );
			// var dd1 = new DropDown( $('#dd-1') ),
			// dd2 = new DropDown( $('#dd-2') ),
			// dd3 = new DropDown( $('#dd-3') ),
			// dd4 = new DropDown( $('#dd-4') );
				

				$(document).click(function() {
					// all dropdowns
					// $('.wrapper-dropdown').removeClass('active');
				});
		});
		
		
		// Automargin answer
		
		autoMargin(".answers", ".answer");
		autoMargin(".question", ".qchild");
		autoMargin('.thank-container', '.thank-text');
		/*для проверки*/ autoMargin(".answers-drop", ".answer");
		
		//setInterval('autoMargin(".question", ".qchild")', 100) ;
		//setInterval('autoMargin(".ans-container", ".answer")', 120) ;
		

