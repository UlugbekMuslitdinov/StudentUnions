	$(function() {  	
        
        // initial setting
        if($("input[@name=package]:checked").val()) {
        		$("#theRest").show();
        	} else {
        		$("#theRest").hide();
        } 
        checkPkg();
        
        if ($('#mainALaCarte').is(':checked')) {
        		$("#mainALaCarte-list").show();
        	} else {
        		$("#mainALaCarte-list").hide();
        	}
        	if ($('#potatoesALaCarte').is(':checked')) {
        		$("#potatoesALaCarte-list").show( );
        	} else {
        		$("#potatoesALaCarte-list").hide( );
        	}
        	
        if ($('#stuffingALaCarte').is(':checked')) {
        		$("#stuffingALaCarte-list").show( );
        	} else {
        		$("#stuffingALaCarte-list").hide( );
        	}
        	
        	if ($('#vegetablesALaCarte').is(':checked')) {
        		$("#vegetablesALaCarte-list").show( );
        	} else {
        		$("#vegetablesALaCarte-list").hide( );
        	}
        	
        	if ($('#relishesALaCarte').is(':checked')) {
        		$("#relishesALaCarte-list").show( );
        	} else {
        		$("#relishesALaCarte-list").hide( );
        	}
        	
        	if ($('#breadsALaCarte').is(':checked')) {
        		$("#breadsALaCarte-list").show( );
        	} else {
        		$("#breadsALaCarte-list").hide( );
        	}
        	
        	if ($('#saladsALaCarte').is(':checked')) {
        		$("#saladsALaCarte-list").show( );
        	} else {
        		$("#saladsALaCarte-list").hide( );
        	}
        	
        	if ($('#dessertsALaCarte').is(':checked')) {
        		$("#dessertsALaCarte-list").show( );
        	} else {
        		$("#dessertsALaCarte-list").hide( );
        	}
        	
        // event handlers react to changes after the page has loaded. 
          	
    		// event handler:
    		$("input[@name=package]").change(function() {        
        		if($("input[@name=package]:checked").val()) {
        			$("#theRest").show(500);
        		} else {
        			$("#theRest").hide(500);
        		} 
        		checkPkg();
    		});
    		
    		$("#mainALaCarte").change(function() {        
        		if ($('#mainALaCarte').is(':checked')) {
        			$("#mainALaCarte-list").show(500);
        		} else {
        			$("#mainALaCarte-list").hide(500);
        		}
    		});
    		
    		$("#potatoesALaCarte").change(function() {        
        		if ($('#potatoesALaCarte').is(':checked')) {
        			$("#potatoesALaCarte-list").show(500);
        		} else {
        			$("#potatoesALaCarte-list").hide(500);
        		}
    		});
    		
    		$("#stuffingALaCarte").change(function() {        
        		if ($('#stuffingALaCarte').is(':checked')) {
        			$("#stuffingALaCarte-list").show(500);
        		} else {
        			$("#stuffingALaCarte-list").hide(500);
        		}
    		});
    		
    		$("#vegetablesALaCarte").change(function() {        
        		if ($('#vegetablesALaCarte').is(':checked')) {
        			$("#vegetablesALaCarte-list").show(500);
        		} else {
        			$("#vegetablesALaCarte-list").hide(500);
        		}
    		});
    		
    		$("#relishesALaCarte").change(function() {        
        		if ($('#relishesALaCarte').is(':checked')) {
        			$("#relishesALaCarte-list").show(500);
        		} else {
        			$("#relishesALaCarte-list").hide(500);
        		}
    		});
    		
    		$("#breadsALaCarte").change(function() {        
        		if ($('#breadsALaCarte').is(':checked')) {
        			$("#breadsALaCarte-list").show(500);
        		} else {
        			$("#breadsALaCarte-list").hide(500);
        		}
    		});
    		
    		$("#saladsALaCarte").change(function() {        
        		if ($('#saladsALaCarte').is(':checked')) {
        			$("#saladsALaCarte-list").show(500);
        		} else {
        			$("#saladsALaCarte-list").hide(500);
        		}
    		});
    		
    		$("#dessertsALaCarte").change(function() {        
        		if ($('#dessertsALaCarte').is(':checked')) {
        			$("#dessertsALaCarte-list").show(500);
        		} else {
        			$("#dessertsALaCarte-list").hide(500);
        		}
    		});
    		
	});
	
	// a la carte package hides the drop-downs
	function checkPkg() {
		var packageChecked = $("input[@name=package]:checked").val();
		 if (packageChecked == 4) {
        		$(".pkgDropDown").hide(500);
        		$('#mainCourse').val('');
        		$('#potatoes').val('');
        		$('#stuffing').val('');
        		$('#vegetables').val('');
        		$('#relishes').val('');
        		$('#breads').val('');
        		$('#salads').val('');
        		$('#desserts').val('');
        	} else {
        		$(".pkgDropDown").show(500);
        } 
	}