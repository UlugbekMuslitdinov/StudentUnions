<?php
//header and navigation
require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');

function dining_start($page_options){ global $page_options;
	$dining_options['ssheets'][] = '/dining/template/dining.css';
	$dining_options['ad_image'] = '/dining/template/images/mealplan_ad.gif';
	$dining_options['ad_alt']= 'Meal Plans';
	$dining_options['ad_link']= '/mealplans';
	//$page_options['header_image'] = '/dining/template/images/dining_header.png';
	


//	if (!array_key_exists('header_image', $page_options)){
//		$page_options['header_image'] = '/template/images/banners/dining_banner.jpg';
//	}
}
	//$header = '<img id="dining-header-img" src="'.$page_options['header_image'].'" width="950"/>';
	$page_options = array_merge($dining_options, $page_options);
	page_start('Dining');
									 
	$current_path = $_SERVER['REQUEST_URI'];

function half_line_item($name, $price){

if($price){
?>
	<div  class="half-line-item">
				<div><?=str_replace(' ', '&nbsp;', str_replace('-','&#8209;',$name))?>.........................................................................................................................................................................</div> <?=str_replace(' ', '&nbsp;',$price)?><br />
	</div>
<?php
}
else{
?>
	<div  class="half-line-item">
		<?=str_replace(' ', '&nbsp;',$name)?>
	</div>
<?php
}
}

function full_line_item($name, $sub, $price){
?>
<div class="line-item">
	<div><?=str_replace(' ', '&nbsp;', str_replace('-','&#8209;',$name))?>.........................................................................................................................................................................</div> <?=str_replace(' ', '&nbsp;',$price)?><br />
	<span><?=str_replace(' ', '&nbsp;',$sub)?></span>
</div>


<?php
}

function full_line_item_omelet($name, $sub, $price){
?>
<div class="line-item-omelet">
	<div><?=str_replace(' ', '&nbsp;', str_replace('-','&#8209;',$name))?>.........................................................................................................................................................................</div> <?=str_replace(' ', '&nbsp;',$price)?><br />
	<span><?=str_replace(' ', '&nbsp;',$sub)?></span>
</div>



<?php
}

function full_line_item_pangea($name, $sub, $price){
?>

<div class="line-item-pangea">
	<div><?=str_replace(' ', '&nbsp;',$name)?>.........................................................................................................................................................................</div> <?=str_replace(' ', '&nbsp;',$price)?><br />
	<span><?=str_replace(' ', '&nbsp;',$sub)?></span>
</div>
<?php
}

function item_only_pangea($name, $sub, $price){
?>
<div class="item-only-pangea">
	<div><?php echo $name; ?></div><br />
	<span><?php echo $sub; ?></span>
</div>
<?php

}

function full_line_item_pangea_sushi($name, $sub, $price){
?>
<div class="line-item-pangea-sushi">
	<div><?=str_replace(' ', '&nbsp;',$name)?>.........................................................................................................................................................................</div> <?=str_replace(' ', '&nbsp;',$price)?><br />
	<span><?=str_replace(' ', '&nbsp;',$sub)?></span>
</div>
<?php
}

function cactus_menu_title($title){
	?>
	<h1 class="title"><?php echo strtoupper($title['title']); ?></h1>
	<div class="current_date">
		<script>
			currentDate();
		</script>
	<?php if (strlen($title['available']) != 0){
	?>
		<div class="available">Available 
			<?php echo ucwords($title['available']); ?>
		</div>
	<?php } ?>
	</div>

	<?php
	if (strlen($title['desc']) != 0){
	?>
		<div class="desc"><?php echo $title['desc']; ?></div>
	<?php
	}
}




function full_line_item_bdk($name, $sub, $price){
?>
<div class="line-item-bdk">
	<div><?=str_replace(' ', '&nbsp;',$name)?>.........................................................................................................................................................................</div> <?=str_replace(' ', '&nbsp;',$price)?><br />
	<span><?=str_replace(' ', '&nbsp;',$sub)?></span>
</div>
<?php
}

function item_only_bdk($name, $sub, $price){
?>
<div class="item-only-bdk">
	<div><?php echo $name; ?></div><br />
	<span><?php echo $sub; ?></span>
</div>
<?php
}



function cactus_title($title, $tagline, $description){
	$upper_title = strtoupper($title);
	$title_arr = explode('$', $upper_title, 2);

	if (count($title_arr) >1){
		$upper_title = trim($title_arr[0]) . ": $" . $title_arr[1];
	} else{
		$upper_title .= ':';
	}
	
	
	$invalid = array( ' ', '~', '!', '@', '$', '%', '^', '&', '*', '(', ')', '_', '+', '-', '=', '.', '/', '\\', "'", ';', ':', '"', '?', '>', '<', '[', ']', "\\", '{', '}', '|', '`');
	$css = strtolower(str_replace($invalid, "_", $title));
	
	?>
	<h2 class="section_title <?php echo $css;?>">
		<div class="sub_title"><?php echo $upper_title;?></div>
		<div class="tag_line"><?php echo strtoupper($tagline); ?></div>
	</h2>
		<?php
			if (strlen($description) != 0){ ?>
			<div class="flex-line-item-cactus title_description <?php echo $css;?>">
				<?php echo $description; ?>
			</div>
		<?php }
		?>

	<?php 
}

