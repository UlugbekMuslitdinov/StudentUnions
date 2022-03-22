<?php 
	// turn on sessions
	@session_start();
	require_once('includes/field_validation.inc.php');
	require_once('dining.inc');
	$page_options['page'] = 'Dining';
	$page_options['header_image'] = "/template/images/banners/13_Union_Holiday-Meal_web_banner.jpg";
	
	dining_start($page_options);
?>

<script type="text/javascript" src="/template/takehome_2.js"></script>

<?php
     
	// package amounts
	$package1_amount = 55.00;
	$package1_amount = number_format((float)$package1_amount, 2, '.', '');
	$package2_amount = 85.00;
	$package2_amount = number_format((float)$package2_amount, 2, '.', '');
	$package3_amount = 115.00;
	$package3_amount = number_format((float)$package3_amount, 2, '.', '');
	$package4_amount = 0.00;
	$package4_amount = number_format((float)$package4_amount, 2, '.', '');
	
	// a la carte amounts
	$mainCourse_amount = 37.50;
	$mainCourse_amount = number_format((float)$mainCourse_amount, 2, '.', '');
	$potatoes_amount = 5.25;
	$potatoes_amount = number_format((float)$potatoes_amount, 2, '.', '');
	$stuffing_amount = 4.45;
	$stuffing_amount = number_format((float)$stuffing_amount, 2, '.', '');
	$vegetables_amount = 5.95;
	$vegetables_amount = number_format((float)$vegetables_amount, 2, '.', '');
	$relishes_amount = 2.95;
	$relishes_amount = number_format((float)$relishes_amount, 2, '.', '');
	$breads_amount = 3.45;
	$breads_amount = number_format((float)$breads_amount, 2, '.', '');
	$salads_amount = 4.45;
	$salads_amount = number_format((float)$salads_amount, 2, '.', '');
	$desserts_amount = 8.95;
	$desserts_amount = number_format((float)$desserts_amount, 2, '.', '');
	
