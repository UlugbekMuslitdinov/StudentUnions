<?php
// include('global.inc');
include('../template/global.inc');
$page_options = array();
$page_options['page'] = 'events';
page_start($page_options);
?>
<style>
.cal-on, .cal-off{
	float:left; height:10px; width:10px; margin:3px; clear:both; display:inline-block;
}
.cal-off{
	background-color:#ffffff !important;
}
h1{
	font-size:30px;
	color:#776655;
}
</style>
<script>
	function toggle_cal(elm){
		if(elm.className=='cal-on'){
			elm.className='cal-off';
			frames[0].goog$calendar$CalendarList$0showHideCalendar(elm.id, false);
		}else{
			elm.className='cal-on';
			frames[0].goog$calendar$CalendarList$0showHideCalendar(elm.id, true);}
	}
</script>
<h1>Union Calendars</h1>
<div style="float:left; font-size:9px;">Toggle display/iCal Feed</div><br />

<div style="float:left; width:150px; font-size:10px; line-height:20px;">
	<div title="Click to toggle calendar display" id="http<?=isset($_SERVER['HTTPS'])?'s':''?>://<?=$_SERVER['SERVER_NAME']?>/calendar/feeds/azstudentunion%40gmail.com/public/embed" class="cal-on" style="border:2px solid #C3D445; background-color:#C3D445;" onclick="toggle_cal(this)" ></div> <a title="Click to subscribe to iCal feed" href="https://www.google.com/calendar/ical/azstudentunion%40gmail.com/public/basic.ics">Student Union</a><br />

<div title="Click to toggle calendar display" id="http<?=isset($_SERVER['HTTPS'])?'s':''?>://<?=$_SERVER['SERVER_NAME']?>/calendar/feeds/0rvt013ke1jdi67oeojcmvovtc%40group.calendar.google.com/public/embed" class="cal-on" style="border:2px solid #3640AD; background-color:#3640AD;" onclick="toggle_cal(this)" ></div> <a title="Click to subscribe to iCal feed" href="https://www.google.com/calendar/ical/0rvt013ke1jdi67oeojcmvovtc%40group.calendar.google.com/public/basic.ics">ASUA</a><br />
<!--
<div id="http<?=$_SERVER['HTTPS']?'s':''?>://<?=$_SERVER['SERVER_NAME']?>/calendar/feeds/uaor65u7g4rp3qfo9jtjv66n7s%40group.calendar.google.com/public/embed" class="cal-on" style="border:2px solid #AB2671; background-color:#AB2671;" onclick="toggle_cal(this)" ></div> Career Services<br />
<div id="http<?=$_SERVER['HTTPS']?'s':''?>://<?=$_SERVER['SERVER_NAME']?>/calendar/feeds/np7b4221terameeeuugv1e7ou8%40group.calendar.google.com/public/embed" class="cal-on" style="border:2px solid #CF9911; background-color:#CF9911;" onclick="toggle_cal(this)" ></div> CSIL<br />
-->
<div title="Click to toggle calendar display" id="http<?=isset($_SERVER['HTTPS'])?'s':''?>://<?=$_SERVER['SERVER_NAME']?>/calendar/feeds/7lde8gnlc08uue6oebb8j33dt4%40group.calendar.google.com/public/embed" class="cal-on" style="border:2px solid #AD2D2D; background-color:#AD2D2D;" onclick="toggle_cal(this)" ></div> <a title="Click to subscribe to iCal feed" href="https://www.google.com/calendar/ical/7lde8gnlc08uue6oebb8j33dt4%40group.calendar.google.com/public/basic.ics">Dining</a><br />
<div title="Click to toggle calendar display" id="http<?=isset($_SERVER['HTTPS'])?'s':''?>://<?=$_SERVER['SERVER_NAME']?>/calendar/feeds/r91kf8e58gjq33akrnhlo5ituk%40group.calendar.google.com/public/embed" class="cal-on" style="border:2px solid #668CB3; background-color:#668CB3;" onclick="toggle_cal(this)" ></div> <a title="Click to subscribe to iCal feed" href="https://www.google.com/calendar/ical/r91kf8e58gjq33akrnhlo5ituk%40group.calendar.google.com/public/basic.ics">Events Board</a><br />
<div title="Click to toggle calendar display" id="http<?=isset($_SERVER['HTTPS'])?'s':''?>://<?=$_SERVER['SERVER_NAME']?>/calendar/feeds/nkj5uavso16ofaf4umvfdlbvd4%40group.calendar.google.com/public/embed" class="cal-on" style="border:2px solid #737373; background-color:#737373" onclick="toggle_cal(this)" ></div> <a title="Click to subscribe to iCal feed" href="https://www.google.com/calendar/ical/nkj5uavso16ofaf4umvfdlbvd4%40group.calendar.google.com/public/basic.ics">Gallagher</a><br />

