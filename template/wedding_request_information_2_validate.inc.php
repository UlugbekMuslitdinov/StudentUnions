<?php    		
		// event information
		$todayDate = new DateTime();
		// set hours, minutes and seconds to zero
		// just in case the user picks today
		$todayDate->setTime(0, 0, 0);
		
		$begDate = new DateTime($eventDate);
		$otherDate = new DateTime($altDate);
		$oneYear = new DateTime();
		// add 1 year
		$oneYear = $oneYear->add(new DateInterval('P1Y'));
		
		if(!$eventDate)	
		{
			$response .= "You must enter an Event Date.<br />";
		}
		else if(!validateDate($eventDate))
		{
			$response .= sprintf("The Event Date <strong>%s</strong> is invalid.<br />", $eventDate);
		} 
		else if ($begDate < $todayDate) 
		{
			$response .= "From Date cannot be less than today's date.<br />";
		} 
		else if ($begDate > $oneYear) 
		{
			$response .= "From Date cannot be greater than 1 year in the future.<br />";
		}
		
		if(!$altDate)	
		{
			$response .= "You must enter an Alternate Date.<br />";
		}
		else if(!validateDate($altDate))
		{
			$response .= sprintf("The Alternate Date <strong>%s</strong> is invalid.<br />", $altDate);
		} 
		else if ($otherDate < $todayDate) 
		{
			$response .= "Alternate Date cannot be less than today's date.<br />";
		} 
		else if ($otherDate > $oneYear) 
		{
			$response .= "Alternate Date cannot be greater than 1 year in the future.<br />";
		}
		
		if (!ceremonyTime)
		{
			$response .= "You must enter a Ceremony Time.<br />";
		}
		else if(!validateComment($ceremonyTime))
		{
			$response .= sprintf("The Ceremony Time <strong>%s</strong> contains invalid characters.<br />", $ceremonyTime);
		}
		if (!receptionTime)
		{
			$response .= "You must enter a Reception Time.<br />";
		}
		else if(!validateComment($receptionTime))
		{
			$response .= sprintf("The Reception Time <strong>%s</strong> contains invalid characters.<br />", $receptionTime);
		}
		
		if(!$numAttend)
		{
			$response .= "You must enter the number of attendees.<br />";
		}
		else if(!is_numeric($numAttend))
		{
			$response .= sprintf("The number of attendees <strong>%s-%s-%s</strong> is invalid.<br />", $numAttend);
		}
		if(!ceremonyLocation) {
			$response .= "You must select a Ceremony Location.<br />";
		}
		if (!$eventType)
		{
			$response .= "You must select an Event Type.<br />";
		}
		if (!$budget)
		{
			$response .= "You must enter a Food/Beverage Budget.<br />";
		}
		
		 
		if ($expectations)
		{
		 	if(!validateComment($expectations))
			{
				$response .= sprintf("The Expectations <strong>%s</strong> contains invalid characters.<br />", $expectations);
			}
		}
?>