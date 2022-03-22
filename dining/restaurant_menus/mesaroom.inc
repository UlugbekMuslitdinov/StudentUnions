<?php
	// connect to database
	include($_SERVER['DOCUMENT_ROOT'] . "/commontools/mysql_link.inc");
	
	// include menu settings
	include($_SERVER['DOCUMENT_ROOT'] . "/dining/menu_mesa/admin_menu_settings.php");
?>
<div id="nav" >
<!--	<span class="active" onclick="show('pastas_entrees')" id="pastas_entrees-link">entr&eacute;es</span>  :  <span onclick="show('healthy')" id="healthy-link">Nutrition Info</span>
	<script>var current='pastas_entrees';</script>-->
</div>
<div id="logo">
	<img src="template/images/logos/mesaroom.gif" alt="Mesa Room"/>
</div>
<div id="desc">
		<p>upscale dining with a full-service menu and wait staff in a classic, intimate setting &#150; a perfect option for meetings and events</p>
</div>
<div id="menu-content" style="clear:both; margin-top:-5px;">
	<div id="pastas_entrees" >
		<!--<h1>$11.00 per person <span class="small">(plus tax)</span></h1>-->
		<p style="margin-bottom:5px;">$11.95 - <span class="small">includes tax and gratuity</span></p>

<?php

## FIGURE OUT WHAT DAY IT IS AND WHICH MENU TO DISPLAY ##

// select database
mysql_select_db("menus_mesa", $DBlink)
	or die(mysql_error());

?>

<?php
	## START THE LOGIC TO DISPLAY THE MENU INFORMATION
	// figure out which day it is and which menu to display
	// get the menu start dates
	$result = mysql_query("SELECT * FROM start ORDER BY startDate ASC");

	// initialize vars
	$i = 0;
	$future = false;

	## Figure out the order to display the menus
	## We will never have two future or current day menus.
	## Error checking on the entry side will prevent this.
	## The only options supported/allowed are expired and current or current and future menus.
	## This way we always have one menu that is current/displayed
	// loop through results and assign to array
	while ($row = mysql_fetch_array($result)) {
		if ($row['startDate'] <= $today) {
			$menuID[$i] = $row['menuID'];
			$i++;
		} else {
			$future = true;
			$_SESSION['future'] = true;
			$menuID[$i] = $row['menuID'];
			$i++;
		}
	}
	
	if ($future) {
		// query for current menu name and schedule - it will always be in the first position of the array
		$currentMenu = mysql_query("SELECT * FROM menu WHERE id = " . $menuID[0] . "");
		$currentMenuR = mysql_fetch_array($currentMenu);

		// query for future menu start date - it will always be in the second position of the array
		$futureMenu = mysql_query("SELECT startDate FROM start WHERE menuID = " . $menuID[1] . "");
		$futureMenuR = mysql_fetch_array($futureMenu);

		// assign to var so that it only show if future menu exists
		$futureMenuStart = '<span style="font-size:10px; color:#bd2342;">[New menu begins ' . date("m/d/Y", strtotime($futureMenuR['startDate'])) . ']</span>';
		
	} else {
		// query for current menu name and schedule - it will always be in the second position of the array
		$currentMenu = mysql_query("SELECT * FROM menu WHERE menu.id = " . $menuID[1] . "");
		$currentMenuR = mysql_fetch_array($currentMenu);
	}
	
	// set counter to track empty menu items
	$noMenu = 0;

	// display the menu name
//	echo '<div style="float:left;"><h1 style="margin-bottom:0; margin-top:0;">Chef\'s ' . $currentMenuR['name'] . ' Menu '.$futureMenuStart.'</h1></div>';
	// show a consistent menu name
	echo '<div style="float:left;"><h1 style="margin-bottom:0; margin-top:0;">Chef\'s Mesa Room Menu '.$futureMenuStart.'</h1></div>';
