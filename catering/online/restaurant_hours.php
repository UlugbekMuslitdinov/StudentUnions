<?php

class restaurant {
	private $name;
	private $slug;
	private $store_hours = array(
		"Sunday"	=>	array(),
		"Monday"	=>	array(),
		"Tuesday"	=>	array(),
		"Wednesday"	=>	array(),
		"Thursday"	=>	array(),
		"Friday"	=>	array(),
		"Saturday"	=>	array(),
	);
	private $delivery_hours;
	private $pickup_hours;
	private $delivery_fee_hours;
	
	private $days_open;
	
	private $notice_required = 0;
	private $address;
	private $building;
	private $delivery_fee;
	
	private $earliest_date_time;
	private $todays_date;
	
	function __construct($name, $slug) {
		$this->name = $name;
		$this->slug = $slug;
		$this->delivery_hours = $this->store_hours;
		$this->pickup_hours = $this->store_hours;
		$this->delivery_fee_hours = $this->store_hours;
		$this->earliest_date_time = new DateTime();
		$this->todays_date = new DateTime();

    }
	
	function set_building($building_name){
		$this->building = $building_name;
	}
	
	function set_address($address_str){
		$this->address = $address_str;
	}
	
	/*
	$open		->	Open Hours in 24 hour time format
	$close		->	Closing hour in 24 hour time format
	$openDays	->	A string containing the days of the week this restaurant is open 
	*/
	function delivery_hours ($open, $close, $openDays){
		$weekdays = $this->get_days_of_week($openDays);
		foreach($weekdays as $i){
			array_push($this->delivery_hours[$i], array($open, $close)); 
		}
	}
	
	function pickup_hours ($open, $close, $openDays){
		$weekdays = $this->get_days_of_week($openDays);
		foreach($weekdays as $i){
			array_push($this->pickup_hours[$i], array($open, $close));
		}
	}
	
	public function delivery_fee_hours($start, $stop, $openDays){
		$weekdays = $this->get_days_of_week($openDays);
		foreach($weekdays as $i){
			array_push($this->delivery_fee_hours[$i], array($start, $stop));
		}
	}
	
	private function get_days_of_week($openDays){
		$days_of_week = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
		$return_arr = array();
		for ($i = 0; $i < strlen($openDays); $i++){
			$index = intval($openDays[$i]);
			if (($index >=0) && ($index <= 6) && !in_array ($days_of_week[$index], $return_arr)){
				array_push($return_arr, $days_of_week[$index]);
			};
		};
		return $return_arr;
	}
	
	public function add_notice_required($hours){
		$this->notice_required = $hours;
	}
	
	private function dump_hours($var, $hour_set){
		$ret_val = "";
		$ret_val .= "<b>" . ucwords($this->name) . " $var</b><br>";
		foreach ($hour_set as $day => $hours){
			$ret_val .= "&nbsp;&nbsp;&nbsp;&nbsp;" . $day. ":  ";
			if (!empty($hours)){
				foreach ($hours as $val_arr){
					$ret_val .= "[$val_arr[0] - $val_arr[1]] ";
				};
			};
			$ret_val .= "<br>";
		}
		$ret_val .= "<br>";
		return $ret_val;
	}
	
	public function dump_pickup_hours(){
		return $this->dump_hours("Pickup Hours:", $this->pickup_hours);
	}
	public function dump_delivery_hours(){
		return $this->dump_hours("Delivery Hours:", $this->delivery_hours);
	}	
	public function dump_delivery_fee_hours(){
		return $this->dump_hours("Delivery Fee Hours:", $this->delivery_fee_hours);
	}
	
	public function set_delivery_fee($fee){
		$this->delivery_fee = $fee;
	}
	public function __toString(){
		$ret_val = "";
		$ret_val .= "<strong>Notice Required: </strong>$this->notice_required \n<br>";
		$ret_val .= "<strong>Earliest Order Date: </strong>" . $this->earliest_date_time->format("l, F d Y h:i A") . "\n<br>";
		$ret_val .= $this->dump_pickup_hours();
		$ret_val .= $this->dump_delivery_hours();
		$ret_val .= $this->dump_delivery_fee_hours();
		return $ret_val;
	}
	public function get_time_picker(){
		$ret_val = "<div>\n";
		 ?>
		<select id="hour" class="form-control su-timepicker">
		<?php
			for ($i=1; $i <= 12; $i++) { 
				echo sprintf('<option value="%02d">%02d</option>', $i, $i);
			}
		?>
		</select>
		<?php 
		}
	
