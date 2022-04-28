var currQuant = {"cookie_1": 0, "cookie_2": 0, "cookie_3": 0, "cookie_4": 0, "cookie_5": 0,  "cookie_6": 0,  "cookie_7": 0,  "cookie_8": 0, "cookie_9": 0,  "cookie_10": 0};

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

function dateCheck(value) {
    var error_msg = document.getElementById("date-error");
    if(dateValidation(value)) {
        error_msg.style.display = "none";
        console.log("Valid!");
    }
    else {
        error_msg.style.display = "block";
        console.log("Invalid!");
    }
}

function dateValidation(value) {
    var date = Date.parse(value.replace(/-/g, "/"));
	// 4/20-4/22, 4/25-4/29, 5/2-5/6, 5/9-5/13
    if(date > Date.parse('2022-4-19'.replace(/-/g, "/")) && date <= Date.parse('2022-4-22'.replace(/-/g, "/"))) {
        return true;
    }
	else if(date > Date.parse('2022-4-24'.replace(/-/g, "/")) && date <= Date.parse('2022-4-29'.replace(/-/g, "/"))) {
        return true;
    }
    else if(date > Date.parse('2022-5-1'.replace(/-/g, "/")) && date <= Date.parse('2022-5-6'.replace(/-/g, "/"))) {
        return true;
    }
    else if(date > Date.parse('2022-5-8'.replace(/-/g, "/")) && date <= Date.parse('2022-5-13'.replace(/-/g, "/"))) {
        return true;
    } else {
		return false;
	}
	//if(date > Date.parse('4 17 2022') && date <= Date.parse('4 22 2022')) {
//        return true;
//    }
//	else if(date > Date.parse('4 24 2022') && date <= Date.parse('4 29 2022')) {
//        return true;
//    }
//    else if(date > Date.parse('5 1 2022') && date <= Date.parse('5 6 2022')) {
//        return true;
//    }
//    else if(date > Date.parse('5 8 2022') && date <= Date.parse('5 13 2022')) {
//        return true;
//    } else {
//		return false;
//	}
}

function changeQuant(x) {
    var num = 0;
    var total = 0;
	var tax = 0;
	var total2 = 0;
	var total_text = document.getElementById("total_price");
	var total_tax = document.getElementById("total_tax");
	var tax_total = document.getElementById("tax_total");

    if(isNumeric(x.value)) {
        num = Math.floor(Number(x.value));

        if(num <= 0) {
            num = 0;
        }
    }

    currQuant[x.name] = num;
    x.value = num;

    total = calculateTotal();
	total_text.innerHTML = total;
	tax = total * .061;  // Calculate 6.1% tax.
	tax = parseFloat(tax).toFixed(2);
	total2 = parseFloat(total) + parseFloat(tax);
	total2 = parseFloat(total2).toFixed(2);
	total_tax.innerHTML = tax;
	tax_total.innerHTML = total2;
	document.forms['form'].total_price_2.value = total;
	document.forms['form'].total_tax.value = tax;
	document.forms['form'].total_price_3.value = total2;
}

function isNumeric(str) {
  if (typeof str != "string") return false; 
  return !isNaN(str) && !isNaN(parseFloat(str));
}

function calculateTotal() {
    var ret = currQuant["cookie_1"] * 14.99 +
        currQuant["cookie_2"] * 14.99 +
        currQuant["cookie_3"] * 14.99 +
        currQuant["cookie_4"] * 14.99 +
        currQuant["cookie_5"] * 14.99 +
        currQuant["cookie_6"] * 14.99 +
        currQuant["cookie_7"] * 14.99 +
        currQuant["cookie_8"] * 14.99 +
		currQuant["cookie_9"] * 14.99 +
        currQuant["cookie_10"] * 14.99;

    return ret.toFixed(2);
}

// At least, one item must be selected.
function OnSubmitForm() { 
	var check_total = document.getElementById("total_price").innerHTML;
    var date_value = document.getElementById("pickupdate").value;
	if (check_total == 0) {
		alert("Please select, at least, one item from the package.");
		return false;
	} else if(!dateValidation(date_value)) {
        alert("Please enter a valid pick up date within the given range.");
        return false;
    } else {
		return true;
	}
}

