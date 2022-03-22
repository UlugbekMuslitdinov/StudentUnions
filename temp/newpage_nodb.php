<?php
	// header("Location: ../index.php");
	// die();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Student Unions';
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
<div class="col-12 page_title">Thanksgiving Offerings To-Go and Bake Sale!</div>
<div class="col-12 page_content">
	<p class="text_description">
	This year we are proud to feature a "Create Your Own Feast" dining experience for your Thanksgiving celebration at home. Beginning November 9, 2020 the Arizona Student Unions will begin accepting reservations for the 2020 Thanksgiving Offerings To-Go. 
	</p><br />
	<p class="text_description">
</div>
<br /><br />
<div class="col-12 mt-5">
	<div style="margin-left: auto; margin-right: auto;">
		<a href="/dining/sumc/thanksgiving.php" target="_blank"><img src="/template/images/buttons/thanksgiving_feast_to_go.png" alt="Thanksgiving Offerings To Go"></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/dining/sumc/thanksgiving_sides.php" target="_blank"><img src="/template/images/buttons/thanksgiving_side.png" alt="Thanksgiving Side Offerings To Go"></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/dining/forms/bakesale.php" target="_blank"><img src="/template/images/buttons/bake_sale.png" alt="Holiday Bake Sale"></a>
	</div>
</div>
<br /><br /><br />
</div>
</div>
</body>
<?php page_finish(); ?>
