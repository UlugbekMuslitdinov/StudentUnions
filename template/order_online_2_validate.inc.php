<?php    		
		// event information
		if (!$eventType)
		{
			$response .= "You must select an Event Type.<br />";
		}
		if (!$eventTitle)
		{
			$response .= "You must enter an Event Title.<br />";
		}
		else if(!validateComment($eventTitle))
		{
			$response .= sprintf("The Event Title <strong>%s</strong> contains invalid characters.<br />", $eventTitle);
		}
		
		if (!$eventDesc)
		{
			$response .= "You must enter an Event Description.<br />";
		}
		else if(!validateComment($eventDesc))
		{
			$response .= sprintf("The Event Description <strong>%s</strong> contains invalid characters.<br />", $eventDesc);
		}
		
		if(!$numAttend)
		{
			$response .= "You must enter the number of attendees.<br />";
		}
		else if(!is_numeric($numAttend))
		{
			$response .= sprintf("The number of attendees <strong>%s-%s-%s</strong> is invalid.<br />", $numAttend);
		}
		
		/*
		if(!$prevEvent) {
			$response .= "Please select whether you have had a prior event with us.<br />";
		} else if ($prevEvent == "Yes") {
			if($prevEventDate) {
				if(!validateDate($prevEventDate)) {
					$response .= "You must enter a valid Previous Event Date.<br />";
				}
			}
			if($prevEventDesc) {
				if(!validateComment($prevEventDesc)) {
					$response .= sprintf("The Previous Event Description <strong>%s</strong> contains invalid characters.<br />", $prevEventDesc);
				}
			}
			
		}
		 * 
		 */
		
		$todayDate = new DateTime();
		// set hours, minutes and seconds to zero
		// just in case the user picks today
		$todayDate->setTime(0, 0, 0);
		
		$begDate = new DateTime($fromDate);
		$endDate = new DateTime($toDate);
		$oneYear = new DateTime();
		// add 1 year
		$oneYear = $oneYear->add(new DateInterval('P1Y'));
		
		if(!$fromDate)	
		{
			$response .= "You must enter a From Date.<br />";
		}
		else if(!validateDate($fromDate))
		{
			$response .= sprintf("The From Date <strong>%s</strong> is invalid.<br />", $fromDate);
		} 
		else if ($begDate < $todayDate) 
		{
				$response .= "From Date cannot be less than today's date.<br />";
		} 
		else if ($begDate > $oneYear) 
		{
			$response .= "From Date cannot be greater than 1 year in the future.<br />";
		}
		
		if(!$toDate)	
		{
			$response .= "You must enter a To Date.<br />";
		}
		else if(!validateDate($toDate))
		{
			$response .= sprintf("The To Date <strong>%s</strong> is invalid.<br />", $fromDate);
		} 
		else if ($endDate < $todayDate) 
		{
			$response .= "To Date cannot be less than today's date.<br />";
		} 
		else if ($endDate < $begDate) 
		{
			$response .= "To Date cannot be less than From Date.<br />";
		} 
		else if ($endDate > $oneYear) 
		{
			$response .= "To Date cannot be greater than 1 year in the future.<br />";
		}
		
		$altBegDate = new DateTime($altFromDate);
		$altEndDate = new DateTime($altToDate);
		
		if(!$altFromDate)	
		{
			$response .= "You must enter an Alternate From Date.<br />";
		}
		else if(!validateDate($altFromDate))
		{
			$response .= sprintf("The Alternate From Date <strong>%s</strong> is invalid.<br />", $fromDate);
		} 
		else if ($altBegDate < $todayDate) 
		{
				$response .= "Alternate From Date cannot be less than today's date.<br />";
		} 
		else if ($altBegDate > $oneYear) 
		{
			$response .= "Alternate From Date cannot be greater than 1 year in the future.<br />";
		}
		
		if(!$altToDate)	
		{
			$response .= "You must enter a Alternate To Date.<br />";
		}
		else if(!validateDate($altToDate))
		{
			$response .= sprintf("The Alternate To Date <strong>%s</strong> is invalid.<br />", $fromDate);
		} 
		else if ($altEndDate < $todayDate) 
		{
			$response .= "Alternate To Date cannot be less than today's date.<br />";
		} 
		else if ($altEndDate < $begDate) 
		{
			$response .= "Alternate To Date cannot be less than From Date.<br />";
		} 
		else if ($altEndDate > $oneYear) 
		{
			$response .= "Alternate To Date cannot be greater than 1 year in the future.<br />";
		}
		
		if (!$startTime)
		{
			$response .= "You must enter a Start Time.<br />";
		}
		else if(!validateComment($startTime))
		{
			$response .= sprintf("The Start Time <strong>%s</strong> contains invalid characters.<br />", $startTime);
		}
		if (!$endTime)
		{
			$response .= "You must enter a End Time.<br />";
		}
		else if(!validateComment($endTime))
		{
			$response .= sprintf("The End Time <strong>%s</strong> contains invalid characters.<br />", $endTime);
		}
		
		if (!$account) {
			$response .= "You must enter an Account Number.<br />";
		} else if (!validateComment($account)) {
			$response .= sprintf("The account number <strong>%s</strong> contains invalid characters.<br />", $account);
		}
	
?>