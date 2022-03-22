<style>
    .info-form {
        margin-right:5px;	
    }
</style>

<div class="col-sm-12 <?= $_SESSION['catering']['restaurant'] ?>">
    <?php if ($_SESSION['catering']['restaurant'] == 'highland_burrito'){ ?>
	<img src="/catering/online/img/17_Highland_Burrito_Webbanner.jpg">
	<?php
	}
	else
	{
		echo '<img src="/catering/online/img/'.$_SESSION['catering']['restaurant'].'_banner.jpg" style="width:100%;">';
	}
	?>
    <h1 class="page-header" style="margin-top:20px;"><?php echo $pageSetting['header']; ?></h1>
    <?php //include_once($sidebar); ?>
    <div class="col-sm-12 wrap-info">
	<?php
			$action = "/api/catering/retail/customer_info";
			if ($_SESSION['catering']['restaurant'] == 'highland' || $_SESSION['catering']['restaurant'] == 'ondeck'){
				$action = '/catering/online/post/post.php';
			}
//		include dirname(__DIR__, 1) . "\\restaurant_hours.php"; 	//
		include dirname(__DIR__, 1) . "/restaurant_hours.php";
	  	$restaurant = get_restaurant_obj($_SESSION['catering']['restaurant']);
	  	echo $restaurant;


	?>
		
<style>
	:root {
		--button-default-color: #424242;
		--button-default-color-hover: #ffffff;
		
		--button-default-background: #e4e3e3 ;
		--button-default-background-hover: #689c69 ;
		
		--button-default-border-color: #ccc;
		--button-default-border-color-hover: #689c69;
		
	}
	.flex-row {
		display: flex;
		flex-wrap: nowrap;
		justify-content: space-around;
	}
	.flex-js-button{
		justify-content: center;
		background: var(--button-default-background);
		color: var(--button-default-color);
		max-width: 40%;
    	flex: 1 1 auto;
		font-weight: 700;
		
		border-style: solid;
		border-color: #ccc;
		
	}
	.flex-js-button.clicked, .flex-js-button:hover{
		background: var(--button-default-background-hover);
		color: var(--button-default-color-hover);
		border-color: var(--button-default-border-color-hover);
		
	}
	.ui-datepicker-buttonpane.ui-widget-content {
    display: none;
	}
	select#hour {
    width: unset;
	}
</style>
        <form class="info-form" id="form_cust_info" action="<?= $action ?>" method="POST">
            <input type="hidden" name="status" value="Customer Information">

			<div class="panel panel-primary delivery_info wrap-info-box">
				<div class="panel-heading">
                    <h3 class="panel-title">Select Order Type:</h3>
                </div>
				<div class="panel-body">
					<div class="flex-row">
						<div id="delivery-button"	class="wrap-delivery-option btn flex-js-button"	onclick="display_delivery_form(this);">Delivery</div>
						<div id="pickup-button"		class="wrap-delivery-option btn flex-js-button" onclick="display_pickup_form(this);">Pickup</div>
					</div>
				</div>
			</div>
			
			<?php $restaurant->get_delivery_form();?>

			<div id="pickup-form" class="panel panel-primary delivery_info wrap-info-box" style="display: none;">
				<div class="panel-heading">
					<h3 class="panel-title">Pick Up Order Information:</h3>
				</div>
				<div class="panel-body">
					This should be relatively easy. I've been error checking the stores for delivery information, I just need to change/create some javascript functions to manipulate the pickup fields instead of the delivery fields. Everything else should be relatively quick"
				</div>
			</div>

            <input type="hidden" name="location" value="<?= $_SESSION['catering']['restaurant'] ?>">

			<!-- Delivery Information -->
<!--            <div class="panel panel-primary delivery_info wrap-info-box">
                <div class="panel-heading">
                    <h3 class="panel-title">Delivery Information</h3>
                </div>
                <div class="panel-body">
                    <div class="col-sm-12 wrap-delivery-option">

						<label for="" class="col-sm-12 remove-padding required-input" id="">Select Your Delivery Method</label>

						<label class="col-sm-2 btn btn-default delivery_label delivery-option-pickup">
				        	<input type="radio" name="delivery_option" id="deliveryOption_pickup" value="Pickup">
				        	Pick Up
				      	</label>

						<label class="col-sm-2 btn btn-default delivery_label delivery-option-delivery">
					        <input type="radio" name="delivery_option" id="deliveryOption_delivery" value="Delivery">
					        Delivery
				      	</label>
				   </div>

					<div class="form-group col-sm-12"></div>

					<div class="form-group col-sm-8">
						<label for="delivery_time" class="required-input" id="time_label">Delivery Time</label>
						<?php /*$restaurant->get_time_picker();*/ ?>
						<div>

							<select id="min" class="form-control su-timepicker">
								<?php
//									for ($i = 0; $i < 60; $i = $i + 15) { 
//										echo sprintf('<option value="%02d">%02d</option>', $i, $i);
//									}
								?>
							</select>

							<!-- Mnemonic -->

<!--
							<select id="mnemonic" class="form-control su-timepicker">
								<option value="AM">AM</option>
								<option value="PM">PM</option>
							</select>

						</div>
						<div>
							Available to order : 
-->
								<?php
//									switch ($_SESSION['catering']['restaurant']) {
//										case 'highland':
//											echo 'Mon - Fri. 7:30 am - 2:00 pm';
//											break;
//										case 'ondeck':
//											echo 'Mon - Fri. 8:00 am - 3:00 pm';
//											break;
//										case 'catalyst':
//											echo 'Mon - Thu. 8:00 am - 4:00 pm, ';
//											echo 'Fri. 8:00 am - 2:00 pm';
//											break;
//										case 'slotcanyon':
//											echo 'Mon - Thu. 8:00 am - 4:00 pm, ';
//											echo 'Fri. 8:00 am - 2:00 pm';
//											break;
//										default:
//											echo '';
//									}
								?>