?>
		<br clear="all" />

		<?php

		## START THE MENU DISPLAY
		// BEGIN FIRST COURSE
		// query the item table to get all the First Courses on this menu
		$itemResult = mysql_query("SELECT * FROM item WHERE menuID = " . $currentMenuR['id'] . " AND dishID = " . $firstCourses . " ORDER BY id");

		// init counters and flags
		$count = 1;
		$display = false;
		$showHeader = false;

		while (($itemRow = mysql_fetch_array($itemResult)) || ($count <= $maxFirstCourse)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $itemRow['name'] != '') {
					echo '<p style="margin-top:5px;"><strong style="font-size:12px;">First Course</strong><br />';
				$showHeader = true;
			} // END IF to show header
			
			// only show the row if it is not empty
			if ($itemRow['name'] != '') {
				echo '<span style="font-size:9px;">';
				// put a comma before the next item ONLY if we have an initial item and more than one item
				if ($display) {
					echo ', ';
				}
				echo $itemRow['name'] . '</span>';
				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} else if ($count == 1) {
				$noMenu++;
			} // END IF not empty
			$count++;
			
			// only show the closing P tag if we actually have items in the list
			if (!$showHeader && $itemRow['name'] != '') {
				echo '</p>';
			} // END IF to show header
			
		} // END While loop
		// END FIRST COURSE

		// BEGIN ENTREES
		// query the item table to get all the Entrees on this menu
		$itemResult = mysql_query("SELECT * FROM item WHERE menuID = " . $currentMenuR['id'] . " AND dishID = " . $entrees . " ORDER BY id");

		// init counters and flags
		$count = 1;
		$display = false;
		$showHeader = false;

		while (($itemRow = mysql_fetch_array($itemResult)) || ($count <= $maxEntrees)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $itemRow['name'] != '') {
				echo '<p style="margin-bottom:0;"><strong style="font-size:12px;">Entr&eacute;es</strong><br />';
				$showHeader = true;
			} // END IF to show header
			
			// only show the row if it is not empty
			if ($itemRow['name'] != '') {
				echo '<span style="font-size:10px;">';
				// put a comma before the next item ONLY if we have an initial item and more than one item
//				if ($display) {
//					echo ', ';
//				}
				echo $itemRow['name'] . '<br /></span>';
					echo '<span style="font-size:9px; color:#999999; display:block; padding-bottom:3px;">' . $itemRow['description'] . '<br /></span>';
				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} else if ($count == 1) {
				$noMenu++;
			} // END IF not empty
			$count++;
			
			// only show the closing P tag if we actually have items in the list
			if (!$showHeader && $itemRow['name'] != '') {
				echo '</p>';
			} // END IF to show header
			
		} // END While loop
		// END ENTREES

		// BEGIN DESSERT
		// query the item table to get all the Desserts on this menu
		$itemResult = mysql_query("SELECT * FROM item WHERE menuID = " . $currentMenuR['id'] . " AND dishID = " . $desserts . " ORDER BY id");

		// init counters and flags
		$count = 1;
		$display = false;
		$showHeader = false;

		while (($itemRow = mysql_fetch_array($itemResult)) || ($count <= $maxDesserts)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $itemRow['name'] != '') {
				echo '<p style="margin-top:5px;"><strong style="font-size:12px;">Dessert</strong><br />';
				$showHeader = true;
			} // END IF to show header
			
			// only show the row if it is not empty
			if ($itemRow['name'] != '') {
				echo '<span style="font-size:9px;">';
				// put a comma before the next item ONLY if we have an initial item and more than one item
				if ($display) {
					echo ', ';
				}
				echo $itemRow['name'] . '</span>';
				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} else if ($count == 1) {
				$noMenu++;
			} // END IF not empty
			$count++;
			
			// only show the closing P tag if we actually have items in the list
			if (!$showHeader && $itemRow['name'] != '') {
				echo '</p>';
			} // END IF to show header
			
		} // END While loop
		// END DESSERT

		// BEGIN COMMENTS (Chef's Notes)
		// query the menu table to get comments on this menu
		$commentResult = mysql_query("SELECT comments FROM menu WHERE id = " . $currentMenuR['id'] . "");

		// init counters and flags
		$display = false;
		$showHeader = false;

		while ($commentRow = mysql_fetch_array($commentResult)) {
			// if we haven't shown the header and this category is not blank, show the header
			if (!$showHeader && $commentRow['comments'] != '') {
				echo '<p style="margin-bottom:0;"><strong>Chef\'s Notes</strong><br />';
				$showHeader = true;
			} // END IF to show header
			
			// only show the row if it is not empty
			if ($commentRow['comments'] != '') {
				echo '<span style="font-size:9px;">' . nl2br($commentRow['comments']) . '</span><br />';
				echo '<span style="font-size:8px; color:#cccccc;">The opinions expressed herein are solely those of the commentator and do not reflect the opinions or judgments of the University of Arizona.</span>';
				$display = true;
			// if we're in here and the count has not been incremented it means no items for this category, so track it for no menu tally
			} // END IF not empty
			
			// only show the closing P tag if we actually have items in the list
			if (!$showHeader && $commentRow['comments'] != '') {
				echo '</p>';
			} // END IF to show header
			
		} // END While loop
		// END COMMENTS (Chef's Notes)
		## END THE MENU DISPLAY
	
	// if we have 4 dishes w/o items, we have no menu, so let them know
	if ($noMenu == 3) {
		echo '<p>We are open today, but our menu has yet to be determined. We apologize for any inconvenience.</p>
		<p>Please try again later.</p>';
	}
	// END THE LOGIC TO DISPLAY THE MENU INFORMATION	
	
?>

	<p style="font-size:8px; color:#cccccc; margin-top:5px;">The consumption of raw or undercooked meat, fish, eggs, poultry, seafood, or shellfish can increase your risk of foodborne illness. This is especially true for people with certain medical conditions.</p>

	</div>
	<div id="healthy" align="center" style="display:none; margin-top:20px;">
  	<?php include("./healthy_options.inc"); ?>
  	<h1>Top Healthy Options</h1>
  	<table width="95%" cellpadding="5">
  		<tr><td><strong>Item</strong></td><td><strong>Cal</td><td><strong>Pro</strong></td><td><strong>Fat</strong></td><td><strong>Carb</strong></td></tr>
  	<?php 
  	
  		$arr = $healthy_options[$_SESSION['menu_location_id']];
  		for($i = 1; $i < count($arr); $i++)
		{
			echo "<tr>";	
			for($z = 0; $z < count($arr[$i]); $z++)
			{
				echo "<td>".$arr[$i][$z]."</td>";
			}
			echo "</tr>";
		}
	?>
	</table>
  </div>
</div>