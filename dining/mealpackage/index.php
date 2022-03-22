<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'] .'/dining/template/dining.inc');
	include($_SERVER['DOCUMENT_ROOT'] . '/dining/mealpackage/include/main.php');

	loginCheck();
	$page_options['page'] = 'Meal Package Order Form';
    page_start($page_options);
?>
<link rel="stylesheet" type="text/css" href="/dining/mealpackage/index_2.css">
<!--Enter code to open the page. -->
<!-- <div id="code_form" class="code_form" method="POST">
	<h2 class="mb-4">Meal Package Order Form</h2>
	<div class="form-group mb-4">
		<h4>Enter the code:</h4>
		<div class="form-group">
			<input type="text" id="enter_code" name="enter_code" class="form-control" value="">
		</div>
	</div>
	<button class="btn submit" id="btn_enter_code" onclick="check_secret_code();">Enter</button>
</div> -->

<!-- Instruction for the users -->
<div id="instruction" class="instruction">
	<!-- <p>Isolation boxes can be ordered 7days a week and will be delivered <span style="color: red; text-decoration: underline;">8:30am-5pm</span>, typically within 2hrs of order confirmation.
	If the order is placed after <span style="color: red; text-decoration: underline;">4:45pm</span> and you are in urgent need of food, please utilize the Grub Hub app. The Student Union will process all orders received after <span style="color: red; text-decoration: underline;">4:45pm</span> for earliest next day delivery after confirmation.</p><br/>
    <p>If this is an urgent matter after hours or you need assistance placing the order, please email: <a href = "mailto: su-sueventplanning@email.arizona.edu">su-sueventplanning@email.arizona.edu</a> or <a href = "mailto: raymiegrimm@arizona.edu">raymiegrimm@arizona.edu</a>. 

 -->



    	<p>Isolation boxes can be ordered 7days a week and will be delivered <span style="color: red; text-decoration: underline;">at two set times daily, 10:30am-11:30am for overnight or morning orders and 4:30pm-5:30pm for all other orders placed after 8am.</span> If the order is placed after <span style="color: red; text-decoration: underline;">4:45pm</span> and you are in urgent need of food, please utilize the Grub Hub app. The Student Union will process all orders received after <span style="color: red; text-decoration: underline;">4:45pm</span> for earliest next day delivery after confirmation.</p><br/>

    	<p>If this is an urgent matter after hours or you need assistance placing the order, please email: <a href = "mailto: su-sueventplanning@email.arizona.edu">su-sueventplanning@email.arizona.edu</a> or <a href = "mailto: raymiegrimm@arizona.edu">raymiegrimm@arizona.edu</a>.</p>



    </p>
</div>