<!--

						</div>

						<br />
						<input type="hidden" class="form-control timepicker" id="delivery_time" name="delivery_time" value=""  autocomplete="off">
					</div>

					<div class="col-sm-12"></div>

					<div class="form-group col-sm-3 wrap_delivery_info">
						<label for="delivery_building" class="required-input">Delivery Building</label>
						<input type="text" class="form-control" id="delivery_building" name="delivery_building" value="" autocomplete="off" spellcheck="false">
					</div>

					<div class="form-group col-sm-4 wrap_delivery_info">
						<label for="delivery_room" class="required-input">Delivery Room Number</label>
						<input type="text" class="form-control" id="delivery_room" name="delivery_room" value="" autocomplete="off" spellcheck="false">
					</div>

					 <div class="form-group col-sm-12"></div> 

					<div class="form-group col-sm-9" id="special_note">
						<label for="delivery_notes">Delivery Notes</label> &nbsp;&nbsp; (Please DO NOT include credit card numbers in this form.)
						<textarea class="form-control" id="delivery_notes" name="delivery_notes" col="400" rows="6"  ></textarea>
					</div>

					<div class="col-sm-12"></div>

					<div class="form-group col-sm-3 wrap_delivery_info">
						<label for="onsite_name" class="required-input">On-Site Contact</label>
						<input type="text" class="form-control" id="onsite_name" name="onsite_name" value="" autocomplete="off" spellcheck="false">
					</div>

					<div class="form-group col-sm-4 wrap_delivery_info">
						<label for="onsite_email" class="required-input">On-Site Email</label>
						<input type="text" class="form-control" id="onsite_email" name="onsite_email" value="" autocomplete="off">
					</div>

					<div class="form-group col-sm-5 wrap_delivery_info">
						<label for="onsite_phone" class="required-input">On-Site Contact Phone Number</label>
						<input type="text" class="form-control" id="onsite_phone" name="onsite_phone" value="" autocomplete="off" placeholder="(xxx)xxx-xxxx">
					</div>
				</div>
			</div>
-->

			<!-- Customer Information -->
			<div class="panel panel-primary customer_info wrap-info-box">
				<div class="panel-heading">
					<h3 class="panel-title">
						Customer Information
						<label class="sameasOnsite">
							<input type="checkbox" id="sameAsOnsite"> same as on-site contact
						</label>
					</h3>
				</div>
				<div class="panel-body">
					<div class="form-group col-sm-4">
						<label for="customer_name" class="required-input">Name</label>
						<input type="text" class="form-control" id="customer_name" name="customer_name" value="" autocomplete="off" spellcheck="false">
					</div>

					<div class="col-sm-12"></div>

					<div class="form-group col-sm-6">
						<label for="customer_email" class="required-input">Email</label>
						<input type="text" class="form-control" id="customer_email" name="customer_email" value="" autocomplete="off" spellcheck="false">
					</div>

					<div class="col-sm-12"></div>

					<div class="form-group col-sm-4">
						<label for="customer_phone" class="required-input">Phone</label>
						<input type="text" class="form-control" id="customer_phone" name="customer_phone" value="" autocomplete="off" placeholder="(xxx)xxx-xxxx">
					</div>
				</div>
			</div>

			<!-- Payment Information -->
			<div class="panel panel-primary payment_info wrap-info-box">
				<div class="panel-heading">
					<h3 class="panel-title"><span class="required-input">Payment Information</span></h3>
				</div>
				<div class="col-sm-12">
		      		<p class="text-danger input-err text-align-center" id="payment_opt_err"></p>
		      	</div>
				<div class="panel-body">
					<div class="input-group col-sm-12">
						<label class="col-sm-3 uaidb-radio remove-padding" id="">
							<input type="radio" name="payment_method" id="idb_acc" value="IDB">
				         	UA IDB Account Number 
				      	</label>
				      	<div class="col-sm-6" id="uaidb_input">
				      		<input type="text" class="form-control col-sm-6" id="idb_acc_num" name="account_num" maxlength="7" autocomplete="off">
				      	</div>
				      	<div class="col-sm-12" id="uaidb_code_wrap">
				      		<label for="uaidb_code" class="uaidb_code_label">
				      			Sub account/object code/project code
				      			<input type="text" class="form-control col-sm-6" id="uaidb_code" name="sub_code" autocomplete="off">
				      		</label>				      	
				      	</div>
				      <!-- <input type="text" class="form-control" aria-label="..."> -->
					</div>

					<div class="input-group col-sm-12">
						<label>
					        <input type="radio" name="payment_method" value="Credit Card">
					        Credit Card : <span class="font-weight-500">Must be paid over the phone or in person prior to delivery. Please DO NOT include credit card numbers in this form.</span>
				    	</label>
					</div>

					<div class="input-group col-sm-12">
						<label>
					        <input type="radio" name="payment_method" value="Cash, Meal Plan or UA Student Dining Card">
					        Cash, Meal Plan or UA Student Union Dining Card: <span class="font-weight-500">Must be paid in person prior to delivery</span>
				      	</label>
					</div>

				</div>
			</div>
			<div class="col-sm-12 wrap-submit-btn">
				<button type="submit" class="btn btn-lg catering submit-btn">NEXT</button>
				<a href="cancel_order.php" class="cancel-order-btn">Cancel My Order</a>
			</div>
		</form>
	</div>
</div>
<?php $restaurant->get_javascript();?>