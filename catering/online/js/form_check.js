// var loaded = false;

// function get_data(){
// 	var location = document.getElementById("location").value;

// 	fetch('/api/catering/delivery_time/' + location)
// 	.then(function(response) {
// 	    return response.json();
// 	})
// 	.then(function(json) {
// 	    if (json.success){
// 	    	delivery_data = json;
// 	        loaded = true;
// 	    }
// 	    else{
// 	    	console.log("JSON error!");
// 	    }
// 	});
// }

// function parse_time(timestring){
// 	var time_array = $.map(timestring.split(':'), function(value) {
// 		return parseInt(value, 10);
// 	});

// 	if(time_array[1] >= 60){
// 		time_array[1] -= 60;
// 		time_array[0] += 1;
// 	}

// 	return {
// 		'h': time_array[0],
// 		'm': time_array[1]
// 	};
// }

// function parse_time24(timestring){
// 	var mnemonic = timestring.split(' ')[1];
// 	var time = parse_time(timestring.split(' ')[0]);

// 	if(mnemonic === 'PM')
// 		time.h += 12;

// 	return time;
// }

// function time_sum(time1, time2){
// 	var ret = {
// 		'h': time1.h + time2.h,
// 		'm': time1.m + time2.m
// 	};

// 	if(ret.m >= 60)
// 	{
// 		ret.h += 1;
// 		ret.m -= 60;
// 	}

// 	return ret;
// }

// function greater_eq(time1, time2){
// 	if(time1.h > time2.h || (time1.h === time2.h && time1.m >= time2.m))
// 		return true;
	
// 	return false;
// }

// function date_eq(date1, date2){
// 	if(date1.m === date1.m && date1.d === date2.d && date1.y === date2.y)
// 		return true;

// 	return false;
// }

// function date_greater(date1, date2){
// 	if(date1.y > date2.y || (date1.m > date2.m && date1.y <= date2.y) || (date1.d > date2.d && date1.y <= date2.y && date1.m <= date2.m))
// 		return true;

// 	return false;
// }

// function get_time(h, m){
// 	return {
// 		'h': h,
// 		'm': m
// 	};
// }

// function get_date(m, d, y){
// 	return {
// 		'm': m,
// 		'd': d,
// 		'y': y
// 	};
// }

// function get_current_time(){
// 	var date = new Date();

// 	return get_time(date.getHours(), date.getMinutes());
// }

// function get_current_date(){
// 	var date = new Date();

// 	return get_date(date.getMonth() + 1, date.getDate(), date.getFullYear());
// }

// function get_current_date_str(){
// 	var date = new Date();

// 	return (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
// }

// function time_str(time){
// 	return time.h + ':' + time.m;
// }

// function get_delivery_time(){
// 	var d_hour = document.getElementById("hour").value;
// 	var d_min = document.getElementById("min").value;
// 	var d_mnemonic = document.getElementById("mnemonic").value;

// 	var delivery_time_str = d_hour + ':' + d_min + ' ' + d_mnemonic;

// 	return parse_time24(delivery_time_str);
// }

// function check_delivery_time(){
// 	var delivery_time = get_delivery_time();
// 	var delivery_date = document.getElementById("delivery_date").value;
// 	var delivery_day;
// 	var current_time = get_current_time();
// 	var current_date = get_current_date();
// 	var current_date_str = get_current_date_str();
// 	var delivery;

// 	if(delivery_date === ""){
// 		delivery_date = current_date_str;
// 	}

// 	delivery = new Date(delivery_date + ' ' + time_str(delivery_time));
// 	delivery_day = delivery.getDay();
// 	delivery_time = get_time(delivery.getHours(), delivery.getMinutes());
// 	delivery_date = get_date(delivery.getMonth() + 1, delivery.getDate(), delivery.getFullYear());

// 	var start_time = parse_time(delivery_data[delivery_day].start_time);
// 	var end_time = parse_time(delivery_data[delivery_day].end_time);
// 	var advance_time = parse_time(delivery_data[delivery_day].advance_delivery_time);

// 	console.log(start_time, end_time, advance_time);
// 	console.log(current_time, delivery_time);
// 	console.log(current_date, delivery_date);

// 	if(
// 		(date_eq(delivery_date, current_date) && greater_eq(delivery_time, time_sum(current_time, advance_time)) &&
// 			greater_eq(delivery_time, start_time) && greater_eq(end_time, delivery_time)) ||
// 		(!date_eq(delivery_date, current_date) && date_greater(delivery_date, current_date) && greater_eq(delivery_time, time_sum(start_time, advance_time)) &&
// 			greater_eq(delivery_time, start_time) && greater_eq(end_time, delivery_time))
// 		){
// 		document.getElementById("delivery_time_error").innerHTML = "";
// 		return true;
// 	}
// 	else{
// 		error = true;
// 		$("#delivery_time").addClass("inputBox-err");

// 		getErrPosition("#delivery_time");

// 		console.log("Invalid Delivery Time!");
// 		document.getElementById("delivery_time_error").innerHTML = "<b style='color: #d40000;'>Invalid Delivery Time/Date!</b>";
// 		return false;
// 	}
// }

// var hour = document.getElementById("hour");
// var min = document.getElementById("min");
// var mnemonic = document.getElementById("mnemonic");
// var date = document.getElementById("delivery_date");

// get_data();

// hour.onchange = function() {
// 	check_delivery_time();
// }

// min.onchange = function() {
// 	check_delivery_time();
// }

// mnemonic.onchange = function() {
// 	check_delivery_time();
// }

// $(function() {
// 	$("#delivery_date").datepicker({
// 		onSelect: function() {
// 			check_delivery_time();
// 		}
// 	});
// });