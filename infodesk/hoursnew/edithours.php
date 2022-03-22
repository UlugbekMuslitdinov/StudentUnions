<?php

session_start();

require('hours_db.inc');

$months = explode(', ', 'January, February, March, April, May, June, July, August, September, October, November, December');
$location_id=$_GET['location'];

$query = 'select location_name from location where location_id='.$location_id;
$result = $db->query($query);
$location_name = $result->fetch_array();
$location_name = $location_name['location_name'];


if(isset($_GET['year']))
	$year = $_GET['year'];
else
	$year = date("Y");
if(isset($_GET['month']))
	$month = $_GET['month'];
else
	$month = date('m');

do{

	if($month == 12){
		$Nmonth = 1;
		$Nyear = $year+1;
	}
	else{
		$Nmonth = $month+1;
		$Nyear = $year;
	}

	if($month == 1){
		$Pmonth = 12;
		$Pyear = $year -1;
	}
	else{
		$Pmonth = $month-1;
		$Pyear = $year;
	}

$first_day_month = date("Y-m-1", strtotime($year."-".$month."-1"));
$last_day_month = date("Y-m-t", strtotime($year."-".$month."-1"));


$days = date("t", strtotime($year."-".$month."-1"));

$first_day_week = date("w", strtotime($year.'-'.$month.'-1'));

$query = 'select type, (DAYOFMONTH(end_date)) as  end_date, (end_date >= "'.$last_day_month.'") as end_in from periods where start_date <= "'.$year.'-'.$month.'-1" and end_date > "'.$year.'-'.$month.'-1"';
$result = $db->query($query);

$defined = $result->num_rows;
if($defined == 0){
$month = $Pmonth;
$year = $Pyear;
print 'Period Not Defined Yet';
}
}while($defined == 0);



//print $query;
$period = $result->fetch_array();

$query = 'select time_format(openu, "%h"), time_format(openm, "%h"), time_format(opent, "%h"), time_format(openw, "%h"), time_format(openr, "%h"), time_format(openf, "%h"), time_format(opens, "%h"), time_format(openu, "%i"),  time_format(openm, "%i"),  time_format(opent, "%i"),  time_format(openw, "%i"),  time_format(openr, "%i"),  time_format(openf, "%i"),  time_format(opens, "%i"), time_format(openu, "%p"), time_format(openm, "%p"), time_format(opent, "%p"), time_format(openw, "%p"), time_format(openr, "%p"), time_format(openf, "%p"), time_format(opens, "%p"), time_format(closeu, "%h"), time_format(closem, "%h"), time_format(closet, "%h"), time_format(closew, "%h"), time_format(closer, "%h"), time_format(closef, "%h"), time_format(closes, "%h"), time_format(closeu, "%i"),  time_format(closem, "%i"),  time_format(closet, "%i"),  time_format(closew, "%i"),  time_format(closer, "%i"),  time_format(closef, "%i"),  time_format(closes, "%i"), time_format(closeu, "%p"), time_format(closem, "%p"), time_format(closet, "%p"), time_format(closew, "%p"), time_format(closer, "%p"), time_format(closef, "%p"), time_format(closes, "%p"), time_format(subtime(closeu, openu) , "%H"), time_format(subtime(closem, openm) , "%H"), time_format(subtime(closet, opent) , "%H"), time_format(subtime(closew, openw) , "%H"), time_format(subtime(closer, openr) , "%H"), time_format(subtime(closef, openf) , "%H"), time_format(subtime(closes, opens) , "%H") from hours where location_id='.$location_id.' and type='.$period['type'];
//print $query;




$result = $db->query($query);



$hours = $result->fetch_array(MYSQLI_NUM);

//var_dump($hours);
for($i=$first_day_week-1; $i > -1; $i--){
	$cal[$i]['day'] = '';
	$cal[$i]['type'] = 0;
	$time['ohour'][$i] = '';
	$time['ominute'][$i] = '';
	$time['oam/pm'][$i] = '';
	$time['chour'][$i] = '';
	$time['cminute'][$i] = '';
	$time['cam/pm'][$i] = '';
	$time['closed'][$i] = '';
}


$d=1;
$dayss = $days+$first_day_week;
for($i=$first_day_week; $i < $dayss; $i++){
	$cal[$i]['day'] = $d++;
	$cal[$i]['type'] = $period['type'];
	$time['ohour'][$i] = $hours[$i%7];
	$time['ominute'][$i] = $hours[$i%7+7];
	$time['oam/pm'][$i] = $hours[$i%7+14];
	$time['chour'][$i] = $hours[$i%7+21];
	$time['cminute'][$i] = $hours[$i%7+28];
	$time['cam/pm'][$i] = $hours[$i%7+35];
	$time['closed'][$i] = $hours[$i%7+42];

}

