<link rel="StyleSheet" href="/template/global.css" type="text/css" />
<?php
	require_once('dining.inc');
	require_once('includes/mysqli.inc');
	$db = new db_mysqli('hours2');
	$page_options['page'] = 'Dining';
	// $current_path = $_SERVER['REQUEST_URI'];
	//$page_options['header_image'] = '/dining/template/images/dining_header.png';
	$page_options['header_alt'] = 'Dining Services';
	$page_options['video_image'] = '/dining/template/images/video_placeholder.jpg';
	$page_options['video_alt'] = 'Dining Video';

	$page_options['styles'] .= 'h1 {margin-bottom:20px}';
	$page_options['styles'] .= '#center-col h2 { font-size:16px; color:#393939;}';
	$page_options['styles'] .= '#center-col h2 a:active, #center-col h2 a:link, #center-col h2 a:active, #center-col h2 a:visited{ font-size:16px; color:#D30033;}';
	$page_options['styles'] .= '#center-col h2 a:hover{ color:#FF1F57; }';
	$page_options['styles'] .= '#center-col p{font-size:12px; margin:0px; margin-bottom:8px; line-height:11px;}';
	$page_options['styles'] .= '#center-col p a:active, #center-col p a:link, #center-col p a:hover, #center-col p a:visited{ font-size:9px;}';
	$page_options['styles'] .= '.black-button { height:20px; width:118px; text-align:center; background-color:#393939; float:left; margin-right:12px;}';
	$page_options['styles'] .= '#center-col .black-button a:active, #center-col .black-button a:link, #center-col .black-button a:hover, #center-col .black-button a:visited{ color:#ffffff; line-height:20px; font-size:13px; font-weight:bold;}';
	$page_options['styles'] .= '#location-description p{font-size:12px; line-height:14px;}';
  	$page_options['styles'] .= '#location-description p a:active, #location-description p a:link, #location-description p a:hover, #location-description p a:visited{ font-size:12px;}';
	if(!empty($_GET['q'])){
		switch($_GET['q']){
			case 'sumc':
				$page_options['page'] = 'sumc';
				$place = 'Student Union';
				$title = 'Student Union Restaurants';
				$query = 'select location.location_id, location_name, location_url, short, short_name from location
							join location_descriptions on location.location_id=location_descriptions.location_id
							where group_id=1 and subgroup="Dining"
							order by location_name';
			break;
			case 'psu':
				$page_options['page'] = 'psu';
				// $page_options['header_image'] = '/template/images/banners/strawberry-web2-F.jpg';
				$place = 'Park Student Union';
				$title = 'Park Student Union Restaurants';
				$query = 'select location.location_id, location_name, location_url, short, short_name from location
							join location_descriptions on location.location_id=location_descriptions.location_id
							where group_id=2 and subgroup="Dining"
							order by location_name';
			break;
			case 'other':
				$page_options['page'] = 'other';
				$place = 'Around Campus';
				$title = 'More Dining Around Campus';
				$query = 'select location.location_id, location_name, location_url, short, short_name from location
							join location_descriptions on location.location_id=location_descriptions.location_id
							where group_id=3
							order by location_name';
			break;
			default:
				$page_options['page'] = 'sumc';
				$place = 'Student Union';
				$title = 'Student Union Restaurants';
				$query = 'select location.location_id, location_name, location_url, short, short_name from location
							join location_descriptions on location.location_id=location_descriptions.location_id
							where group_id=1 and subgroup="Dining"
							order by location_name';
			break;

		}

	}

	if(!empty($_GET['q']) && !empty($_GET['p'])){
		$place_short = $page_options['page'];
		$page_options['page'] = 'unit';
		$query = 'select * from location join location_descriptions on location.location_id = location_descriptions.location_id where short_name="'.substr($db->real_escape_string($_GET['p']), 0, 15).'"';
		$result = $db->query($query);
		if(mysqli_num_rows($result) == 0){
			header("Location:/dining/".$place_short);
			exit();
		}
		$location = mysqli_fetch_assoc($result);
		require_once('template/locations.inc');
		if($l[$location['location_id']]['banner'] != ''){
			// Assign the banner image for Scoop.
			if ($location['location_id'] ==22) {
			$page_options['header_image'] = '/dining/template/headers/scoop_header.jpg';	
			$page_options['ad'] = '<img src="/dining/template/images/scoop_right.jpg">';
			} else {
			$page_options['header_image'] = $l[$location['location_id']]['banner'];
			}
		}
		if($l[$location['location_id']]['ad']){

			$page_options['ad'] = $l[$location['location_id']]['ad'];

		}
	}


	$page_options['has_mobile_version'] = 1;

	//------------------------------------------------------------*
	// the $no_menu array uses the location id of locations that
	// either don't have menus or locations where we don't want
	// to show the menus.
	//------------------------------------------------------------*
	$no_menu = array(31, 2, 57, 29, 26, 36, 37, 65, 66, 79);


	$coming_soon = array(68);
	/* "Now Open" places get a "Now Open"
	 * indicator next to their name
	 */
	$now_open = array(45);

  if($page_options['page'] == 'Dining')
	// $page_options['ad'] = '<img src="/dining/template/images/scoop_right.jpg">';
    $page_options['ad'] = '<a href="http://www.youtube.com/embed/oG7sMjd1t54?autoplay=1" rel="shadowbox;width=560;height=347;"><img src="/dining/healthy/images/Healthy_video_still.jpg"></a>';
	dining_start($page_options);
	if($page_options['page'] == 'Dining'){

?>
<style>
	h1 {
		font-family: Helvetica,Arial,sans-serif !important;
		font-size:30px !important;
		line-height:32px !important;
		margin-top:0 !important;
		color: #776655 !important;
	}

	.reg-p p {
		font-size: 13px !important;
		line-height: 1.25em !important;
	}
	.reg-p a {
		font-size: 13px !important;

	}
	
	.size_20 {
		font-size:24px;
		
	}
	.ua_main_calendar input {
		color: #808000;
		background-color: #FFD700;
		display: block;    
		width: 160px;    
		height: 20px;   
		border-color:transparent;
		text-decoration: none;   
		border-radius: 4px;
	}
	.ua_main_calendar input:hover {
		color: #ffffff;
		background-color: #D1861A;
		display: block;   
		width: 160px;
		height: 20px;        
		border-color:transparent;
		text-decoration: none;
	}

</style>

	<h1>Quality. Convenient. Healthy.</h1>

	<p class="opening">
		The University of Arizona offers one of the finest college dining services in the country. Our quality, variety, convenience, and healthy food options are unsurpassed.
	</p>

	<div class="reg-p" >
	<p>
		There are over 35 different eateries, conveniently situated throughout the campus to meet your dining needs for every meal, every day.
	</p>

	<p>
		From cafeteria dining, to national franchises and brands - plus a variety of specialty restaurants and value added meal plans - the University of Arizona will provide you with the very best!
	</p>
	<br />
	<p>
		<a href="sumc">Student Union Memorial Center Restaurants &gt;</a><br />
		<br />
		<a href="psu">Park Student Union Restaurants &gt;</a><br />
		<br />
		<a href="other">More Places to Eat &gt;</a>
	</p>
	<br />
	<!--
	<p><b>Student Union's Finals Survival Week Specials</b><br />
	<i>December 10-18, 2014</i></p>
	<ul>
		<li><b>FREE LATE-NIGHT PANCAKE BREAKFAST, </b>(Thurs. 12/11; 10pm-Midnight only) at Cactus Grill, Bear Down Kitchen, Park Ave. Dining. Bring your CatCard. </li>
		<li><b>FREE 24-HOUR DELIVERY of Highland Market menu</b> w/Tapingo iPhone/Android app. $7 minimum order delivered to Res Life,Main Library, Campus Rec or Greek houses. (Wednesday, Dec. 10 noon to Thursday, Dec. 18 noon)</li>
		<li><b>FREE 12oz Drip Coffee (after 3p) at </b>Cactus Grill, PSU Dining, Einstein's Bagels, Cellar Bistro</li>
		<li><b>FREE Chili Cheese Dog (9p to 1am) at </b>Cellar Bistro</li>
		<li><b>FREE Side &amp; Fountain Drink </b>with purchase of any BBQ sandwich at Cactus Grill BBQ</li>
		<li><b>FREE Protein </b>with purchase of any salad at Core, Core+ at PSU</li>
		<li><b>FREE Toppings </b>with purchase of a small or larger frozen yogurt at Pinkberry</li>
		<li><b>FREE Empanada </b>with purchase of any entrée at Sabor</li>
		<li><b>FREE Medium Fountain Drink </b>with purchase of any bagel and cream cheese or bagel sandwich at On Deck Deli, Bagel Talk</li>
		<li><b>FREE 12oz Coffee or 24oz Fountain Drink (10pm-3am only) </b>with purchase of a breakfast burrito, Highland Market</li>
		<li><b>FREE Short Drip Coffee (6pm-5am) </b>atStarbucks @ Library</li>
		<li><b>FREE Cookie </b>with any signature grande size coffee at CC's Coffee House</li>
		<li><b>50% Off Any Red and Blue Market item </b>(after 5p) at 7 campus locations</li>
		<li><b>50% Off Any Size Smoothie </b>with purchase of any entree or wrap at IQ Fresh</li>
	</ul>
	-->
	</div>


<?php
	}

