$(document).ready(function() { 
	$(".datepicker").datepicker();
});

$(function() {

	resetLabels();
	resetAltLabels();
	
	checkDates();
	checkAltDates();

	// initial setting
	var prevEventRadio = $("input[name=prevEvent]:checked").val();
	if (prevEventRadio == "Yes") {
		$("#prevEventInfo").show();
	} else {
		$("#prevEventInfo").hide();
	}

	// event handler:
	$("input[name=prevEvent]").change(function() {
		var prevEventRadio = $("input[name=prevEvent]:checked").val();

		if (prevEventRadio == "Yes") {
			$("#prevEventInfo").show(500);
		} else {
			$("#prevEventInfo").hide(500);
		}
	});

	// event handler:
	$("#toDate").change(function() {
		resetLabels();
		checkDates();
	});

	// event handler:
	// this reacts to changes after the page has loaded.
	$("#fromDate").change(function() {
		resetLabels();
		checkDates();
	});

	// event handler:
	$("#altToDate").change(function() {
		resetAltLabels();
		checkAltDates();
	});

	// event handler:
	$("#altFromDate").change(function() {
		resetAltLabels();
		checkAltDates();
	});

});

function resetLabels() {
	$("#label0").hide();
	$("#label1").hide();
	$("#label2").hide();
}

function resetAltLabels() {
	$("#label3").hide();
	$("#label4").hide();
	$("#label5").hide();
}

function checkDates() {
	var fromDate = $("#fromDate").val();
	var toDate = $("#toDate").val();

	if ((fromDate > "") && (toDate > "")) {
		var todayDate = new Date();
		// set the hours, minutes, seconds
		// milliseconds of todayDate to 0,
		// in case one of the dates is today.
		todayDate.setHours(0);
		todayDate.setMinutes(0);
		todayDate.setSeconds(0);
		todayDate.setMilliseconds(0);

		var begDate = new Date(fromDate);
		var endDate = new Date(toDate);
		var maxDate = new Date();
		maxDate.setDate(maxDate.getDate() + 365);

		if (endDate < begDate) {
			$("#label0").show();
		} else {
			$("#label0").hide();
		}

		if ((begDate < todayDate) || (endDate < todayDate)) {
			$("#label1").show();
		} else {
			$("#label1").hide();
		}

		if ((begDate > maxDate) || (endDate > maxDate)) {
			$("#label2").show();
		} else {
			$("#label2").hide();
		}
	}
}

function checkAltDates() {
	var altFromDate = $("#altFromDate").val();
	var altToDate = $("#altToDate").val();

	if ((altFromDate > "") && (altToDate > "")) {
		var todayDate = new Date();
		// set the hours, minutes, seconds
		// milliseconds of todayDate to 0,
		// in case one of the dates is today.
		todayDate.setHours(0);
		todayDate.setMinutes(0);
		todayDate.setSeconds(0);
		todayDate.setMilliseconds(0);

		var altBegDate = new Date(altFromDate);
		var altEndDate = new Date(altToDate);
		var maxDate = new Date();
		maxDate.setDate(maxDate.getDate() + 365);

		if (altEndDate < altBegDate) {
			$("#label3").show();
		} else {
			$("#label3").hide();
		}

		if ((altBegDate < todayDate) || (altEndDate < todayDate)) {
			$("#label4").show();
		} else {
			$("#label4").hide();
		}

		if ((altBegDate > maxDate) || (altEndDate > maxDate)) {
			$("#label5").show();
		} else {
			$("#label5").hide();
		}
	}
}

