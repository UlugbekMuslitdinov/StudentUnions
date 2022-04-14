<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');

function dining_start($page_options){ global $page_options;

	############################################
	# required for all pages using DELIVERANCE #
	############################################

	// enables 'edit | view' options to appear for authorized users
	//session_start();

	// connect to database
	require_once($_SERVER["DOCUMENT_ROOT"] . "/commontools/deliverance/inc_db_switch.php");

	// includes the display functions
	require_once($_SERVER["DOCUMENT_ROOT"] . "/commontools/deliverance/display_functions.php");

	################################
	# end DELIVERANCE requirements #
	################################

ob_start();
randomFeed(6);
$ad = ob_get_clean();

ob_start();
randomFeed(8);
$header = ob_get_clean();

//connect to database
include($_SERVER["DOCUMENT_ROOT"] . "/commontools/mysql_link.inc");

// $DBlink=mysqli_connect('mysql_host', 'web', 'viv3nij'); 
mysqli_select_db($DBlink,"hours2");									 
// mysqli_select_db('hours2');
// mysql_select_db('hours2');
	$page_options['script_incs']= array('/commontools/jslib/jquery.js', '/commontools/jslib/shadowbox/shadowbox.js','/js/rotate.js');
	$page_options['scripts'] = 'Shadowbox.init();';
	$dining_options['ssheets'][] = '/dining/template/dining.css';
	$dining_options['ssheets'][] = '/commontools/jslib/shadowbox/shadowbox.css';
	$dining_options['ad_image'] = '/dining/template/images/mealplan_ad.gif';
	$dining_options['ad_static'] = $ad;
	$dining_options['ad_alt']= 'Meal Plans';
	$dining_options['ad_link']= '/mealplans';

	if (array_key_exists('header_image', $page_options)){
	// if(isset($page_options['header_image'])){
		$header = '<img id="dining-header-img" src="'.$page_options['header_image'].'" width="950"/>';
	}
	unset($page_options['header_image']);


	$page_options = array_merge($dining_options, $page_options);
	page_start('Dining');
									 
	$current_path = $_SERVER['REQUEST_URI'];

?>
	<div style="height:300px; margin-top:6px; margin-bottom:15px; border-radius: 10px;">
	<?=$header?>

	</div>
	<div id="right-col">
		
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
	  
		<div class="wrap-restaurants" 
	    <?php
		if ($current_path != "/dining/sumc/scoop") {
		?> 
	    id=all_rest
		<?php } ?>
		>
		<?php
		if ($current_path == '/dining/other/catalyst'){
	    	echo '<a><img src="/dining/template/images/CatalystCafe/welcome.gif" alt="events" /></a>';
	    }
		else if ($current_path != "/dining/sumc/scoop") {
		$conn = new db_mysqli("su");


		// if ($_GET['p']=='') {
		// 	$location = 'default';
		// }else{
		// 	$location = $_GET['p'];
		// }

		if (!array_key_exists('p', $_GET) || is_null($_GET['p'])) {
			$location = 'default';
		}else{
			$location = $_GET['p'];
		}
		
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
		// No rotating images at the right column for Scoop
		// if ($current_path != "/dining/sumc/scoop") {			 
		foreach ($image_list as $row) {
			$print = '<a href="'.$row['url'].'">'.
						'<img src="'.$row['file_path'].$row['file_name'].'" id="img">'.
					 '</a>';
			echo $print;
		}
		}
		?>
		</div>
		
		
		<!-- <a href="/dining/template/movies/BagelTalk.mov" rel="shadowbox;height=353;width=600"><img src="<?=$page_options['video_image']?>" alt"<?=$page_options['video_alt']?>" /></a> -->
		<a href="<?=$page_options['ad_link']?>" class="ad-block"><img src="<?=$page_options['ad_image']?>" alt"<?=$page_options['ad_alt']?>" /></a>
		<a href="/events"><img src="/dining/template/images/events_btn.jpg" alt="events" /></a>
		<a href="/about/marketing/ask.php"><img src="/dining/template/images/feedback_btn.jpg" alt="contact" /></a>
		<a href="/tellus"><img src="/dining/template/images/tellus_btn.jpg" alt="donate" /></a>
		<?php
			// $url = $_SERVER['REQUEST_URI'];
			// $url_arr = explode('/', $url);
			// $last_element = $url_arr[count($url_arr)-1];
			// if ($last_element == 'slotcanyon')
			// {
			// 	echo '<a href="/dining/template/resources/Slot_Canyon_Catering_Brochure_Menu_web_only.pdf" target="_blank"><img src="/dining/template/images/SlotCanyon_Catering_Buttons.jpg" style="width: 100%;"></a>';
			// 	echo '<a href="/dining/template/resources/Slot_Canyon_Catering_OrderForm.pdf" target="_blank"><img src="/dining/template/images/SlotCanyon_Catering_Form_Button.jpg" style="width: 100%;"></a>';
			// }
		?>
	</div>

	<div id="left-col">
		<div class="mobile-menu-toggle-btn" onclick="openPageMenu();">
			<!-- Menu<br> -->
	    	<i class="fa fa-angle-double-right"></i>
	    </div>
	    <div class="wrap-left-col-menu">
		   	<span>Let's Eat</span>
			<ul>
				<li><a href="/dining" class="<?=$page_options['page'] == 'Dining'?'active':''?>" >Dining Home</a></li>
				<li><a href="/mealplans">Meal Plans</a></li>
				<li><a href="/dining/sumc" class="<?=$page_options['page'] == 'sumc'?'active':''?>">Eat at Student Union</a></li>
				<li><a href="/dining/psu" class="<?=$page_options['page'] == 'psu'?'active':''?>">Eat at Global Center</a></li>
				<li><a href="/roadrunner" class="<?=$page_options['page'] == 'roadrunner'?'active':''?>">RoadRunner Mobile Kitchen</a></li>
				<li><a href="/dining/other" class="<?=$page_options['page'] == 'other'?'active':''?>">More Places to Eat</a></li>
				<!--<li><a href="/dining/redandblue" class="<?=$page_options['page'] == 'redblue'?'active':''?>">Red & Blue Market</a></li>-->
				<li><a href="/catering">Arizona Catering Company</a></li>
				<li><a href="/infodesk/hours/index.php?cat=dining">Dining Hours</a></li>
				<li><a href="/maps">Building Maps</a></li>
				<!-- <li><a href="">Gift Connection</a></li> -->
				<li><a href="/diningcard/index.php">Departmental Dining Card</a></li>
				<li><a href="/employment">Employment Opportunities</a></li>
				<li><a href="/foodsafety/index.php">Food Safety Information</a></li>
				<li><a href="http://nutrition.union.arizona.edu" target="_blank">Nutrition</a></li>
			</ul>
		</div>
 	</div>

 	<script type="text/javascript">
 		function openPageMenu(){
 			var x = document.getElementsByClassName("wrap-left-col-menu")[0];
 			var btn = document.getElementsByClassName('mobile-menu-toggle-btn')[0];
 			var fa = document.getElementsByClassName('mobile-menu-toggle-btn')[0].getElementsByClassName('fa')[0];
 			// console.log(fa);
 			// var fa = document.querySelectorAll('.mobile-menu-toggle-btn .fa')[0];

			if (x.style.display === "block") {
				x.style.display = "none";

				// Change btn icon
				btn.innerHTML = '<i class="fa fa-angle-double-right"></i>';
				btn.style.width = '30px';
				btn.style.paddingLeft = '10px';

				// fa.style.float = 'none';
			}
			else {
				x.style.display = "block";

				// Change btn icon
				btn.innerHTML = '<i class="fa fa-times"></i>';
				btn.style.width = '100%';
				btn.style.paddingLeft = '0px';
				// btn.style.marginRight = '40px';

				// fa.style.float = 'right';
			}
 		}
 	</script>

<div id="center-col">


<?php
}

function dining_finish(){
?>
	</div>
<?php
	page_finish();
}
