<?php
	// header("Location: ../index.php");
	// die();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Spring into Clean Hygiene Toiletry Drive';
	page_start($page_options);	
	// DIsplay confirmation after Feast submission.
    // $confirm = $_GET["confirm"];
?>
<style type="text/css">
	body.togo_order {
		background: #F4E7D7 !important;
	}
	.page_background {
		background: #FFFFFF;
		margin-top:-20px;
		padding:10px;
	}
	.page_title {
		font-size: 24px;
		font-weight: 600;			
		color: orangered;
		margin-bottom:20px;
	}
	.page_content {
		line-height: 20px;
	}
	.text_description {
		font-size:16px;
	}
	.subheader{
		width: 100%;
		height: 16px;
		background: #CC9D66;
		overflow: hidden;
	}
</style>
<body>
<div class="container">
<div class="row"><div class="col-md-12 wrap-banner-img mb-0"><img src="/template/images/banners/raffle.jpg" class="img-fluid" alt=""></div></div>
<div class="row page_background mt-2">
<div class="col-12 page_title">Spring into Clean Hygiene Toiletry Drive</div>
<div class="col-12 page_content">
	<p class="text_description">
	The Winning Numbers!<br /><br />
	<!--(list of all the winning ticket numbers- so far we have 15 prizes, but I'm still waiting to get prizes from one more org)<br /><br />-->

	Please take your winning ticket to the Administration Front Desk of the Unions (SUMC RM 403) on Monday, March 22nd in between the hours of 8AM-4PM to redeem your prize! If you cannot redeem your prize on 3/22/21, please email <a href="mailto:drake1@arizona.edu">drake1@arizona.edu</a> to coordinate a day/time to pick up your gift, and again congratulations!<br /><br />

	Thanks for helping our Wildcat Community!
	</p><br />
	<p class="text_description">
</div>
<br /><br />
<br /><br /><br />
</div>
</div>
</body>
<?php page_finish(); ?>