// elseif($page_options['page'] == 'sumc' || $page_options['page'] == 'psu'){
elseif($page_options['page'] == 'sumc') {
	print '<h1>'.$title.'</h1>';

//if ($page_options['page'] == 'psu')
//{
//	print '<h1 style="margin-top: -20px;" >'.$title.'</h1>';
//	print '<div style="margin-top:-20px; margin-bottom:20px; font-weight:bold; font-size:14px;">West Side of Campus</div>';
//	// print "<p style='margin-top: -20px;' ><img src='/template/images/ads/strawberry-web2-menu-F.gif' /></p>";
//} else {
//	print '<h1>'.$title.'</h1>';
//}

$result = $db->query($query);
$num = mysqli_num_rows($result);
$remainder  = $num%3;
$num = intval($num/3);
print '<div style="float:left; width:135px; margin-right:45px;">';
$i=0;
// This is for the 1st column of SUMC restaurant list.
while($i<$num+$remainder){
	$location = mysqli_fetch_assoc($result);
	if(in_array($location['location_id'], $no_menu))
		$more = '';
	else
		// Open PDF Menu for "IQ Fresh".
		if($location['location_id']==27) {
        	$more = ' : <a href="/dining/template/resources/IQFresh.pdf" target="_blank">Menu</a>';
        } else { 
			$more = ' : <a href="../menu.php?unit='.$location['short_name'].'" rel="shadowbox;height=500;width=600">Menu</a>';
        }
	print '<h2><a href="'.$location['location_url'].'">'.$location['location_name'];
	if(in_array($location['location_id'], $coming_soon))
		print '<br /><span style="font-weight:normal;">Coming Soon!</span>';
	if(in_array($location['location_id'], $now_open))
		print '<br /><span style="font-weight:normal;">Now Open!</span>';
	print '</a></h2>';
	print '<p>'.$location['short'].$more.'<p>';
	$i++;
}
print '</div><div style="float:left; width:135px; margin-right:45px;">';
$i=0;
// This is for the 2nd column of SUMC restaurant list.
while($i<$num){
	$location = mysqli_fetch_assoc($result);
	if(in_array($location['location_id'], $no_menu))
		$more = '';
	else
		// Open PDF Menu for "NRICH".
		if($location['location_id']==74) {
        	$more = ' : <a href="/dining/template/resources/NRich.pdf" target="_blank">Menu</a>';
        } else { 
			$more = ' : <a href="../menu.php?unit='.$location['short_name'].'" rel="shadowbox;height=500;width=600">Menu</a>';
        }
	print '<h2><a href="'.$location['location_url'].'">'.$location['location_name'];
	if(in_array($location['location_id'], $coming_soon))
		print '<br /><span style="font-weight:normal;">Coming Soon!</span>';
	if(in_array($location['location_id'], $now_open))
		print '<br /><span style="font-weight:normal;">Now Open!</span>';
	print '</a></h2>';
	print '<p>'.$location['short'].$more.'<p>';
	$i++;
}
// print '<a href="/dining/template/resources/strawberry.pdf" target="_blank"><img src="/dining/template/images/strawberrypdf2.jpg" alt="" /></a>';
print '</div><div style="float:left; width:135px;">';
// This is for the 3rd column of SUMC restaurant list.
while($location = mysqli_fetch_assoc($result)){
	if(in_array($location['location_id'], $no_menu))
		$more = '';
	else
		// Open PDF Menu for "the scoop".
		if($location['location_id']==22) {
        	$more = ' : <a href="/dining/template/resources/scoop_menu.pdf" target="_blank">Menu</a>';        
		// Open PDF Menu for "Sabor".
		} elseif($location['location_id']==21) {
       	  $more = ' : <a href="/dining/template/resources/sabor_menu.pdf" target="_blank">Menu</a>';
		// Open PDF Menu for "Steak 'n Shake".
		} elseif($location['location_id']==75) {
       	  $more = ' : <a href="/dining/template/resources/SteakNShake.pdf" target="_blank">Menu</a>';
		} else { 
			$more = ' : <a href="../menu.php?unit='.$location['short_name'].'" rel="shadowbox;height=500;width=600">Menu</a>';
        }
	print '<h2><a href="'.$location['location_url'].'">'.$location['location_name'];
	if(in_array($location['location_id'], $coming_soon))
		print '<br /><span style="font-weight:normal;">Coming Soon!</span>';
	if(in_array($location['location_id'], $now_open))
		print '<br /><span style="font-weight:normal;">Now Open!</span>';
	print '</a></h2>';
	print '<p>'.$location['short'].$more.'<p>';
}
print '</div>';
	}

