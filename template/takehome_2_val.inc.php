<?php
	
	if (!$package) {
		$response .= "Please select a Package.<br />";
	} else if ($package == "1") {
		$total_amount += $package1_amount;
	} else if ($package == "2") {
		$total_amount += $package2_amount;
	} else if ($package == "3") {
		$total_amount += $package3_amount;
	} else if ($package == "4") {
		$total_amount += $package4_amount;;
	}
	
	// if it is 1 or 2 drop-downs are required
	if (($package == "1") || ($package == "2") || ($package == "3")) {
		if (!$mainCourse) {
			$response .= "Please select a Main Course.<br />";
		}
		if (!$potatoes) {
			$response .= "Please select a type of potato.<br />";
		}
		if (!$stuffing) {
			$response .= "Please select a type of stuffing.<br />";
		}
		if (!$vegetables) {
			$response .= "Please select a vegetable.<br />";
		}
		if (!$relishes) {
			$response .= "Please select a relish.<br />";
		}
		if (!$breads) {
			$response .= "Please select a bread.<br />";
		}
		if (!$salads) {
			$response .= "Please select a salad.<br />";
		}
		if (!$desserts) {
			$response .= "Please select a dessert.<br />";
		}
	}
	
	// main course
	if ($roastedTurkeyBoneInALaCarte) {
		$total_amount += $mainCourse_amount;
	}
	if ($roastedTurkeyBonelessALaCarte) {
		$total_amount += $mainCourse_amount;
	}
	if ($honeyGlazedHamALaCarte) {
		$total_amount += $mainCourse_amount;
	}
	
	
	// potatoes
	if ($mashedPotatoesWGravyALaCarte) {
		$total_amount += $potatoes_amount;
	}
	if ($candiedSweetPotatoesALaCarte) {
		$total_amount += $potatoes_amount;
	}
	if ($mashedYamsWCranberriesALaCarte) {
		$total_amount += $potatoes_amount;
	}
	
	// stuffing
	if ($appleCeleryStuffingALaCarte) {
		$total_amount += $stuffing_amount;
	}
	if ($sausageSageStuffingALaCarte) {
		$total_amount += $stuffing_amount;
	}
	if ($cornbreadStuffingALaCarte) {
		$total_amount += $stuffing_amount;
	}
	
	// vegetables
	if ($greenBeanCasseroleALaCarte) {
		$total_amount += $vegetables_amount;
	}
	if ($greenBeansWRedPeppersALaCarte) {
		$total_amount += $vegetables_amount;
	}
	if ($butteredCornALaCarte) {
		$total_amount += $vegetables_amount;
	}
	if ($glazedCarrotsALaCarte) {
		$total_amount += $vegetables_amount;
	}
	if ($vegetableMedleyALaCarte) {
		$total_amount += $vegetables_amount;
	}
	
	// relishes
	if ($cranberryRelishALaCarte) {
		$total_amount += $relishes_amount;
	}
	if ($orangeCranberrySauceWWalnutsALaCarte) {
		$total_amount += $relishes_amount;
	}
	
	// breads
	if ($dinnerRollsALaCarte) {
		$total_amount += $breads_amount;
	}
	if ($cornMuffinsALaCarte) {
		$total_amount += $breads_amount;
	}
	
	// salads
	if ($houseSaladALaCarte) {
		$total_amount += $salads_amount;
	}
	if ($waldorfSaladALaCarte) {
		$total_amount += $salads_amount;
	}
	if ($anasBroccoliSaladALaCarte) {
		$total_amount += $salads_amount;
	}
	if ($ambrosiaSaladALaCarte) {
		$total_amount += $salads_amount;
	}
	
	// desserts
	if ($pumpkinPieALaCarte) {
		$total_amount += $desserts_amount;
	}
	if ($pumpkinLoafALaCarte) {
		$total_amount += $desserts_amount;
	}
	if ($pecanPieALaCarte) {
		$total_amount += $desserts_amount;
	}
	if ($applePieALaCarte) {
		$total_amount += $desserts_amount;
	}
	if ($almondRingALaCarte) {
		$total_amount += $desserts_amount;
	}
	
	if($comment) {
		if(!validateComment($comment))
		{
			$response .= sprintf("The comment <strong>%s</strong> contains invalid characters.<br />", $comment);
		}
	}
	
	if($total_amount == 0) {
		$response .= "Nothing was selected.<br />";
	}
	
?>