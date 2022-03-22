<?php session_start();

	// This functon converts an array of healthy options to a bitmask
	function healthyarray_to_bitmask($options) {
		$bitmask = 0x0;
		
		if($options['vegetarian']==true) {
			$bitmask = $bitmask | 0x8;
		}
		if($options['lo-fat']==true) {
			$bitmask = $bitmask | 0x4;
		}
		if($options['lo-carb']==true) {
			$bitmask = $bitmask | 0x2;
		}
		if($options['vegan']==true) {
			$bitmask = $bitmask | 0x1;
		}
		
		return $bitmask;
	}
	
	$db_name = "menuboards";
	$db_host = "trinity.sunion.arizona.edu";
	$db_user = "web";
	$db_pass = "viv3nij";
	
	$link = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
	mysql_select_db($db_name, $link) or die(mysql_error());
	
	// Grab the ID of the unit which is being edited
	$unit_id=$_GET[unitID];
	// Grab the ID fo the panel which is being edited
	$panel_id=$_POST['panel_id'];
	// Determine if the current panel is locked
	//$current = mysql_query("select locked from panel where id='".$panel_id."'");
	//$panel_locked = mysql_fetch_assoc($current);
	//$panel_locked = $panel_locked['locked'];
	
	if ($_POST['submit_type']=='cat') {
		if (isset($_POST['cat_name'])) {
			mysql_query('UPDATE category SET name="'.$_POST['cat_name'].'" where id='.$_POST['cat_id']);
		}
		if (isset($_POST['cat_price1'])) {
			mysql_query('UPDATE category SET price1='.$_POST['cat_price1'].' where id='.$_POST['cat_id']);
		}
		if (isset($_POST['cat_price2'])) {
			mysql_query('UPDATE category SET price2='.$_POST['cat_price2'].' where id='.$_POST['cat_id']);
		}
		if (isset($_POST['cat_price3'])) {
			mysql_query('UPDATE category SET price3='.$_POST['cat_price3'].' where id='.$_POST['cat_id']);
		}
		
		$options = array();
		if(isset($_POST['cat_healthy'][0])) {$options['vegan']=true;}
		if(isset($_POST['cat_healthy'][1])) {$options['lo-carb']=true;}
		if(isset($_POST['cat_healthy'][2])) {$options['lo-fat']=true;}
		if(isset($_POST['cat_healthy'][3])) {$options['vegetarian']=true;}
		$healthy_bitmask = healthyarray_to_bitmask($options);
		mysql_query('UPDATE category SET healthy_options='.$healthy_bitmask.' where id='.$_POST['cat_id']);
	}
	
	if ($_POST['submit_type']=='item') {
		if (isset($_POST['item_title'])) {
			mysql_query('UPDATE item SET title="'.$_POST['item_title'].'" where id='.$_POST['item_id']);
		}
		if (isset($_POST['item_subtitle'])) {
			mysql_query('UPDATE item SET subtitle="'.$_POST['item_subtitle'].'" where id='.$_POST['item_id']);
		}
		if (isset($_POST['item_price1'])) {
			mysql_query('UPDATE item SET price1='.$_POST['item_price1'].' where id='.$_POST['item_id']);
		}
		if (isset($_POST['item_price2'])) {
			mysql_query('UPDATE item SET price2='.$_POST['item_price2'].' where id='.$_POST['item_id']);
		}
		if (isset($_POST['item_price3'])) {
			mysql_query('UPDATE item SET price3='.$_POST['item_price3'].' where id='.$_POST['item_id']);
		}
		
		$options = array();
		if(isset($_POST['item_healthy'][0])) {$options['vegan']=true;}
		if(isset($_POST['item_healthy'][1])) {$options['lo-carb']=true;}
		if(isset($_POST['item_healthy'][2])) {$options['lo-fat']=true;}
		if(isset($_POST['item_healthy'][3])) {$options['vegetarian']=true;}
		$healthy_bitmask = healthyarray_to_bitmask($options);
		mysql_query('UPDATE item SET healthy_options='.$healthy_bitmask.' where id='.$_POST['item_id']);
	}

	header('Location: ./jsmenueditor.php?unitID='.$unit_id);
	exit;

require('sectioninfo.inc');
	$template = 'sidebar_only';
	require('global.inc');
	$title = 'Panel Edit Submition';
	pageStart($title);
?>

<?php pageFinish(); ?>