// Including "Park Student Union Restarants" as a static page.
elseif($page_options['page'] == 'psu') {
	include 'psu_included.php';
	
// Including "More Places to Eat" as a static page.
} elseif($page_options['page'] == 'other') {
	include 'other_included.php';

} else {

?>
<style>
.temp_menu p
{
	padding: .5em;
}

.temp_menu td p
{
	margin: 0!important;
}
</style>

<h1><?=$place?>: <span style="color:#D30033;"><?=$location['location_name']?></span></h1>
<div>
	<?php 
		printLocationHours($location['location_id']); 
		// printLocationHours($location['old_id'])
	?>
</div>

<div style="height:20px; margin-top:8px; margin-bottom:13px;">

<!-- For BagelTalk Menu. -->
<? if($location['location_id']==35) { ?>
    <div class="black-button"><a href="/dining/template/resources/BagelTalk.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>
    <!--<div class="black-button"><a href="/dining/menu.php?unit=<?=$location['short_name']?>" rel="shadowbox;height=500;width=600">Menu</a></div>-->
    
<!-- For La Petite Patisserie Menu. -->
<? } elseif($location['location_id']==62) { ?>
    <div class="black-button"><a href="/dining/template/resources/LaPetite.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>
    <!--<div class="black-button"><a href="/dining/menu.php?unit=<?=$location['short_name']?>" rel="shadowbox;height=500;width=600">Menu</a></div>-->
    
<!-- For Core+ Menu. -->
<? } elseif($location['location_id']==38) { ?>
    <div class="black-button"><a href="/dining/template/resources/CorePlus.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>
    <!--<div class="black-button"><a href="/dining/menu.php?unit=<?=$location['short_name']?>" rel="shadowbox;height=500;width=600">Menu</a></div-->>

<!-- For MoltoGusto, open PDF for the Menu. -->
<? } elseif($location['location_id']==71) { ?>
    <div class="black-button"><a href="/dining/template/resources/MoltoGusto.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>
    
<!-- For OnDeckDeli2, open PDF for the Menu. -->
<? } elseif($location['location_id']==73) { ?>
    <div class="black-button"><a href="/dining/template/resources/OnDeck2.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>

<!-- For the scoop, open PDF for the Menu. -->
<? } elseif($location['location_id']==22) { ?>
    <!--<div class="black-button"><a href="/dining/template/resources/scoop_menu.pdf" target="_blank"></a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>-->

<!-- For NRICH, open PDF for the Menu. -->
<? } elseif($location['location_id']==74) { ?>
    <div class="black-button"><a href="/dining/template/resources/NRich.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>

<!-- For Sabor, open PDF for the Menu. -->
<? } elseif($location['location_id']==21) { ?>
    <div class="black-button"><a href="/dining/template/resources/sabor_menu.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>

<!-- For Steak N Shake, open PDF for the Menu. -->
<? } elseif($location['location_id']==75) { ?>
    <div class="black-button"><a href="/dining/template/resources/SteakNShake.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>
                       
<!-- For TheDen, open PDF for the Menu. -->
<? } elseif($location['location_id']==72) { ?>
    <div class="black-button"><a href="/dining/template/resources/TheDen.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>

<!-- For Highland Market, open PDF for the Menu. -->
<? } elseif($location['location_id']==42) { ?>
    <div class="black-button"><a href="/dining/template/resources/HighlandMarketMenu.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"><strong>Menu Updated!! Open 24 Hours.</strong></span>

<!-- For Catalyst Cafe, open PDF for the Menu. -->
<? } elseif($location['location_id']==47) { ?>
    <div class="black-button"><a href="/dining/template/resources/Catalyst_Cafe.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;">
        
<!-- For ShakeSmart, open PDF for the Menu. -->
<? } elseif($location['location_id']==77) { ?>
    <div class="black-button"><a href="/dining/template/resources/ShakeSmart.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>
    
<!-- For IQFresh, open PDF for the Menu. -->
<? } elseif($location['location_id']==27) { ?>
    <div class="black-button"><a href="/dining/template/resources/IQFresh.pdf" target="_blank">Menu</a></div>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"></span>
    
<? } else { ?>
	<? if(!in_array($location['location_id'], $no_menu)) {?>
    <div class="black-button"><a href="../menu.php?unit=<?=$location['short_name']?>" rel="shadowbox;height=500;width=600">Menu</a></div><?php } ?>
    <!-- This is for the extra button next to the Menu button. -->
	<? if($location['location_id']==999) { ?>
		<div class="black-button"><a href="../menu.php?unit=ondeck_delivery" rel="shadowbox;height=500;width=600">Delivery</a>
        </div>
	<?php } ?>
<?php } ?>
</div>

<!--This is the main content of the specific restaurant page.-->
<div id="location-description">
<?php
// THis is the customized page for Scoop.
if($location['location_id'] == 22) {
?>
<div>
	<hr>
	<img src="/dining/template/images/monthly_special.jpg" alt="Scoop Monthly Special" width="550" height="95" />
	<hr />
	<img src="/dining/template/images/scoop_blurb.jpg" alt="Scoop Monthly Special" width="550" height="190" />
	<hr />
	<div align="center">
	<a href="/dining/template/resources/Scoop_Catering_Menu.pdf" target="_blank"><img src="/dining/template/images/button_menu.jpg" alt="Scoop Menu" width="146" height="58" /></a>&nbsp;&nbsp;
	<a href="/dining/template/resources/Scoop_Catering_Coffee.pdf" target="_blank"><img src="/dining/template/images/button_coffee.jpg" alt="Scoop Menu" width="146" height="58" /></a>&nbsp;&nbsp;
	<a href="/dining/template/resources/Scoop_Catering_IceCream.pdf" target="_blank"><img src="/dining/template/images/button_icecream.jpg" alt="Scoop Menu" width="146" height="58" /></a>
	</div>
	<hr />

	<style type="text/css">
			.wrap-restaurants {
				position: relative;
				clear: both;
				width: 100%;
			}
			.wrap-restaurants > a {
				position: absolute;
				z-index: 0;
				visibility: hidden;
			}
			.wrap-restaurants > a:nth-child(1){
				visibility: visible;
			}
		</style>
		<div class="wrap-restaurants" id=all_rest2>
		<?php
			$conn = new db_mysqli("su");
			$location = 'scoop';

			// Get list of images depends on the location
			$query = "SELECT * FROM rotation WHERE active = 1 AND location = '".$location."'";
			if ($result = $conn->query($query, MYSQLI_USE_RESULT)) {
				$image_list = mysqli_fetch_all($result,MYSQLI_ASSOC);
				$result->close();
			}

			// Count to check if there is no data
			if ( count($image_list) <= 0 ){
				// Then get default images
				$location = 'default';
				$query = "SELECT * FROM rotation WHERE active = 1 AND location = '".$location."'";
				if ($result = $conn->query($query, MYSQLI_USE_RESULT)) {
					$image_list = mysqli_fetch_all($result,MYSQLI_ASSOC);
					$result->close();
				}
			}

			$conn->close();

			// Rotating images

			foreach ($image_list as $row) {
				$print = '<a href="'.$row['url'].'">'.
							'<img src="'.$row['file_path'].$row['file_name'].'" id="img" width="550">'.
						 '</a>';
				echo $print;
			}

			?>
	</div>

	
</div>
<?php } else {
echo $location['long'];
}
?>
	
<!-- Add buttons depending on the page -->
<?
// If Chick-Fil-A then add a corresponding button
if($location['location_id'] == 24) {
	// This adds an img that is linked to the Chick-Fil-A Catering PDF
	// img is floated left and have an empty div after that clears both (clearfix)
	echo '<br/><a href="/dining/template/resources/Chick-Fil-A_Catering.pdf" target="_blank"><img style="float:left;margin: 0 180px;" src="../template/images/Chick-Fil-A_WebOrderButton_17.jpg" alt="Order Now Button"></a><div style="clear:both;"></div>';
}
// If Einstein Bros Bagels then add a corresponding button
else if ($location['location_id'] == 67) {
	// This adds an img that is linked to the Einstein Bros Bagels Catering PDF
	// img is floated left and have an empty div after that clears both (clearfix)
	echo '<br/><a href="/dining/template/resources/EBB_Catering.pdf" target="_blank"><img style="float:left;margin: 0 180px;" src="../template/images/EinsteinsBrosBagels_WebOrderButton_17.jpg" alt="Order Now Button"></a><div style="clear:both;"></div>';
}
// If Highland Market then add a corresponding button
else if ($location['location_id'] == 42) {
	// This adds an img that is linked to the Highland Market Catering PDF
	// img is floated left and have an empty div after that clears both (clearfix)
	echo '<br/><div align="center"><a href="/dining/template/resources/Highland_Burrito_CateringMenu_RS.pdf" target="_blank"><img src="../template/images/highland_party_menu.jpg" alt="Party Menu"></a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="../../catering/online_order/index.php" target="_blank"><img src="../template/images/highland_catering_order.jpg" alt="Catering Online Order"></a>
	</div><br />';
}
?>
</div>
<br />
<a href="/dining/<?=$place_short?>" style="font-weight:bold; font-size:16px;"><img src="/dining/template/images/back_arrow.gif" /> Back to <?=$place?></a>

<!--
	look up the location_id in the location table of the hours2 database
-->

<!-- This img is commented out because it is replaced by a button to maintain uniformity across other pages -->
<!-- <?if($location['location_id']==42){?>
	<p style="margin-top: 20px;"><a href="/dining/template/resources/Highland_Burrito_CateringMenu_RS.pdf" target="_blank" /><img src="/dining/template/images/HighlandMarketPage.jpg" /></a></p>
<?php }?> -->

<!--
<?if($location['location_id']==65){?>
	<p style="margin-top: 20px;"><img src="/dining/template/images/Thanks12_psu-web.gif" /></p>
<?php }?>
-->

<?php

	}
	dining_finish();



	function printLocationHours($location_id, $loc_name = "") {
  global $location;
	// $db_name = "hours2";
	// $db_host = "mysql_host";
	// $db_user = "web";
	// $db_pass = "viv3nij";

	$locations_table = "locations";
	$groups_table = "groups";
	$subgroups_table = "subgroups";
	$hours_table = "hours";

	// $db2 = new DB('hours2');
	$db2 = new db_mysqli('hours2');

	$today = date("Y-m-d", time());
	// echo $today;

	$day = date("N");
	/*
	$query_string = "SELECT * FROM $locations_table, $hours_table
    				 WHERE ( ${hours_table}.location_id = '$location_id'
    				 AND ${hours_table}.location_id = ${locations_table}.location_id
    				 AND ${hours_table}.start_date <= '$today'
    				 AND ${hours_table}.end_date >= '$today' )";

	$query_result = mysql_query( $query_string );

	$query_row = mysqli_fetch_assoc( $query_result );

	$open = $query_row[$day . "_open"];
	$close = $query_row[$day . "_close"];
	$isClosed = $query_row[$day . "_isClosed"];
	*/
	$query='select location_id from location where location_id='.$location_id;
	// $query='select location_id from location where old_id='.$location_id;
	//print $query;
	$result = $db2->query($query);
	$temp =  $result->fetch_array();
	$location_id = $temp['location_id'];

	$query = 'select * from hours join periods on hours.type=periods.type where start_date<="'.$today.'" and end_date>="'.$today.'" and location_id='.$location_id;

	//print $query;
	$result = $db2->query($query, $link);
	$query_row = $result->fetch_array(MYSQL_NUM);
	//var_dump($query_row);
	//print (($day-1)*2)+1;
	//print (($day-1)*2)+2;
	$open = $query_row[(($day-1)*2)+1];
	$close = $query_row[(($day-1)*2)+2];
	$isClosed = (($open==$close) && ($open == '00:00:00'));


	$query = 'select * from exceptions where location_id ='.$location_id.' and date_of="'.$today.'"';
	//print $query;
	$result = $db2->query($query);
	if(mysqli_num_rows($result)){
	//print 'exception';
		$row = mysqli_fetch_assoc($result);
		$open = $row['open'];
		$close = $row['close'];
		$isClosed = (($open==$close) && ($open == '00:00:00'));
	}

	$phone = $location["phone"];

	echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" bgcolor=\"#999999\" width=\"100%\">";
	echo "<tr><td>";
	echo "<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\" bgcolor=\"#ffffff\" width=\"100%\">";
	echo "<tr><td width=\"35\"><img src=\"/template/images/clock.gif\" width=\"33\" height=\"33\" alt=\"clock image\" border=\"0\"></td>";
	echo "<td>";

	if( $loc_name == "" ) $loc_name = $query_row["location_name"];

	// This is for the customized message for specific restaurant.
	if($location['location_id']==999){
		echo "We will be CLOSED until mid August for remodeling.";
	} else {
	if( $isClosed == 1 || !isset($open) || !isset($close)) {
		echo $loc_name . " is closed today.&nbsp;&nbsp;";
	}
	// highland market is open 24hrs during the regular school year.
	else if ($open == $close && $open != "00:00:00") {
		echo $loc_name . " is open 24hrs!&nbsp;&nbsp;";
	}
	else {
		echo $loc_name . " is open today from ";
		echo printHours($open, $close, $isClosed);
		echo ".&nbsp;&nbsp;";
	}
	}

		
	if( $phone != null && isset($phone) ) {
		echo "<br>Call us at " . $phone . ".";
	}

	echo "<br><a href = \"/infodesk/hours\">view all student union hours</a>&nbsp;&nbsp;";

	echo "</td>";
	echo "</tr></table></td></tr></table>";

}

function printHours($open_time, $close_time, $isClosed) {

	// check if the location is closed
	if ($isClosed == 1) {

		echo "<font color=\"#666666\">closed</font><br>";

	} else {

		echo prettyTime($open_time) . '-' . prettyTime($close_time);

	}

}

function prettyTime($time) {

	list($hour, $min, $sec) = explode(":", $time);

	//echo $open_hour, ":<br>", $open_min,":<br>", $open_sec,":<br>",$close_hour,":<br>", $close_min,":<br>", $close_sec;

	if ($hour >= 12) { // hour changes to pm at 12, not 13
		$hour = $hour >= 13 ? $hour - 12 : $hour; // if hour is indeed 13+, change to 1+
		$ampm = 'p';
	} else {
		$ampm = 'a';
	}

	$hour = (int)$hour; // cast to an int to get rid of leading 0

	if ($min == "00") {
		if ($hour == "00") return "mid";
		if ($hour == "12") return "noon";
		else return $hour . $ampm;
	} else {
		return $hour . ':' . $min . $ampm;
	}

}
?>