// has the form been submitted?
if (isset($_POST['submit'])) {
	// remove any html tags from the input

	// order information
	$package = strip_tags($_POST['package']);
	$mainCourse = strip_tags($_POST['mainCourse']);
	$roastedTurkeyBoneInALaCarte = strip_tags($_POST['roastedTurkeyBoneInALaCarte']);
	$roastedTurkeyBonelessALaCarte = strip_tags($_POST['roastedTurkeyBonelessALaCarte']);
	$honeyGlazedHamALaCarte = strip_tags($_POST['honeyGlazedHamALaCarte']);
	$potatoes = strip_tags($_POST['potatoes']);
	$mashedPotatoesWGravyALaCarte = strip_tags($_POST['mashedPotatoesWGravyALaCarte']);
	$candiedSweetPotatoesALaCarte = strip_tags($_POST['candiedSweetPotatoesALaCarte']);
	$mashedYamsWCranberriesALaCarte = strip_tags($_POST['mashedYamsWCranberriesALaCarte']);
	$stuffing = strip_tags($_POST['stuffing']);
	$appleCeleryStuffingALaCarte = strip_tags($_POST['appleCeleryStuffingALaCarte']);
	$sausageSageStuffingALaCarte = strip_tags($_POST['sausageSageStuffingALaCarte']);
	$cornbreadStuffingALaCarte = strip_tags($_POST['cornbreadStuffingALaCarte']);
	$vegetables = strip_tags($_POST['vegetables']);
	$greenBeanCasseroleALaCarte = strip_tags($_POST['greenBeanCasseroleALaCarte']);
	$greenBeansWRedPeppersALaCarte = strip_tags($_POST['greenBeansWRedPeppersALaCarte']);
	$butteredCornALaCarte = strip_tags($_POST['butteredCornALaCarte']);
	$glazedCarrotsALaCarte = strip_tags($_POST['glazedCarrotsALaCarte']);
	$vegetableMedleyALaCarte = strip_tags($_POST['vegetableMedleyALaCarte']);
	$relishes = strip_tags($_POST['relishes']);
	$breads = strip_tags($_POST['breads']);
	$cranberryRelishALaCarte = strip_tags($_POST['cranberryRelishALaCarte']);
	$orangeCranberrySauceWWalnutsALaCarte = strip_tags($_POST['orangeCranberrySauceWWalnutsALaCarte']);
	$dinnerRollsALaCarte = strip_tags($_POST['dinnerRollsALaCarte']);
	$cornMuffinsALaCarte = strip_tags($_POST['cornMuffinsALaCarte']);
	$salads = strip_tags($_POST['salads']);
	$houseSaladALaCarte = strip_tags($_POST['houseSaladALaCarte']);
	$waldorfSaladALaCarte = strip_tags($_POST['waldorfSaladALaCarte']);
	$anasBroccoliSaladALaCarte = strip_tags($_POST['anasBroccoliSaladALaCarte']);
	$ambrosiaSaladALaCarte = strip_tags($_POST['ambrosiaSaladALaCarte']);
	$desserts = strip_tags($_POST['desserts']);
	$pumpkinPieALaCarte = strip_tags($_POST['pumpkinPieALaCarte']);
	$pumpkinLoafALaCarte = strip_tags($_POST['pumpkinLoafALaCarte']);
	$pecanPieALaCarte = strip_tags($_POST['pecanPieALaCarte']);
	$applePieALaCarte = strip_tags($_POST['applePieALaCarte']);
	$almondRingALaCarte = strip_tags($_POST['almondRingALaCarte']);
	
	$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
	$xcomment = filter_var($_POST['xcomment'], FILTER_SANITIZE_STRING);
	
	// initialize the response variable
	$response = "";
	
	//total
	$total_amount = 000;
	$total_amount = number_format((float)$total_amount, 2, '.', '');
	
	require_once('takehome_2_val.inc.php');
	
	if (!$response) {
		// register session variables
		$_SESSION['package'] = $package;
		
		$_SESSION['mainCourse'] = $mainCourse;
		$_SESSION['roastedTurkeyBoneInALaCarte'] = $roastedTurkeyBoneInALaCarte;
		$_SESSION['roastedTurkeyBonelessALaCarte'] = $roastedTurkeyBonelessALaCarte;
		$_SESSION['honeyGlazedHamALaCarte'] = $honeyGlazedHamALaCarte;
		
		$_SESSION['potatoes'] = $potatoes;
		$_SESSION['mashedPotatoesWGravyALaCarte'] = $mashedPotatoesWGravyALaCarte;
		$_SESSION['candiedSweetPotatoesALaCarte'] = $candiedSweetPotatoesALaCarte;
		$_SESSION['mashedYamsWCranberriesALaCarte'] = $mashedYamsWCranberriesALaCarte;
		
		$_SESSION['stuffing'] = $stuffing;
		$_SESSION['appleCeleryStuffingALaCarte'] = $appleCeleryStuffingALaCarte;
		$_SESSION['sausageSageStuffingALaCarte'] = $sausageSageStuffingALaCarte;
		$_SESSION['cornbreadStuffingALaCarte'] = $cornbreadStuffingALaCarte;
		
		$_SESSION['vegetables'] = $vegetables;
		$_SESSION['greenBeanCasseroleALaCarte'] = $greenBeanCasseroleALaCarte;
		$_SESSION['greenBeansWRedPeppersALaCarte'] = $greenBeansWRedPeppersALaCarte;
		$_SESSION['butteredCornALaCarte'] = $butteredCornALaCarte;
		$_SESSION['glazedCarrotsALaCarte'] = $glazedCarrotsALaCarte;
		$_SESSION['vegetableMedleyALaCarte'] = $vegetableMedleyALaCarte;
		
		$_SESSION['relishes'] = $relishes;
		$_SESSION['cranberryRelishALaCarte'] = $cranberryRelishALaCarte;
		$_SESSION['orangeCranberrySauceWWalnutsALaCarte'] = $orangeCranberrySauceWWalnutsALaCarte;
		
		$_SESSION['breads'] = $breads;
		$_SESSION['dinnerRollsALaCarte'] = $dinnerRollsALaCarte;
		$_SESSION['cornMuffinsALaCarte'] = $cornMuffinsALaCarte;
		
		$_SESSION['salads'] = $salads;
		$_SESSION['houseSaladALaCarte'] = $houseSaladALaCarte;
		$_SESSION['waldorfSaladALaCarte'] = $waldorfSaladALaCarte;
		$_SESSION['anasBroccoliSaladALaCarte'] = $anasBroccoliSaladALaCarte;
		$_SESSION['ambrosiaSaladALaCarte'] = $ambrosiaSaladALaCarte;
		
		$_SESSION['desserts'] = $desserts;
		$_SESSION['pumpkinPieALaCarte'] = $pumpkinPieALaCarte;
		$_SESSION['pumpkinLoafALaCarte'] = $pumpkinLoafALaCarte;
		$_SESSION['pecanPieALaCarte'] = $pecanPieALaCarte;
		$_SESSION['applePieALaCarte'] = $applePieALaCarte;
		$_SESSION['almondRingALaCarte'] = $almondRingALaCarte;
		
		$_SESSION['comment'] = $comment;
		$_SESSION['xcomment'] = $xcomment;
		
		// constants
		$_SESSION['package1_amount'] = $package1_amount;
		$_SESSION['package2_amount'] = $package2_amount;
		$_SESSION['package3_amount'] = $package3_amount;
		$_SESSION['package4_amount'] = $package4_amount;
		$_SESSION['mainCourse_amount'] = $mainCourse_amount;
		$_SESSION['potatoes_amount'] = $potatoes_amount;
		$_SESSION['stuffing_amount'] = $stuffing_amount;
		$_SESSION['vegetables_amount'] = $vegetables_amount;
		$_SESSION['relishes_amount'] = $relishes_amount;
		$_SESSION['breads_amount'] = $breads_amount;
		$_SESSION['salads_amount'] = $salads_amount;
		$_SESSION['desserts_amount'] = $desserts_amount;
		
		// total amount of the order
		$_SESSION['total_amount'] = $total_amount;	
	}

} else {

	// if we are going backward through the screens, we restore the variables
	
	// note: on the checkbox values we have to test for null, before copying 
	// to the post variable. otherwise everything gets checked when we go back.
 
	if (!isset($_POST['package'])) {
		if (isset($_SESSION['package'])) {
			$package = strip_tags($_SESSION['package']);
			$_POST['package'] = strip_tags($_SESSION['package']);
		}
	}
	
	if (!isset($_POST['mainCourse'])) {
		if (isset($_SESSION['mainCourse'])) {
			$mainCourse = strip_tags($_SESSION['mainCourse']);
			$_POST['mainCourse'] = strip_tags($_SESSION['mainCourse']);
		}
	}
	
	if (!isset($_POST['roastedTurkeyBoneInALaCarte'])) {
		if (isset($_SESSION['roastedTurkeyBoneInALaCarte'])) {
			$roastedTurkeyBoneInALaCarte = strip_tags($_SESSION['roastedTurkeyBoneInALaCarte']);
			if ($roastedTurkeyBoneInALaCarte) {
				$_POST['roastedTurkeyBoneInALaCarte'] = strip_tags($_SESSION['roastedTurkeyBoneInALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['roastedTurkeyBonelessALaCarte'])) {
		if (isset($_SESSION['roastedTurkeyBonelessALaCarte'])) {
			$roastedTurkeyBonelessALaCarte = strip_tags($_SESSION['roastedTurkeyBonelessALaCarte']);
			if($roastedTurkeyBonelessALaCarte) {
				$_POST['roastedTurkeyBonelessALaCarte'] = strip_tags($_SESSION['roastedTurkeyBonelessALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['honeyGlazedHamALaCarte'])) {
		if (isset($_SESSION['honeyGlazedHamALaCarte'])) {
			$honeyGlazedHamALaCarte = strip_tags($_SESSION['honeyGlazedHamALaCarte']);
			if($honeyGlazedHamALaCarte) {
				$_POST['honeyGlazedHamALaCarte'] = strip_tags($_SESSION['honeyGlazedHamALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['potatoes'])) {
		if (isset($_SESSION['potatoes'])) {
			$potatoes = strip_tags($_SESSION['potatoes']);
			$_POST['potatoes'] = strip_tags($_SESSION['potatoes']);
		}
	}

	if (!isset($_POST['mashedPotatoesWGravyALaCarte'])) {
		if (isset($_SESSION['mashedPotatoesWGravyALaCarte'])) {
			$mashedPotatoesWGravyALaCarte = strip_tags($_SESSION['mashedPotatoesWGravyALaCarte']);
			if($mashedPotatoesWGravyALaCarte) {
				$_POST['mashedPotatoesWGravyALaCarte'] = strip_tags($_SESSION['mashedPotatoesWGravyALaCarte']);
			}
		}
	}

	if (!isset($_POST['candiedSweetPotatoesALaCarte'])) {
		if (isset($_SESSION['candiedSweetPotatoesALaCarte'])) {
			$candiedSweetPotatoesALaCarte = strip_tags($_SESSION['candiedSweetPotatoesALaCarte']);
			if($candiedSweetPotatoesALaCarte) {
				$_POST['candiedSweetPotatoesALaCarte'] = strip_tags($_SESSION['candiedSweetPotatoesALaCarte']);
			}
		}
	}

	if (!isset($_POST['mashedYamsWCranberriesALaCarte'])) {
		if (isset($_SESSION['mashedYamsWCranberriesALaCarte'])) {
			$mashedYamsWCranberriesALaCarte = strip_tags($_SESSION['mashedYamsWCranberriesALaCarte']);
			if($mashedYamsWCranberriesALaCarte) {
				$_POST['mashedYamsWCranberriesALaCarte'] = strip_tags($_SESSION['mashedYamsWCranberriesALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['stuffing'])) {
		if (isset($_SESSION['stuffing'])) {
			$stuffing = strip_tags($_SESSION['stuffing']);
			$_POST['stuffing'] = strip_tags($_SESSION['stuffing']);
		}
	}
	
	if (!isset($_POST['appleCeleryStuffingALaCarte'])) {
		if (isset($_SESSION['appleCeleryStuffingALaCarte'])) {
			$appleCeleryStuffingALaCarte = strip_tags($_SESSION['appleCeleryStuffingALaCarte']);
			if($appleCeleryStuffingALaCarte) {
				$_POST['appleCeleryStuffingALaCarte'] = strip_tags($_SESSION['appleCeleryStuffingALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['sausageSageStuffingALaCarte'])) {
		if (isset($_SESSION['sausageSageStuffingALaCarte'])) {
			$sausageSageStuffingALaCarte = strip_tags($_SESSION['sausageSageStuffingALaCarte']);
			if($sausageSageStuffingALaCarte) {
				$_POST['sausageSageStuffingALaCarte'] = strip_tags($_SESSION['sausageSageStuffingALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['cornbreadStuffingALaCarte'])) {
		if (isset($_SESSION['cornbreadStuffingALaCarte'])) {
			$cornbreadStuffingALaCarte = strip_tags($_SESSION['cornbreadStuffingALaCarte']);
			if($cornbreadStuffingALaCarte) {
				$_POST['cornbreadStuffingALaCarte'] = strip_tags($_SESSION['cornbreadStuffingALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['vegetables'])) {
		if (isset($_SESSION['vegetables'])) {
			$vegetables = strip_tags($_SESSION['vegetables']);
			$_POST['vegetables'] = strip_tags($_SESSION['vegetables']);
		}
	}

	if (!isset($_POST['greenBeanCasseroleALaCarte'])) {
		if (isset($_SESSION['greenBeanCasseroleALaCarte'])) {
			$greenBeanCasseroleALaCarte = strip_tags($_SESSION['greenBeanCasseroleALaCarte']);
			if($greenBeanCasseroleALaCarte) {
				$_POST['greenBeanCasseroleALaCarte'] = strip_tags($_SESSION['greenBeanCasseroleALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['greenBeansWRedPeppersALaCarte'])) {
		if (isset($_SESSION['greenBeansWRedPeppersALaCarte'])) {
			$greenBeansWRedPeppersALaCarte = strip_tags($_SESSION['greenBeansWRedPeppersALaCarte']);
			if($greenBeansWRedPeppersALaCarte) {
				$_POST['greenBeansWRedPeppersALaCarte'] = strip_tags($_SESSION['greenBeansWRedPeppersALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['butteredCornALaCarte'])) {
		if (isset($_SESSION['butteredCornALaCarte'])) {
			$butteredCornALaCarte = strip_tags($_SESSION['butteredCornALaCarte']);
			if($butteredCornALaCarte) {
				$_POST['butteredCornALaCarte'] = strip_tags($_SESSION['butteredCornALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['glazedCarrotsALaCarte'])) {
		if (isset($_SESSION['glazedCarrotsALaCarte'])) {
			$glazedCarrotsALaCarte = strip_tags($_SESSION['glazedCarrotsALaCarte']);
			if($glazedCarrotsALaCarte) {
				$_POST['glazedCarrotsALaCarte'] = strip_tags($_SESSION['glazedCarrotsALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['vegetableMedleyALaCarte'])) {
		if (isset($_SESSION['vegetableMedleyALaCarte'])) {
			$vegetableMedleyALaCarte = strip_tags($_SESSION['vegetableMedleyALaCarte']);
			if($vegetableMedleyALaCarte) {
				$_POST['vegetableMedleyALaCarte'] = strip_tags($_SESSION['vegetableMedleyALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['relishes'])) {
		if (isset($_SESSION['relishes'])) {
			$relishes = strip_tags($_SESSION['relishes']);
			$_POST['relishes'] = strip_tags($_SESSION['relishes']);
		}
	}

	if (!isset($_POST['cranberryRelishALaCarte'])) {
		if (isset($_SESSION['cranberryRelishALaCarte'])) {
			$cranberryRelishALaCarte = strip_tags($_SESSION['cranberryRelishALaCarte']);
			if($cranberryRelishALaCarte) {
				$_POST['cranberryRelishALaCarte'] = strip_tags($_SESSION['cranberryRelishALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['orangeCranberrySauceWWalnutsALaCarte'])) {
		if (isset($_SESSION['orangeCranberrySauceWWalnutsALaCarte'])) {
			$orangeCranberrySauceWWalnutsALaCarte = strip_tags($_SESSION['orangeCranberrySauceWWalnutsALaCarte']);
			if($orangeCranberrySauceWWalnutsALaCarte) {
				$_POST['orangeCranberrySauceWWalnutsALaCarte'] = strip_tags($_SESSION['orangeCranberrySauceWWalnutsALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['breads'])) {
		if (isset($_SESSION['breads'])) {
			$breads = strip_tags($_SESSION['breads']);
			$_POST['breads'] = strip_tags($_SESSION['breads']);
		}
	}
	
	if (!isset($_POST['dinnerRollsALaCarte'])) {
		if (isset($_SESSION['dinnerRollsALaCarte'])) {
			$dinnerRollsALaCarte = strip_tags($_SESSION['dinnerRollsALaCarte']);
			if($dinnerRollsALaCarte) {
				$_POST['dinnerRollsALaCarte'] = strip_tags($_SESSION['dinnerRollsALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['cornMuffinsALaCarte'])) {
		if (isset($_SESSION['cornMuffinsALaCarte'])) {
			$cornMuffinsALaCarte = strip_tags($_SESSION['cornMuffinsALaCarte']);
			if($cornMuffinsALaCarte) {
				$_POST['cornMuffinsALaCarte'] = strip_tags($_SESSION['cornMuffinsALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['salads'])) {
		if (isset($_SESSION['salads'])) {
			$salads = strip_tags($_SESSION['salads']);
			$_POST['salads'] = strip_tags($_SESSION['salads']);
		}
	}

	if (!isset($_POST['houseSaladALaCarte'])) {
		if (isset($_SESSION['houseSaladALaCarte'])) {
			$houseSaladALaCarte = strip_tags($_SESSION['houseSaladALaCarte']);
			if($houseSaladALaCarte) {
				$_POST['houseSaladALaCarte'] = strip_tags($_SESSION['houseSaladALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['waldorfSaladALaCarte'])) {
		if (isset($_SESSION['waldorfSaladALaCarte'])) {
			$waldorfSaladALaCarte = strip_tags($_SESSION['waldorfSaladALaCarte']);
			if($waldorfSaladALaCarte) {
				$_POST['waldorfSaladALaCarte'] = strip_tags($_SESSION['waldorfSaladALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['anasBroccoliSaladALaCarte'])) {
		if (isset($_SESSION['anasBroccoliSaladALaCarte'])) {
			$anasBroccoliSaladALaCarte = strip_tags($_SESSION['anasBroccoliSaladALaCarte']);
			if($anasBroccoliSaladALaCarte) {
				$_POST['anasBroccoliSaladALaCarte'] = strip_tags($_SESSION['anasBroccoliSaladALaCarte']);
			}
		}
	}

	if (!isset($_POST['ambrosiaSaladALaCarte'])) {
		if (isset($_SESSION['ambrosiaSaladALaCarte'])) {
			$ambrosiaSaladALaCarte = strip_tags($_SESSION['ambrosiaSaladALaCarte']);
			if($ambrosiaSaladALaCarte) {
				$_POST['ambrosiaSaladALaCarte'] = strip_tags($_SESSION['ambrosiaSaladALaCarte']);
			}
		}
	}

	if (!isset($_POST['desserts'])) {
		if (isset($_SESSION['desserts'])) {
			$desserts = strip_tags($_SESSION['desserts']);
			$_POST['desserts'] = strip_tags($_SESSION['desserts']);
		}
	}
	
	if (!isset($_POST['pumpkinPieALaCarte'])) {
		if (isset($_SESSION['pumpkinPieALaCarte'])) {
			$pumpkinPieALaCarte = strip_tags($_SESSION['pumpkinPieALaCarte']);
			if($pumpkinPieALaCarte) {
				$_POST['pumpkinPieALaCarte'] = strip_tags($_SESSION['pumpkinPieALaCarte']);
			}
		}
	}
	
	if (!isset($_POST['pumpkinLoafALaCarte'])) {
		if (isset($_SESSION['pumpkinLoafALaCarte'])) {
			$pumpkinLoafALaCarte = strip_tags($_SESSION['pumpkinLoafALaCarte']);
			if($pumpkinLoafALaCarte) {
				$_POST['pumpkinLoafALaCarte'] = strip_tags($_SESSION['pumpkinLoafALaCarte']);
			}
		}
	}

	if (!isset($_POST['pecanPieALaCarte'])) {
		if (isset($_SESSION['pecanPieALaCarte'])) {
			$pecanPieALaCarte = strip_tags($_SESSION['pecanPieALaCarte']);
			if($pecanPieALaCarte) {
				$_POST['pecanPieALaCarte'] = strip_tags($_SESSION['pecanPieALaCarte']);
			}
		}
	}

	if (!isset($_POST['applePieALaCarte'])) {
		if (isset($_SESSION['applePieALaCarte'])) {
			$applePieALaCarte = strip_tags($_SESSION['applePieALaCarte']);
			if($applePieALaCarte) {
				$_POST['applePieALaCarte'] = strip_tags($_SESSION['applePieALaCarte']);
			}
		}
	}

	if (!isset($_POST['almondRingALaCarte'])) {
		if (isset($_SESSION['almondRingALaCarte'])) {
			$almondRingALaCarte = strip_tags($_SESSION['almondRingALaCarte']);
			if($almondRingALaCarte) {
				$_POST['almondRingALaCarte'] = strip_tags($_SESSION['almondRingALaCarte']);
			}
		}
	}

	if (!isset($_POST['comment'])) {
		if (isset($_SESSION['comment'])) {
			$comment = strip_tags($_SESSION['comment']);
			$_POST['comment'] = strip_tags($_SESSION['comment']);
		}
	}
	
	if (!isset($_POST['xcomment'])) {
		if (isset($_SESSION['xcomment'])) {
			$xcomment = strip_tags($_SESSION['xcomment']);
			if($xcomment) {
				$_POST['xcomment'] = strip_tags($_SESSION['xcomment']);
			}
		}
	}
	
	if (!isset($_POST['total_amount'])) {
		if (isset($_SESSION['total_amount'])) {
			$total_amount = strip_tags($_SESSION['total_amount']);
			$_POST['total_amount'] = strip_tags($_SESSION['total_amount']);
		}
	}	
}
?>	


	<h1>Online Order Form</h1>
	
	<p>
		<strong>Orders must be picked up at The Arizona Room located in the SUMC,<br /> from 9am-6pm on Monday, December 23, 2013.</strong>
	</p>
	
	
	<?php 
	// if the submit button was clicked.
	if (isset($_POST['submit']))
	{
		// if there were no errors go to the next page.
		if(!$response)
	    { ?>
	    	
			<script type="text/javascript" >
					location.href="/dining/takehome_3.php";
			</script>

		<?php } else {
			// if there were errors, display them.
			echo "<h4 class='error-msg sub-nav-left-col'  >There were errors in processing the order information.</h4>";
	
			echo "<p class='error-msg' > $response </p>";
		}
	}?>
	
	<!-- the $_SERVER['PHP_SELF'] in the action field always posts back to the same form. -->
	<form name="form1" id="frm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
	<p>
		<b>Select an option: </b><span class="req" >*</span>  
		<ul style="list-style-type: none; margin-left: .5em; margin-top: -.5em; margin-bottom: 1em; line-height: 1.5em;">
			<li><input type="radio" name="package" value="1"  <?php if(isset($_POST['package'])) { if($_POST['package'] == "1") { echo "checked=\"checked\""; }} ?> > Package # 1: Serves 6-8 people <?php echo str_repeat(".",21); ?> <?php echo $package1_amount; ?> + tax</li>
			<li><input type="radio" name="package" value="2"  <?php if(isset($_POST['package'])) { if($_POST['package'] == "2") { echo "checked=\"checked\""; }} ?> > Package # 2: Serves  12-15 people <?php echo str_repeat(".",17); ?> <?php echo $package2_amount; ?> + tax</li>
			<li><input type="radio" name="package" value="3"  <?php if(isset($_POST['package'])) { if($_POST['package'] == "3") { echo "checked=\"checked\""; }} ?> > Package # 3: Serves  15-20 people <?php echo str_repeat(".",15); ?> <?php echo $package3_amount; ?> + tax</li>
			<li><input type="radio" name="package" value="4"  <?php if(isset($_POST['package'])) { if($_POST['package'] == "4") { echo "checked=\"checked\""; }} ?> > Package # 4: A la carte only <?php echo str_repeat(".",26); ?> charge for each item + tax</li>
		</ul>
	</p>
	<p>
		<strong>All a la carte items will serve approximately 6-8 people.</strong>
	</p>
	
	<div id="theRest" >
	<p class="pkgDropDown" >
		Select one choice from each drop-down menu.
	</p> 
	
	<p class="pkgDropDown" >	
		Optionally, you may also select extra <b>a la carte</b> items for an additional charge for each item selected.
	</p>
	
	<p>	
		You may select as many of the a la carte items as you wish.
	</p>
	
	<p>		
		Check the checkbox for each category to see the list of a la carte choices.
	</p>
	
	 <p class="pkgDropDown" style="margin-bottom: 0;" >
		<b>Main Course: </b><br />  
		<!-- by using a drop-down list for subject, we can route the email to the appropriate person. --> 
		<select id="mainCourse" name="mainCourse" size="1" style="height: 18px; margin-left: 16px; margin-top: 8px;">
     		<option value="" >Select One</option>
			<option value="roastedTurkeyBoneIn"  <?php if ($_POST['mainCourse'] == 'roastedTurkeyBoneIn') { echo 'selected="selected"'; } ?> > Roasted Turkey Bone-In (16-20lbs)</option>
			<option value="honeyGlazedHam"  <?php if ($_POST['mainCourse'] == 'honeyGlazedHam') { echo 'selected="selected"'; } ?> > Honey Glazed Ham</option>
		</select>
	</p>
	
	<p style="margin-left: 16px; margin-top: 2px;">
		<input type="checkbox" id="mainALaCarte" name="mainALaCarte" style="margin-left:0;" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['mainALaCarte'])) { echo "checked=\"checked\""; } ?> /> Main Course A La Carte ($<?php echo $mainCourse_amount; ?> per)
	 	<ul id="mainALaCarte-list" style="list-style-type: none; margin-left: 24px; margin-top: -12px; margin-bottom: 16px; line-height: 26px;">
			<li><input type="checkbox" id="roastedTurkeyBoneInALaCarte" name="roastedTurkeyBoneInALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['roastedTurkeyBoneInALaCarte'])) { echo "checked=\"checked\""; } ?> /> Roasted Turkey Bone-In (16-20lbs)</li>
			<li><input type="checkbox" id="honeyGlazedHamALaCarte" name="honeyGlazedHamALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['honeyGlazedHamALaCarte'])) { echo "checked=\"checked\""; } ?> /> Honey Glazed Ham</li>
		</ul>
	</p>
	
	 <p  class="pkgDropDown"  style="margin-bottom: 0;" >
		<b>Potatoes: </b><br />  
		<!-- by using a drop-down list for subject, we can route the email to the appropriate person. --> 
		<select id="potatoes" name="potatoes" size="1" style="height: 18px; margin-left: 16px; margin-top: 8px;">
     		<option value="" >Select One</option>
			<option value="mashedPotatoesWGravy"  <?php if ($_POST['potatoes'] == 'mashedPotatoesWGravy') { echo 'selected="selected"'; } ?> > Mashed Potatoes W/Gravy</option>
			<option value="candiedSweetPotatoes" <?php if ($_POST['potatoes'] == 'candiedSweetPotatoes') { echo 'selected="selected"'; } ?> > Candied Sweet Potatoes</option>
			<option value="mashedYamsWCranberries"  <?php if ($_POST['potatoes'] == 'mashedYamsWCranberries') { echo 'selected="selected"'; } ?> > Mashed Yams W/Cranberries</option>
		</select>
	</p>
	
	<p style="margin-left: 16px; margin-top: 2px;">
		<input type="checkbox" id="potatoesALaCarte" name="potatoesALaCarte" style="margin-left:0;" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['potatoesALaCarte'])) { echo "checked=\"checked\""; } ?> /> Potatoes A La Carte ($<?php echo $potatoes_amount; ?> per)
	 	<ul id="potatoesALaCarte-list" style="list-style-type: none; margin-left: 24px; margin-top: -12px; margin-bottom: 16px; line-height: 26px;" >
			<li><input type="checkbox" id="mashedPotatoesWGravyALaCarte" name="mashedPotatoesWGravyALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['mashedPotatoesWGravyALaCarte'])) { echo "checked=\"checked\""; } ?> /> Mashed Potatoes W/Gravy</li>
			<li><input type="checkbox" id="candiedSweetPotatoesALaCarte" name="candiedSweetPotatoesALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['candiedSweetPotatoesALaCarte'])) { echo "checked=\"checked\""; } ?> /> Candied Sweet Potatoes</li>
			<li><input type="checkbox" id="mashedYamsWCranberriesALaCarte" name="mashedYamsWCranberriesALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['mashedYamsWCranberriesALaCarte'])) { echo "checked=\"checked\""; } ?> /> Mashed Yams W/Cranberries</li>
		</ul>
	</p>
	
	<p  class="pkgDropDown" style="margin-bottom: 0;" >
		<b>Stuffing: </b><br />  
		<!-- by using a drop-down list for subject, we can route the email to the appropriate person. --> 
		<select id="stuffing" name="stuffing" size="1" style="height: 18px; margin-left: 16px; margin-top: 8px;" >
     		<option value="" >Select One</option>
			<option value="appleCeleryStuffing"  <?php if ($_POST['stuffing'] == 'appleCeleryStuffing') { echo 'selected="selected"'; } ?> > Apple Celery Stuffing</option>
			<option value="sausageSageStuffing" <?php if ($_POST['stuffing'] == 'sausageSageStuffing') { echo 'selected="selected"'; } ?> > Sausage Sage Stuffing</option>
			<option value="cornbreadStuffing"  <?php if ($_POST['stuffing'] == 'cornbreadStuffing') { echo 'selected="selected"'; } ?> > Cornbread Stuffing</option>
		</select>
	</p>
	
	<p style="margin-left: 16px; margin-top: 2px;">
		<input type="checkbox" id="stuffingALaCarte" name="stuffingALaCarte" style="margin-left:0;" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['stuffingALaCarte'])) { echo "checked=\"checked\""; } ?> /> Stuffings A La Carte ($<?php echo $stuffing_amount; ?> per)
	 	<ul id="stuffingALaCarte-list" style="list-style-type: none; margin-left: 24px; margin-top: -12px; margin-bottom: 16px; line-height: 26px;" >
			<li><input type="checkbox" id="appleCeleryStuffingALaCarte" name="appleCeleryStuffingALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['appleCeleryStuffingALaCarte'])) { echo "checked=\"checked\""; } ?> /> Apple Celery Stuffing</li>
			<li><input type="checkbox" id="sausageSageStuffingALaCarte" name="sausageSageStuffingALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['sausageSageStuffingALaCarte'])) { echo "checked=\"checked\""; } ?> /> Sausage Sage Stuffing</li>
			<li><input type="checkbox" id="cornbreadStuffingALaCarte"   name="cornbreadStuffingALaCarte"   title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['cornbreadStuffingALaCarte'])) { echo "checked=\"checked\""; } ?> /> Cornbread Stuffing</li>
		</ul>
	</p>
	
	<p  class="pkgDropDown" style="margin-bottom: 0;" >
		<b>Vegetables: </b><br />  
		<!-- by using a drop-down list for subject, we can route the email to the appropriate person. --> 
		<select id="vegetables" name="vegetables" size="1" style="height: 18px; margin-left: 16px; margin-top: 8px;" >
     		<option value="" >Select One</option>
			<option value="greenBeanCasserole"  <?php if ($_POST['vegetables'] == 'greenBeanCasserole') { echo 'selected="selected"'; } ?> > Green Bean Casserole</option>
			<option value="greenBeansWRedPeppers" <?php if ($_POST['vegetables'] == 'greenBeansWRedPeppers') { echo 'selected="selected"'; } ?> > Green Beans W/Red Peppers</option>
			<option value="butteredCorn"  <?php if ($_POST['vegetables'] == 'butteredCorn') { echo 'selected="selected"'; } ?> > Buttered Corn</option>
			<option value="glazedCarrots"  <?php if ($_POST['vegetables'] == 'glazedCarrots') { echo 'selected="selected"'; } ?> > Glazed Carrots</option>
			<option value="vegetableMedley"  <?php if ($_POST['vegetables'] == 'vegetableMedley') { echo 'selected="selected"'; } ?> > Vegetable Medley</option>
		</select>
	</p>
	
	<p style="margin-left: 16px; margin-top: 2px;">
		<input type="checkbox" id="vegetablesALaCarte" name="vegetablesALaCarte" style="margin-left:0;" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['vegetablesALaCarte'])) { echo "checked=\"checked\""; } ?> /> Vegetables A La Carte ($<?php echo $vegetables_amount; ?> per)
	 	<ul id="vegetablesALaCarte-list" style="list-style-type: none; margin-left: 24px; margin-top: -12px; margin-bottom: 16px; line-height: 26px;" >
			<li><input type="checkbox" id="greenBeanCasseroleALaCarte" name="greenBeanCasseroleALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['greenBeanCasseroleALaCarte'])) { echo "checked=\"checked\""; } ?> /> Green Bean Casserole</li>
			<li><input type="checkbox" id="greenBeansWRedPeppersALaCarte" name="greenBeansWRedPeppersALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['greenBeansWRedPeppersALaCarte'])) { echo "checked=\"checked\""; } ?> /> Green Beans W/Red Peppers</li>
			<li><input type="checkbox" id="butteredCornALaCarte" name="butteredCornALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['butteredCornALaCarte'])) { echo "checked=\"checked\""; } ?> /> Buttered Corn</li>
			<li><input type="checkbox" id="glazedCarrotsALaCarte" name="glazedCarrotsALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['glazedCarrotsALaCarte'])) { echo "checked=\"checked\""; } ?> /> Glazed Carrots</li>
			<li><input type="checkbox" id="vegetableMedleyALaCarte" name="vegetableMedleyALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['vegetableMedleyALaCarte'])) { echo "checked=\"checked\""; } ?> /> Vegetable Medley</li>
		</ul>
	</p>
	
	<p  class="pkgDropDown" style="margin-bottom: 0;" >
		<b>Relishes: </b><br />  
		<!-- by using a drop-down list for subject, we can route the email to the appropriate person. --> 
		<select id="relishes" name="relishes" size="1" style="height: 18px; margin-left: 16px; margin-top: 8px;" >
     		<option value="" >Select One</option>
			<option value="cranberryRelish"  <?php if ($_POST['relishes'] == 'cranberryRelish') { echo 'selected="selected"'; } ?> > Cranberry Relish</option>
			<option value="orangeCranberrySauceWWalnuts" <?php if ($_POST['relishes'] == 'orangeCranberrySauceWWalnuts') { echo 'selected="selected"'; } ?> > Orange Cranberry Sauce W/Walnuts</option>
		</select>
	</p>
	
	<p style="margin-left: 16px; margin-top: 2px;">
		<input type="checkbox" id="relishesALaCarte" name="relishesALaCarte" style="margin-left:0;" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['relishesALaCarte'])) { echo "checked=\"checked\""; } ?> /> Relishes A La Carte ($<?php echo $relishes_amount; ?> per)
	 	<ul id="relishesALaCarte-list" style="list-style-type: none; margin-left: 24px; margin-top: -12px; margin-bottom: 16px; line-height: 26px;" >
			<li><input type="checkbox" id="cranberryRelishALaCarte" name="cranberryRelishALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['cranberryRelishALaCarte'])) { echo "checked=\"checked\""; } ?> /> Cranberry Relish</li>
			<li><input type="checkbox" id="orangeCranberrySauceWWalnutsALaCarte" name="orangeCranberrySauceWWalnutsALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['orangeCranberrySauceWWalnutsALaCarte'])) { echo "checked=\"checked\""; } ?> /> Orange Cranberry Sauce W/Walnuts</li>
		</ul>
	</p>
	
	<p  class="pkgDropDown" style="margin-bottom: 0;" >
		<b>Breads: </b><br />  
		<!-- by using a drop-down list for subject, we can route the email to the appropriate person. --> 
		<select id="breads" name="breads" size="1" style="height: 18px; margin-left: 16px; margin-top: 8px;" >
     		<option value="" >Select One</option>
			<option value="dinnerRolls"  <?php if ($_POST['breads'] == 'dinnerRolls') { echo 'selected="selected"'; } ?> > Dinner Rolls</option>
			<option value="cornMuffins"  <?php if ($_POST['breads'] == 'cornMuffins') { echo 'selected="selected"'; } ?> > Corn Muffins</option>
		</select>
	</p>
	
	<p style="margin-left: 16px; margin-top: 2px;">
		<input type="checkbox" id="breadsALaCarte" name="breadsALaCarte" style="margin-left:0;" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['breadsALaCarte'])) { echo "checked=\"checked\""; } ?> /> Breads A La Carte ($<?php echo $breads_amount; ?> per)
	 	<ul id="breadsALaCarte-list" style="list-style-type: none; margin-left: 24px; margin-top: -12px; margin-bottom: 16px; line-height: 26px;" >
			<li><input type="checkbox" id="dinnerRollsALaCarte" name="dinnerRollsALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['dinnerRollsALaCarte'])) { echo "checked=\"checked\""; } ?> /> Dinner Rolls</li>
			<li><input type="checkbox" id="cornMuffinsALaCarte" name="cornMuffinsALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['cornMuffinsALaCarte'])) { echo "checked=\"checked\""; } ?> /> Corn Muffins</li>
		</ul>
	</p>
	
	<p  class="pkgDropDown"  style="margin-bottom: 0;" >
		<b>Salads: </b><br />  
		<!-- by using a drop-down list for subject, we can route the email to the appropriate person. --> 
		<select id="salads" name="salads" size="1" style="height: 18px; margin-left: 16px; margin-top: 8px;" >
     		<option value="" >Select One</option>
			<option value="houseSalad"  <?php if ($_POST['salads'] == 'houseSalad') { echo 'selected="selected"'; } ?> > House Salad</option>
			<option value="waldorfSalad" <?php if ($_POST['salads'] == 'waldorfSalad') { echo 'selected="selected"'; } ?> > Waldorf Salad</option>
			<option value="anasBroccoliSalad"  <?php if ($_POST['salads'] == 'anasBroccoliSalad') { echo 'selected="selected"'; } ?> > Ana’s Broccoli Salad</option>
			<option value="ambrosiaSalad"  <?php if ($_POST['salads'] == 'ambrosiaSalad') { echo 'selected="selected"'; } ?> > Ambrosia Salad</option>
		</select>
	</p>
	
	<p style="margin-left: 16px; margin-top: 2px;">
		<input type="checkbox" id="saladsALaCarte" name="saladsALaCarte" style="margin-left:0;" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['saladsALaCarte'])) { echo "checked=\"checked\""; } ?> /> Salads A La Carte ($<?php echo $salads_amount; ?> per)
	 	<ul id="saladsALaCarte-list" style="list-style-type: none; margin-left: 24px; margin-top: -12px; margin-bottom: 16px; line-height: 26px;" >
			<li><input type="checkbox" id="houseSaladALaCarte" name="houseSaladALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['houseSaladALaCarte'])) { echo "checked=\"checked\""; } ?> /> House Salad	</li>
			<li><input type="checkbox" id="waldorfSaladALaCarte" name="waldorfSaladALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['waldorfSaladALaCarte'])) { echo "checked=\"checked\""; } ?> /> Waldorf Salad</li>
			<li><input type="checkbox" id="anasBroccoliSaladALaCarte" name="anasBroccoliSaladALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['anasBroccoliSaladALaCarte'])) { echo "checked=\"checked\""; } ?> /> Ana’s Broccoli Salad</li>
			<li><input type="checkbox" id="ambrosiaSaladALaCarte" name="ambrosiaSaladALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['ambrosiaSaladALaCarte'])) { echo "checked=\"checked\""; } ?> /> Glazed Carrots</li>
		</ul>
	</p>
	
	<p  class="pkgDropDown" style="margin-bottom: 0;" >
		<b>Desserts: </b><br />  
		<!-- by using a drop-down list for subject, we can route the email to the appropriate person. --> 
		<select id="desserts" name="desserts" size="1" style="height: 18px; margin-left: 16px; margin-top: 8px;" >
     		<option value="" >Select One</option>
			<option value="pumpkinPie"  <?php if ($_POST['desserts'] == 'pumpkinPie') { echo 'selected="selected"'; } ?> > Pumpkin Pie</option>
			<option value="pumpkinLoaf" <?php if ($_POST['desserts'] == 'pumpkinLoaf') { echo 'selected="selected"'; } ?> > Pumpkin Loaf</option>
			<option value="pecanPie"  <?php if ($_POST['desserts'] == 'pecanPie') { echo 'selected="selected"'; } ?> > Pecan Pie</option>
			<option value="applePie"  <?php if ($_POST['desserts'] == 'applePie') { echo 'selected="selected"'; } ?> > Apple Pie</option>
			<option value="almondRing"  <?php if ($_POST['desserts'] == 'almondRing') { echo 'selected="selected"'; } ?> > Almond Ring</option>
		</select>
	</p>
	
	<p style="margin-left: 16px; margin-top: 2px;">
		<input type="checkbox" id="dessertsALaCarte" name="dessertsALaCarte" style="margin-left:0;" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['dessertsALaCarte'])) { echo "checked=\"checked\""; } ?> /> Desserts A La Carte ($<?php echo $desserts_amount; ?> per)
	 	<ul id="dessertsALaCarte-list" style="list-style-type: none; margin-left: 24px; margin-top: -12px; margin-bottom: 16px; line-height: 26px;" >
			<li><input type="checkbox" id="pumpkinPieALaCarte" name="pumpkinPieALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['pumpkinPieALaCarte'])) { echo "checked=\"checked\""; } ?> /> Pumpkin Pie</li>
			<li><input type="checkbox" id="pumpkinLoafALaCarte" name="pumpkinLoafALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['pumpkinLoafALaCarte'])) { echo "checked=\"checked\""; } ?> /> Pumpkin Loaf</li>
			<li><input type="checkbox" id="pecanPieALaCarte" name="pecanPieALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['pecanPieALaCarte'])) { echo "checked=\"checked\""; } ?> /> Pecan Pie</li>
			<li><input type="checkbox" id="applePieALaCarte" name="applePieALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['applePieALaCarte'])) { echo "checked=\"checked\""; } ?> /> Apple Pie</li>
			<li><input type="checkbox" id="almondRingALaCarte" name="almondRingALaCarte" title="Check if you wish to order A La Carte" value="yes"  <?php if(isset($_POST['almondRingALaCarte'])) { echo "checked=\"checked\""; } ?> /> Almond Ring</li>
		</ul>
	</p>
	
		<p>
		Your Comments/Suggestions: <br />
		<textarea name="comment" cols="50" rows="4" id="comment" maxlength="500" ><?php echo (isset($_POST['comment'])) ? (($result) ? "" : $_POST['comment']) : ""; ?></textarea>
		</p>
		
		<p id="xcomment" >
		Your Extended Comments/Suggestions: <span class="req" >*</span><br />
		<textarea name="xcomment" cols="50" rows="4" id="xcomment" maxlength="500" ><?php echo (isset($_POST['xcomment'])) ? (($result) ? "" : $_POST['xcomment']) : ""; ?></textarea>
		</p>
	
	</div>
	 
	<br />
		
		<!-- the input with type submit, automatically posts the form to the server. -->
		<input type="button" id="previous" name="previous" value="previous" onclick="location.href='/dining/takehome.php';" >
		<input type="submit" name="submit" value="save and continue">
		<span class="left300 reg12">2 of 4</span>
		<br /><br />
		
	</form>
	
	
</div>	
	
 
<?php 
	dining_finish();
?>