<div title="Click to toggle calendar display" id="http<?=isset($_SERVER['HTTPS'])?'s':''?>://<?=$_SERVER['SERVER_NAME']?>/calendar/feeds/6p4vfk5bfd3tgd1np34skev3gs%40group.calendar.google.com/public/embed" class="cal-on" style="border:2px solid #4CB052; background-color:#4CB052;" onclick="toggle_cal(this)" ></div> <a title="Click to subscribe to iCal feed" href="https://www.google.com/calendar/ical/6p4vfk5bfd3tgd1np34skev3gs%40group.calendar.google.com/public/basic.ics">Games Room</a><br />

<div title="Click to toggle calendar display" id="http<?=isset($_SERVER['HTTPS'])?'s':''?>://<?=$_SERVER['SERVER_NAME']?>/calendar/feeds/ucd9kt5sgbdve5jalkpbmddtc8%40group.calendar.google.com/public/embed" class="cal-on" style="border:2px solid #D47F1E; background-color:#D47F1E;" onclick="toggle_cal(this)" ></div> <a title="Click to subscribe to iCal feed" href="https://www.google.com/calendar/ical/ucd9kt5sgbdve5jalkpbmddtc8%40group.calendar.google.com/public/basic.ics">Union Galleries</a><br />
<div title="Click to toggle calendar display" id="http<?=isset($_SERVER['HTTPS'])?'s':''?>://<?=$_SERVER['SERVER_NAME']?>/calendar/feeds/klocp42akqe62qrt3k3avqtdpo%40group.calendar.google.com/public/embed" class="cal-on" style="border:2px solid #603F99; background-color:#603F99;" onclick="toggle_cal(this)" ></div> <a title="Click to subscribe to iCal feed" href="https://www.google.com/calendar/ical/klocp42akqe62qrt3k3avqtdpo%40group.calendar.google.com/public/basic.ics">Women's Resource Center</a>
</div>
<?php

include('event_cal.php');
// include('event_cal.php');
// the calendars are on azstudentunion@gmail.com  pswd=sumc4414

// display the calendar
print '<div style="float:left; margin-left:50; height:600px;"><iframe src="'.$url.'" height="600" width="800" frameborder="0"></iframe></div>';


?>
<!-- <iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=r91kf8e58gjq33akrnhlo5ituk%40group.calendar.google.com&amp;color=%23AB8B00&amp;src=0rvt013ke1jdi67oeojcmvovtc%40group.calendar.google.com&amp;color=%2323164E&amp;src=7lde8gnlc08uue6oebb8j33dt4%40group.calendar.google.com&amp;color=%23333333&amp;src=nkj5uavso16ofaf4umvfdlbvd4%40group.calendar.google.com&amp;color=%231B887A&amp;src=6p4vfk5bfd3tgd1np34skev3gs%40group.calendar.google.com&amp;color=%230D7813&amp;src=bbt1joikvitvd0u5a0bo1ltahg%40group.calendar.google.com&amp;color=%23B1365F&amp;src=ucd9kt5sgbdve5jalkpbmddtc8%40group.calendar.google.com&amp;color=%238C500B&amp;ctz=America%2FPhoenix" ></iframe> -->
<?php page_finish();?>