	public function get_pickup_hours(){
		return $this->get_hours_array($this->pickup_hours);
	}
	
	private function earliest_earliest_date_time(){
		$i=0;
		$notice = new DateTime();
//		echo "<br>{$i}) <strong>Start: {$notice->format("Y-m-d @ H:i")}</strong><br>"; $i++;
		$notice->add(new DateInterval("PT{$this->notice_required}H"));	//Adds minimum delivery time
		$can_be_today = $this->check_if_before_cutoff_this_day($notice);
		if (!$can_be_today){
			$notice = $this->get_next_day_open($notice);
			$notice = $this->set_opening_hours($notice);
		}
		$sec = $notice->format("s");
		
		$notice->modify("-". $sec . " second");
		
		
		$min = $notice->format("i");
		
		
		$min_rounded = ceil($min/15) * 15;
		
		$dif = $min_rounded - $min;
		$notice->add(new DateInterval("PT".$dif."M"));
//		echo "<br>{$i}) <strong>Start: {$notice->format("Y-m-d @ h:i")}</strong><br>"; $i++;
		$this->earliest_date_time = $notice;
		return $notice;
	}
	private function check_if_before_cutoff_this_day($date){
		$h = $date->format("H");
		$weekday = $date->format("l");
		$hours_arr = $this->pickup_hours;

		foreach($hours_arr[$weekday] as $hr_set){
			if ($h >= $hr_set[0] && $h < $hr_set[1]){
				return true;
			}
		}
		return false;
	}
	
	private function get_next_day_open($start_date){
		for ($i = 0; $i < 7; $i++){
			$start_date->add(new DateInterval("P1D"));
			$next_day_open = $this->is_open_today($start_date);
			if ($next_day_open){
				return $start_date;
			}
			$start_date->add(new DateInterval("P1D"));
		}
	}
		
	private function set_opening_hours($date_time){
		$day_of_week = $date_time->format("l");
		
		$hours_arr = $this->pickup_hours;
		$calc_hr = $date_time->format("H");
		$all_hours = array();
		foreach($hours_arr[$day_of_week] as $hr_set){
			$all_hours = array_merge($all_hours, $hr_set);
		}
		sort($all_hours);
		
		if ($all_hours[0] < $date_time->format("H")){
			$date_time->modify("+1 day");	
		}
		
		
		$date_time->setTime($all_hours[0], 0);
		return $date_time;
	}
	
	private function find_next_hour_open($date_time){
		echo "<strong>FIND Tomorrow Open</strong>";
		echo $date_time->format("Y-m-d") . "=="  . $this->todays_date->format("Y-m-d");
		echo "<BR><pre>{$date_time->format("Y-m-d H:i")}</pre>";
		return $date_time;
	}
	
	private function is_open_today($date_time){
		$weekday = $date_time->format("l");
		$hours_arr = $this->pickup_hours;
		
		foreach($hours_arr[$weekday] as $hr_set){
			return true;
			echo "Open $weekday: $hr_set[0] - $hr_set[1]<br>";
		}
		return false;
	}
	

	public function get_delivery_hours(){
		$delivery_hrs = $this->get_hours_array($this->delivery_hours);
		$earliest = $this->earliest_earliest_date_time();				//Must be called after get hours to pre-select min hour
		
//		echo "<br>) <strong>Start: {$earliest->format("Y-m-d @ h:i")}</strong><br>";
		
		foreach ($delivery_hrs as $meridiem => $weekdays){
			foreach($weekdays as $day => $hours){
//				echo "<br>) <strong>Start: {$earliest->format("W A, Y-m-d @ h:i")}</strong><br>";
//				echo "(({$earliest->format("l")} == {$day}) && ({$earliest->format("A")} == {$meridiem}))<br>";
				if (($earliest->format("l") == $day) && ($earliest->format("A") == $meridiem)){
					$style = "id=\"hour\"";
				} else {
					$style = "id=\"\" style=\"display: none;\"";
				}
				
				
				echo "\n\t\t\t<select $style daymeridiem=\"$day$meridiem\" onchange=\"check_selected_is_after_minimum_date();\" active=\"false\" day=\"$day\" meridiem=\"$meridiem\"class=\"form-control su-timepicker\" >";
				foreach ($hours as $hr){
					echo "\n\t\t\t\t$hr";
				}
				echo "\n\t\t\t</select>";
			}
//			echo "<br>";
		}
		
		
		
		//		var_dump($delivery_hrs);
//		echo '<select id="hour" class="form-control su-timepicker">';
//		foreach ($delivery_hrs as $i){
//			echo "$i";
//		}
//		echo '</select>';
	}
	
	
	public function get_standard_delivery_hours_array(){
		return $this->get_hours_array($this->delivery_hours);
	}

