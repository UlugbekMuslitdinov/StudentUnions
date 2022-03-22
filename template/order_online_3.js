
$(function() { 

	// initial setting
	if ($('#venueOther').is(':checked')) {
        	$("#otherVenuePara").show();
    } else {
        	$("#otherVenuePara").hide();
    }
    
    if ($('#setupOther').is(':checked')) {
        	$("#otherSetupPara").show();
    } else {
        	$("#otherSetupPara").hide();
    }
    
	var breakoutRadio = $("input[name=breakout]:checked").val();
	if (breakoutRadio == "yes") {
		$("#breakoutPara").show();
	} else {
		$("#breakoutPara").hide();
	}

	// event handler:
	$("input[name=breakout]").change(function() {
		var breakoutRadio = $("input[name=breakout]:checked").val();
		if (breakoutRadio == "yes") {
			$("#breakoutPara").show(500);
		} else {
			$("#breakoutPara").hide(500);
		}
	});

	// event handler:
	$("#venueOther").change(function() {        
        	if ($('#venueOther').is(':checked')) {
        		$("#otherVenuePara").show(500);
        	} else {
        		$("#otherVenuePara").hide(500);
        	}
    	});
    	
	// event handler:
	$("#setupOther").change(function() {        
        	if ($('#setupOther').is(':checked')) {
        		$("#otherSetupPara").show(500);
        	} else {
        		$("#otherSetupPara").hide(500);
        	}
    	});

	
});

