<?php
	//header("Location: https://union.arizona.edu/celebrationcookies/index.php");
//	die();
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
	.page_title {
		font-size: 25px;
		font-weight: bold;
		color: red;
	}
	.price {
		font-size: 20px;
		font-weight: bold;
		color: green;
	}
	.price_red {
		font-size: 20px;
		font-weight: bold;
		color: red;
	}
</style>
<script>
  function setFocusToTextBox(){
    document.getElementById('first_name').focus();
  }
</script>
<script type="text/javascript" src="./cookie_7.js"></script>
<body onload='setFocusToTextBox()'>
<div class="container">
	<div class="row">
		<div class="col-md-12 wrap-banner-img mb-0"><img src="/template/images/banners/CookieBanner.jpg" class="img-fluid" alt="">
		</div>
	</div><br />
	<div class="text_description">	
		Each mouth-watering butter cookie is gently glazed with a sweetened velvet smooth icing and hand-decorated by our cookie artists.<br /><br />
		Ordering website will launch on April 18. Cookie pick-up will begin April 20 at The Scoop located at the Student Unions Memorial Center. <br /></div>
</div><br />
<div align="center" style="margin-top:20px;margin-bottom:30px;">
	<span class="page_title">COOKIE ORDER FORM</span><br />
	<span class="text_description">Everyone could use a cookie, Student Unions delivering smiles</span>
</div><br />

<?php
// Display the form before the form is submitted.
if (!isset($_POST['submit'])) {
?>	
<div class="col-sm-12 order-form">
	<form name="form" id="form" class="form-inline" action="submit_handler_5.php" method="POST" onsubmit="return OnSubmitForm()">
	<div class="row">
		<div class="text_bold">PURCHASER INFORMATION</div>
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
		
		<div class="text_bold" style="margin-top:20px;">STUDENT INFORMATION</div>
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
				<!--<input type="date" id="pickupdate" name="pickupdate" required /><span id="date-error" style="color: red; display: none;"> Please enter a valid pickup date.</span>-->
				
				<input type="date" id="pickupdate" name="pickupdate" onchange="dateCheck(this.value);"  required /><span id="date-error" style="color: red; display: none;">Please enter a valid pickup date.</span>
				<i>* Valid pickup dates - 4/20-4/22, 4/25-4/29, 5/2-5/6, 5/9-5/13</i>
			</span>
		</div>
		
		<div class="text_bold" style="margin-top:40px;">PACKAGE SELECTION FOR CELEBRATION<span class="asterisk">*</span></div>
		<div class="col-sm-12 no-padding">
		<table width="" border="0" cellspacing="0" cellpadding="3" class="cookie_options">
		  
			<tr>
			  <td colspan="4" class="page_title_red" style="border-color:white;"><img src="./images/SpringBanner.jpg" alt="Hop Into Spring" /></td>
			</tr>
			<tr>
			  <td class="page_title_red" width="200">&nbsp;</td>
			  <td width="250" class="text_bold" align="left">ITEM</td>
			  <td width="80" class="text_bold" align="center">Quantity</td>
			  <td width="80" class="text_bold" align="center">Donation</td>
			</tr>
			<tr>
			  <td><img src="images/SpringBox.png" width="150" alt="Spring Box"/><br /><img src="images/ArizonaBox.png" width="150" alt="Arizona Box"/></td>
			  <td class="cookie_options">Spring Cookie<br /> 5-Pack<br /><span class="price">PRICE: $14.99</span></td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_1" size="1" value="0"></td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_5" size="1" value="0"></td>
			</tr>
			<tr>
			  <td colspan="4" style="border-color:white;">&nbsp;</td>
			</tr>
			<tr>
			  <td colspan="4" class="page_title_red"><img src="./images/GradBanner.jpg" alt="Congrats, Grad" /></td>
			</tr>
			<tr>
			  <td class="page_title_red" width="200">&nbsp;</td>
			  <td width="250" class="text_bold" align="left">ITEM</td>
			  <td width="80" class="text_bold" align="center">Quantity</td>
			  <td width="80" class="text_bold" align="center">Donation</td>
			</tr>
			<tr>
			  <td><img src="images/GradBox.png" width="150" alt="Grad Box"/></td>
			  <td class="cookie_options">Graduation<br /> 5-Pack<br /> <span class="price_red">PRICE: $14.99</span></td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_2" size="1" value="0"></td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_6" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/ABox.png" width="150" alt="A Box"/></td>
			  <td class="cookie_options">"A" Cookie<br /> 4-Pack<br /> <span class="price_red">PRICE: $14.99</span></td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_4" size="1" value="0"></td>
			  <td class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_8" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/BaseballBox.png" width="150" alt="Baseball or Softball"/></td>
			  <td class="cookie_options">Baseball/Softball<br /> 5-Pack<br /> <span class="price_red">PRICE: $14.99</span>
			  </td>
			  <td valign="middle" class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_9" size="1" value="0"></td>
			  <td valign="middle" class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_10" size="1" value="0"></td>
			</tr>
			<tr>
			  <td><img src="images/BasketballBox.png" width="150" alt="Football or Basketball"/></td>
			  <td class="cookie_options">Football/Basketball<br /> 5-Pack<br /> <span class="price_red">PRICE: $14.99</span>
			  </td>
			  <td valign="middle" class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_3" size="1" value="0"></td>
			  <td valign="middle" class="text_bold" align="center"><input id="quant" type="number" class="food-qty" onkeyup="changeQuant(this);" onchange="changeQuant(this);" name="cookie_7" size="1" value="0"></td>
			</tr>
			<tr>
			  <td colspan="4">&nbsp;</td>
			</tr>
			<tr style="border-color:white;">
			  <td colspan="3" class="page_title_black" align="center">TOTAL: 
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
		  
		</table>
		</div>	
	</div>
	</form>
</div><br /><br /><br />
<div class="text_description">
	If you have any questions or concerns please call or email Arizona Dining at <a href="mailto:su-arizonadining@arizona.edu">su-arizonadining@arizona.edu</a> or <br />call 520-621-1945.
</div>
</div>
<?php
	}
?>
</body>

