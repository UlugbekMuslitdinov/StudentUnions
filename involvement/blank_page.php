<?php 

require_once ($_SERVER['DOCUMENT_ROOT'] . '/involvement/template/involv.inc.php');

$page_options = array();
$page_options['page'] = 'Involvement';
$page_options['header_image'] = '/template/images/banners/involvement_banner.jpg';
involv_start('Involvement &amp; Entertainment');
?>
<style type="text/css" >
.su-main-content p {
	margin-bottom: 1rem;
}
	.center-list li {
		margin-top: 1.5em !important;
	}	
	.center-list a:active, .center-list a:link, .center-list a:visited {
		color: #444444 !important;
		font-weight: bold !important;
	}
	.center-list a:hover {
		color: #CC0033 !important;
		font-weight: bold !important;
	}
</style>

 <h1>Get Involved</h1> 

<p>
	Students involved on campus tend to have better grades, retention, and graduation rates and have a more enjoyable college experience overall. So come see what’s here and be a part of it!
</p>



<?php
involv_finish();
?>