	public function get_delivery_fee_hours(){
		return $this->get_hours_array($this->delivery_fee_hours);
	}
	
	private function get_hours_array($hour_blocks_open_array){
		$min_date = $this->earliest_date_time;
		$weekday_hours = array();
		$am_pm_hours = array(
			"AM" => array(),
			"PM" => array(),
			);
		foreach ($hour_blocks_open_array as $day => $hours_arrs){
			$AM = array( );
			$PM = array( );
			$h24 = 0;	//Need access to after foreach
			$h12 = 0;	//Need access to after foreach
			$meridiem = "AM";
			foreach ($hours_arrs as $hours){		
				for ($h24 = $hours[0]; $h24 < $hours[1]; $h24++){
					$selected = "";
					$h12 = $h24;
					if ($h12 >= 12){
						$meridiem = "PM";
					}
					if ($h12 > 12){
						$h12 = $h12 - 12;
					}
					if ($h12 == 0){
						$h12 = 12;
					}
					if (($min_date->format("lHA") == "{$day}{$h24}{$meridiem}")){
						$selected = "selected";
					}
					$str = sprintf('<option value="%02d" %s>%02d</option>', $h24, $selected, $h12);			
					
					if ($h24 < 12){
						array_push($AM, $str);
					} else {
						array_push($PM, $str);
					}
				}
				$am_pm_hours["AM"][$day] = $AM;
				$am_pm_hours["PM"][$day] = $PM;
				$all = array_merge($AM, $PM);
				$weekday_hours[$day] = $all;
			}
		}
		return $am_pm_hours;
	}
	
	public function make_minutes(){
		?><select id="min" class="form-control su-timepicker" onchange="check_selected_is_after_minimum_date();">
			<?php 
		echo sprintf('<option value="%02d" selected>%02d</option>', 0, 0);		
		for ($i = 15; $i < 60; $i += 15) { 
				echo sprintf('<option value="%02d">%02d</option>', $i, $i);
			}	?>
		</select>
	<?php
	}
	
	public function print_meridiem_selector(){
		$min_date_meridiem = $this->earliest_date_time->format("A");
		echo "\n\t\t\t<select id=\"mnemonic\" class=\"form-control su-timepicker\" onchange=\"am_or_pm(); check_selected_is_after_minimum_date()\">\n";

		if ($min_date_meridiem == "AM"){ 
			echo "\t\t\t\t<option value=\"AM\" selected>AM</option>\n\t\t\t\t<option value=\"PM\" >PM</option>";  
		} else { 
			echo "\t\t\t\t<option value=\"AM\">AM</option>\n\t\t\t\t<option value=\"PM\" selected>PM</option>";
		   }
		echo "\n\t\t\t</select>\n";
	}
	
	public function get_days_of_week_open_for_js(){
		$weekdays = array(
		
		"Sunday" => 0,
		"Monday" => 1, 
		"Tuesday" => 2, 
		"Wednesday" => 3,
		"Thursday" => 4, 
		"Friday" => 5, 
		"Saturday" => 6,
			);
		$store_hours = $this->delivery_hours;
		$days = array();
		foreach ($store_hours as $day => $sets_of_hours){
			if (count($sets_of_hours) > 0){
				array_push($days, $weekdays[$day]);
			}
		}
		sort($days);
		$str = implode(", ", $days);
		return "[$str]";
	}
	
	public function get_earliest_delivery_date_for_js(){
		
		$date = $this->earliest_date_time;
		$timestamp = $date->format('Y-m-d') . "T";
		$timestamp .= $date->format('H:i:s');
		return $timestamp;
	}
	
