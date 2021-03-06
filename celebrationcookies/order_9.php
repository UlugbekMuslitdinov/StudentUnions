<?php
//	This is to test the form on the testing site without redirecting to the Unions site.
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
	.page_title_black {
		font-size: 24px;
		font-weight: 600;			
		color: black;
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
	<form name="form" id="form" class="form-inline" action="submit_handler_9.php" method="POST" onsubmit="return OnSubmitForm()">
	<div class="row">
		<div class="text_bold">Purchaser Information</div>
		<div class="col-sm-12 no-padding client-contact-info">
			<div class="form-group col-sm-8">
			<div class="form-group col-sm-8">
				<label class="text_bold">FIRST NAME <span class="asterisk">*</span></label>
				<input type="text" name="first_name" id="first_name" size="50" required>
			</div><br /><br /><br />
			<div class="form-group col-sm-8">
				<label class="text_bold">LAST NAME <span class="asterisk">*</span></label>
				<input type="text" name="last_name" id="last_name" size="50" required>
			</div><br /><br /><br />
			<div class="form-group col-sm-8">
				<label class="text_bold">EMAIL (for receipt) <span class="asterisk">*</span></label>
				<input type="text" name="email" id="email" size="50" required>
			</div><br /><br /><br />
			<div class="form-group col-sm-8">
				<label class="text_bold">PHONE <span class="asterisk">*</span></label>
				<input type="text" name="phone" id="phone" size="50" required>
			</div><br /><br /><br />
			<div class="form-group col-sm-12">
				<label class="text_bold">NOTE (for Custom Message from Purchaser)</label>
				<textarea name="statement" cols="120" rows="3" id="statement" maxlength="5000"></textarea>
			</div><br />
			</div>
		</div>
		
		<div class="text_bold" style="margin-top:20px;">Student Information</div>
		<div class="col-sm-12 no-padding client-contact-info">
			<div class="form-group col-sm-8">
			<div class="form-group col-sm-8">
				<label class="text_bold">STUDENT NAME <span class="asterisk">*</span></label>
				<input type="text" name="s_name" id="s_name" size="50" required>
			</div><br /><br /><br />
			<div class="form-group col-sm-8">
				<label class="text_bold">STUDENT EMAIL <span class="asterisk">*</span></label>
				<input type="text" name="s_email" id="s_email" size="50" required>
			</div><br /><br /><br />
			<div class="form-group col-sm-8">
				<label class="text_bold">STUDENT PHONE <span class="asterisk">*</span></label> (We will be contacting students for pick up location/date ONLY.)
				<input type="text" name="s_phone" id="s_phone" size="50" required>
			</div><br /><br /><br />
			</div>
		</div>
		
		<div class="text_bold" style="margin-top:20px;">Pickup Date <span class="asterisk">*</span></div>
		<div class="col-sm-12 no-padding client-contact-info">
			<span id="info-pickup">
				<!--<input type="date" id="pickupdate" name="pickupdate" required /><span id="date-error" style="color: red; display: none;">Please enter a valid pickup date.</span>--> 
				
				<input type="date" id="pickupdate" name="pickupdate" onchange="dateCheck(this.value);"  required /><span id="date-error" style="color: red; display: none;">Please enter a valid pickup date.</span>
				<i>* Valid pickup dates - 4/26-4/30, 5/3-5/7, 5/10-5/18.</i>
			</span>
		</div>
		
		<div class="text_bold" style="margin-top:20px;">Package Selection for Celebration <span class="asterisk">*</span></div>
		<div class="col-sm-12 no-padding">
		<table width="" border="0" cellspacing="0" cellpadding="3" class="cookie_options">
		  <tbody>
			<tr>
			  <td class="page_title_red" width="200">SPRING&nbsp;</td>
			  <td width="400">&nbsp;</td>
			  <td width="80" class="text_bold" align="center">Quantity</td>
			</tr>
			<tr>
			  <td><img src="images/springbouquet.jpg" width="150" /></td>
			  <td class="cookie_options">Potted Cookie Bouquet - $19.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" min="0" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/spring4-pack.jpg" width="150" /></td>
			  <td class="cookie_options">Spring Cookie 4-Pack - $9.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_2" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/spring5-pack.jpg" width="150" /></td>
			  <td class="cookie_options">Spring Cookie 5-Pack - $11.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_3" size="1" value="0"></td>
			</tr>
			<tr>
			  <td colspan="3">&nbsp;</td>
			</tr>
			<tr>
			  <td class="page_title_red" width="200">GRADUATION&nbsp;</td>
			  <td width="400">&nbsp;</td>
			  <td width="10" class="text_bold" align="center">&nbsp;</td>
			</tr>
			<tr>
			  <td><img src="images/gradboquet.jpg" width="150" /></td>
			  <td class="cookie_options">Potted Cookie Bouquet - $19.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_4" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/grad4-pack.jpg" width="150" /></td>
			  <td class="cookie_options">Graduation Cookie 4-Pack - $9.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_5" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/grad5-pack.jpg" width="150" /></td>
			  <td class="cookie_options">Graduation Cookie 5-Pack - $11.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_6" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/gradsport5-pack.jpg" width="150" /></td>
			  <td class="cookie_options">Sports Cookie 5-Pack - $11.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_7" size="1" value="0"></td>
			</tr>
			<tr>
			  <td colspan="3">&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="3" width="10" class="text_bold" align="center">Celebrate this major milestone with a unique graduation gift to say 'congrats, you did it.' Made from fresh baked and hand decorated cookies, this graduation cookie bouquet can be delivered to sweeten their special day. </td>
			</tr>
			<tr>
			  <td colspan="3">&nbsp;</td>
			</tr>
			<tr>
			  <td class="page_title_red" width="200">DONATE&nbsp;</td>
			  <td width="400">&nbsp;</td>
			  <td width="10" class="text_bold" align="center">&nbsp;</td>
			</tr>
			<tr>
			  <td class="text_bold" colspan="3" width="800">The AZ Student Union is providing Celebration Cookie packages to commemorate students and their end of the semester and graduation accomplishments! We recognize that not every student has the opportunity to receive a cookie treat. If you are interested in donating a cookie pack or bouquet to a student, please see those options below.</td>
			</tr>
			<tr>
			  <td><img src="images/springbouquet.jpg" width="150" /></td>
			  <td class="cookie_options">Spring Potted Cookie Bouquet - $19.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_8" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/spring4-pack.jpg" width="150" /></td>
			  <td class="cookie_options">Spring Cookie 4-Pack - $9.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_9" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/spring5-pack.jpg" width="150" /></td>
			  <td class="cookie_options">Spring Cookie 5-Pack - $11.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_10" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/gradboquet.jpg" width="150" /></td>
			  <td class="cookie_options">Graduation Potted Cookie Bouquet - $19.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_11" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/grad4-pack.jpg" width="150" /></td>
			  <td class="cookie_options">Graduation Cookie 4-Pack - $9.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_12" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/grad5-pack.jpg" width="150" /></td>
			  <td class="cookie_options">Graduation Cookie 5-Pack - $11.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_13" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/gradsport5-pack.jpg" width="150" /></td>
			  <td class="cookie_options">Sports Cookie 5-Pack - $11.99</td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_14" size="1" value="0"></td>
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
				<p id="xcomment" >
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

