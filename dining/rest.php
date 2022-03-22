<?php
	ini_set('display_errors', 0);

	require_once("includes/mysqli.inc");
	$db = new db_mysqli("hours2");

	$query = "select * from location 
						join location_descriptions on location.location_id = location_descriptions.location_id 
						where short_name='".substr($db->real_escape_string($_GET["name"]), 0, 15)."'";

	$result = $db->query($query);
	((mysqli_num_rows($result) == 1) ? ($location = mysqli_fetch_assoc($result)) : die("Restaurant not Found."));

	if($_GET["mode"] == "hours")
	{
		if(isset($_GET["name"]))
		{
			$today = date("Y-m-d", time());

			$time = time();
			$date = date("Y-m-d", $time);
			$dow = date("N", $time)-1;

			$week_start = date("Y-m-d", ($time-$dow*86400));
			$week_end = date("Y-m-d", ($time+(6-$dow)*86400));
			
			$id = $location["location_id"];

			$query = "select * from hours join periods on hours.type=periods.type where start_date <= '$date' and end_date > '$date' and location_id=$id";
			$result1 = $db->query($query);
			$location1 = mysqli_fetch_array($result1);

			$subquery = "select * from exceptions where date_of >= '$week_start' and date_of <= '$week_end' and location_id=$id";
			$subresult = $db->query($subquery);

			while($exception = mysqli_fetch_array($subresult))
			{
				$temp = (date("N", strtotime($exception["date_of"]))-1);
				$location1[$temp*2+1]=$exception["open"];
				$location1[$temp*2+2]=$exception["close"];			
			}

			echo "BEGIN:VCALENDAR"."\r\n".
	        "VERSION:2.0"."\r\n".
	        "PRODID:-//SVN Rev: 6126//m.union.arizona.edu Hours//EN"."\r\n".
	        "CALSCALE:Gregorian"."\r\n".
	        "X-WR-TIMEZONE:America/Phoenix"."\r\n".
	        "X-WR-CALNAME:$location[location_name] Hours"."\r\n".
	        "X-WR-CALDESC:Contains:https://union.arizona.edu$location[location_url]"."\r\n";
			

			for($index = 1; $index <= 14; $index+=2)
			{
				$open = $location1[$index];
				$close = $location1[$index + 1];
				$offset = $week_start . " +" . (($index-1)/2) . " days ";
				$sdate = date("Ymd\THis", strtotime($offset . " midnight"));

				if($open == "00:00:00" && $close == "00:00:00")
				{
					//Action for is_closed
				}
				else if($open == $close)
				{
					echo "BEGIN:VEVENT"."\r\n".
					"UID:{$sdate}Z-".md5($i++)."@union.arizona.edu"."\r\n".
					"SUMMARY:Open 24 Hours"."\r\n".
					"DTSTART:".$sdate."\r\n".
					"DTEND:".date("Ymd\THis", strtotime($offset . " 11:59:59pm"))."\r\n".
					"END:VEVENT"."\r\n";

				}
				else
				{
					echo "BEGIN:VEVENT"."\r\n".
					"UID:{$sdate}Z-".md5($i++)."@union.arizona.edu"."\r\n".
					"SUMMARY:Open"."\r\n".
					"DTSTART:".$sdate."\r\n".
					"DTEND:".date("Ymd\THis", strtotime($offset . $close))."\r\n".
					"END:VEVENT"."\r\n";
				}
			}

			echo "END:VCALENDAR";
		}
	}
	else if($_GET["mode"] == "categories")
	{
		$result = $db->query("select * from meal_times 
								left join meal_details on meal_details_id=meal_details.id
								where location_id = $location[location_id]");

		$date = isset($_GET["date"]) ? $_GET["date"] : "today";
		$days = array("Mon" => "m", "Tue" => "t", "Wed" => "w", "Thu" => "r", "Fri" => "f", "Sat" => "s", "Sun" =>"u");
		$short_day = ($days[date("D", strtotime($date))]);

		if(isset($_GET["format"]) && $_GET["format"] == "json")
		{
			$return["success"] = true;
			//$return["obj"] = $location;

			while($row = mysqli_fetch_assoc($result))
			{
				$tmp["category"] = $row["meal_name"];

				if($row["start$short_day"] == "")
					$tmp["start"] = "Closed";
				else
					$tmp["start"] = date("Ymd\THis", strtotime($date . " " .$row["start$short_day"]));

				if($row["end$short_day"] == "")
					$tmp["end"] = "Closed";
				else
					if(strtotime($date . " " .$row["start$short_day"]) > strtotime($date . " " .$row["end$short_day"]))
						$date = date("m/d/Y", strtotime("$date + 1 day"));
						
					$tmp["end"] = date("Ymd\THis", strtotime($date . " " .$row["end$short_day"]));

				$return["hours"][] = $tmp;
			}

			echo json_encode($return);
		}
		else
		{
			echo "BEGIN:VCALENDAR"."\r\n".
	        "VERSION:2.0"."\r\n".
	        "PRODID:-//union.arizona.edu pg_iCal//EN"."\r\n".
	        "CALSCALE:Gregorian"."\r\n".
	        "X-WR-TIMEZONE:America/Phoenix"."\r\n".
	        "X-WR-CALNAME:Available Categories"."\r\n";

	        $sdate = (date("Ymd\THis", strtotime($date . " " .$row["start$short_day"])));
	        $i = 0;

	        while($row = mysqli_fetch_assoc($result)) {
				
				// KMB: added conditional to make sure a location is open during a given day
	        	if ($row["start$short_day"] != "" && $row["start$short_day"] != "00:00:00") {
					// open

	        		$start = date("Ymd\THis", strtotime($date . " " .$row["start$short_day"]));

	        		if(strtotime($date . " " .$row["start$short_day"]) > strtotime($date . " " .$row["end$short_day"]))
						$date = date("m/d/Y", strtotime("$date + 1 day"));

					$end = date("Ymd\THis", strtotime($date . " " .$row["end$short_day"]));

		        	echo "BEGIN:VEVENT"."\r\n".
						"UID:{$sdate}Z-".md5($i++)."@union.arizona.edu"."\r\n".
						"SUMMARY:$row[meal_name]"."\r\n".
						"DTSTART:".$start."\r\n".
						"DTEND:".$end."\r\n".
						"END:VEVENT"."\r\n";

	        	}
	        	// if a location is not open on a given day, don't show any event parameters at all

	        }
	        
	        echo "END:VCALENDAR";
		}
	}
	else if($_GET["mode"] == "menu")
	{
		//Replicated from m_union
		$result = $db->query('select * from menu_items 
								left join meal_details on meal_details_id=meal_details.id
								where menu_restaurant='.$location['location_id']);
		while($row = $result->fetch_assoc()){
			$tmp["itemName"] = str_replace("\n", " ", htmlentities($row["menu_item"]));
			$tmp["meal"] = $row["meal_name"];
			$tmp["price"] = $row["menu_item_price"];

			$items[] = $tmp;
		}
		
		echo json_encode($items);
	}

?>	