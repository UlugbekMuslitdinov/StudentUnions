
	$(function() { 
		
		/* this reacts to the current value when the page loads. */
		var currValue = $("#country").val();
		if ((currValue == "") || (currValue == "United States")) {
            	$("#zip").show();
          	$("#state").show();
          	$("#province").hide();
          	$("#postalCode").hide();
        	} else {	
            	$("#zip").hide();
          	$("#state").hide();
          	$("#province").show();
          	$("#postalCode").show();
        	};
        	
        	/* this reacts to the current value when the page loads. */
		var affiliation = $("#affiliation").val();
		if (affiliation == "other") {
            	$("#otherPara").show(); 	
        	} else {	
            	$("#otherPara").hide();
        	};
        	
        	/* this reacts to change after the page has loaded. */	
    		$("#country").change(function() {        
        		
        		var selectValue = $(this).val();
       		
        		if ((selectValue == "") || (selectValue == "United States")) {
            		$("#orgZip").show(500);
          		$("#state").show(500);
          		$("#orgProvince").hide(500);
          		$("#orgPostalCode").hide(500);
        		} else {	
            		$("#orgZip").hide(500);
          		$("#state").hide(500);
          		$("#orgProvince").show(500);
          		$("#orgPostalCode").show(500);
        		};
    		});
    		
    		/* this reacts to change after the page has loaded. */	
    		$("#affiliation").change(function() {        
        		
        		var affiliation = $(this).val();
       		
        		if (affiliation == "other") {
            		$("#otherPara").show(500); 	
       	 	} else {	
           	 	$("#otherPara").hide(500);
        		};
    		});
	});
	
	//-----------------------------------------------------*
	// this function automatically moves the cursor to the
	// next field when the maximum number of characters has
	// been reached.
	//-----------------------------------------------------*
	function moveOnMax(field,nextFieldID){
  		if(field.value.length >= field.maxLength) {
   			 document.getElementById(nextFieldID).focus();
  	    }
	}