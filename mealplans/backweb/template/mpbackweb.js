//keep track of the current tab on the home page
var current_tab = 'pending-deposits';

//set up popup calendar object for config page
var popup_cal = new popupcal({'callback':function(year, month, day){document.config_plus_form[popup_cal.id].value = year+'-'+month+'-'+day;}, "name":"popup_cal"});

//set up popup calendar object for seach page with time included
var popup_cal_time = new popupcal({'callback':function(year, month, day, hour, minute, second){document.search_form[popup_cal_time.id].value = year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second;}, "name":"popup_cal_time", "includeTime":1});

//allow swichting between tabs on the home page
function switch_tabs(id){
	//remove active class from current tab
	document.getElementById(current_tab+'-tab').className = '';
	//add actove class to newly selected tab
	document.getElementById(id+'-tab').className = 'active';
	//hide content from previous tab
	document.getElementById(current_tab).style.display = 'none';
	//show content from selected tab
	document.getElementById(id).style.display = 'block';
	//update current state
	current_tab=id;
	location.hash = id;
}
//called when ajax calls return with an error
function ajax_error(){
	alert('Opps, something went wrong. Most likely your sessions has died. This page will be reloaded to reactivate your session.');
	window.reload();
}
//get and place content for export errors tab
function get_export_errors(timestamp){
	$.post("mpbackweb.ajax.php", {"action":"get-export-errors", "when":timestamp}, function(data){if(data == 'error') ajax_error(); document.getElementById('export-errors-results').innerHTML = data;}, "html");
}
//get and place content for pending deposits tab
function get_pending_deposits(timestamp){
	$.post("mpbackweb.ajax.php", {"action":"get-pending-deposits", "when":timestamp}, function(data){if(data == 'error') ajax_error();document.getElementById('pending-deposits-results').innerHTML = data;}, "html");
}
//get and place content for recently completed tab
function get_recently_completed(timestamp){
	$.post("mpbackweb.ajax.php", {"action":"get-recently-completed", "when":timestamp}, function(data){if(data == 'error') ajax_error();document.getElementById('recently-completed-results').innerHTML = data;}, "html");
}
//get and place content for lost cards tab
function get_lost_cards(timestamp){
	$.post("mpbackweb.ajax.php", {"action":"get-lost-cards", "when":timestamp}, function(data){if(data == 'error') ajax_error();document.getElementById('lost-cards-results').innerHTML = data;}, "html");
}
function remove_pending_signup(id){
	$.post("mpbackweb.ajax.php", {"action":"remove-pending-signup", "id":id}, function(data){if(data == 'error') ajax_error(); alert("Pending signup has been removed")}, "html");
	
}

//function takes arguments as to how to sort results and pulls values from search form and sends request for results and places results in results div
function get_search_results(order_by, asce_desc){
	
	//grab totals form
	var form = document.totals_form;	
	
	var totals = '';
	//check to see if either of the show totals or sort by type and total buttons are checked
	for(var x=0; x < form.totals.length; x++){
		if(form.totals[x].checked){
			var totals = form.totals[x].value;
			break;
		}
	}
	
	//grab search criteria form
	form = document.search_form;
	
	//get selected value for date range radio buttons
	for(var x=0; x < form.date_range.length; x++){
		if(form.date_range[x].checked){
			var date_range = form.date_range[x].value;
			break;
		}
	}
	
	//grab all search form values, set action, and set sort variables
	var form_values = {
			"action":"get-search-results",
			"first_name":form.first_name.value,
			"last_name":form.last_name.value,
			"cust_id":form.cust_id.value,
			"deposit_id":form.deposit_id.value,
			"amount":form.amount.value,
			"payment_type":form.payment_type.options[form.payment_type.selectedIndex].value,
			"bursars":form.bursars_hold.checked,
			"last_four":form.last_four.value,
			"date_range":date_range,
			"from":form.from.value,
			"to":form.to.value,
			"totals":totals,
			"order_by":order_by,
			"asce_desc":asce_desc
	};
	
	//send request and place response html into appropriate div
	$.post("mpbackweb.ajax.php", form_values, function(data){if(data == 'error') ajax_error();document.getElementById('search-results-div').innerHTML = data;}, "html");
	return false;
}

//function to remove user from autherized backweb users
function remove_user(id, elem){
	elem.parentNode.parentNode.removeChild(elem.parentNode);
	$.post("mpbackweb.ajax.php", {"action":"remove-user", "id":id});
}

//function to remove user or ip from autherized cashier users
function remove_user2(id, elem){
	elem.parentNode.parentNode.removeChild(elem.parentNode);
	$.post("mpbackweb.ajax.php", {"action":"remove-cashier", "id":id});
}

//function to add user to autherized backweb users
function add_user(netID){
	//dont add blank netids
	if(netID == '') return false;
	
	//send request and replace old content with updated content
	$.post("mpbackweb.ajax.php", {"action":"add-user", "netID":netID}, function(data){if(data == 'error') ajax_error();document.getElementById('user-access').innerHTML = data;},"html");
	return false;
}

//function to add user to autherized cashier users
function add_user2(netID){
	//dont add blank netids
	if(netID == '') return false;
	
	//send request and replace old content with updated content
	$.post("mpbackweb.ajax.php", {"action":"add-user2", "netID":netID}, function(data){if(data == 'error') ajax_error();document.getElementById('cashier-access').innerHTML = data;},"html");
	return false;
}

//function to add user to autherized cashier users
function add_ip(ip){
	//dont add blank netids
	if(ip == '') return false;
	
	//send request and replace old content with updated content
	$.post("mpbackweb.ajax.php", {"action":"add-ip", "ip":ip}, function(data){if(data == 'error') ajax_error();document.getElementById('ip-access').innerHTML = data;},"html");
	return false;
}

var date = new Date();
var to = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate()+' 04:15:00';
date.setDate(date.getDate()-1);
var from = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate()+' 04:15:00';

var reports = {0:{"from":from, "to":to, "date_range":3, "total":1}, 1:{"from":from, "to":to, "date_range":3, "total":1, "payment_type":4}, 2:{"from":from, "to":to, "date_range":3, "total":1, "payment_type":5}};

function do_report(num){
	
	var values = reports[num];
	
	
	//grab search criteria form
	form = document.search_form;
	form.reset();
	
	if(values["date_range"]!=""){
		form.date_range[values["date_range"]].checked = true;
		
	}
	
	if(values["payment_type"]!=""){
		form.payment_type.selectedIndex = values["payment_type"];
		//values.pop();
	}
	
	//"payment_type":form.payment_type.options[form.payment_type.selectedIndex].value,
	for(x in values){
		try{
			if(x != 'payment_type')
				form[x].value = values[x];
		}
		catch(e){}
	}
	
	
	var form = document.totals_form;	
	form.reset();
	
	if(values["total"]!=-1){
		form.totals[values["total"]].checked = true;
	}
	
		
	get_search_results('deposit_time', 'DESC');
}