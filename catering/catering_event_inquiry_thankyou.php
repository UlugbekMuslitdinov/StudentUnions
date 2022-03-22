<?php 
	
require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
$page_options['title'] = 'Arizona Catering Company';
require_once('deliverance.inc.php');	
require_once('includes/field_validation.inc.php');  
page_start($page_options);
require_once('contact_us.inc.php');
?>
<?php
require_once('catering_slider.inc.php');
?>
<div id="catering_page" >
<?php
require_once('catering_left_col.inc.php');
?>
<div id="center-col" >
	
	<h1>Thank you for your inquiry!</h1>
	
	<p>
		You should receive an email summary of your inquiry soon.
	</p>
	
	<p>
		<strong>Our staff will contact you shortly to discuss your inquiry.</strong>
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