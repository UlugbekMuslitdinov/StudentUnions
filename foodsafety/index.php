<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/dining/template/dining.inc');
  $page_options['title'] = 'Food Safety Information';
  $page_options['header_image'] = '/template/images/banners/food_safety_banner.jpg';
  $page_options['page'] = 'Food Safety Information';
  dining_start($page_options);
?>
<style>
	h4 {
		margin-top: 10px;
		margin-bottom: 5px;
	}
</style>

<h1>Arizona Student Unions Food Safety Information</h1>

<p>
The Arizona Student Unions and it's associated dining facilities located in the Student Union Memorial Center and Park Student Union routinely
receive scheduled and unscheduled inspections by the Pima County Health Department (<a href="http://webcms.pima.gov/health/food-safety" target="_blank">http://webcms.pima.gov/health/food-safety</a>).
The Unions are proud of the exceptional consumer health and food safety evaluations it continually receives from the Pima County Health Department.
The Unions have a proven track record in taking a proactive approach to ensure food safety by meeting and exceeding all Pima County Health sanitation
and food safety guidelines, and by conducting ongoing training of dining service staff to ensure such guidelines are met.
</p>

<br style="clear: both;" />


<?php
dining_finish();
?>
