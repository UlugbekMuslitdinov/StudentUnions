<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/rooms/template/rooms.inc');
$page_options['title'] = 'Reserving a Room';
$page_options['styles'] = '#center-col{width:780px;}';
$page_options['page'] = 'Banner Hanging';
$page_options['header_image'] = '/template/images/banners/policies_banner.jpg';
rooms_start($page_options);
?>


<h1>Banner Policies and Reservations</h1>
	<p>
	<a href="template/resources/BannerPolicy.pdf" target="_blank">Download Banner Policies and Request Form</a> (Please download the file and use Adobe Reader to complete the form.)
	<h2>POLICIES</h2>
	<p>
		Only banners promoting a specific function or event taking place in the Student Union Memorial Center (SUMC) may be posted in available SUMC banner spaces.  Any banners hung outside of the approved spaces will be removed and the club, organization or department may forfeit their posting privileges.  The Arizona Student Unions reserve the right to dispose of any unauthorized banners and are not responsible for lost, stolen or damaged banners.
		<ol style="margin-left:20px; line-height: 1.5em !important;">
			<li>	Banner requests must be submitted to the Event Services Office a minimum of 14 days prior to the start date of the requested reservation.</li>
			<li>	All banners must be approved by the Arizona Student Unions’ Event Services Office prior to being displayed.</li>
			<li>	Banners must be in good taste, clean, neat, use correct grammar, and contain no commercial comment other than a small endorsement or acknowledgement.  </li>
			<li>	University groups displaying banners must be recognized campus organizations or departments and include their organization/department name on their banner.</li>
			<li>	No outside vendors or agencies may utilize banner spaces unless they have scheduled the use of facilities in the SUMC.</li>
			<li>	Banners will be hung by Arizona Student Unions’ staff ONLY.</li>
			<li>	Banners will only be displayed in one of the seven approved banner spaces in the SUMC. Please see diagram on back of form.  <a href="template/resources/banner_policy.pdf" target="_blank">Download Banner Policies and Request Form</a>  </li>
			<li>	Banners must be delivered to the Event Services Office at least 1 day prior to the start of the reservation.</li>
			<li>	Banners must be picked up from the Event Services Office within 2 business days after the conclusion of the reservation.  Any banners  picked up within this time frame will be disposed of.</li>
		</ol>
	</p>

	<h2>PRICING</h2>
	<p>
		Charges are applied on the 1st day of the reservation and every 7th day thereafter.
			<ol style="margin-left:20px; line-height: 1.5em !important;">
				<li>University Rate: $50.00</li>
				<li>Non-University Rate: $100.00</li>
			</ol>
	</p>
	<p>
		<h2>BANNER SPECIFICS</h2>
			<ol style="margin-left:20px; line-height: 1.5em !important;">
				<li>Banners must be 3ft tall x 8ft wide in size.</li>
				<li>Banners must be vinyl and have grommets every 2 feet.</li>
			</ol>

	</p>
	</p>


<?php
rooms_finish()
?>
