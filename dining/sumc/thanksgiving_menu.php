<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');
// require_once('includes/mysqli.inc');
// if page is not loaded includes/mysqli.inc has problem.
// instead use hours.inc 
// require_once ('hours.inc');
$page_options['title'] = 'Turkey To Go';

dining_start($page_options);

?>

<!-- <link rel="stylesheet" type="text/css" href="turkey-togo.css"> -->

<h1 class="turkey-header" style="text-align: center;">Chef Omo's Thanksgiving Feast</h1>

<p clsss="turkey-description" style="text-align:center;font-size:16px;line-height:20px;">


	<br>
	<span style="font-size:18px;font-weight:800;">Starters</span><br>
	Watergate Salad Pineapple, Pistachio, Pecan and Chantilly Cream <br>
	Roasted Pear, Cranberry, Almond and Ancient Grain Salad<br><br>
	<span style="font-size:18px;font-weight:800;">Entrées</span><br>
	Whole Tom Turkey (pre-roasted 10-13lbs) Rich Pan Gravy<br>
	or<br>
	Prime Rib of Beef (pre-roasted 5-7lbs) Au Jus<br>
	Autumn Sage and Sausage Stuffing<br>
	Creamy Yukon Mashed Potatoes<br>
	Creamed Corn<br>
	Spiced-Maple Garnet Yams, Pecans and Apricots<br>
	Medley of Fall Vegetables<br>
	Cranberry Orange Chutney<br>
	Parker House Rolled<br><br>
	<span style="font-size:18px;font-weight:800;">Dessert</span><br>
	Cinnamon Streusel Apple Pie<br>
	or<br>
	Classic Pumpkin Pie with Chantilly Cream<br><br>
	<span style="font-size:18px;font-weight:800;">Coffee</span><br>
	Wildcat-Blend Coffee Package<br><br>

</p>

<div class="wrap-orderNow-btn">
	<a href="/dining/sumc/turkey_order.php" target="_blank" class="orderNow-btn"><img src="/dining/sumc/images/OrderNow_Botton.png"></a>
</div>

<?php
dining_finish();





function dining_start($page_options){ global $page_options;



//connect to database
// include("mysql_link.inc");

// mysql_select_db('hours2');
	$page_options['script_incs']= array('/commontools/jslib/jquery.js', '/commontools/jslib/shadowbox/shadowbox.js');
	$page_options['scripts'] = 'Shadowbox.init();';
	$dining_options['ssheets'][] = '/dining/template/dining.css';
	$dining_options['ssheets'][] = '/commontools/jslib/shadowbox/shadowbox.css';
	$dining_options['ssheets'][] = '/dining/sumc/turkey-togo.css';
	$dining_options['ad_image'] = '/dining/template/images/mealplan_ad.gif';
	$dining_options['ad_static'] = $ad;
	$dining_options['ad_alt']= 'Meal Plans';
	$dining_options['ad_link']= '/mealplans';
	
	if($page_options['header_image']){
		$header = '<img id="dining-header-img" src="images/TurkeyMastHeader.jpg" width="950"/>';
	}
	$header = '<img id="dining-header-img" src="/dining/sumc/images/TurkeyMastHeader.jpg" width="950"/>';
	unset($page_options['header_image']);
	
	
	$page_options = array_merge($dining_options, $page_options);
	page_start('Dining');
	?>
	<!-- <div style="height:300px; margin-top:6px; margin-bottom:15px;"> -->
		<?=$header?>
		
	</div>
	<div id="left-col">
		<a href="/dining/sumc/thanksgiving_menu.php"><img src="/dining/sumc/images/ChefOmo_Ribbon.png" width="250"></a>
	</div>
	<div id="center-col">

		<?php 
	}

	function dining_finish(){
		?>
	</div>
	<?php 
	page_finish();
}

