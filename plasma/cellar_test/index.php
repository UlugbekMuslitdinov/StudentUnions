<?php
	###########################################
	# required for all pages using DELIVERANCE #
	############################################
	
	// enables 'edit | view' options to appear for authorized users
	session_start();
	  
	// includes the display functions
	include($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/display_functions.php");
	  
	// connect to database
	include($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/inc_db_switch.php");
	
	// select database
	mysql_select_db("deliverance", $DBlink)
	or die(mysql_error());
	
	################################
	# end DELIVERANCE requirements #
	################################
	
	// Make sure menuID is not blank
	$menuID = $_GET['menuID'];
	if (!isset($menuID)||$menuID==null||$menuID=="") {
		$menuID = "menu_1";
	}
	
	// Set all the date information used to determine which slides to display
	// alter curtime to test various times and how menu works
	// mktime is Hours, Minutes, Seconds, Month, Day, Year
	$dayBump = 0;
	$hourBump = 0;
	$minBump = 0;
	// get a time with the bumps
	$curtime = mktime(intval(date("G"))+$hourBump, intval(date("i"))+$minBump, intval(date("s")), date("m")  , date("d")+$dayBump, date("Y"));
	$day = intval(date("N", $curtime));
	$hour = intval(date("G", $curtime));
	$min = intval(date("i", $curtime));
	// Flag used for special menus
	$isSpecial = false;
	// Flag used for night and weekend menu
	$isNightWeekend = false;
	
	// These are the 2 time references for the dates of the special menu
	// This could be adapted to arrays or db info later
	//$specialStart = mktime(15, 0, 0, 11, 5, date("Y"));
	//$specialEnd = mktime(2, 0, 0, 11, 6, date("Y"));
	
	$specialStart = mktime(17, 28, 0, 11, 9, date("Y"));
	$specialEnd = mktime(17, 35, 0, 11, 9, date("Y"));
	
	if ($specialStart < $curtime && $curtime < $specialEnd) {
		// We should be running the special menu now
		$isSpecial = true;
		// These are the deliverance display ids
		$specialID1 = 47;
		$specialID2 = 48;
		// Use this as a flag to disable fading when only using one of the special blocks
		$onlyOne = true;
	}
	if ($day > 5 || ($hour<6 || $hour>=20)) {
		// Night and weekend menu displayed sat, sun, and mon-fri(6am-8pm)
		$isNightWeekend = true;
	}
?>
<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
		<script type="text/javascript">
			// The time between transitions
			var fadeInterval = 15000;
			// The time between reloads
			var reloadInterval = 300000;
			// Use this to keep track of which menu div is currently showing
			var current = 'menu_1';
			// Use this to keep track of if only one slide is in special. pulled from php
			var disableFade = <?php if($onlyOne) {print("true");} else {print("false");} ?>;
			
			/**
			 * The following 3 functions are used to manipulate the string
			 *   returned by test.php to remove any unnecessary characters.
			 */
			function trimWhite(str) {
				var chars = new Array(' ', '\t', '\n', '\r');
				return ltrim(rtrim(str, chars), chars);
			}
			function ltrim(str, chars) {
				chars = chars || "\\s";
				return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
			}
			function rtrim(str, chars) {
				chars = chars || "\\s";
				return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
			}
			
			/**
			 * This function has now been simplified and waits 15 secs and then
			 *   calls the switch_images function which does the fading and
			 *   changing of the current menu.
			 */
			function start_fade() {
				setTimeout(switch_images,fadeInterval);
				// call this every one second to run the time change and check for reload times.
				setInterval('checkForReload()', 1000);
			}
			
			/**
			 * This function makes sure that the menu divs are in the right order
			 *   when we reload the page. This makes the reload far less apparent
			 *   if we still show the same slide. It also removes any alt and title
			 *   tags from images to prevent tooltips.
			 */
			function switch_onreload(curmenu){
				document.getElementById('menu_1').style.zIndex =1;
				document.getElementById('menu_2').style.zIndex =0;
				document.getElementById(curmenu).style.zIndex =10;
				current=curmenu;
				for(i =0;i<document.images.length;i++) {
					document.images[i].title='';
					document.images[i].alt='';
				}
			}
		
			/**
			 * This function uses JQuery to fade the menu divs containing images
			 *   unless the disable flag is true. It also updates what the current
			 *   menu being displayed is. It also recursivly calls back to
			 *   itself every 15 secs.
			 */
			function switch_images(){
				if (!disableFade) {
					if (current == "menu_1") {
						$('#menu_1').fadeOut('slow');
						$('#menu_2').fadeIn('slow', function() {
							current = "menu_2";
							setTimeout(switch_images,fadeInterval);
						});
					}
					else if (current == "menu_2") {
						$('#menu_2').fadeOut('slow');
						$('#menu_1').fadeIn('slow', function() {
							current = "menu_1";
							setTimeout(switch_images,fadeInterval);
						});
					}
				}
			}
			
			/**
			 * This function is called instead of reload on the page to ensure
			 *   the server is up and responding to requests and not recieving
			 *   errors when connecting to mysql/deliverance. It uses an ajax
			 *   call to see if test.php only generates the string "success"
			 *   and no other text which would likely be an error. If this is
			 *   not true it does not reload and the caller should add logic to
			 *   try again later.
			 */
			function check_connection_and_reload(){
			    var xmlHttp;
			    try {
			    	// Firefox, Opera 8.0+, Safari
			    	xmlHttp=new XMLHttpRequest();
			    } catch (e) {
			    	// Internet Explorer
			    	try {
			    		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
			    	} catch (e) {
			    		try {
			    			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			    		} catch (e) {
			    			alert("Your browser does not support AJAX!");
			    			return false;
			    		}
			    	}
			    }
			    xmlHttp.onreadystatechange = function() {
			    	if(xmlHttp.readyState==4) {
			    		testResponse = xmlHttp.responseText;
			    		testResponse = testResponse.toLowerCase();
			    		testResponse = trimWhite(testResponse);
				    	if(testResponse=='success') {
				    		window.location='./index.php?menuID='+current;
				    	}
				    }
			    };
			    xmlHttp.open("POST", './test.php', true);
			    xmlHttp.send('');  
			}
			
			/**
			 * The purpose of this function is to keep track of the time in JS
			 *   and to reload the page to adjust to new menus at assinged times.
			 */
			function checkForReload() {
				// Grab the hour & min bump from php
				var hBump = <?php print($hourBump); ?>;
				var mBump = <?php print($minBump); ?>;
				// Get a new date object
				var date = new Date();
				// Grab the seconds from the current time
				var secs = date.getSeconds();
				/* Grab the hours from the current time, shift by hour bump and
				 *   then add any number of rollover generated by a min bump 
				 *   which generates numbers greater than 60
				 */
				var hour = date.getHours() + hBump + Math.floor((date.getMinutes() + mBump)/60);
				/* Grab the minutes from the current time, shift by minute bump
				 *   and modulo by 60 to avoid minutes > 60
				 */
				var min = (date.getMinutes() + mBump) % 60;
				var suff = "AM";
				
				if (secs < 10) {
					secs = "0" + secs;
				}
				if (min < 10) {
					min = "0" + min;
				}
				if (hour == 12 && min >= 1) {
					suff = "PM";
				}
				if (hour == 24 && min >= 1) {
					hour-= 12;
					suff = "AM";
				}
				if (hour > 12) {
					hour-= 12;
					suff = "PM";
				}
				
				var time = hour + ":" + min + ":" + secs + " " + suff;
				document.getElementById('time').innerHTML=(time);
				
				// Reload when night menu should start
				if (time == "8:00:00 PM") {
                                        setTimeout("check_connection_and_reload()", 5000);
				}
				// Reload when day menu should start
				if (time == "6:00:00 AM") {
                                        setTimeout("check_connection_and_reload()", 5000);
				}
				// Reload every day at midnight
				if (time == "12:00:00 AM") {
                                        setTimeout("check_connection_and_reload()", 5000);
				}
				// Reload when a special starts we use php to know this
				if (time == "<?php print(date("g:i:s A", $specialStart)); ?>") {
                                        setTimeout("check_connection_and_reload()", 5000);
				}
				// Reload when a special ends we use php to know this
				if (time == "<?php print(date("g:i:s A", $specialEnd)); ?>") {
					setTimeout("check_connection_and_reload()", 5000);
				}
			}
		</script>
		<style>
			* {
				cursor: none;
			}
			body {
				margin:0px;
				padding:0px;
				background-color:#000000;
				overflow:hidden;
				cursor:none;
			}
			.content {
				margin:0px;
				padding:0px;
				font-family:"Helvetica Neue";
				z-index:0;
			}
		</style>
	</head>
	<body onload="start_fade();">
		<div class="content">
			<div id="menu_1" style="width:1280px; height:720px; position:absolute; top:0px; left:0px;">
				<?php
					// Decide which block is in the second menu based on booleans previously generated
					if ($isSpecial) {
						staticfeed(intval($specialID1));
					}
					else if ($isNightWeekend) {
						staticfeed(35);
					}
					else {
						staticfeed(33);
					}
				?>
			</div>
			<div id="menu_2" style="width:1280px; height:720px; position:absolute; top:0px; left:0px;">
				<?php
					// Decide which block is in the second menu based on booleans previously generated
					if ($isSpecial) {
						staticfeed(intval($specialID2));
					}
					else if ($isNightWeekend) {
						staticfeed(44);
					}
					else {
						staticfeed(34);
					}
				?>
			</div>
		</div>
		<?php
			// Display debugging text at the bottom of the page.
			echo '<div style="position:absolute;top:750px;color:#FFF;">PHP @ Load Time: '.date("D M j G:i:s T Y", $curtime).'<br />Current JS Time: <span id="time"></span></div>';
		?>
	</body>
	<script type="text/javascript">
		// Make sure we pick up where we left off
		switch_onreload( <?php echo '"'.$menuID.'"'; ?> );
		// Reload the page every 5 minutes to refresh resources
		setInterval(check_connection_and_reload, reloadInterval);
	</script>
</html>
