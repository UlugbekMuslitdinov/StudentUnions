//Add date, time, and datetime pickers to all applicable fields
document.addEventListener("DOMContentLoaded", function(){
	var dpoStandard = { //Date picker
		likeXDSoftDateTimePicker: true,
		norange: true,
		cells: [1, 1],
		weekEnds: [],
		dayOfWeekStart: 7,
		resizeButton: false,
		fullsizeButton: false,
		fullsizeOnDblClick: false,
		formatDate: 'YYYY-MM-DD',
		timepicker: false
	};
	var dtpoStandard = $.extend(dpoStandard);
	delete dtpoStandard.formatDate;
	dtpoStandard.formatDateTime = 'YYYY-MM-DD HH:mm:ss';
	dtpoStandard.timepicker = true;
	dtpoStandard.timepickerOptions = {
		hours: true,
		minutes: true,
		seconds: true,
		ampm: true
	}
	var tpoStandard = { //Time picker
		ampm: true,
		twelveHoursFormat: true,
		inputFormat: 'hh:mm a',
		seconds: false
	};
	
	//Add pickers
	$(".tbl-picker-date").periodpicker(dpoStandard);
	$(".tbl-picker-datetime").periodpicker(dtpoStandard)
	$(".tbl-picker-time").TimePickerAlone(tpoStandard);
});