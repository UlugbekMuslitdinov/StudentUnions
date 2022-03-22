<?php
	session_start();
	
	$pageURL = 'http://elvis.sunion.arizona.edu/dining/menus/jsmenueditor.php';



////////////////////////////////////////////////////////////////////////////
//					get either netid or email pass combo				  //
////////////////////////////////////////////////////////////////////////////

	if(isset($_GET['ticket'])){
		$tix = $_GET['ticket'];
		
		$url = '"https://webauth.arizona.edu/webauth/serviceValidate?ticket='.$tix.'&service='.$pageURL.'"';
		
		exec("curl -m 120 $url " ,$return_message_array, $return_number);
		
		//check to make sure ticket was valid
		if($return_message_array[1] == "	<cas:authenticationSuccess>"){
						
			$netID = $return_message_array[2];		
			$netID = trim(str_replace("<cas:user>","",str_replace("</cas:user>","", $netID)));
			
			$_SESSION['netID'] = $netID;
			
		}
		
		//if not send back to webauth to get valid ticket
		else{
			header("Location: https://webauth.arizona.edu/webauth/login?service=".$pageURL);
			exit();
		}
	}
	else{
		header("Location: https://webauth.arizona.edu/webauth/login?service=".$pageURL);
		exit();	
	}
	
	if ($_SESSION['netID']=="sanorris" || $_SESSION['netID']=="styx" || $_SESSION['netID']=="jamsson" || $_SESSION['netID']=="nbischof" || $_SESSION['netID']=="mburton2" || $_SESSION['netID']=="kmbeyer") {
		$unit_id = 3;
	}
	else {
		session_destroy();
		header('Location: http://union.arizona.edu');
		exit();
	}
	
	require('sectioninfo.inc');
	$template = 'sidebar_only';
	require('global.inc');
	$title = 'Editing Unit Menu';
	pageStart($title);
	
	$db_name = "menuboards";
	$db_host = "trinity.sunion.arizona.edu";
	$db_user = "web";
	$db_pass = "viv3nij";
	
	$link = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
	mysql_select_db($db_name, $link) or die(mysql_error());
	
	$panels = array();
	
	// This functon converts a given bitmask to an array containing the different healthy options
	function bitmask_to_healthyarray($bitmask) {
		/** 
		*	Basically this bitmask is composed in opposite order of the healthy options logo
		*	the ones place represents vegan, the tens place represents the lo-carb option,
		*	the hundreds represents the lo-fat option, and the thousands represents vegitarian. (012809)
		**/
		$options = array();
		
		if($bitmask & 0x8) {
			$options['vegetarian']=true;
		}
		if ($bitmask & 0x4) {
			$options['lo-fat']=true;
		}
		if ($bitmask & 0x2) {
			$options['lo-carb']=true;
		}
		if ($bitmask & 0x1) {
			$options['vegan']=true;
		}
		
		return $options;
	}
?>
<script type="text/javascript">
	var browserType;

	if (document.layers) {browserType = "nn4"}
	if (document.all) {browserType = "ie"}
	if (window.navigator.userAgent.toLowerCase().match("gecko")) {
	   browserType= "gecko"
	}

	function hideshow(divID) {		
		// Get the proper div correctly based on browser
		if (browserType == "gecko" || browserType == "ie") {
			document.poppedLayer = eval('document.getElementById("' + divID + '")');
		}
		else {
			document.poppedLayer = eval('document.layers["' + divID + '"]');
		}
		// Change to Show/Hide Stuff
		var expantxtID = divID.substring(4);
		if (document.poppedLayer.style.display=="block") {
			document.poppedLayer.style.display = "none";
			document.getElementById('expantxt_' + expantxtID).innerHTML= "Expand";
		}
		else {
			document.poppedLayer.style.display = "block";
			document.getElementById('expantxt_' + expantxtID).innerHTML= "Collapse";
		}
	}
</script>

<style type="text/css">
	@import url("menuedit.css");