	public function get_delivery_form(){
		?>

		<div id="delivery-form" class="panel panel-primary delivery_info wrap-info-box" style="display: none;"Default>
			<div class="panel-heading">
				<h3 class="panel-title">Delivery Order Information:</h3>
			</div>


		<div class="panel-body">
	
			<div class="form-group col-sm-2">
				<label for="delivery_date" class="required-input" id="date_label">Delivery Date</label>
				<input type="text" class="form-control datepicker" id="delivery_date" name="delivery_date" autocomplete="off">
			</div>

			<div class="form-group col-sm-8">
				<label for="delivery_time" class="required-input" id="time_label">Delivery Time:</label>
				<div>
					<?= $this->get_delivery_hours(); ?>
					<?= $this->make_minutes(); ?>
					<?= $this->print_meridiem_selector(); ?>
				</div>
				<div>
					<?php 
						echo "The earliest we can schedule a delivery order is for: <br><b>" . $this->earliest_date_time->format("l, F d, Y @ h:i A") . "<b>";
						?>
				</div>
				<br>
				<input type="hidden" class="form-control timepicker" id="delivery_time" name="delivery_time" value="" autocomplete="off">
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

			<!-- <div class="form-group col-sm-12"></div> -->

			<div class="form-group col-sm-9" id="special_note">
				<label for="delivery_notes">Delivery Notes</label> &nbsp;&nbsp; (Please DO NOT include credit card numbers in this form.)
				<textarea class="form-control" id="delivery_notes" name="delivery_notes" col="400" rows="6"></textarea>
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
		
	
<?php
	}
	public function get_javascript(){
?>
<script type="text/javascript">
			function get_delivery_fee_hours(){
				$var = $restaurant.get_delpickup-formivery_fee_hours();
				alert($var);
				return $var;
			}
	
			function test_the_javascript(){
				alert("IT works");
			}
	
			function display_delivery_form($this){
					document.getElementById("delivery-form").style.removeProperty("display");
					document.getElementById("pickup-form").style.display = "none";
					document.getElementById("delivery-button").classList.add("clicked");
					document.getElementById("pickup-button").classList.remove("clicked");
			}
	
			function display_pickup_form($this){
					document.getElementById("pickup-form").style.removeProperty("display");
					document.getElementById("delivery-form").style.display = "none";
					document.getElementById("pickup-button").classList.add("clicked");
					document.getElementById("delivery-button").classList.remove("clicked");
			}
			function check_restaurant_hours($date_picker){
					;
			}
			function  get_days_of_week_open(){
				return <?php echo $this->get_days_of_week_open_for_js(); ?>;
			}
			function get_earliest_date(){
				return new Date("<?php echo $this->get_earliest_delivery_date_for_js();?>");
			}
	
			function am_or_pm(){
				
				
				var $this = document.getElementById("mnemonic");
				var $val = $this.options[$this.selectedIndex].value;
				var $selected = $this.options[$this.selectedIndex].value;

				var $day = document.getElementById("hour").getAttribute("day");
				var $am_menu  = $("select[day='"+$day+"'][meridiem='AM']");
				var $pm_menu = $("select[day='"+$day+"'][meridiem='PM']");

				var $show_this;
				var $hide_this;

				if ($val == "AM"){
					$show_this = $am_menu;
					$hide_this = $pm_menu;
				} else{
					$show_this = $pm_menu;
					$hide_this = $am_menu;
				}

				$show_this.css('display','');
				$show_this.attr('id', 'hour');

				$hide_this.attr('id', '');
				$hide_this.css("display", "none");
			}
	
			function check_selected_is_after_minimum_date(){
				
				var $earliest = get_earliest_date();
				
				var $date = $("#delivery_date").datepicker("getDate");
				if ($date == null){
					$("#delivery_date").datepicker("setDate", $earliest);
					$date = Date();
				}

				var $hour_sel = document.getElementById("hour");
				var $min_sel = document.getElementById("min");
				var $mnemonic_sel = document.getElementById("mnemonic");
				
				var $hour = $hour_sel.options[$hour_sel.selectedIndex];
				if ($hour == null){
					$hour_sel.selectedIndex = 0;
				var $hour = $hour_sel.options[$hour_sel.selectedIndex];
				}
				$hour = $hour.value;
				
				var $min = $min_sel.options[$min_sel.selectedIndex];
				if($min == null){
					$min_sel.selectedIndex=0;
					var $min = $min_sel.options[$min_sel.selectedIndex];
				}
				$min = $min.value;
				
//				var $hour = $hour_sel.options[$hour_sel.selectedIndex].value
				console.log("Hour " + $hour);
				$date.setHours($hour, $min, 0);
				
				console.log("E: " + $earliest + "\nD: " + $date);
				if ($date < $earliest) {
					var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric' };
					var $date_str = $earliest.toLocaleDateString("en-US", options);
					alert("We need time to prepare your order. Please select a time after \n" + $date_str);
					set_form_to_earliest_pickup();
				}
			}
	
			function set_form_to_earliest_pickup(){

				var $earliest = get_earliest_date();
				var $date = $("#delivery_date").datepicker("setDate", $earliest);
				var $min_sel = document.getElementById("min");
				var $mnemonic_sel = document.getElementById("mnemonic");

				var $hours = $earliest.getHours();




				if ($hours < 12) {
					$mnemonic_sel.value = "AM";
				} else {
					$mnemonic_sel.value = "PM";
				}
				console.log("Hours " + $hours);
				am_or_pm();

				var $hour_sel = document.getElementById("hour");
				$hour_sel.value = ($earliest.getHours()).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
//				alert($earliest.getHours() + ", " + $hour_sel.value);
				var $minutes = $earliest.getMinutes();
				$min_sel.value = ((parseInt(($minutes + 7.5)/15) * 15) % 60).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
			}
		function prime_form(){
			document.getElementById("mnemonic").selectedIndex = 0;
			document.getElementById("min").selectedIndex = 0;
			document.getElementById("hour").selectedIndex = 0;
		}
//		prime_form();
		</script>
<?php
		
	}
}