function two_prices($price1, $price2){
	if ((preg_match('/\\d/', $price1) != 0 ) && (strlen($price1) != 0)){
		$price1 = "$" . $price1;
	}
	if ((preg_match('/\\d/', $price2) != 0 ) && (strlen($price2) != 0)){
		$price2 = "$" . $price2;
	}
	return "<div class=\"two_prices\"><span class=\"two_price_option\">" . $price1 . "</span><span class=\"slash\">/</span><span class=\"two_price_option\">" . $price2 . "</span></div>";
	
}


function full_line_item_cactus($name, $sub, $price){
?>
<div class="line-item-cactus">
	<div><?=str_replace(' ', '&nbsp;',$name)?>.........................................................................................................................................................................</div> <code><?=str_replace(' ', '&nbsp;',$price)?></code><br />
	<span><?=str_replace(' ', '&nbsp;',$sub)?></span>
</div>
<?php
}

function flex_line_item_cactus($name, $sub, $price){
?>
<div class="flex-line-item-cactus">
	<div class="food-title-line">
		<div class="flex-left menu-item-title"><?=str_replace(' ', '&nbsp;',$name)?></div>
	<?php
	if (strlen($price) >= 1){
		if ((strpos($price, "¢") == false) && (strpos($price, "two_prices") == false)){
			$price = "$" . $price;
		}
			
	?>
		<div class="flex-middle dot-dot-dot">...........................................................................................................................................................................................................................................</div>
		<div class="flex-right menu-item-price"><?php echo $price;?></div>
	<?php }	?>
	</div>
	<?php
	if (strlen($sub) != 0) {
	?>
	<div class="food-description"><?php echo $sub;?></div>
	<?php }?>
</div>

<?php
}

function list_item_options($data_arr){
	$title 			= $data_arr['title'];
	$price 			= $data_arr['price'];
	$desc			= $data_arr['desc'];
	$options	= $data_arr['options'];
	
	cactus_title($title, $price, $desc);

	/* Determine Cols in Display */

	$col_count = count($options);
	$flex_cols = ' one_third_col ';
	if ($col_count % 4  == 0) {
		$flex_cols = " one_fourth_col ";
	}

	/* Start Sorting Options */
	$capitalized_options = array();
	foreach ($options as $item){
		array_push($capitalized_options, ucwords($item));
	}
	asort($capitalized_options);
	$options = $capitalized_options;
	/* End Sorting Options */

	?>
		<div class="flex-line-item-cactus options">
	<?php
	foreach ($options as $item){	?>
		<div class="option_item<?php echo $flex_cols; ?>"><?php echo ucwords($item); ?></div>
	<?php 
	} 
 	 ?>
	</div>
	<?php


}

function print_cactus_wrap_list($array_of_wraps){
	foreach ($array_of_wraps as $item_array){
		flex_line_item_cactus($item_array['name'], $item_array['desc'], $item_array['price']);
	}
}



function breakfast_title($name){
	?><h2 class="sub_title"><?php echo $name; ?></h2>
<?php 
}


function full_line_item_sub_list_cactus($name, $sub, $price){
?>
<div class="item-only-cactus">
	<div><?php echo $name; ?></div><br />
	<span><?php echo $sub; ?></span>
</div>
<?php
}


function item_only_cactus($name, $sub, $price){
?>
<div class="item-only-cactus">
	<div><?php echo $name; ?></div><br />
	<span><?php echo $sub; ?></span>
</div>
<?php
}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/template/common/css/global.css">
<link rel="stylesheet" type="text/css" href="/dining/menu.css">
<script>
	function show(name){
		document.getElementById(current).style.display = 'none';
		document.getElementById(current+'-link').className = '';
		document.getElementById(name).style.display = 'block';
		document.getElementById(name+'-link').className = 'active';
		current = name;
	}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</head>
<body>
<!--
This is for the web banner. 
<div class="col-md-12 wrap-banner-img" style="margin-bottom: -120px">
	<img src='/dining/template/images/banner/starbucks.jpg' />
</div>
-->
	
	<div class="wrap-menu">
		<!-- <div style="height:28px; border-bottom:2px solid #3e3e37; background-color:#f39332; "> -->
		<div style="height:30px;">

		</div>

		<div id="menu-content-wrapper" style="padding-left:35px; padding-right:20px;">
			<?php

				require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
				$db = new db_mysqli('hours2');
				$query = 'select * from location where short_name="'.$db->escape($_GET['unit']).'"';
				$result = $db->query($query);
				$location = $result->fetch_array();

				$_SESSION['menu_location_id'] = $location['location_id'];

				include('restaurant_menus/'.$_GET['unit'].'.inc');

				$group_id = $location['group_id'];
				$place = ['', 'sumc', 'psu', 'other'];
				$redirect_url = '/dining/' . $place[$group_id] . '/' . $_GET['unit'];
			?>

			<!-- <div class="content-bottom">
				<a onclick="window.close();" style="cursor: pointer;">Back to Restaurant</a>
			</div> -->
		</div>

		<!-- <div style="height:12px; border-top:2px solid #3e3e37; background-color:#f39332;"> -->
		<div style="height:14px;">
		</div>
	</div>

</body>
</html>