for($i=$i; $i < 42; $i++){
	$cal[$i]['day'] = '';
	$cal[$i]['type']= 0;
	$time['ohour'][$i] = '';
	$time['ominute'][$i] = '';
	$time['oam/pm'][$i] = '';
	$time['chour'][$i] = '';
	$time['cminute'][$i] = '';
	$time['cam/pm'][$i] = '';
	$time['closed'][$i] = '';

}

//var_dump($time);

$type = ++$period['type']%2;

$query = 'select time_format(openu, "%h"), time_format(openm, "%h"), time_format(opent, "%h"), time_format(openw, "%h"), time_format(openr, "%h"), time_format(openf, "%h"), time_format(opens, "%h"), time_format(openu, "%i"),  time_format(openm, "%i"),  time_format(opent, "%i"),  time_format(openw, "%i"),  time_format(openr, "%i"),  time_format(openf, "%i"),  time_format(opens, "%i"), time_format(openu, "%p"), time_format(openm, "%p"), time_format(opent, "%p"), time_format(openw, "%p"), time_format(openr, "%p"), time_format(openf, "%p"), time_format(opens, "%p"), time_format(closeu, "%h"), time_format(closem, "%h"), time_format(closet, "%h"), time_format(closew, "%h"), time_format(closer, "%h"), time_format(closef, "%h"), time_format(closes, "%h"), time_format(closeu, "%i"),  time_format(closem, "%i"),  time_format(closet, "%i"),  time_format(closew, "%i"),  time_format(closer, "%i"),  time_format(closef, "%i"),  time_format(closes, "%i"), time_format(closeu, "%p"), time_format(closem, "%p"), time_format(closet, "%p"), time_format(closew, "%p"), time_format(closer, "%p"), time_format(closef, "%p"), time_format(closes, "%p"), time_format(subtime(closeu, openu) , "%H"), time_format(subtime(closem, openm) , "%H"), time_format(subtime(closet, opent) , "%H"), time_format(subtime(closew, openw) , "%H"), time_format(subtime(closer, openr) , "%H"), time_format(subtime(closef, openf) , "%H"), time_format(subtime(closes, opens) , "%H") from hours where location_id='.$location_id.' and type='.$type;

$result = $db->query($query);
$hours2 = $result->fetch_array(MYSQLI_NUM);


if(!$period['end_in']){

	for($i = ($first_day_week + $period['end_date']); $i < $dayss; $i++){
		$cal[$i]['type'] = $type;
		$time['ohour'][$i] = $hours2[$i%7];
		$time['ominute'][$i] = $hours2[$i%7+7];
		$time['oam/pm'][$i] = $hours2[$i%7+14];
		$time['chour'][$i] = $hours2[$i%7+21];
		$time['cminute'][$i] = $hours2[$i%7+28];
		$time['cam/pm'][$i] = $hours2[$i%7+35];
		$time['closed'][$i] = $hours2[$i%7+42];
	}

}

$query = 'select (DAYOFMONTH(date_of)+'.$first_day_week.'-1) as dates_of, time_format(open, "%h"), time_format(open, "%i"),time_format(open, "%p"), time_format(close, "%h"), time_format(close, "%i"),time_format(close, "%p"), time_format(subtime(close, open) , "%H") from exceptions where location_id='.$location_id.' and date_of >= "'.$first_day_month.'" and date_of <= "'.$last_day_month.'"';

//print $query;

$result = $db->query($query);

while($exception = $result->fetch_array(MYSQLI_NUM)){
	//print $exception['dates_of'];
	$i = $exception[0];
	$cal[$i]['type']="2";
	$time['ohour'][$i] = $exception[1];
	$time['ominute'][$i] =  $exception[2];
	$time['oam/pm'][$i] =  $exception[3];
	$time['chour'][$i] =  $exception[4];
	$time['cminute'][$i] =  $exception[5];
	$time['cam/pm'][$i] =  $exception[6];
	$time['closed'][$i] =  $exception[7];
	//var_dump($cal);
}

if(isset($_GET['week']))
	$open_week = $_GET['week'];
else
	$open_week = intval(($first_day_week + date("j"))/7);

$i=0;
$w=0;

?>



