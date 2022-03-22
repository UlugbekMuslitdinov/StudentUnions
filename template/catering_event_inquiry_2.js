$(document).ready(function() {
	$(".datepicker").datepicker();
});

$(function() {

	resetLabels();
	
	checkDates();
	
	// event handler:
	// this reacts to changes after the page has loaded.
	$("#eventDate").change(function() {
		resetLabels();
		checkDates();
	});
});

function resetLabels() {
	$("#label1").hide();
	$("#label2").hide();
}
 
function checkDates() {
	var eventDate = $("#eventDate").val();
	var toDate = $("#toDate").val();

	if (eventDate > "") {
		var todayDate = new Date();
		// set the hours, minutes, seconds
		// milliseconds of todayDate to 0,
		// in case one of the dates is today.
		todayDate.setHours(0);
		todayDate.setMinutes(0);
		todayDate.setSeconds(0);
		todayDate.setMilliseconds(0);

		var begDate = new Date(eventDate);
		
		var maxDate = new Date();
		maxDate.setDate(maxDate.getDate() + 365);

		if (begDate < todayDate) {
			$("#label1").show();
		} else {
			$("#label1").hide();
		}

		if (begDate > maxDate) {
			$("#label2").show();
		} else {
			$("#label2").hide();
		}
	}
}