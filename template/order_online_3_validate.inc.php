<?php    		
		if($venueOther == "yes") {
			if (!$otherVenueDesc) {
				$response .= "Please enter a description of the other venue.<br />";
			} else if (!validateComment($otherVenueDesc)) {
				$response .= sprintf("The Other Venue description <strong>%s</strong> contains invalid characters.<br />", $otherVenueDesc);
			}
		}	
		
		if($setupOther == "yes") {
			if (!$otherSetupDesc) {
				$response .= "Please enter a description of the other setup.<br />";
			} else if (!validateComment($otherSetupDesc)) {
				$response .= sprintf("The Other Setup description <strong>%s</strong> contains invalid characters.<br />", $otherSetupDesc);
			}
		}	
		
		if($breakout == "yes")	
		{
			if (!is_numeric($breakoutNumber))
			{
				$response .= sprintf("The number of breakout rooms <strong>%s</strong> is invalid.<br />", $breakoutNumber);
			} 
		}
	
?>