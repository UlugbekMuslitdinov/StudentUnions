<?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/mall/template/mall.inc');
  $page_options['title'] = 'Campus Use Activity Form';
  $page_options['styles'] = '.table td{ padding:4px;}';
  $page_options['header_image'] = '/template/images/banners/ua_mall_banner.jpg';
  $page_options['page'] = 'Campus Use/Mall Activity Request Form';
  mall_start($page_options);
?>
<h1 style="width:700px;">Campus Use/Mall Activity Request Form</h1>

<p>To inquire on event space and for further information, please contact Cheryl Plummer at (520) 626-2630 or via email at <a href="mailto:DOS-UACampususe@email.arizona.edu">DOS-UACampususe@email.arizona.edu</a>.</p>
<p>Click on <a href="http://deanofstudents.arizona.edu/campususe" target="_blank">Campus Use Activity Request Form</a> to fill out your event request. UA WebAuth is required to log into the website.</p>
<p><b>FAQ's:</b>
<div>
	<ul>
		<li>UA WebAuth is required to log into the website.</li>
		<li>You must submit a separate form for each individual event:</li>
			<ol>For example: weekly tabling – you need to complete a form for EACH day requested.</ol>
		<li>Please know that your 'preferred location' is not guaranteed and will depend on space available.</li>
		<li>If you have a multi-day event during the same week, you only need to fill out one form:</li>
		<ol>For example: Family Weekend Oct. 5 – 7 will be on one form.</ol>
		<li>If you are a student organization, your advisor will be emailed the event form to sign and return.  Your event will not be processed without your advisors’ signature. It is the <b>club's</b> responsibility to follow up with the advisor to ensure signature.</li>
		<li>As a department, college or student organization, if you sponsor a Non-UA sponsored organization/business, your representative from that organization/business will be emailed the event form to sign and return. The event will not be processed without signature. It is the <b>responsibility of the UA department, college or student organization</b> to ensure a signature.</li> 
		<li>At the end of the form, please upload any additional documents: maps, diagram layouts, event schedules, insurance forms or additional event details.</li>
		<li>Once your event is confirmed, you will receive an event approval email, which will include <b>any location changes</b>. Please be prepared to show the event approval email at your event location.</li>

	</ul>
</div>
</p>
<?php mall_finish() ?>
