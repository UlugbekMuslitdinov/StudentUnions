<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
$page_options['title'] = 'Arizona Catering Company';
require_once('deliverance.inc.php');	 
page_start($page_options);
?>
<?php
require_once('catering_slider.inc.php');
?>
<div id="catering_page" >
<?php
require_once('catering_left_col.inc.php');
?>
<link rel="StyleSheet" href="/template/catering.css" type="text/css" media="screen" />
	
<div id="center-col" >
	 
	 	<h2>Arizona Catering Co.</h2>
		<p>
			Content coming soon.
		</p>
		 
		 
</div> 

<?php
require_once('catering_right_col.inc.php');
?>

</div>
		 
<div style="clear:both;">
	<br /><br />
</div>

<?php page_finish(); ?>