<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript">
var test = ['a', 'b', 'c', 'd', 'e', 'f', 'g'];
var ohour = ['<?php print implode("', '", $time['ohour']); ?> '];
var ominute = ['<?php print implode("', '", $time['ominute']); ?> '];
var oampm = ['<?php print implode("', '", $time['oam/pm']); ?> '];
var chour = ['<?php print implode("', '", $time['chour']); ?> '];
var cminute = ['<?php print implode("', '", $time['cminute']); ?> '];
var campm = ['<?php print implode("', '", $time['cam/pm']); ?> '];
var closed1 = ['<?php print implode("', '", $time['closed']); ?> '];
var day = [<?php for($y=0; $y < 41; $y++){ print "'".$cal[$y]['day']."', ";} print "'".$cal[$y]['day']."'";?>];
var month = '<?php print $month;?>';
var year = '<?php print $year; ?>';
var current_week ='';

//alert(closed1);
<?php if($type==1){ ?>

var default_h_o = [['<?php print implode("', '", array_slice($hours, 0, 7));?>'], ['<?php print implode("', '", array_slice($hours2, 0, 7));?>']];

var default_m_o = [['<?php print implode("', '", array_slice($hours, 7, 7));?>'], ['<?php print implode("', '", array_slice($hours2, 7, 7));?>']];

var default_ap_o = [['<?php print implode("', '", array_slice($hours, 14, 7));?>'], ['<?php print implode("', '", array_slice($hours2, 14, 7));?>']];

var default_h_c = [['<?php print implode("', '", array_slice($hours, 21, 7));?>'], ['<?php print implode("', '", array_slice($hours2, 21, 7));?>']];

var default_m_c = [['<?php print implode("', '", array_slice($hours, 28, 7));?>'], ['<?php print implode("', '", array_slice($hours2, 28, 7));?>']];

var default_ap_c = [['<?php print implode("', '", array_slice($hours, 35, 7));?>'], ['<?php print implode("', '", array_slice($hours2, 35, 7));?>']];

var default_closed = [['<?php print implode("', '", array_slice($hours, 42, 7));?>'], ['<?php print implode("', '", array_slice($hours2, 42, 7));?>']];

<?php
}
else{ ?>

var default_h_o = [['<?php print implode("', '", array_slice($hours2, 0, 7));?>'], ['<?php print implode("', '", array_slice($hours, 0, 7));?>']];

var default_m_o = [['<?php print implode("', '", array_slice($hours2, 7, 7));?>'], ['<?php print implode("', '", array_slice($hours, 7, 7));?>']];

var default_ap_o = [['<?php print implode("', '", array_slice($hours2, 14, 7));?>'], ['<?php print implode("', '", array_slice($hours, 14, 7));?>']];

var default_h_c = [['<?php print implode("', '", array_slice($hours2, 21, 7));?>'], ['<?php print implode("', '", array_slice($hours, 21, 7));?>']];

var default_m_c = [['<?php print implode("', '", array_slice($hours2, 28, 7));?>'], ['<?php print implode("', '", array_slice($hours, 28, 7));?>']];

var default_ap_c = [['<?php print implode("', '", array_slice($hours2, 35, 7));?>'], ['<?php print implode("', '", array_slice($hours, 35, 7));?>']];

var default_closed = [['<?php print implode("', '", array_slice($hours2, 42, 7));?>'], ['<?php print implode("', '", array_slice($hours, 42, 7));?>']];

<?php } ?>

