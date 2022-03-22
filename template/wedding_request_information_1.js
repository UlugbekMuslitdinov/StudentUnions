$(document).ready(function() { 
	$(".datepicker").datepicker();
});

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
	
	/* this reacts to change after the page has loaded. */
	$("#country").change(function() {

		var selectValue = $(this).val();

		if ((selectValue == "") || (selectValue == "United States")) {
			$("#zip").show(500);
			$("#state").show(500);
			$("#province").hide(500);
			$("#postalCode").hide(500);
		} else {
			$("#zip").hide(500);
			$("#state").hide(500);
			$("#province").show(500);
			$("#postalCode").show(500);
		};
	});

});

//-----------------------------------------------------*
// this function automatically moves the cursor to the
// next field when the maximum number of characters has
// been reached.
//-----------------------------------------------------*
function moveOnMax(field, nextFieldID) {
	if (field.value.length >= field.maxLength) {
		document.getElementById(nextFieldID).focus();
	}
}