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
	
	private $notice_required = 0;
	private $address;
	private $building;
	private $delivery_fee;
	
	function __construct($name, $slug) {
		$this->name = $name;
		$this->slug = $slug;
		$this->delivery_hours = $this->store_hours;
		$this->pickup_hours = $this->store_hours;
		$this->delivery_fee_hours = $this->store_hours;
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
	
	public function notice_required($hours){
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
		$ret_val .= $this->dump_pickup_hours();
		$ret_val .= $this->dump_delivery_hours();
		$ret_val .= $this->dump_delivery_fee_hours();
		return $ret_val;
	}
	public function get_time_picker(){
		$ret_val = "<div>\n";
		 ?>
<!--	<div>-->
		<select id="hour" class="form-control su-timepicker">
		<?php
			for ($i=1; $i <= 12; $i++) { 
				echo sprintf('<option value="%02d">%02d</option>', $i, $i);
			}
		?>
		</select>
		<?php 
//			echo $this->get_pickup_hours();
//			$this->make_minutes();
//			$this->print_mnemonic();
		}
	
	public function get_pickup_hours(){
		return $this->get_hours($this->pickup_hours);
	}

	public function get_delivery_hours(){
		return $this->get_hours($this->delivery_hours);
	}

	public function get_delivery_fee_hours(){
		return $this->get_hours($this->delivery_fee_hours);
	}
	
	private function get_hours($hour_array){
		$weekday_hours = array();
		
		foreach ($hour_array as $day => $hours_arrs){
			$tmp = array();
			foreach ($hours_arrs as $hours){
				for ($i = $hours[0]; $i <= $hours[1]; $i++){
					array_push($tmp, $i);
				}
			}
			if (count($tmp) > 0){
				$weekday_hours[$day] = $tmp;
			}
		}
		$ret_arr = array();
		foreach ($weekday_hours as $day => $hours){
			$tmp = array();
			foreach ($hours as $h){
				$meridiem = "AM";
				if ($h >= 12){
					$meridiem = "PM";
				}
				if ($h > 12){
					$h = $h - 12;
				}
				$str = sprintf('<option value="%02d">%02d %s</option>', $h, $h, $meridiem);
				$str = sprintf('%02d %s', $h, $meridiem);
				array_push($tmp, $str);
			}
			$ret_arr[$day] = $tmp;
		}
		return $ret_arr;
	}
	
	private function make_minutes(){
		?><select id="min" class="form-control su-timepicker">';
			<?php for ($i = 0; $i < 60; $i = $i + 15) { 
				echo sprintf('<option value="%02d">%02d</option>', $i, $i);
			}	?>
		</select>
	<?php
	}
	
	private function print_mnemonic(){
		echo '<select id="mnemonic" class="form-control su-timepicker">
			<option value="AM">AM</option>
			<option value="PM">PM</option>
		</select><div>';
		
	}
}

function get_restaurant_obj($slug){
	if ($slug == "highland"){
		$highland = new restaurant("Highland Market", "highland");
		$highland->set_address("525 N. Highland Ave. Tucson, AZ 85719");
		$highland->set_building("Highland Market");
		$highland->set_delivery_fee(5);
		$highland->notice_required(2);

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
		$ondeck->notice_required(2);

		$ondeck->delivery_hours(8, 3 + 12, "0123456");

		$ondeck->pickup_hours(8, 3 + 12, "0123456");
	
		return $ondeck;
	
	} elseif ($slug == "catalyst"){

		$catalyst = new restaurant("Catalyst Cafe", "catalyst");
		$catalyst->set_address("1230 N Cherry Ave, Tucson, AZ 85719");
		$catalyst->set_building("Biosciences Research Laboratories");
		$catalyst->set_delivery_fee(10);
		$catalyst->notice_required(48);

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
		$slotcanyon->notice_required(48);

		$slotcanyon->delivery_hours(8, 4 + 12, "1234");
		$slotcanyon->delivery_hours(8, 4 + 12, "5");

		$slotcanyon->delivery_fee_hours(8, 4 + 12, "1234");
		$slotcanyon->delivery_fee_hours(8, 4 + 12, "5");

		$slotcanyon->pickup_hours(8, 4 + 12, "1234");
		$slotcanyon->pickup_hours(8, 4 + 12, "5");
		return $slotcanyon;
	}
}


	