function edit_week(week){

for(var i=0; i < 7; i++){

	document.exceptions['openh'+i].selectedIndex = (ohour[7*week+i]%12);
	if(ominute[7*week+i] == "00")
	document.exceptions['openm'+i].selectedIndex = 0;
	else
	document.exceptions['openm'+i].selectedIndex = 1;
	if(oampm[7*week+i]  == 'AM')
	document.exceptions['openap'+i][0].checked = true;
	else{
	document.exceptions['openap'+i][1].checked = true;
	}

	document.exceptions['closeh'+i].selectedIndex = (chour[7*week+i]%12);
	if(cminute[7*week+i] == "00")
	document.exceptions['closem'+i].selectedIndex = 0;
	else
	document.exceptions['closem'+i].selectedIndex = 1;
	if(campm[7*week+i]  == 'AM')
	document.exceptions['closeap'+i][0].checked = true;
	else{
	document.exceptions['closeap'+i][1].checked = true;
	}

	if(closed1[7*week+i] == "00" && (ohour[7*week+i]%12) == 0){
	document.exceptions['closed'+i].checked = true;
	document.exceptions['openh'+i].disabled = true;
	document.exceptions['closeh'+i].disabled = true;
	document.exceptions['openm'+i].disabled = true;
	document.exceptions['closem'+i].disabled = true;
	document.exceptions['openap'+i][0].disabled = true;
	document.exceptions['closeap'+i][0].disabled = true;
	document.exceptions['openap'+i][1].disabled = true;
	document.exceptions['closeap'+i][1].disabled = true;
	}
	else{
	document.exceptions['closed'+i].checked = false;
	document.exceptions['openh'+i].disabled = false;
	document.exceptions['closeh'+i].disabled = false;
	document.exceptions['openm'+i].disabled = false;
	document.exceptions['closem'+i].disabled = false;
	document.exceptions['openap'+i][0].disabled = false;
	document.exceptions['closeap'+i][0].disabled = false;
	document.exceptions['openap'+i][1].disabled = false;
	document.exceptions['closeap'+i][1].disabled = false;
	}

	document.getElementById('d'+i).innerHTML = month+'/'+day[week*7+i];
	test[i]= year+'-'+month+'-'+day[week*7+i];



	if(document.getElementById('cell'+(week*7+i)).className == 'a2'){
		document.getElementById('e'+i).innerHTML = '<input type="button" value="delete exception" onclick="delete_exceptions(\''+year+'-'+month+'-'+day[week*7+i]+'\')">';
		document.getElementById('d'+i).parentNode.style.backgroundColor = 'green';
	}
	else{
		document.getElementById('d'+i).parentNode.style.backgroundColor = 'white';
		document.getElementById('e'+i).innerHTML = '';
	}
}
current_week = week;
document.getElementById('banner').style.display = 'none';
document.getElementById('exceptions_div').style.display = 'block';
}

function edit_default(type){

for(var i=0; i < 7; i++){

	document.exceptions['openh'+i].selectedIndex = (default_h_o[type][i]%12);
	if(default_m_o[type][i] == "00")
	document.exceptions['openm'+i].selectedIndex = 0;
	else
	document.exceptions['openm'+i].selectedIndex = 1;
	if(default_ap_o[type][i]  == 'AM')
	document.exceptions['openap'+i][0].checked = true;
	else{
	document.exceptions['openap'+i][1].checked = true;
	}

	document.exceptions['closeh'+i].selectedIndex = (default_h_c[type][i]%12);
	if(default_m_c[type][i] == "00")
	document.exceptions['closem'+i].selectedIndex = 0;
	else
	document.exceptions['closem'+i].selectedIndex = 1;
	if(default_ap_c[type][i]  == 'AM')
	document.exceptions['closeap'+i][0].checked = true;
	else{
	document.exceptions['closeap'+i][1].checked = true;
	}

	if(default_closed[type][i] == "00" && (default_h_o[type][i]%12)==0){
	document.exceptions['closed'+i].checked = true;
	document.exceptions['openh'+i].disabled = true;
	document.exceptions['closeh'+i].disabled = true;
	document.exceptions['openm'+i].disabled = true;
	document.exceptions['closem'+i].disabled = true;
	document.exceptions['openap'+i][0].disabled = true;
	document.exceptions['closeap'+i][0].disabled = true;
	document.exceptions['openap'+i][1].disabled = true;
	document.exceptions['closeap'+i][1].disabled = true;

	}
	else{
	document.exceptions['closed'+i].checked = false;
	document.exceptions['openh'+i].disabled = false;
	document.exceptions['closeh'+i].disabled = false;
	document.exceptions['openm'+i].disabled = false;
	document.exceptions['closem'+i].disabled = false;
	document.exceptions['openap'+i][0].disabled = false;
	document.exceptions['closeap'+i][0].disabled = false;
	document.exceptions['openap'+i][1].disabled = false;
	document.exceptions['closeap'+i][1].disabled = false;
	}
	document.getElementById('d'+i).innerHTML = '';

	document.getElementById('d'+i).parentNode.style.backgroundColor = 'white';
	document.getElementById('e'+i).innerHTML = '';


}
current_week = 'default'+type;
document.getElementById('exceptions_div').style.display = 'block';
document.getElementById('banner').style.display = 'block';
if(type==0){
document.getElementById('banner').style.backgroundColor = '#003366';
document.getElementById('banner').innerHTML = 'Default School Hours';
}
else{
document.getElementById('banner').style.backgroundColor = '#6699cc';
document.getElementById('banner').innerHTML = 'Default Summer Hours';
}
}

