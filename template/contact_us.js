	$(function() {   
		
		$("#comment_block").hide();
		$("#iam").hide();
		$("#re").hide();
		$("#contactyou").hide();
		
        	/* this reacts to change after the page has loaded. */
        	var feedback = null;
    		$("input[name='feedback']").click(function() {
    			feedback = this.value;
    			$("#comment_block").show(500);
    			if (feedback == "Yes") {
    				$("#iam").show(500);
    				$("#re").show(500);
    				$("#contactyou").show(500);
    			} else {	
    				$("#iam").hide(500);
    				$("#re").hide(500);
    				$("#contactyou").hide(500);	
    			}
		});
    		
	});
	
	function clearForm(){
		$('#frm input[type="text"]').each(function(){
      	     $(this).val("");   
 		});
 		
  		$('#frm input[type="radio":checked]').each(function(){
      		$(this).checked = false;  
 		});
 	}