<script>
function check_secret_code(){
	var code = document.getElementById("enter_code").value;
	// console.log(code);
    fetch('/dining/mealpackage/checkcode.php',{
		method: 'POST',
		headers: {
			'Accept': 'application/json',
      		'Content-Type': 'application/json'
		},
        body: JSON.stringify({
            code: code
        }),
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(json) {
		// console.log(json);
        if (json.success){
			// console.log('true');
            document.getElementById('code_form').style.display = 'none';
			document.getElementById('meal_package_form').style.display = 'block';
			document.getElementById('secret_key').value = code;
            return false;
        }
    });
    return false;
}
</script>

<form id="meal_package_form" name="meal_package_form" method="POST" onsubmit="return OnSubmitForm()" action="/dining/mealpackage/submit_handler_3.php">

	<?php if (isset($_SESSION['mealpackage']['error']) && $_SESSION['mealpackage']['error']['status']){ ?>
	<div class="alert alert-danger" role="alert">
		<strong>Please enter the mandatory fields (*).</strong><br/>
		<?= $_SESSION['mealpackage']['error']['message'] ?>
	</div>
	<?php } ?>

	<div class="alert alert-danger alert_box" role="alert" style="display: none;">
		<strong>Please enter the mandatory fields (*).</strong><br/>
	</div>

	<h2 class="mb-4">Meal Package Order Form</h2>

	<input type="hidden" id="secret_key" name="secret_key" value="" />
	<p class="mb-4">
		<b><a href="menu/index.php" target="_blank">Click to open the list of the MENU.</a></b>
	</p>
	
	<p class="mb-4">
		<!-- <b>Enter your information below to order meal packages for dorm delivery.  Once we process your order, you will receive confirmation for a 1 Day Meal Package to be delivered (excluding Apache-Santa Cruz, Babcock, Coconino, Coronado and Kaibab-Huachuca).  <span style="color: red;">Apache-Santa Cruz, Babcock, Coconino, Coronado and Kaibab-Huachuca</span> residents can order a 3 Day Meal Package for delivery.</b> -->

		<!-- <b>At this time, meal packages are only available for delivery to UArizona residence locations listed below. We are working on expanding this service to offsite locations. Please check back or email for more information.</b> -->
		<b>At this time, meal packages are only available for delivery to the Coconino Dorm. We are working on expanding this service to offsite locations. Please check back or email for more information.</b>
	</p>

	<p class="mb-4" style="font-size: 26px; text-align: right;">
		<b>Order Total :</b> <span style="color: red;">$<span id="order_total">0</span></span>
		<input type="hidden" id="order_total_hidden" name="order_total_hidden" value="">
		<input type="hidden" id="order_total_hidden_2" name="order_total_hidden_2" value="">
	</p>
	
	<div class="form-group mb-4">
		<h4 class="required-input">Dorm for Delivery:</h4>
		<select id="dorm" name="dorm" class="form-control"  style="font-weight: bold;"> <!-- can disable but will NOT send value if disabled -->
			<?php
				//$dorms = ['Coconino', 'Apache-Santa Cruz', 'Arbol de la Vida', 'Arizona-Sonora', 'Babcock', 'Cochise', 'Colonia de la Paz', 'Coronado', 'Gila', 'Graham-Greenlee', 'Honors Village', 'Hopi', 'Kaibab-Huachuca', 'La Aldea', 'Likins', 'Manzanita-Mohave', 'Maricopa', 'Navajo-Pinal (Stadium)', 'Pima', 'Posada San Pedro', 'Pueblo de la Cienega', 'Villa del Puente', 'Yavapai', 'Yuma'];
				
				$dorms = ['Coconino'];
				foreach ($dorms as $dorm) { 
					echo '<option value="'.$dorm.'">'.$dorm.'</option>';
				}
			?> 
			<!-- <option value="Coconino">Coconino</option>--> 
			<!-- <option value="Apache-Santa Cruz">Apache-Santa Cruz</option>
			<option value="Arbol de la Vida">Arbol de la Vida</option>
			<option value="Arizona-Sonora">Arizona-Sonora</option>
			<option value="Babcock">Babcock</option> -->
		</select>
	</div>

	<div class="form-group mb-4">
		<h4 class="required-input">Select Package:</h4>
		<input type="radio" id="1day" name="days" value="1day" /> <label>1-Day Meal Package ($30)</label><br>
		<input type="radio" id="3day" name="days" value="3day" /> <label>3-Day Meal Package ($90)</label>
	</div>

	<div class="form-group mb-4">
		<h4 class="required-input">Select your meal:</h4>
		<select id="meal" name="meal" class="form-control">
			<!--<option disabled selected value> -------------------- </option>-->
			<option value="Regular meals">Regular meals</option>
			<option value="Vegetarian meals">Vegetarian meals</option>
			<option value="Gluten free meals">Made without Gluten</option>
		</select>

        <!-- <label style="">
			<input type="radio" name="meal" value="Regular meals"> Regular meals
		</label><br>
        <label style="">
			<input type="radio" name="meal" value="Vegetarian"> Vegetarian
		</label><br>
		<label style="">
			<input type="radio" name="meal" value="Gluten Free"> Gluten Free
		</label><br> -->
    </div>

	<div class="form-group mb-4">
		<h4 class="required-input">Do you have a refrigerator in your room?</h4>
		<select id="refrigerator" name="refrigerator" class="form-control">
			<!--<option disabled selected value> -------------------- </option>-->
			<option value="Yes">Yes</option>
			<option value="No">No</option>
		</select>
        <!-- <label style="">
			<input type="radio" name="refrigerator" value="Yes"> Yes
		</label>
		&nbsp;
        <label style="">
			<input type="radio" name="refrigerator" value="No"> No
		</label> -->
    </div>

	<div class="form-group mb-4">
		<h4 class="required-input">Do you have a microwave in your room?</h4>
		<select id="microwave" name="microwave" class="form-control">
			<!--<option disabled selected value> -------------------- </option>-->
			<option value="Yes">Yes</option>
			<option value="No">No</option>
		</select>
        <!-- <label style="">
			<input type="radio" name="microwave" value="Yes"> Yes
		</label>
		&nbsp;
        <label style="">
			<input type="radio" name="microwave" value="No"> No
		</label> -->
    </div>

	<div class="form-group mb-4">
		<h4>Would you like to add extra water to your order?</h4> 
		<p class="mb-4">
			$4 for 6 pack of 16.9 floz Dasani water<br />
			<label style="">
			<input type="radio" name="water" value="1" onclick="selectWater(4);"> 1 x 6 pack ($4) <br/>
			<input type="radio" name="water" value="2" onclick="selectWater(8);"> 2 x 6 pack ($8) <br/>
			<input type="radio" name="water" value="3" onclick="selectWater(12);"> 3 x 6 pack ($12) <br/>
			<input type="radio" name="water" value="4" onclick="selectWater(16);"> 4 x 6 pack ($16) <br/>
			</label>	
		</p>
		<!--
		<select id="microwave" name="microwave" class="form-control">
			<option disabled selected value> -------------------- </option>
			<option value="Yes">Yes</option>
			<option value="No">No</option>
		</select>-->
        <!-- <label style="">
			<input type="radio" name="microwave" value="Yes"> Yes
		</label>
		&nbsp;
        <label style="">
			<input type="radio" name="microwave" value="No"> No
		</label> -->
    </div>
	
	<div class="form-group mb-4">
		<h4>Please add additional information such as food allergies, dietary requests, or or any details needed for delivery:</h4>
		<textarea name="requests" class="form-control" rows="5" placeholder="Type in here"></textarea>
    </div>

	<div class="form-group mb-4">
		<h4>Your Information:</h4>
		<div class="form-group">
			<label for="inputEmail" class="required-input">Email</label>
			<input type="text" name="email" class="form-control" placeholder="email" value="<?=$_SESSION['mealpackage']['login_info']['netid']?>@email.arizona.edu">
		</div>
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label for="first_name" class="required-input">First Name</label>
					<input type="text" name="first_name" class="form-control" placeholder="first name">
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label for="last_name" class="required-input">Last Name</label>
					<input type="text" name="last_name" class="form-control" placeholder="last name">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="phone" class="required-input">Phone</label>
			<input type="text" name="phone" class="form-control" placeholder="phone">
		</div>
    </div>

	<div class="form-group mb-4">
		<h4>Delivery</h4>
		<div class="form-group">
			<label for="room_number" class="required-input">Room Number</label>
			<input type="text" name="room_number" class="form-control" placeholder="room number">
		</div>
	</div>

	<div class="form-group mb-4">
		<h4 class="required-input">Payment Method</h4>
		<select id="payment" name="payment" class="form-control">
			<option disabled selected value> -------------------- </option>
			<option value="Credit Card">Credit Card</option>
			<option value="MealPlan">MealPlan</option>
			<option value="CatCash">CatCash</option>
		</select>
		<!-- <label style="">
			<input type="radio" name="payment" value="Credit Card"> Credit Card
		</label><br/>
        <label style="">
			<input type="radio" name="payment" value="MealPlan"> MealPlan
		</label><br/>
		<label style="">
			<input type="radio" name="payment" value="CatCash"> CatCash
		</label> -->
	</div>

	<hr class="mb-4" />

	<p class="mb-4" style="font-size: 26px; text-align: right;">
		<b>Order Total :</b> <span style="color: red;">$<span id="order_total_2">0</span></span>
	</p>

	<input class="submit" type="submit" name="submit" id="submit" value="SUBMIT">

	<div class="mt-2 alert alert-danger alert_box" role="alert" style="display: none;">
		<strong>Please enter the mandatory fields (*).</strong><br/>
	</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="/dining/mealpackage/index_5.js"></script>
<?php
page_finish();
?>