function get_restaurant_obj($slug){
	if ($slug == "highland"){
		$highland = new restaurant("Highland Market", "highland");
		$highland->set_address("525 N. Highland Ave. Tucson, AZ 85719");
		$highland->set_building("Highland Market");
		$highland->set_delivery_fee(5);
		$highland->add_notice_required(2);

		$highland->delivery_hours(0, 3, "0123456");
		$highland->delivery_hours(6, 12+12, "0123456");

		$highland->delivery_fee_hours(0, 3, "0123456");
		$highland->delivery_fee_hours(10+12, 12+12, "0123456");

		$highland->pickup_hours(0, 3, "0123456");
		$highland->pickup_hours(6, 12+12, "0123456");
		
		return $highland;
		
	} elseif ($slug == "ondeck"){

		$ondeck = new restaurant("On Deck Deli", "ondeck");
		$ondeck->set_address("1303 E University Blvd, Tucson, AZ 85719");
		$ondeck->set_building("Student Union Memorial Center");
		$ondeck->set_delivery_fee(0);
		$ondeck->add_notice_required(2);

		$ondeck->delivery_hours(8, 3 + 12, "0123456");

		$ondeck->pickup_hours(8, 3 + 12, "0123456");
	
		return $ondeck;
	
	} elseif ($slug == "catalyst"){

		$catalyst = new restaurant("Catalyst Cafe", "catalyst");
		$catalyst->set_address("1230 N Cherry Ave, Tucson, AZ 85719");
		$catalyst->set_building("Biosciences Research Laboratories");
		$catalyst->set_delivery_fee(10);
		$catalyst->add_notice_required(48);

		$catalyst->delivery_hours(8, 4 + 12, "1234");
		$catalyst->delivery_hours(8, 2 + 12, "5");

		$catalyst->pickup_hours(8, 4 + 12, "1234");
		$catalyst->pickup_hours(8, 2 + 12, "5");

		$catalyst->delivery_fee_hours(8, 4 + 12, "1234");
		$catalyst->delivery_fee_hours(8, 2 + 12, "5");
	
		return $catalyst;
	} elseif ($slug == "slotcanyon"){


		$slotcanyon = new restaurant("Slot Canyon Cafe", "slotcanyon");
		$slotcanyon->set_address("1064 E. Lowell Street, Tucson, AZ 85719");
		$slotcanyon->set_building("ENR2");
		$slotcanyon->set_delivery_fee(10);
		$slotcanyon->add_notice_required(48);

		$slotcanyon->delivery_hours(8, 4 + 12, "1234");
		$slotcanyon->delivery_hours(8, 4 + 12, "5");

		$slotcanyon->delivery_fee_hours(8, 4 + 12, "1234");
		$slotcanyon->delivery_fee_hours(8, 4 + 12, "5");

		$slotcanyon->pickup_hours(8, 4 + 12, "1234");
		$slotcanyon->pickup_hours(8, 4 + 12, "5");
		return $slotcanyon;
	}
}
?>

	