function submit_changes(){

//alert('true');

var open_time= new Array();


var close_time= new Array();

var day_local = new Array();


if(current_week == 'default0' || current_week == 'default1'){

if(current_week == 'default0')
	var type=0;
else
	var type=1;

	for(var i=0; i < 7; i++){
		if(document.exceptions['closed'+i].checked){
			open_time.push("00:00:00");
			close_time.push("00:00:00");
		}
		else{
			if(document.exceptions['openap'+i][0].checked)
				var openap=document.exceptions['openap'+i][0].value;
			else
				var openap=document.exceptions['openap'+i][1].value;

			if(document.exceptions['closeap'+i][0].checked)
				var closeap=document.exceptions['closeap'+i][0].value;
			else
				var closeap=document.exceptions['closeap'+i][1].value;

			if(openap == "PM")
				var hour = document.exceptions['openh'+i].selectedIndex+12;
			else
				var hour = document.exceptions['openh'+i].selectedIndex;

			if(closeap == "PM"){
				var hour2 = document.exceptions['closeh'+i].selectedIndex+12;
				//alert(temph);
				//var hour2 = temph+12;
				//alert(hour2);
			}
			else{
				var hour2 = document.exceptions['closeh'+i].selectedIndex;
				//alert(hour2);
			}

			if(hour.length < 2){
				hour = '0'+hour;
			}
			if(hour2.length < 2){
				hour2 = '0'+hour2;
			}

			open_time.push(hour+":"+document.exceptions['openm'+i].value+':00');
			close_time.push(hour2+":"+document.exceptions['closem'+i].value+':00');
			//alert(close_time);

		}
	}

}
else{

var type=2;

	//alert(test);
	for(var i=0; i < 7; i++){

	if (test[i].substr(test[i].length - 1) != '-')
	{
			if(document.exceptions['closed'+i].checked){
				open_time.push("00:00:00");
				close_time.push("00:00:00");
				day_local.push(test[i]);
				//alert(test[i]);
				//document.getElementById('cell'+current_week*7+i).className = 'a2';

			}
			else if(!document.exceptions['closed'+i].checked ){

			if(document.exceptions['openap'+i][0].checked)
				var openap=document.exceptions['openap'+i][0].value;
			else
				var openap=document.exceptions['openap'+i][1].value;

			if(document.exceptions['closeap'+i][0].checked)
				var closeap=document.exceptions['closeap'+i][0].value;
			else
				var closeap=document.exceptions['closeap'+i][1].value;

				if(openap == "PM")
					var hour = document.exceptions['openh'+i].selectedIndex+12;
				else
					var hour = document.exceptions['openh'+i].selectedIndex;

				if(closeap == "PM")
					var hour2 = document.exceptions['closeh'+i].selectedIndex+12;
				else
					var hour2 = document.exceptions['closeh'+i].selectedIndex;
				if(hour.length < 2){
					hour = '0'+hour;
				}
				if(hour2.length < 2){
					hour2 = '0'+hour2;
				}


				if(document.exceptions['openh'+i].value == "00")
					var oh = "12";
				else
					var oh = document.exceptions['openh'+i].value;

				if(document.exceptions['closeh'+i].value == "00")
					var ch = "12";
				else
					var ch = document.exceptions['closeh'+i].value;

				if(oh.length < 2){
					oh = '0'+oh;
				}
				if(ch.length < 2){
					ch = '0'+ch;
				}

				var temp1 = oh+':'+document.exceptions['openm'+i].value+':'+	openap;
				var temp2 = ch+':'+document.exceptions['closem'+i].value+':'+closeap;
				var temp3 = ohour[7*current_week+i]+':'+ominute[7*current_week+i]+':'+oampm[7*current_week+i];
				var temp4 = chour[7*current_week+i]+':'+cminute[7*current_week+i]+':'+campm[7*current_week+i];

				//alert(temp1+"="+temp3+" and "+temp2+"="+temp4);

				if(temp1!=temp3 || temp2!=temp4){
					open_time.push(hour+":"+document.exceptions['openm'+i].value+':00');
					close_time.push(hour2+":"+document.exceptions['closem'+i].value+':00');
					day_local.push(test[i]);
					//document.getElementById('cell'+(current_week*7+i)).className = 'a2';
				}
			}

		}
	}
	}
	var xmlHttp;

	try
	  {
	  // Firefox, Opera 8.0+, Safari
	  xmlHttp=new XMLHttpRequest();
	  }
	catch (e)
	  {
	  // Internet Explorer
	  try
		{
		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
	  catch (e)
		{
		try
		  {
		  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		catch (e)
		  {
		  alert("Your browser does not support AJAX!");
		  return false;
		  }
		}
	  }

	  xmlHttp.onreadystatechange=function()
	{
	if(xmlHttp.readyState==4)
	  {
	  //alert(xmlHttp.responseText);
	  window.location = './edithours.php?location=<?php print $location_id;?>&month='+month+'&year='+year+'&week='+current_week;
	  //eval(handler);
	  }
	}

	data = 'data='+open_time+'&data2='+close_time+'&data3=<?php print $location_id;?>&data4='+day_local+'&data5='+type;
	//alert(data);
	xmlHttp.open("POST", 'save_hours.php', true);
	//Send the proper header information along with the request
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//xmlHttp.setRequestHeader("Content-length", data.length);
	//xmlHttp.setRequestHeader("Connection", "close");
	//alert(close_time);
	xmlHttp.send(data);
document.getElementById('exceptions_div').style.display = 'none';
//
	return true;


}
function delete_exceptions(day){
	var xmlHttp;

	try
	  {
	  // Firefox, Opera 8.0+, Safari
	  xmlHttp=new XMLHttpRequest();
	  }
	catch (e)
	  {
	  // Internet Explorer
	  try
		{
		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
	  catch (e)
		{
		try
		  {
		  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		catch (e)
		  {
		  alert("Your browser does not support AJAX!");
		  return false;
		  }
		}
	  }

	  xmlHttp.onreadystatechange=function()
	{
	if(xmlHttp.readyState==4)
	  {
	  //alert(xmlHttp.responseText);
	  window.location = './edithours.php?location=<?php print $location_id;?>&month='+month+'&year='+year+'&week='+current_week;
	  //eval(handler);
	  }
	}

	data = 'data='+day+'&data2=<?php print $location_id;?>';
	xmlHttp.open("POST", 'delete_exceptions.php', true);
	//Send the proper header information along with the request
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//xmlHttp.setRequestHeader("Content-length", data.length);
	//xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send(data);

}
function open_close(checked, i){
if(checked){
	document.exceptions['openh'+i].disabled = true;
	document.exceptions['openh'+i].selectedIndex = 0;
	document.exceptions['closeh'+i].disabled = true;
	document.exceptions['closeh'+i].selectedIndex = 0;
	document.exceptions['openm'+i].disabled = true;
	document.exceptions['openm'+i].selectedIndex = 0;
	document.exceptions['closem'+i].disabled = true;
	document.exceptions['closem'+i].selectedIndex = 0;
	document.exceptions['openap'+i][0].disabled = true;
	document.exceptions['openap'+i][0].checked = true;
	document.exceptions['closeap'+i][0].disabled = true;
	document.exceptions['closeap'+i][0].checked = true;
	document.exceptions['openap'+i][1].disabled = true;
	document.exceptions['closeap'+i][1].disabled = true;

}
else{
	document.exceptions['openh'+i].disabled = false;
	document.exceptions['closeh'+i].disabled = false;
	document.exceptions['openm'+i].disabled = false;
	document.exceptions['closem'+i].disabled = false;
	document.exceptions['openap'+i][0].disabled = false;
	document.exceptions['closeap'+i][0].disabled = false;
	document.exceptions['openap'+i][1].disabled = false;
	document.exceptions['closeap'+i][1].disabled = false;
}

}
</script>
<style>
.a0{
/*background-color:#066cc;*/
}
.a1{
background-color:#6699cc;
}
.a2{
background-color:green;
}
.calendar td{
	color:white;
	width:25px;
	text-align:center;
}
#excep_table td{
	padding-bottom:10px;
}
#d0, #d1, #d2, #d3, #d4, #d5,  #d6{
	padding-left:10px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<div><span style="font-size:24px; margin-left:125px;"><?php print $location_name;?></span></div><br />
<div>
    <div id="caldiv" align="center" style="width: 210px; height: 221px; background-image:url(images/cal_sm2.png); background-repeat: no-repeat; display: block;  float:left;">
        <div style="padding-top:15px; color:#fff;">
            <input type="button" style="float:left;" value="&lt;" onclick="window.location='<?php print './edithours.php?location='.$location_id.'&month='.$Pmonth.'&year='.$Pyear;?>'">
            <?php print $months[$month-1]." ".$year; ?>
            <input type="button" style="float:right;" value="&gt;" onclick="window.location='<?php print './edithours.php?location='.$location_id.'&month='.$Nmonth.'&year='.$Nyear;?>'">
            <table style="clear:both; margin-top:10px;" cellspacing="0" class="calendar">
                <tbody>
                    <tr>
                        <td>Sun</td>
                        <td>Mon</td>
                        <td>Tue</td>
                        <td>Wed</td>
                        <td>Thu</td>
                        <td>Fri</td>
                        <td>Sat</td>
                    </tr>

                    <tr onclick="edit_week(<?php print $w++;?>)">
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                    </tr>
                    <tr onclick="edit_week(<?php print $w++;?>)">
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                    </tr>
                    <tr onclick="edit_week(<?php print $w++;?>)">
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                    </tr>
                    <tr onclick="edit_week(<?php print $w++;?>)">
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                    </tr>
                    <tr onclick="edit_week(<?php print $w++;?>)">
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                    </tr>
                    <tr onclick="edit_week(<?php print $w;?>)">
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i++]['day'];?></td>
                        <td id="cell<?php print $i;?>" class="a<?php print $cal[$i]['type'];?>"><?php print $cal[$i]['day'];?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div style="float:left; width:auto; border:1px solid #003366; padding:15px; margin-left:30px;">
    	<table align="left">
        	<tr onclick="edit_default(0);">
            	<td style="background-color:#003366; width:18px;"></td>
                <td style="color:black; width:auto; text-align:left;" >Default school hours</td>
            </tr>
            <tr onclick="edit_default(1);">
            	<td style="background-color:#6699cc; width:18px;"></td>
                <td style="color:black; width:auto; text-align:left;" >Default summer hours</td>
            </tr>
            <tr>
            	<td style="background-color:green; width:18px;"></td>
                <td style="color:black; width:auto; text-align:left;">Exceptions</td>
            </tr>
         </table>
     </div>
  </div>
  <div id="exceptions_div" style="clear:both; display:none; padding-top:50px;">
  <div id="banner" align="center" style="color:white; font-size:18px;"></div>
  <form name="exceptions">
  <input type="hidden" name="first_date" value="" />
  <table style="color:black;" cellspacing="0" cellpadding="0" id="excep_table" style="">
  <tr>
  <td align="center" colspan="2">day</td></td><td colspan="2" align="center" >open</td><td colspan="2" align="center">close</td><td align="center" style="padding-left:30px;">closed</td><td></td>
  </tr>
  <tr>
  <td>Sunday</td>
  <td id="d0">2/1</td>
  <td style="padding-left:30px;">
  	<select name="openh0">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="openm0">
    	<option value="00">00</option>
        <option value="30">30</option>
    </select>
    </td>
    <td>
    	<input type="radio" name="openap0" value="AM" />AM<br />
  		<input type="radio" name="openap0" value="PM"/>PM<br />

 </td>
 <td style="padding-left:30px;">
 <select name="closeh0">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="closem0">
    	<option value="00">00</option>
        <option value="30">30</option>

    </select>
    </td>
    <td>
    	<input type="radio" name="closeap0" value="AM" />AM<br />
  		<input type="radio" name="closeap0" value="PM"/>PM<br />

 </td>
 <td align="center" style="padding-left:30px;">
 <input type="checkbox" name="closed0" value="1"  onclick="open_close(this.checked, 0);"/>
 </td>
 <td id="e0"></td>
 <tr>
  <td>Monday</td>
  <td id="d1">2/2</td>
  <td style="padding-left:30px;">
  	<select name="openh1">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="openm1">
    	<option value="00">00</option>
        <option value="30">30</option>
    </select>
    </td>
    <td>
    	<input type="radio" name="openap1" value="AM" />AM<br />
  		<input type="radio" name="openap1" value="PM"/>PM<br />

 </td>
 <td style="padding-left:30px;">
 <select name="closeh1">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="closem1">
    	<option value="00">00</option>
        <option value="30">30</option>

    </select>
    </td>
    <td>
    	<input type="radio" name="closeap1" value="AM" />AM<br />
  		<input type="radio" name="closeap1" value="PM"/>PM<br />

 </td>
 <td align="center" style="padding-left:30px;">
 <input type="checkbox" name="closed1" value="1"  onclick="open_close(this.checked, 1);"/>
 </td>
 <td id="e1"></td>
 <tr>
  <td>Tuesday</td>
  <td id="d2">2/3</td>
  <td style="padding-left:30px;">
  	<select name="openh2">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="openm2">
    	<option value="00">00</option>
        <option value="30">30</option>
    </select>
    </td>
    <td>
    	<input type="radio" name="openap2" value="AM" />AM<br />
  		<input type="radio" name="openap2" value="PM"/>PM<br />

 </td>
 <td style="padding-left:30px;">
 <select name="closeh2">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="closem2">
    	<option value="00">00</option>
        <option value="30">30</option>

    </select>
    </td>
    <td>
    	<input type="radio" name="closeap2" value="AM" />AM<br />
  		<input type="radio" name="closeap2" value="PM"/>PM<br />

 </td>
 <td align="center" style="padding-left:30px;">
 <input type="checkbox" name="closed2" value="1"  onclick="open_close(this.checked, 2);"/>
 </td>
 <td id="e2"></td>
 <tr>
  <td>Wednesday</td>
  <td id="d3">2/4</td>
  <td style="padding-left:30px;">
  	<select name="openh3">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="openm3">
    	<option value="00">00</option>
        <option value="30">30</option>
    </select>
    </td>
    <td>
    	<input type="radio" name="openap3" value="AM" />AM<br />
  		<input type="radio" name="openap3" value="PM"/>PM<br />

 </td>
 <td style="padding-left:30px;">
 <select name="closeh3">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="closem3">
    	<option value="00">00</option>
        <option value="30">30</option>

    </select>
    </td>
    <td>
    	<input type="radio" name="closeap3" value="AM" />AM<br />
  		<input type="radio" name="closeap3" value="PM"/>PM<br />

 </td>
 <td align="center" style="padding-left:30px;">
 <input type="checkbox" name="closed3" value="1"  onclick="open_close(this.checked, 3);"/>
 </td>
 <td id="e3"></td>
 <tr>
  <td>Thursday</td>
  <td id="d4">2/5</td>
  <td style="padding-left:30px;">
  	<select name="openh4">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="openm4">
    	<option value="00">00</option>
        <option value="30">30</option>
    </select>
    </td>
    <td>
    	<input type="radio" name="openap4" value="AM" />AM<br />
  		<input type="radio" name="openap4" value="PM"/>PM<br />

 </td>
 <td style="padding-left:30px;">
 <select name="closeh4">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="closem4">
    	<option value="00">00</option>
        <option value="30">30</option>

    </select>
    </td>
    <td>
    	<input type="radio" name="closeap4" value="AM" />AM<br />
  		<input type="radio" name="closeap4" value="PM"/>PM<br />

 </td>
 <td align="center" style="padding-left:30px;">
 <input type="checkbox" name="closed4" value="1"  onclick="open_close(this.checked, 4);"/>
 </td>
 <td id="e4"></td>
 <tr>
  <td>Friday</td>
  <td id="d5">2/6</td>
  <td style="padding-left:30px;">
  	<select name="openh5">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="openm5">
    	<option value="00">00</option>
        <option value="30">30</option>
    </select>
    </td>
    <td>
    	<input type="radio" name="openap5" value="AM" />AM<br />
  		<input type="radio" name="openap5" value="PM"/>PM<br />

 </td>
 <td style="padding-left:30px;">
 <select name="closeh5">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="closem5">
    	<option value="00">00</option>
        <option value="30">30</option>

    </select>
    </td>
    <td>
    	<input type="radio" name="closeap5" value="AM" />AM<br />
  		<input type="radio" name="closeap5" value="PM"/>PM<br />

 </td>
 <td align="center" style="padding-left:30px;">
 <input type="checkbox" name="closed5" value="1"  onclick="open_close(this.checked, 5);"/>
 </td>
 <td id="e5"></td>
 <tr>
  <td>Saturday</td>
  <td id="d6">2/7</td>
  <td style="padding-left:30px;">
  	<select name="openh6">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="openm6">
    	<option value="00">00</option>
        <option value="30">30</option>
    </select>
    </td>
    <td>
    	<input type="radio" name="openap6" value="AM" />AM<br />
  		<input type="radio" name="openap6" value="PM"/>PM<br />

 </td>
 <td style="padding-left:30px;">
 <select name="closeh6">
       <option value="00">12</option>12</option><option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
    </select>:<select name="closem6">
    	<option value="00">00</option>
        <option value="30">30</option>

    </select>
    </td>
    <td>
    	<input type="radio" name="closeap6" value="AM" />AM<br />
  		<input type="radio" name="closeap6" value="PM"/>PM<br />

 </td>
 <td align="center" style="padding-left:30px;">
 <input type="checkbox" name="closed6" value="1"  onclick="open_close(this.checked, 6);"/>
 </td>
 <td id="e6"></td>
 </table>
 <input type="button" value="update" onclick="submit_changes()" /><input type="button" value="cancel" onclick="document.getElementById('exceptions_div').style.display='none';" />
 </form>
  </div>
 <script type="text/javascript">edit_week(<?php print $open_week;?>);</script>
</body>
</html>
