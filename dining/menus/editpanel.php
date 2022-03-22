<?php
	session_start();
	
	require('sectioninfo.inc');
	$template = 'sidebar_only';
	require('global.inc');
	$title = 'Editing Menu Panel';
	pageStart($title);
	
// Database
include('../../commontools/mysql_link.inc');
mysql_select_db('menuboards', $DBlink);
	
//	$db_name = "menuboards";
//	$db_host = "trinity.sunion.arizona.edu";
//	$db_user = "web";
//	$db_pass = "viv3nij";
	
//	$db_link = mysql_connect($db_host,$db_user,$db_pass)
//or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later. (error 1)</p>");
	
//mysql_select_db($db_name, $db_link)
//or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 2)</p>");
	
	// Grab the ID of the unit which is being edited
	$unit_id=$_GET[unitID];
	// Grab the ID fo the panel which is being edited
	$panel_id=$_GET[panelID];
	// Determine if the current panel is locked
	$current = mysql_query("select locked from panel where id='".$panel_id."'");
	$panel_locked = mysql_fetch_assoc($current);
	$panel_locked = $panel_locked['locked'];
	
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

<style type="text/css">
	@import url("menuedit.css");
</style>

<div class="content">
	<div class="pagetitle">
		<?php
			// Get the name of the current unit based on the current unitID
			$current = mysql_query("select name from unit where id='".$unit_id."'");
			$unit_name = mysql_fetch_assoc($current);
			// Get the name of the current panel based on the current panelID
			$current = mysql_query("select name from panel where id='".$panel_id."'");
			$panel_name = mysql_fetch_assoc($current);
		?>
		<h1 style=" font-size:16px;">Editing <?php echo $panel_name['name']; ?> panel at <?php echo $unit_name['name']; ?></h1>
	</div>
		<div class="subcontent">
			<div id="panelpagetitle">
				<strong style="color:#333366;">Categories & Items</strong> (contact the marketing department to edit information which is not displayed in entry boxes)
			</div>
			<div id="contentlist">
				<?php
					// Get the list of categories whose which are in the current panel
					$current = mysql_query("select * from category where panelID='".$panel_id."'");
					while($category_row = mysql_fetch_assoc($current)) {
						// Get some information about the current category
						$category_id = mysql_query("select * from category where id='".$category_row['id']."'");
						$category_id = mysql_fetch_assoc($category_id);
						$category_id = $category_id['id'];
						
						/********************* If the category is locked then display the locked category and its items *********************/
						if($category_row['locked'] || $panel_locked) {
							// div for locked category
							echo '<div class="category">';
							echo('<table vAlign="middle" height="27px" cellspacing="0" cellpadding="0"><tr><td style="padding-right:6px;">'.$category_row['name'].'</td>');
								// Only show a price if it is not 0.00
								if ($category_row['price1'] != 0.00) {
									echo '<td width="75px">Price 1: '.$category_row['price1'].'</td>';
								}
								if ($category_row['price2'] != 0.00) {
									echo '<td width="75px">Price 2: '.$category_row['price2'].'</td>';
								}
								if ($category_row['price3'] != 0.00) {
									echo '<td width="75px">Price 3: '.$category_row['price3'].'</td>';
								}
							echo '</tr></table>';
							
							echo('<table vAlign="middle" cellspacing="0"><tr><td> Healthy Options:</td>');
							if ($item_row['healthy_options'] != null) {
								$options = bitmask_to_healthyarray($category_row['healthy_options']);
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
							$cur_item = mysql_query("select * from item where categoryID='".$category_id."'");
							while($item_row = mysql_fetch_assoc($cur_item)) {
								echo '<div class="item">';
								// These 2 divs are the title and subtitle of a locked item
								echo ('<div style="float:left;">'.$item_row['title'].'</div><div style="float:left;">'.$item_row['subtitle'].'</div><br />');
								echo('<table vAlign="middle" cellpadding="0" cellspacing="0"><tr>');
									// Only show a price if it is not 0.00
									if ($item_row['price1'] != 0.00) {
										echo '<td width="75px">Price 1: '.$item_row['price1'].'</td>';
									}
									if ($item_row['price2'] != 0.00) {
										echo '<td width="75px">Price 2: '.$item_row['price2'].'</td>';
									}
									if ($item_row['price3'] != 0.00) {
										echo '<td width="75px">Price 3: '.$item_row['price3'].'</td>';
									}
								echo '</tr></table>';
								
								// List the applicable uneditable healthy options
								echo('<table vAlign="middle" cellspacing="0"><tr><td> Healthy Options:</td>');
								if ($item_row['healthy_options'] != null) {
									$options = bitmask_to_healthyarray($item_row['healthy_options']);
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
							echo '</div>';
						}
						
						/******************************************** The Category is not locked ********************************************/
						else {
							echo '<div class="category">';
								echo '<form action="submitpanel.php?unitID='.$unit_id.'&panelID='.$panel_id.'" enctype="multipart/form-data" method="post">';
							
								// This div contains the sumbit button for a given group
								echo '<div style="float:right; padding-top:3px;" >';
									echo '<input type="submit" value="Update" name="submit">';
									echo '<input type="hidden" value="cat" id="submit_type" name="submit_type" />';
									echo '<input type="hidden" value="'.$category_row['id'].'" id="cat_id" name="cat_id" />';
								echo '</div>';
								
								// This is an editable category
								echo '<div style="float:left;">';
								echo('<table vAlign="middle" height="27px" cellspacing="0" cellpadding="0"><tr>');
								// Display the category's name as an editable input
								echo('<td style="padding-right:8px;"><input name="cat_name" type="text" class="textbox" id="cat_name" size="25" value="'.$category_row['name'].'" /></td>');
									// Only show a price if it is not 0.00
								if ($category_row['price1'] != 0.00) {
									echo '<td width="100px">Price 1:<input name="cat_price1" type="text" class="textbox" id="cat_price1" size="5" value="'.$category_row['price1'].'" /></td>';
								}
								if ($category_row['price2'] != 0.00) {
									echo '<td width="100px">Price 2:<input name="cat_price2" type="text" class="textbox" id="cat_price2" size="5" value="'.$category_row['price2'].'" /></td>';
								}
								if ($category_row['price3'] != 0.00) {
									echo '<td width="100px">Price 3:<input name="cat_price3" type="text" class="textbox" id="cat_price3" size="5" value="'.$category_row['price3'].'" /></td>';
								}
								echo '</tr></table>';
											
								// List the editable healthy options for the category
								echo('<table vAlign="middle" cellspacing="0"><tr><td> Healthy Options:</td>');
									$options = bitmask_to_healthyarray($category_row['healthy_options']);
									echo '<td><input name="cat_healthy[0]" type="checkbox" class="checkbox" value="vegan"';if ($options['vegan']) {echo 'checked';} echo '/>Vegan</td>';
									echo '<td><input name="cat_healthy[1]" type="checkbox" class="checkbox" value="l-carb"';if ($options['lo-carb']) {echo 'checked';} echo '/>lo-carb</td>';
									echo '<td><input name="cat_healthy[2]" type="checkbox" class="checkbox" value="lo-fat"';if ($options['lo-fat']) {echo 'checked';} echo '/>lo-fat</td>';
									echo '<td><input name="cat_healthy[3]" type="checkbox" class="checkbox" value="vegetarian"';if ($options['vegetarian']) {echo 'checked';} echo '/>Vegetarian</td>';
								echo '</tr></table>';
								echo '</form>';
							echo '</div>';
							
							// Layout the div which will contain the items in this category
							echo('<div class="item_group">');
							$cur_item = mysql_query("select * from item where categoryID='".$category_id."'");
							while($item_row = mysql_fetch_assoc($cur_item)) {
								echo '<div class="item">';
								/************************** The category is unlocked, but ONLY the current item is locked **************************/
								if($item_row['locked']) {
									echo('<div style="float:left;">'.$item_row['title'].'</div><div style="float:left;">'.$item_row['subtitle'].'</div><br />');
									echo('<table vAlign="middle" cellspacing="0" cellpadding="0"><tr>');
										// Only show a price if it is not 0.00
										if ($item_row['price1'] != 0.00) {
											echo '<td width="75px">Price 1: '.$item_row['price1'].'</td>';
										}
										if ($item_row['price2'] != 0.00) {
											echo '<td width="75px">Price 2: '.$item_row['price2'].'</td>';
										}
										if ($item_row['price3'] != 0.00) {
											echo '<td width="75px">Price 3: '.$item_row['price3'].'</td>';
										}
									echo '</tr></table>';
									echo('<table vAlign="middle" cellspacing="0"><tr><td> Healthy Options:</td>');
									if ($item_row['healthy_options'] != null) {
										$options = bitmask_to_healthyarray($item_row['healthy_options']);
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
										echo '<form action="submitpanel.php?unitID='.$unit_id.'&panelID='.$panel_id.'" enctype="multipart/form-data" method="post">';
											echo '<div style="float:right;" >';
												echo '<input type="submit" value="Update" name="submit">';
												echo '<input type="hidden" value="item" id="submit_type" name="submit_type" />';
												echo '<input type="hidden" value="'.$item_row['id'].'" id="item_id" name="item_id" />';
											echo '</div>';
									
											// This div will contain the title of the item and allow for editing
											echo('<div><div style="float:left;padding-right:8px;"><input name="item_title" type="text" class="textbox" id="item_title" size="25" value="'.$item_row['title'].'" /></div>');
											// This div will contain the subtitle of the item and allow for editing
											if ($item_row['subtitle'] != null) {
												echo('<div  style="float:left;"><input name="item_subtitle" type="text" class="textbox" id="item_subtitle" size="25" value="'.$item_row['subtitle'].'" /></div>');
											}
											// The item is unlocked so make the item editable
											echo('<br /><br /><table vAlign="middle" cellspacing="0" cellpadding="0"><tr>');
												// Only show a price if it is not 0.00
												if ($item_row['price1'] != 0.00) {
													echo '<td width="100px">Price 1:<input name="item_price1" type="text" class="textbox" id=item_price1"" size="5" value="'.$item_row['price1'].'" /></td>';
												}
												if ($item_row['price2'] != 0.00) {
													echo '<td width="100px">Price 2:<input name="item_price2" type="text" class="textbox" id="item_price2" size="5" value="'.$item_row['price2'].'" /></td>';
												}
												if ($item_row['price3'] != 0.00) {
													echo '<td width="100px">Price 3:<input name="item_price3" type="text" class="textbox" id="item_price3" size="5" value="'.$item_row['price3'].'" /></td>';
												}
											echo '</tr></table>';
									
											// List the editable healthy options for the item
											echo('<table vAlign="middle" cellspacing="0"><tr><td> Healthy Options:</td>');
												$options = bitmask_to_healthyarray($item_row['healthy_options']);
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
							echo '</div>';
						}
					}
				?>
			</div>
		</div>
</div>
<?php pageFinish(); ?>
