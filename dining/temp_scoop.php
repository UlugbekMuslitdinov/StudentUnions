<link rel="StyleSheet" href="/template/global.css" type="text/css" />
<?php
	require_once('temp.inc');
	require_once('includes/mysqli.inc');
	$db = new db_mysqli('hours2');
	$page_options['page'] = 'Dining';
	$page_options['header_image'] = '/dining/template/headers/scoop_header.jpg';
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
			$page_options['header_image'] = $l[$location['location_id']]['banner'];
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
	$no_menu = array(31, 2, 57, 29, 26, 36, 37, 65, 66);


	$coming_soon = array(68);
	/* "Now Open" places get a "Now Open"
	 * indicator next to their name
	 */
	$now_open = array(45);
  if($page_options['page'] == 'Dining')
    $page_options['ad'] = '<img src="template/images/scoop_right.jpg">';
    // $page_options['ad'] = '<a href="http://www.youtube.com/embed/oG7sMjd1t54?autoplay=1" rel="shadowbox;width=560;height=347;"><img src="/dining/healthy/images/Healthy_video_still.jpg"></a>';
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

<h1>Student Union: <span style="color:#D30033;">the scoop</span></h1>
<div>
	<img src="template/images/monthly_special.jpg" alt="Scoop Monthly Special" width="550" height="95" />
	<hr />
	<img src="template/images/scoop_blurb.jpg" alt="Scoop Monthly Special" width="550" height="190" />
	<hr />
	<div align="center">
	<a href="template/resources/Scoop_Catering_Menu.pdf" target="_blank"><img src="template/images/button_menu.jpg" alt="Scoop Menu" width="146" height="58" /></a>&nbsp;&nbsp;
	<a href="template/resources/Scoop_Catering_Coffee.pdf" target="_blank"><img src="template/images/button_coffee.jpg" alt="Scoop Menu" width="146" height="58" /></a>&nbsp;&nbsp;
	<a href="template/resources/Scoop_Catering_IceCream.pdf" target="_blank"><img src="template/images/button_icecream.jpg" alt="Scoop Menu" width="146" height="58" /></a>
	</div>
	<hr />
</div>
<div id="right-col3">
	<style type="text/css">
		.wrap-restaurants2 {
			position: relative;
			clear: both;
			width: 100%;
		}
		.wrap-restaurants2 > a {
			position: absolute;
			z-index: 0;
			visibility: hidden;
		}
		.wrap-restaurants2 > a:nth-child(1){
			visibility: visible;
		}
	</style>
<div class="wrap-restaurants2" id="all_rest">
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

<?php
	}
?>

<br />
