<?php
	require('sectioninfo.inc');
	require('global.inc');
	$title = 'Student Union Hours';
	pageStart($title);


	$db_name = "hours2";
	$db_host = "mysql_host";
	$db_user = "web";
	$db_pass = "viv3nij";
	
	$location_table = "location";
	$groups_table = "groups";				
			
	$link = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
	mysql_select_db($db_name, $link) or die(mysql_error());
	
	$current = mysql_query("select group_key from groups");
	while($location = mysql_fetch_assoc($current)) {
		$locations[]=$location['group_key'];
	}
		
	// Grab the appropriate Get variables
	$cur_id=$_GET['cur_id'];
	$cat=$_GET[cat];
	if (!isset($_GET[cat])||$_GET[cat]==""||$_GET[cat]==null||$_GET[cat]=="all") {
		$cat="open";
	}
	$cur_date = date("Y-m-d");
	$cur_day = strtolower(date('D'));
	$cur_time = date('G:i:s');
		
	if (!isset($_GET[cur_id])||$_GET[cur_id]==""||$_GET[cur_id]==null) {
		$query = mysql_query('select * from hours join periods on hours.type=periods.type where start_date<="'.$cur_date.'" and end_date>="'.$cur_date.'" and location_id=9');
		$building = mysql_fetch_assoc($query);
		$query = mysql_query('select * from hours join periods on hours.type=periods.type where start_date<="'.$cur_date.'" and end_date>="'.$cur_date.'" and location_id=23');
		$cellar = mysql_fetch_assoc($query);
		$exceptions = mysql_query('select * from exceptions where date_of="'.$cur_date.'" and location_id=9');
		$exceptions = mysql_fetch_assoc($exceptions);
		$building_open = $row['open'.substr($cur_day,0,1)];
		$building_close = $row['close'.substr($cur_day,0,1)];
		if ($location_exceptions!=null) {
			$building_open = $location_exceptions['open'];
			$building_close = $location_exceptions['close'];
		}
		$exceptions = mysql_query('select * from exceptions where date_of="'.$cur_date.'" and location_id=23');
		$exceptions = mysql_fetch_assoc($exceptions);
		$cellar_open = $row['open'.substr($cur_day,0,1)];
		$cellar_close = $row['close'.substr($cur_day,0,1)];
		if ($location_exceptions!=null) {
			$cellar_open = $location_exceptions['open'];
			$cellar_close = $location_exceptions['close'];
		}
		$cellar_isopen = ($building_open <= $cur_time && $building_close >= $cur_time);
		$building_isopen = ($cellar_open <= $cur_time && $cellar_close >= $cur_time);
		if ($cellar_isopen && !$building_isopen) {
			$cur_id=23;
		}
		else {
			$cur_id=9;
		}
	}

	// Grab the name associated with the current ID
	$current = mysql_query("select location_name from location where location_id='".$cur_id."'");
	$cur_location = mysql_fetch_assoc($current);
