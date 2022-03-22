<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');

function dining_start($page_options){ global $page_options;

	$dining_options['ssheets'][] = '/dining/template/dining.css';
	$dining_options['ad_image'] = '/dining/template/images/mealplan_ad.gif';
	$dining_options['ad_alt']= 'Meal Plans';
	$dining_options['ad_link']= '/mealplans';

	// if (array_key_exists('header_image', $page_options)){
	// 	$header = '<img id="dining-header-img" src="'.$page_options['header_image'].'" width="950"/>';
	// }
	// unset($page_options['header_image']);

	if (!array_key_exists('header_image', $page_options)){
		$page_options['header_image'] = '/template/images/banners/dining_banner.jpg';
	}


	$page_options = array_merge($dining_options, $page_options);
	page_start('Dining');
									 
	$current_path = $_SERVER['REQUEST_URI'];

?>

<div class="col-md-12 wrap-banner-img">
	<img src="<?php echo $page_options['header_image']; ?>" />
</div>
	  
<div class="col wrap-left-col">

	<div id="left-col" class="wrap-left-col-menu">
		<ul>
			<li><a href="/dining">Restaurants Home</a></li>
			<li><a href="/dining/sumc">Eat at SUMC</a></li>
			<li><a href="/dining/psu">Eat at Global</a></li>
			<li><a href="/dining/other">More Places to Eat</a></li>
			<!-- <li><a href="/dining/around">More Dining Around Campus</a></li> -->
			<li><a href="/roadrunner">RoadRunner Mobile Kitchen</a></li>
			<li><a href="/infodesk/hours/index.php?cat=dining">Dining Hours</a></li>
			<li><a href="/maps">Building Maps</a></li>
			<li><a href="/mealplans">Meal Plans</a></li>
			<li><a href="/diningcard/index.php">Departmental Dining Card</a></li>
			<li><a href="/foodsafety/index.php">Food Safety Information</a></li>
			<li><a href="/catering">Arizona Catering Company</a></li>
			<li><a href="http://nutrition.union.arizona.edu" target="_blank" rel="noopener noreferrer">Nutrition</a></li>
        </ul>
	</div>

</div>

<div class="col">
      <div class="col-12 mt-4">

<?php
}

function dining_finish(){
?>
</div></div>
<?php
	page_finish();
}