</style>

 <div class="content">
		<div class="pagetitle">
        	<?php
				// Get the name of the current unit based on the current ID
            	$current = mysql_query("select name from unit where id='".$unit_id."'");
				$current = mysql_fetch_assoc($current);
			?>
        	<h1 style=" font-size:16px;">Editing <?php echo $current['name']; ?>'s Menu</h1>
        </div>
    	<div class="subcontent">
	        <h2 style="font-size:12px;">Menus</h2>
            <div id="contentlist">
            	<?php
            		// Get the panels associated with this unit
         		   	$panels = mysql_query("select * from panel where unitID='".$unit_id."'");
					while($cur_pan = mysql_fetch_assoc($panels)) {
						// The current panel is locked and so is the rest down
						if($cur_pan['locked']) {
							echo '<div class="panel_head" style="margin-bottom:8px;" id="pan_'.$cur_pan['id'].'">';
							echo $cur_pan['name']." (contact the Marketing Department to change this menu)";
							echo "</div>";
						}
						// The current panel is unlocked
						else {
							echo '<div class="panel_head">';
								echo '<table width=100%;><tr>';
									echo '<td>'.$cur_pan['name'].'</td>';
									echo '<td class="expander" id="expan_'.$cur_pan['id'].'"><a href=\'javascript:hideshow("pan_'.$cur_pan['id'].'");\' ><span id="expantxt_'.$cur_pan['id'].'">Expand</span></a></td>';
									//$panels[] = '"pan_'.$cur_pan['id'].'"';
								echo '</tr></table>';
							echo '</div>';
							echo '<table style="margin-left:15px;"><tr><td>';
								echo '<div id="pan_'.$cur_pan['id'].'" style="display:none;" >';
								$categories = mysql_query("select * from category where panelID='".$cur_pan['id']."'");
								while($cur_cat = mysql_fetch_assoc($categories)) {
									// The category is locked
									if($cur_cat['locked']) {
										//The locked category data
										echo '<div class="category">';
											echo('<table vAlign="middle" height="27px" cellspacing="0" cellpadding="0"><tr><td style="padding-right:6px;">'.$cur_cat['name'].'</td>');
												// Only show a price if it is not 0.00
												if ($cur_cat['price1'] != 0.00) {
													echo '<td width="75px">Price 1: '.$cur_cat['price1'].'</td>';
												}
												if ($cur_cat['price2'] != 0.00) {
													echo '<td width="75px">Price 2: '.$cur_cat['price2'].'</td>';
												}
												if ($cur_cat['price3'] != 0.00) {
													echo '<td width="75px">Price 3: '.$cur_cat['price3'].'</td>';
												}
											echo '</tr></table>';

											echo('<table vAlign="middle" cellspacing="0"><tr><td> Healthy Options:</td>');
											if ($cur_cat['healthy_options'] != null && $cur_cat['healthy_options'] != 0) {
												$options = bitmask_to_healthyarray($cur_cat['healthy_options']);
													if ($options['vegan']) {
														echo '<td id="healthy_option">Vegan</td>';
													}
													if ($options['lo-carb']) {
														echo '<td id="healthy_option">lo-carb</td>';
													}
													if ($options['lo-fat']) {
														echo '<td id="healthy_option">lo-fat</td>';
													}
													if ($options['vegetarian']) {
														echo '<td id="healthy_option">Vegetarian</td>';
													}
											}
											else {
												echo '<td>None</td>';
											}
											echo '</tr></table>';
										echo '</div>';
									
										// Layout the div which will contain the items in this category
										echo('<div class="item_group">');
											// Get all the items in this category and their information
											$items = mysql_query("select * from item where categoryID='".$cur_cat['id']."'");
											while($cur_item = mysql_fetch_assoc($items)) {
												echo '<div class="item">';
													// These 2 divs are the title and subtitle of a locked item
													echo ('<div style="float:left;">'.$cur_item['title'].'</div><div style="float:left;">'.$cur_item['subtitle'].'</div><br />');
													echo('<table vAlign="middle" cellpadding="0" cellspacing="0"><tr>');
														// Only show a price if it is not 0.00
														if ($cur_item['price1'] != 0.00) {
															echo '<td width="75px">Price 1: '.$cur_item['price1'].'</td>';
														}
														if ($cur_item['price2'] != 0.00) {
															echo '<td width="75px">Price 2: '.$cur_item['price2'].'</td>';
														}
														if ($cur_item['price3'] != 0.00) {
															echo '<td width="75px">Price 3: '.$cur_item['price3'].'</td>';
														}
													echo '</tr></table>';
								
													// List the applicable uneditable healthy options
										echo('<table vAlign="middle" cellspacing="0"><tr><td> Healthy Options:</td>');
										if ($cur_item['healthy_options'] != null) {
											$options = bitmask_to_healthyarray($cur_item['healthy_options']);
											if ($options['vegan']) {
												echo '<td id="healthy_option">Vegan</td>';
											}
											if ($options['lo-carb']) {
												echo '<td id="healthy_option">lo-carb</td>';
											}
											if ($options['lo-fat']) {
												echo '<td id="healthy_option">lo-fat</td>';
											}
											if ($options['vegetarian']) {
												echo '<td id="healthy_option">Vegetarian</td>';
											}
										}
										else {
											echo '<td>None</td>';
										}
										echo '</tr></table>';
										echo '</div>';
									}
									//echo '</div>';
									
								}
								// The category is not locked
								else {
									//The locked category data
									echo '<div class="category">';
										echo '<form action="submitpanel.php?unitID='.$unit_id.'" enctype="multipart/form-data" method="post">';

										// This div contains the sumbit button for a given group
										echo '<div style="float:right; padding-top:3px;" >';
											echo '<input type="submit" value="Update" name="submit">';
											echo '<input type="hidden" value="cat" id="submit_type" name="submit_type" />';
											echo '<input type="hidden" value="'.$cur_pan['id'].'" id="panel_id" name="panel_id" />';
											echo '<input type="hidden" value="'.$cur_cat['id'].'" id="cat_id" name="cat_id" />';
										echo '</div>';

										// This is an editable category
										echo '<div style="float:left;">';
										echo('<table vAlign="middle" height="27px" cellspacing="0" cellpadding="0"><tr>');
										// Display the category's name as an editable input
										echo('<td style="padding-right:8px;"><input name="cat_name" type="text" class="textbox" id="cat_name" size="25" value="'.$cur_cat['name'].'" /></td>');
											// Only show a price if it is not 0.00
										if ($cur_cat['price1'] != 0.00) {
											echo '<td width="100px">Price 1:<input name="cat_price1" type="text" class="textbox" id="cat_price1" size="5" value="'.$cur_cat['price1'].'" /></td>';
										}
										if ($cur_cat['price2'] != 0.00) {
											echo '<td width="100px">Price 2:<input name="cat_price2" type="text" class="textbox" id="cat_price2" size="5" value="'.$cur_cat['price2'].'" /></td>';
										}
										if ($cur_cat['price3'] != 0.00) {
											echo '<td width="100px">Price 3:<input name="cat_price3" type="text" class="textbox" id="cat_price3" size="5" value="'.$cur_cat['price3'].'" /></td>';
										}
										echo '</tr></table>';

										// List the editable healthy options for the category
										echo('<table vAlign="middle" cellspacing="0"><tr><td> Healthy Options:</td>');
											$options = bitmask_to_healthyarray($cur_cat['healthy_options']);
											echo '<td><input name="cat_healthy[0]" type="checkbox" class="checkbox" value="vegan"';if ($options['vegan']) {echo 'checked';} echo '/>Vegan</td>';
											echo '<td><input name="cat_healthy[1]" type="checkbox" class="checkbox" value="l-carb"';if ($options['lo-carb']) {echo 'checked';} echo '/>lo-carb</td>';
											echo '<td><input name="cat_healthy[2]" type="checkbox" class="checkbox" value="lo-fat"';if ($options['lo-fat']) {echo 'checked';} echo '/>lo-fat</td>';
											echo '<td><input name="cat_healthy[3]" type="checkbox" class="checkbox" value="vegetarian"';if ($options['vegetarian']) {echo 'checked';} echo '/>Vegetarian</td>';
										echo '</tr></table>';
										echo '</form>';
									echo '</div>';

									// Layout the div which will contain the items in this category
									echo('<div class="item_group">');
									$items = mysql_query("select * from item where categoryID='".$cur_cat['id']."'");
									while($cur_item = mysql_fetch_assoc($items)) {
										echo '<div class="item">';
										/************************** The category is unlocked, but ONLY the current item is locked **************************/
										if($cur_item ['locked']) {
											echo('<div style="float:left;">'.$cur_item ['title'].'</div><div style="float:left;">'.$cur_item ['subtitle'].'</div><br />');
											echo('<table vAlign="middle" cellspacing="0" cellpadding="0"><tr>');
												// Only show a price if it is not 0.00
												if ($cur_item ['price1'] != 0.00) {
													echo '<td width="75px">Price 1: '.$cur_item ['price1'].'</td>';
												}
												if ($cur_item ['price2'] != 0.00) {
													echo '<td width="75px">Price 2: '.$cur_item ['price2'].'</td>';
												}
												if ($cur_item ['price3'] != 0.00) {
													echo '<td width="75px">Price 3: '.$cur_item ['price3'].'</td>';
												}
											echo '</tr></table>';
											echo('<table vAlign="middle" cellspacing="0"><tr><td> Healthy Options:</td>');
											if ($cur_item ['healthy_options'] != null) {
												$options = bitmask_to_healthyarray($cur_item ['healthy_options']);
												if ($options['vegan']) {
													echo '<td>Vegan</td>';
												}
												if ($options['lo-carb']) {
													echo '<td>lo-carb</td>';
												}
												if ($options['lo-fat']) {
													echo '<td>lo-fat</td>';
												}
												if ($options['vegetarian']) {
													echo '<td>Vegetarian</td>';
												}
											}
											else {
												echo '<td>None</td>';
											}
											echo '</tr></table>';
										}
								
										/************************************* The category and the item are BOTH unlocked ***************************************/
										else {
											//echo '<div class="item">';
												echo '<form action="submitpanel.php?unitID='.$unit_id.'" enctype="multipart/form-data" method="post">';
													echo '<div style="float:right;" >';
														echo '<input type="submit" value="Update" name="submit">';
														echo '<input type="hidden" value="item" id="submit_type" name="submit_type" />';
														echo '<input type="hidden" value="'.$cur_pan['id'].'" id="panel_id" name="panel_id" />';
														echo '<input type="hidden" value="'.$cur_item ['id'].'" id="item_id" name="item_id" />';
													echo '</div>';
											
													// This div will contain the title of the item and allow for editing
													echo('<div><div style="float:left;padding-right:8px;"><input name="item_title" type="text" class="textbox" id="item_title" size="25" value="'.$cur_item ['title'].'" /></div>');
													// This div will contain the subtitle of the item and allow for editing
													if ($cur_item['subtitle'] != null) {
														echo('<div  style="float:left;"><input name="item_subtitle" type="text" class="textbox" id="item_subtitle" size="25" value="'.$cur_item ['subtitle'].'" /></div>');
													}
													// The item is unlocked so make the item editable
													echo('<br /><br /><table vAlign="middle" cellspacing="0" cellpadding="0"><tr>');
														// Only show a price if it is not 0.00
														if ($cur_item ['price1'] != 0.00) {
															echo '<td width="100px">Price 1:<input name="item_price1" type="text" class="textbox" id=item_price1"" size="5" value="'.$cur_item ['price1'].'" /></td>';
														}
														if ($cur_item ['price2'] != 0.00) {
															echo '<td width="100px">Price 2:<input name="item_price2" type="text" class="textbox" id="item_price2" size="5" value="'.$cur_item ['price2'].'" /></td>';
														}
														if ($cur_item ['price3'] != 0.00) {
															echo '<td width="100px">Price 3:<input name="item_price3" type="text" class="textbox" id="item_price3" size="5" value="'.$cur_item ['price3'].'" /></td>';
														}
													echo '</tr></table>';
									
													// List the editable healthy options for the item
													echo('<table vAlign="middle" cellspacing="0"><tr><td> Healthy Options:</td>');
														$options = bitmask_to_healthyarray($cur_item ['healthy_options']);
														echo '<td><input name="item_healthy[0]" type="checkbox" class="checkbox" value="vegan"';if ($options['vegan']) {echo 'checked';} echo '/>Vegan</td>';
														echo '<td><input name="item_healthy[1]" type="checkbox" class="checkbox" value="l-carb"';if ($options['lo-carb']) {echo 'checked';} echo '/>lo-carb</td>';
														echo '<td><input name="item_healthy[2]" type="checkbox" class="checkbox" value="lo-fat"';if ($options['lo-fat']) {echo 'checked';} echo '/>lo-fat</td>';
														echo '<td><input name="item_healthy[3]" type="checkbox" class="checkbox" value="vegetarian"';if ($options['vegetarian']) {echo 'checked';} echo '/>Vegetarian</td>';
													echo '</tr></table>';
													//echo '</div>';
												echo '</form>';
											echo '</div>';
										}
										echo '</div>';	
									}
								}
								echo '</div>';
							}// END OF ALL THE CATEGORIES AND ITEMS IN AN EDITABLE PANEL
							echo '</div>';
							echo '</td></tr></table>';
						}// END OF EDITABLE PANEL
					}// END OF PANELS LOOP
				?>
            </div>
        </div>
        <? //print_r($panels);?>
</div>
<?php pageFinish(); ?>