?>
	<link rel="stylesheet" type="text/css" href="hours.css">
    
	<script type="text/javascript">
	<!--

		//Contents for menu 1
		var menu1=new Array()
		
		menu1[0]='<a href="index.php?cat=sumc">Student Union</a>'
		menu1[1]='<a href="index.php?cat=psu">Park Student Union</a>'
		menu1[2]='<a href="index.php?cat=ufs">Union Outlets</a>'
		<!--menu1[3]='<a href="index.php?cat=all">All</a>'-->

		//Contents for menu 2, and so on
		var menu2=new Array()
		menu2[0]='<a href="index.php?cat=dining">Dining</a>'
		menu2[1]='<a href="index.php?cat=admin">Administartive</a>'
		menu2[2]='<a href="index.php?cat=services">Services</a>'
		<!--menu2[3]='<a href="index.php?cat=all">All</a>'-->
				
		var menuwidth='166' //default menu width
		var menubgcolor='#00397b'  //menu bgcolor
		var disappeardelay=250  //menu disappear speed onMouseout (in miliseconds)
		var hidemenu_onclick="yes" //hide menu when user clicks within menu?

		/////No further editting needed
		var ie4=document.all
		var ns6=document.getElementById&&!document.all

		if (ie4||ns6)
		document.write('<div id="dropmenudiv" style="visibility:hidden;width:'+menuwidth+';background-color:'+menubgcolor+'" onMouseover="clearhidemenu()" onMouseout="dynamichide(event)"></div>')

		function getposOffset(what, offsettype){
		var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
		var parentEl=what.offsetParent;
		while (parentEl!=null){
		totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
		parentEl=parentEl.offsetParent;
		}
		return totaloffset;
		}

		function showhide(obj, e, visible, hidden, menuwidth){
		if (ie4||ns6)
		dropmenuobj.style.left=dropmenuobj.style.top="-500px"
		if (menuwidth!=""){
		dropmenuobj.widthobj=dropmenuobj.style
		dropmenuobj.widthobj.width=menuwidth
		}
		if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover")
		obj.visibility=visible
		else if (e.type=="click")
		obj.visibility=hidden
		}

		function iecompattest(){
		return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
		}

		function clearbrowseredge(obj, whichedge){
		var edgeoffset=0
		if (whichedge=="rightedge"){
		var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15
		dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
		if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
		edgeoffset=dropmenuobj.contentmeasure-obj.offsetWidth
		}
		else{
		var topedge=ie4 && !window.opera? iecompattest().scrollTop : window.pageYOffset
		var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
		dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
		if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure){ //move up?
		edgeoffset=dropmenuobj.contentmeasure+obj.offsetHeight
		if ((dropmenuobj.y-topedge)<dropmenuobj.contentmeasure) //up no good either?
		edgeoffset=dropmenuobj.y+obj.offsetHeight-topedge
		}
		}
		return edgeoffset
		}

		function populatemenu(what){
		if (ie4||ns6)
		dropmenuobj.innerHTML=what.join("")
		}

		function dropdownmenu(obj, e, menucontents, menuwidth){
		if (window.event) event.cancelBubble=true
		else if (e.stopPropagation) e.stopPropagation()
		clearhidemenu()
		dropmenuobj=document.getElementById? document.getElementById("dropmenudiv") : dropmenudiv
		populatemenu(menucontents)

		if (ie4||ns6){
		showhide(dropmenuobj.style, e, "visible", "hidden", menuwidth)
		dropmenuobj.x=getposOffset(obj, "left")
		dropmenuobj.y=getposOffset(obj, "top")
		dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+"px"
		dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+obj.offsetHeight+"px"
		}

		return clickreturnvalue()
		}

		function clickreturnvalue(){
		if (ie4||ns6) return false
		else return true
		}

		function contains_ns6(a, b) {
		while (b.parentNode)
		if ((b = b.parentNode) == a)
		return true;
		return false;
		}

		function dynamichide(e){
		if (ie4&&!dropmenuobj.contains(e.toElement))
		delayhidemenu()
		else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
		delayhidemenu()
		}

		function hidemenu(e){
		if (typeof dropmenuobj!="undefined"){
		if (ie4||ns6)
		dropmenuobj.style.visibility="hidden"
		}
		}

		function delayhidemenu(){
		if (ie4||ns6)
		delayhide=setTimeout("hidemenu()",disappeardelay)
		}

		function clearhidemenu(){
		if (typeof delayhide!="undefined")
		clearTimeout(delayhide)
		}

		if (hidemenu_onclick=="yes")
		document.onclick=hidemenu
	-->
	</script>

<?php
	// Grab the phone number associated with the current location ID
	$current = mysql_query("select phone from location where location_id='".$cur_id."'");
	$phone = mysql_fetch_assoc($current);
	// Grab the group ID associated with the current location ID (Group ID is the Identity of the union which it belongs to eg. Dining, Services, etc..)
	$current = mysql_query("select group_id from location where location_id='".$cur_id."'");
	$building = mysql_fetch_assoc($current);
	// Grab the name of the Building associated with the current location ID
	$current = mysql_query("select group_name from groups where group_id='".$building['group_id']."'");
	$building = mysql_fetch_assoc($current);
