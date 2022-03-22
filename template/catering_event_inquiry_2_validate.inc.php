<?php   		
		// event information
		$todayDate = new DateTime();
		// set hours, minutes and seconds to zero
		// just in case the user picks today
		$todayDate->setTime(0, 0, 0);
		
		$begDate = new DateTime($eventDate);
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
		 
		if (!startTime)
		{
			$response .= "You must enter a Start Time.<br />";
		}
		else if(!validateComment($startTime))
		{
			$response .= sprintf("The Start Time <strong>%s</strong> contains invalid characters.<br />", $startTime);
		}
		if (!endTime)
		{
			$response .= "You must enter a End Time.<br />";
		}
		else if(!validateComment($endTime))
		{
			$response .= sprintf("The End Time <strong>%s</strong> contains invalid characters.<br />", $endTime);
		}
		
		if(!$numAttend)
		{
			$response .= "You must enter the number of attendees.<br />";
		}
		else if(!is_numeric($numAttend))
		{
			$response .= sprintf("The number of attendees <strong>%s-%s-%s</strong> is invalid.<br />", $numAttend);
		}
		
		if (!$eventType)
		{
			$response .= "You must select an Event Type.<br />";
		}
		if (!$foodService)
		{
			$response .= "You must select an Food/Beverage Service.<br />";
		}
		if (!$setup)
		{
			$response .= "You must select a Setup.<br />";
		}
		 
		if ($comments)
		{
		 	if(!validateComment($comments))
			{
				$response .= sprintf("The Comment <strong>%s</strong> contains invalid characters.<br />", $comments);
			}
		}
?>