<?php 
	// turn on sessions
	@session_start();
	require_once('includes/field_validation.inc.php');
	require_once('dining.inc');
	$page_options['page'] = 'Dining';
	$page_options['header_image'] = "/template/images/banners/13_Union_Holiday-Meal_web_banner.jpg";
	
	dining_start($page_options);
?>

	<h1>Thank you for your order!</h1>
	
	<p>
		You should receive an email summary of your order soon.
	</p>
	
	<p>
		<strong>Orders must be picked up at The Arizona Room, located in the SUMC, from 9am-6pm on Monday, December 23, 2013.</strong>
	</p>
		
	<p>
		<strong>Our staff will contact you shortly to confirm your order.</strong>
	</p>
	
	<p>
		<strong>Payment will be taken at the time of pickup.</strong>
	</p>
		
	<p>
		<b>If you have any questions, contact <a href="mailto:bedillon@email.arizona.edu" >Brandi Dillon</a></b>
	</p>
	
	
</div>	
	
 
<?php 
	dining_finish();
?>