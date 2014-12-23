	//Run the code when document ready
		$(function() { 

	// Colorpicker		
			$('#color').colorPicker({showHexField: false}); 
			
			
			// DropDown
			var dd1 = new DropDown( $('[id *= dd-]') );
				

				// $(document).click(function() {
					// // all dropdowns
					// $('.wrapper-dropdown').removeClass('active');
				// });
		});
		
		
		// Automargin answer
		
		autoMargin(".answers", ".answer");
		autoMargin(".answers-drop", ".answer");
		autoMargin(".question", ".qchild");
		//setInterval('autoMargin(".question", ".qchild")', 100) ;
		//setInterval('autoMargin(".ans-container", ".answer")', 1000) ;
		

