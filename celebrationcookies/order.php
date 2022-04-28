<?php
//header("Location: https://union.arizona.edu/celebrationcookies/index.php");
//	die();
require_once($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
$page_options['title'] = "Order Celebration Cookies";
page_start($page_options);
?>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style type="text/css">
	body.togo_order {
		background: #F4E7D7 !important;
	}

	.page_background {
		background: #FFFFFF;
		margin-top: -20px;
		padding: 10px;
	}

	.page_title {
		font-size: 24px;
		font-weight: 600;
		color: orangered;
		margin-bottom: 20px;
	}

	.page_title_black {
		font-size: 24px;
		font-weight: 600;
		color: black;
		margin-bottom: 20px;
	}

	.page_title_red {
		font-size: 24px;
		font-weight: 600;
		color: red;
		margin-bottom: 20px;
	}

	.page_content {
		line-height: 20px;
	}

	.text_header {
		margin: auto;
		width: 100%;
		margin-bottom: 30px;
		text-align: center;
	}

	.text_description {
		margin-top: -10px;
		margin-bottom: 10px;
		font-size: 22px;
	}

	.text_bold {
		font-size: 20px;
		font-weight: bold;
		padding: 10px 5px 10px 15px;
	}

	.text {
		font-size: 20px;
		font-weight: 400;
		padding: 10px 5px 10px 15px;
	}

	.text_total {
		font-size: 30px;
		font-weight: bold;
		color: orangered;
	}

	.text_total_2 {
		font-size: 45px;
		font-weight: bold;
		color: red;
	}

	.subheader {
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

	.food-qty {
		width: 45px;
	}

	.form {
		margin: auto;
		width: 100%;
		text-align: center;
	}

	.form-group-1 {
		margin-left: 10px;
		display: inline;
	}

	.block-group,
	.block-group>.block_group_span {
		display: block !important;
	}

	#hrCustom {
		height: 2.5px;
		width: 50%;
		margin: 30px auto;
		border-width: 0;
		color: black;
		/* Arizona blue #0C234B */
		background-color: black;
	}

	.pickupDates {
		background-color: yellow;
	}
</style>
<script>
	function setFocusToTextBox() {
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
		<div class="text_description">
			Each mouth-watering butter cookie is gently glazed with a sweetened velvet smooth icing and hand-decorated by our cookie artists.<br />
			Ordering website will launch on April 18. Cookie pick-up will begin April 18 at The Scoop located at the Student Unions Memorial Center. <br /></div>
	</div><br />
	<div align="center" style="margin-top:20px;margin-bottom:30px;">
		<span class="page_title">COOKIE ORDER FORM</span><br />
		<span class="text_description">Everyone could use a cookie, Student Unions delivering smiles</span>
	</div><br />

	<?php
	// Display the form before the form is submitted.
	if (!isset($_POST['submit'])) {
	?>
		<div class="container order-form">
			<form name="form" id="form" class="form" action="submit_handler.php" method="POST" onsubmit="return OnSubmitForm()">
				<div class="row">
					<div class="text_bold text_header">
						<h3>Purchaser Information</h3>
					</div>
				</div>
				<div class="row">
					<div class="form-group col">
						<label class="text block_group">FIRST NAME <span class="asterisk">*</span></label>
						<input class="block_group" type="text" name="first_name" id="first_name" size="40" required>
					</div>
					<div class="form-group col">
						<label class="text">LAST NAME <span class="asterisk">*</span></label>
						<input type="text" name="last_name" id="last_name" size="40" required>
					</div>
				</div>
				<div class="row">
					<div class="form-group col">
						<label class="text">EMAIL (for receipt) <span class="asterisk">*</span></label>
						<input type="text" name="email" id="email" size="40" required>
					</div>
					<div class="form-group col">
						<label class="text">PHONE <span class="asterisk">*</span></label>
						<input type="text" name="phone" id="phone" size="40" required>
					</div>
				</div>
				<div class="row mb-3">
					<div class="form-group col-xs-8" style="text-align:left;">
						<label class="text">NOTE (for Custom Message from Purchaser)</label>
						<textarea class="form-control" name="statement" rows="3" id="statement"></textarea>
					</div><br />
				</div>

				<hr id="hrCustom">

				<div class="row">
					<div class="text_bold text_header">
						<h3>Student Information</h3>
					</div>
				</div>
				<div class="row">
					<div class="form-group col">
						<label class="text">STUDENT NAME <span class="asterisk">*</span></label>
						<input type="text" name="s_name" id="s_name" size="40" required>
					</div>
					<div class="form-group col">
						<label class="text">STUDENT EMAIL <span class="asterisk">*</span></label>
						<input type="text" name="s_email" id="s_email" size="40" required>
					</div>
				</div>
				<div class="row">
					<div class="form-group col">
						<label class="text">STUDENT PHONE <span class="asterisk">*</span></label> (We will be contacting students for pick up location/date ONLY.)
						<br />&emsp;
						<input type="text" name="s_phone" id="s_phone" size="40" required>
					</div><br />
				</div>

				<hr id="hrCustom">

				<div class="row">
					<div class="text_bold text_header">
						<h3>Pickup Date <span class="asterisk">*</span></h3>
					</div>
				</div>
				<div class="row">
					<div class="form-group col">
						<span id="info-pickup">
							<i class="pickupDates">* Valid pickup dates - 4/20-4/22, 4/25-4/29, 5/2-5/6, 5/9-5/13</i>
							<br />
							<input type="date" id="pickupdate" name="pickupdate" onchange="dateCheck(this.value);" required /><span id="date-error" style="color: red; display: none;">Please enter a valid pickup date.</span>
						</span>
					</div>
				</div>

				<hr id="hrCustom">

				<div class="row">
					<div class="text_bold text_header">
						<h3>PACKAGE SELECTION FOR CELEBRATION<span class="asterisk">*</span></h3>
					</div>
				</div>
				<dvi class="row">
					<div class="text">
						Celebrate this major milestone with a unique graduation gift to say 'congrats, you did it.' Made from fresh baked and hand decorated cookies, this graduation cookie bouquet can be delivered to sweeten their special day.
						<br/><br/>
						The AZ Student Union is providing Celebration Cookie packages to commemorate students and their end of the semester and graduation accomplishments! We recognize that not every student has the opportunity to receive a cookie treat. If you are interested in donating a cookie pack or bouquet to a student, mark it under the DONATE section.
					</div>
				</dvi>
				<div class="row">
					<div class="col no-padding table-responsive">
						<table width="100%" border="0" cellspacing="0" cellpadding="3" class="cookie_options table table-borderless">
							<tbody>
								<tr>
									<td class="page_title_red" width="200">SPRING&nbsp;</td>
									<td  class="text_bold" align="center">ITEM</td>
									<td  class="text_bold" align="center">Quantity</td>
									<td  class="text_bold" align="center">Donation</td>
								</tr>
								<tr>
									<td><img src="images/spring5-pack.jpg" width="100%" /></td>
									<td class="cookie_options">Spring Cookie 5-Pack - $14.99</td>
									<td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_1" size="1" value="0"></td>
									<td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_5" size="1" value="0"></td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
								</tr>
								<tr>
									<td class="page_title_red" width="200">GRADUATION&nbsp;</td>
									<td >&nbsp;</td>
									<td class="text_bold" align="center">&nbsp;</td>
								</tr>
								<tr>
									<td><img src="images/grad5-pack.jpg" width="100%" /></td>
									<td class="cookie_options">Graduation Cookie 5-Pack - $14.99</td>
									<td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_2" size="1" value="0"></td>
									<td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_6" size="1" value="0"></td>
								</tr>
								<tr>
									<td><img src="images/gradsport5-pack.jpg" width="100%" /></td>
									<td class="cookie_options"><span >Sports Cookie 5-Pack - $14.99</span>
										<span > <br/>
											<input type="radio" name="theme" value="Football" checked> Football themed <br />
											<input type="radio" name="theme" value="Basketball"> Basketball themed</span>
									</td>
									<td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_3" size="1" value="0"></td>
									<td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_7" size="1" value="0"></td>
								</tr>
								<tr>
									<td><img src="images/grad4-pack.jpg" width="100%" /></td>
									<td class="cookie_options">"A" Cookie 4-Pack - $14.99</td>
									<td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_4" size="1" value="0"></td>
									<td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_8" size="1" value="0"></td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
								</tr>

								<tr>
									<td colspan="3">&nbsp;</td>
								</tr>

								<tr>
									<td colspan="2" class="page_title_black" align="center">TOTAL:
										<span class="text_total">$<span id="total_price">0</span></span> +
										$<span id="total_tax">0</span> (tax) =
										<span class="text_total">$<span id="tax_total">0</span></span>
										<input type="hidden" id="total_price_2" name="total_price_2" value="">
										<input type="hidden" id="total_tax" name="total_tax" value="">
										<input type="hidden" id="total_price_3" name="total_price_3" value="">
									</td>
									<td class="text_bold" align="center">
										<div class="form-group col-sm-8">
											<p id="xcomment">
											<div class="form-group col-sm-12">
												<input type="submit" name="submit" class="submit_button" value="SUBMIT">
											</div><br />
											</p>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
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