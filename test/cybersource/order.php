<?php
	// header("Location: ../index.php");
	// die();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = "Order Celebration Cookies";
	page_start($page_options);	
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
	.page_title_red {
		font-size: 24px;
		font-weight: 600;			
		color: red;
		margin-bottom:20px;
	}
	.page_content {
		line-height: 20px;
	}
	.text_description {
		margin-top: -10px;
		margin-bottom: 10px;
		font-size:22px;
	}
	.text_bold {
		font-size: 20px;
		font-weight: bold;
	}
	.subheader{
		width: 100%;
		height: 16px;
		background: #CC9D66;
		overflow: hidden;
	}
	.asterisk {
		margin-left: 5px;
		font-size: 20px;
		font-weight: bold;
		color: red;
	}
	.cookie_options {
		font-size: 20px;
	}
	.submit_button {
		font-size: 20px;
		font-weight: bold;
		background-color: blanchedalmond;
	}
	.submit_success {
		font-size: 20px;
		font-weight: bold;
		color: red;
	}
		.food-qty{
		width: 45px;
	}
</style>
<script>
  function setFocusToTextBox(){
    document.getElementById('first_name').focus();
  }
</script>
<script type="text/javascript" src="./cookie.js"></script>
<body onload='setFocusToTextBox()'>
<div class="container">
<div class="row">
	<div class="col-md-12 wrap-banner-img mb-0"><img src="/template/images/banners/CelebrationCookieBanner.jpg" class="img-fluid" alt="">
	</div>
</div><br />
	
<h1>Cookie Order Form</h1>
<div class="text_description">	
	Celebrate with a delicious Cookie Bouquet or Box. Each mouth-watering butter cookie is gently glazed with a sweetened velvet smooth icing and hand-decorated by our cookie artists.<br /><br />

	<div align="center" class="page_title_red">EVERYONE COULD USE A COOKIE<br />
	STUDENT UNION DELIVERING SMILES<br /></div>
</div><br />

<?php
// Display the form before the form is submitted.
if (!isset($_POST['submit'])) {
?>	
<div class="col-sm-12 order-form">
	<form name="form" id="form" class="form-inline" action="submit_handler.php" method="POST" onsubmit="return OnSubmitForm()">
	<div class="row">
		<div class="text_bold">Purchaser Information</div>
		<div class="col-sm-12 no-padding client-contact-info">
			<div class="form-group col-sm-8">
			<div class="form-group col-sm-8">
				<label class="text_bold">FIRST NAME <span class="asterisk">*</span></label>
				<input type="text" name="first_name" id="first_name" size="50" required>
			</div><br /><br /><br />
			
			<div class="form-group col-sm-8">
				<label class="text_bold">EMAIL (for receipt) <span class="asterisk">*</span></label>
				<input type="text" name="email" id="email" size="50" required>
			</div><br /><br /><br />
			
			<div class="form-group col-sm-12">
				<label class="text_bold">NOTE (for Custom Message from Purchaser)</label>
				<textarea name="statement" cols="120" rows="3" id="statement" maxlength="5000"></textarea>
			</div><br />
			</div>
		</div>
		
		<div class="form-group col-sm-8">
				<p id="xcomment" >
				<div class="form-group col-sm-12">
				<input type="submit" name="submit" class="submit_button" value="SUBMIT">
				</div><br />
				</p>
			  </div>
		
	
	</div>
	</form>
</div><br /><br /><br />
<div class="text_description">
	If you have any questions or concerns please call or email the Arizona Catering Company at <a href="mailto:su-sueventplanning@email.arizona.edu">su-sueventplanning@email.arizona.edu</a> or call 520-621-1414.
</div>
</div>
<?php
	}
?>
</body>

