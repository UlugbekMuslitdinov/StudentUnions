//Add date, time, and datetime pickers to all applicable fields
document.addEventListener("DOMContentLoaded", function(){
	var dtpoStandard = { //Datetime picker
		likeXDSoftDateTimePicker: true,
		norange: true,
		cells: [1, 1],
		weekEnds: [],
		dayOfWeekStart: 7,
		resizeButton: false,
		fullsizeButton: false,
		fullsizeOnDblClick: false,
		formatDateTime: 'YYYY-MM-DD HH:mm:ss',
		timepicker: true,
		timepickerOptions: {
			hours: true,
			minutes: true,
			seconds: false,
			ampm: true
		}
	};
	
	//Add pickers
	$(".picker-datetime").periodpicker(dtpoStandard);
});