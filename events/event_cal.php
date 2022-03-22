<?php

// the calendars are on azstudentunion@gmail.com  pswd=sumc4414

$url = 'https://www.google.com/calendar/embed?showTitle=0&mode=WEEK&height=600&wkst=1&bgcolor=%23FFFFFF&'.
	'src=azstudentunion%40gmail.com&color=%23C3D445&'.									// Student Union
	'src=0rvt013ke1jdi67oeojcmvovtc%40group.calendar.google.com&color=%233640AD&'.		// ASUA
  	'src=uaor65u7g4rp3qfo9jtjv66n7s%40group.calendar.google.com&color=%23AB2671&'.		// Career Services
  	// 'src=np7b4221terameeeuugv1e7ou8%40group.calendar.google.com&color=%23CF9911&'.		// CSIL
	'src=7lde8gnlc08uue6oebb8j33dt4%40group.calendar.google.com&color=%23AD2D2D&'.      // Dining
	'src=r91kf8e58gjq33akrnhlo5ituk%40group.calendar.google.com&color=%23668CB3&'.		// Events Board
	'src=nkj5uavso16ofaf4umvfdlbvd4%40group.calendar.google.com&color=%23737373&'.      // Gallagher
	'src=6p4vfk5bfd3tgd1np34skev3gs%40group.calendar.google.com&color=%234CB052&'.      // Games Room
	'src=bbt1joikvitvd0u5a0bo1ltahg%40group.calendar.google.com&color=%23E67399&'.		// Off Campus Housing
	'src=ucd9kt5sgbdve5jalkpbmddtc8%40group.calendar.google.com&color=%23D47F1E&'.		// Union Galleries
	'src=email.arizona.edu_ieujbdt3ip8lnhkn56i9vmms5g@group.calendar.google.com&color=%23603F99&'.									// Women's Resources
	// 'src=klocp42akqe62qrt3k3avqtdpo%40group.calendar.google.com&color=%23603F99&'.		// Women's Resources
	// 'src=asuapride@gmail.com&color=%23668CD9&'.											// LGBTQ Student Club Meetings
	'ctz=America%2FPhoenix';
//$url = 'https://www.union.arizona.edu/googlecal/mini.php?showTitle=0&showDate=0&showPrint=0&showTabs=0&showCalendars=0&showTz=0&mode=AGENDA&height=270&wkst=1&bgcolor=%23F4F5F3&color=%238D6F47&src=arizonastudentunions%40gmail.com&ctz=America%2FPhoenix';
$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_REFERER, 'http://union.arizona.edu/events/index.php');
        $buffer = curl_exec($ch);

		curl_close($ch);


// Point stylesheet and javascript to custom versions
$pattern = '/(<link.*>)/';
$replacement = '<link rel="stylesheet" type="text/css" href="/events/fullcalstyle.css" />';
$buffer = preg_replace($pattern, $replacement, $buffer);

$pattern = '/src="(.*js)"/';
//$replacement = 'src="/googlecal/fullcaljs.php?$1"';
//$replacement = 'src="https://www.google.com/calendar/2d85b761572dd165bc0800e94646b758embedcompiled__en.js"';
$replacement = 'src="/googlecal/gcal.js"';
$buffer = preg_replace($pattern, $replacement, $buffer);



//print $buffer;