?>
	<div id="content">
	
    	<div id="banner"><img src="./images/Hours_banner.jpg" alt="Union Hours"/></div>
		<div id="menubar">
	    	<div id="menu"><span href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu1, '165px')" onMouseout="delayhidemenu()" style="padding-left:36px;">Sort By Location</span></div>
    	    <div id="menu" style="border-left:solid 2px; border-right:solid 2px; border-color:#FFFFFF;"><span href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu2, '165px')" onMouseout="delayhidemenu()" style="padding-left:29px; margin-left:2px;">Sort By Category</span></div>
        	<div id="menu"><a href="index.php?cat=open" style="padding-left:29px;">What's Open Now?</a></div>
        </div>
        
        
        <div id="locations">
        	<div class="title">
				<?php
					// If the current catagorey is in the list of locations then display the name of its building (eg. SUMC, PSU, etc..)
	                if (in_array($cat, $locations)){
						$current = mysql_query("select group_name from groups where group_key='".$cat."'");
						$cur_group = mysql_fetch_assoc($current);
						echo $cur_group['group_name'];
					}
					// If the current catrogory is open display whats open
					else if ($cat == open) {
						echo "Open Now";
					}
					// Otherwise just display the catagorey name (eg. Dining, Services, etc..)
					else {
						echo ucwords($cat);
					}
				?>
            </div>
            	<?php
					// If the current catagorey is in the list of locations then grab the locations associated with that building (eg. SUMC, PSU, etc..)
					if (in_array($cat,$locations)){
						$current = mysql_query("select group_id from groups where group_key='".$cat."'");
						$cur_group = mysql_fetch_assoc($current);
						$location_info = mysql_query("select location_name, location_id from location where group_id='".$cur_group['group_id']."' order by location_name");
					}
					// If the current catagorey is null or all then just grab the entire list of locations
					else if ($cat==all || $cat==null) {
						$location_info = mysql_query("select location_name, location_id from location order by location_name");
					}
					// If the current catagorey is open then set the query to the list of currently open locations
					else if ($cat == open) {
						$location_info = mysql_query('select * from hours join periods on hours.type=periods.type join location on hours.location_id=location.location_id where start_date<="'.$cur_date.'" and end_date>="'.$cur_date.'" order by location_name');
						while($row = mysql_fetch_assoc($location_info)) {
							$location_exceptions = mysql_query('select * from exceptions where date_of="'.$cur_date.'" and location_id='.$row['location_id']);
							$location_exceptions = mysql_fetch_assoc($location_exceptions);
							$cur_today_open = $row['open'.substr($cur_day,0,1)];
							$cur_today_close = $row['close'.substr($cur_day,0,1)];
							if ($location_exceptions!=null) {
								$cur_today_open=$location_exceptions['open'];
								$cur_today_close=$location_exceptions['close'];
							}
							if ($cur_today_open <= $cur_time && $cur_today_close >= $cur_time) {
								$current = mysql_query('select location_name from location where location_id='.$row['location_id']);
								$cur_loc_name = mysql_fetch_assoc($current);
								if ($row['location_id'] == $cur_id) {
									echo "<span id='selected_location'>".$cur_loc_name['location_name']."</span><br/>";
								}
								// If not display the Location and its link which sends the catagorey and location ID as GET variables
								else {
									echo "<a href=\"index.php?cat=".$cat."&cur_id=".$row['location_id']."\">".$cur_loc_name['location_name']."</a><br/>";
								}	
									
							}
						}
					}
					// Otherwise just grab list of locations associated with the proper catagorey name (eg. Dining, Services, etc..)
					else {
						$location_info = mysql_query("select location_name, location_id from location where subgroup='".$cat."' order by location_name");
					}
					// Given the appropriate query from about display the list of links which also return the appropriate Get variable information
					if ($cat != open) {
						while ($row = mysql_fetch_assoc($location_info)) {
							// If you are at the current location make it red and dont make it a link
							if ($row['location_id'] == $cur_id) {
								echo "<span id='selected_location'>".$row['location_name']."</span><br/>";
							}
							// If not display the Location and its link which sends the catagorey and location ID as GET variables
							else {
								echo "<a href=\"index.php?cat=".$cat."&cur_id=".$row['location_id']."\">".$row['location_name']."</a><br/>";
							}
					}
					}
				?>
        </div>
        
        <div id="current">
        	<div style="width:338px;">
        		<!--<div id="photo">photo</div>-->
		        <div id="cur_location">
    		    	<div class="title">
						<?php
							// Display the name of the current location
                        	echo $cur_location['location_name'];
						?>
                    </div>
					<?php
						// Display the Building/Location of the current location
	                    echo $building['group_name'];
					?> 
    	    	    <br />
        	    	<br />
					<?php
						// Display the phone number of the current location
						echo $phone['phone'];
					?>
	    	    </div>
            </div>
            <div id="hours">
            	<div class="title">
                	<?php
					// If the current location has hours in the database display the Hours title
                	$current = mysql_query('select * from hours join periods on hours.type=periods.type where start_date<="'.$cur_date.'" and end_date>="'.$cur_date.'" and location_id='.$cur_id);
					$is_hours = mysql_fetch_assoc($current);
					if ($cur_id != null && $is_hours != null) {
						echo "Hours";
					}
				?>
                </div>
               	<div>
					<?php
						if ($cur_id != null && $is_hours != null) {
							// This converts the format in which the times are displayed
							function convert_time($cur_time) {
								$tme=strtotime($cur_time);
								$tme1 = date('g', $tme);
								if(date('i', $tme)!="00"){
									$tme1 .= date(':i', $tme); 
								}
								if(date('a', $tme)=="am"){
									return $tme1 .= " am";
								}
								else{
									return $tme1.= " pm";
								}
							}
							// Grab an array containing the current list of hours
							$query = 'select * from hours join periods on hours.type=periods.type where start_date<="'.$cur_date.'" and end_date>="'.$cur_date.'" and location_id='.$cur_id;
							$current = mysql_query($query);
							$cur_hours = mysql_fetch_assoc($current);
							
							// Allows you to associate the index of an array with the abbreviation of a day
							$day_num = array('m','t','w','r','f','s','u');
							// Allows you to associate an abbreviation of a day with its full name
							$day_abbrev = array('m'=>'Monday','t'=>'Tuesday','w'=>'Wednesday','r'=>'Thursday','f'=>'Friday','s'=>'Saturday','u'=>'Sunday');
							// Initialize days which are used to iterate with
							$start_day = "m";
							
							// Make dates for the begining and end of the week
							$monday_date= time() - ((date(N)-1)*86400);
							$sunday_date= ($monday_date + (6*86400));
							$monday_date= (date("Y-m-d",$monday_date));
							$sunday_date= (date("Y-m-d",$sunday_date));
							
							$query = mysql_query('select * from exceptions where date_of >= "'.$monday_date.'" and date_of <= "'.$sunday_date.'" and location_id = '.$cur_id);
							while($cur = mysql_fetch_assoc($query)) {
								$excep_day = strtotime($cur['date_of']);
								$excep_day = $day_num[date(N,$excep_day)-1];
								//$debug .= $excep_day.$cur['date_of'].$cur['open'].$cur['close'];
								$cur_hours['open'.$excep_day] = $cur['open'];
								$cur_hours['close'.$excep_day] = $cur['close'];
							}
							//echo "<!--".$debug."-->";
														
							$start_open = $cur_hours['openm'];
							$start_close = $cur_hours['closem'];
							$end_day = "m";
							$i=0;
						
							while ($i < 7) {
								// Set the current day to the appropriate value associated with the current index
								$cur_day = $day_num[$i];
							// If the current day has the same open and close times as the previous then move the end date and the index
							if ($start_open == $cur_hours['open'.$cur_day] && $start_close == $cur_hours['close'.$cur_day]) {
								$end_day = $cur_day;
								$i++;
								// If the current day is Sunday then its is finished and needs to be printed
								if ($cur_day == "u" && $start_day == $end_day) {
									echo $day_abbrev[$start_day].": ".convert_time($start_open)." - ".convert_time($start_close)."<br />";
								}
								else if ($cur_day == "u") {
									// If the open and close times are 00:00:00 then display closed
									if ($start_open == "00:00:00" && $start_close == "00:00:00")	{
										echo $day_abbrev[$start_day]." - ".$day_abbrev[$end_day].": Closed<br />";
									}
									else {
										echo $day_abbrev[$start_day]." - ".$day_abbrev[$end_day].": ".convert_time($start_open)." - ".convert_time($start_close)."<br />";
									}
								}
							}
							// If the current day's open and close times are not the same then print out the current set of matchings move reset the start and end days print the data and enter the while loop at the same index
							else {
								// If the start and end days are the same dont print that data twice
								if ($start_day == $end_day) {
									// If it is closed then display that day with closed
									if ($start_open == "00:00:00" && $start_close == "00:00:00")	{
										echo $day_abbrev[$end_day].": Closed<br />";
									}
									// if not then display that day and its open/close time
									else {
										echo $day_abbrev[$end_day].": ".convert_time($start_open)." - ".convert_time($start_close)."<br />";
									}
								}
								// If not then print the start and end days
								else {
									echo $day_abbrev[$start_day]." - ".$day_abbrev[$end_day].": ".convert_time($start_open)." - ".convert_time($start_close)."<br />";
								}
								$start_day = $cur_day;
								$start_open = $cur_hours['open'.$cur_day];
								$start_close = $cur_hours['close'.$cur_day];
								$end_day = $cur_day;
								}
							}
						}
						else {
							echo "Hours not found in database";
						}
                	?>
                </div>
            </div>
        </div>
                
        
    </div>

<?php mysql_close($link);
pageFinish(); ?>
