<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/infodesk/template/infodesk.main.php');
	$page_options['page'] = 'Maps and Rooms';
	infodesk_start($page_options);
?>
<style>
	h2 {
		margin-top: 15px !important;
		margin-bottom: -5px !important;
	}
</style>

<div class="col mt-4">
<link rel="stylesheet" type="text/css" href="style.css">

<div class="col-12">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#cccccc">
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="1" cellpadding="4">
					<tr>
						<td colspan="4">
							<p><b>Student Union Memorial Center Maps</b></p>
						</td>
					</tr>
					<tr>
						<td colspan="2" bgcolor="#e6e6e6">&nbsp;&nbsp;&middot;&nbsp;&nbsp;<a href="/infodesk/maps/17_SUMCPrintableMaps.pdf" target="_blank">SUMC Directory</a></td>
						<td colspan="2" bgcolor="#e6e6e6"><!--&nbsp;&nbsp;&middot;&nbsp;&nbsp;<a href="/infodesk/maps/17_SUMC_MainDirectory_Web.pdf" target="_blank">SUMC Directory</a>--></td>
					</tr>
					<tr><td colspan="2" valign="top" bgcolor="white"></td><td colspan="2" valign="top" bgcolor="white"></td></tr>
					<!-- <tr>
						<td colspan="2" valign="top" bgcolor="white">
							<table border="0" cellspacing="0" cellpadding="2">
								<tr>
									<td><a href="/infodesk/maps/17_SUMCPrintableMaps.pdf" target="_blank">Printable SUMC Maps</a> (PDF, 680kb)</td>
								</tr>
							</table>
						</td>
						<td colspan="2" bgcolor="white">
							<table border="0" cellspacing="0" cellpadding="2">
								<tr>

									<td><a href="/infodesk/maps/17_SUMC_MainDirectory_Web.pdf" target="_blank">SUMC Directory</a> (PDF, 709kb)</td>
								</tr>
							</table>
						</td>
					</tr> -->
				</table>
			</td>
		</tr>
	</table>
</div>

<div class="col-12">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#cccccc">
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="1" cellpadding="4">
					<tr>
						<td colspan="3">
							<p><b>Global Center Maps</b> (<a href="#psu" target="_blank">click here for directory</a>)</p>
						</td>
					</tr>

					<tr>
						<td bgcolor="#e6e6e6" width="25%">&nbsp;&nbsp;&middot;&nbsp;&nbsp;
							<a href="/infodesk/maps/GlobalCenter.pdf" target="_blank">Global Center Directory</a>
							<!--[<?php echo $park_level1_link ?>]</a>--></td>
						<td bgcolor="#e6e6e6" width="25%"><!--&nbsp;&nbsp;&middot;&nbsp;&nbsp;[<?php echo $park_level2_link ?>]</a>--></td>

					</tr>
					<!--<tr>
						<td colspan="2" valign="top" bgcolor="white">
							<table border="0" cellspacing="0" cellpadding="2">
								<tr>

									<td><a href="/infodesk/maps/GlobalCenter.pdf" target="_blank">Global Center Directory</a> (PDF)</td>
								</tr>

							</table>
						</td>

					</tr>-->
				</table>
			</td>
		</tr>
	</table>
</div>

<div class="col-12">
	<p><a href="http://map.arizona.edu/" target="_blank">
	Link to University of Arizona Campus-wide Interactive Map</a></p>
</div>

<div class="col-12 mt-5">
	<h1>Student Union Memorial Center Directory</h2>
</div>

<div style="width:100%;">
<div class="col" style="margin-right:20px;">
	<h2 class="map-list-title">FOOD</h2>
	<p class="wrap-map-list">Arizona Room <i> [<?php echo $sumc_level3_link ?>]</i><br>
		Cactus Grill <i> [<?php echo $sumc_level3_link ?>]</i><br>
		Chick-fil-A <i> [<?php echo $sumc_level2_link ?>]</i><br>
		Core<i> [<?php echo $sumc_level2_link ?>]</i><br>
		IQ Fresh <i> [<?php echo $sumc_level2_link ?>]</i><br>
		The Mesa Room <i> [<?php echo $sumc_level3_link ?>]</i><br>
		Pangea <i> [<?php echo $sumc_level2_link ?>]</i><br>
		On Deck Deli <i> [<?php echo $sumc_level2_link ?>]</i><br>
		Panda Express<i> [<?php echo $sumc_level2_link ?>]</i><br>
		Papa Johns Pizza <i> [<?php echo $sumc_level2_link ?>]</i><br>
		Sabor <i> [<?php echo $sumc_level2_link ?>]</i><br>
		U-Mart (Convenience Store) <i> [<?php echo $sumc_level2_link ?>]</i><br>
	</p>

	<h2 class="map-list-title">INVOLVEMENT &amp; ENTERTAINMENT</h2>
	<p class="wrap-map-list"><b>ASUA</b> (student government) <i> [<?php echo $sumc_level3_link ?>]</i><br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Legal Services<br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Wildcat Events Board<br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Safe Ride<br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Spring Fling</p>

	<p class="wrap-map-list"><b>Center for Student Involvement<br>&amp; Leadership</b> <i> [<?php echo $sumc_level4_link ?>]</i><br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Fraternity &amp; Sorority Programs<br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Leadership Programs<br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;LGBTQ Affairs<br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Pride Alliance<br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Women's Resource Center</p>

	<p class="wrap-map-list"><b>The Cellar</b> <i> [<?php echo $sumc_level1_link ?>]</i><br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Cellar Bistro &amp; Stage<br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Computer Lab<br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Games Room<br>
		<!-- &nbsp;&nbsp;&middot;&nbsp;&nbsp;TV Lounge<br> -->
	</p>

	<p class="wrap-map-list"><b>Gallagher Theater</b> <i> [<?php echo $sumc_level2_link ?>]</i></p>

	<p class="wrap-map-list"><b>Galleries</b><br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Kachina Gallery &amp; Lounge <i> [<?php echo $sumc_level3_link ?>]</i><br>
		&nbsp;&nbsp;&middot;&nbsp;&nbsp;Union Gallery <i> [<?php echo $sumc_level3_link ?>]</i><br>
	</p>

			Graduate Professional Student Council <i>[<?php echo $sumc_level3_link ?>]</i><br>
			Transfer Student Center <i>[<?php echo $sumc_level4_link ?>]</i><br>
			VETS Students Center <i>[<?php echo $sumc_level4_link ?>]</i><br><br>

			<h2 class="map-list-title" style="margin-bottom: 5px !important; font-weight: 500;">SHOPPING &amp; SERVICES</h2>
			<p class="wrap-map-list">
        		Arizona Catering Company <i> [<?php echo $sumc_level3_link ?>]</i><br>
				Arizona Primary Eye Care & Optical <i> [<?php echo $sumc_level2_link ?>]</i><br>
				BookStores <i> [<?php echo $sumc_level2_link ?>]</i><br>
				Career Services <i> [<?php echo $sumc_level4_link ?>]</i><br>
				CatCard & CatCash Offices <i> [<?php echo $sumc_level1_link ?>]</i><br>
				Computer Lab <i> [<?php echo $sumc_level1_link ?>]</i><br>
				Fast Copy &amp; Design, FedEX <i> [<?php echo $sumc_level2_link ?>]</i><br>
        Marketing & Event Services <i> [<?php echo $sumc_level3_link ?>]</i><br>
        Mall Scheduling <i> [<?php echo $sumc_level2_link ?>]</i><br>
				Meal Plans Office <i> [<?php echo $sumc_level1_link ?>]</i><br>
        Office of Student Engagement <i> [<?php echo $sumc_level2_link ?>]</i><br>
				Transfer Student Center <i> [<?php echo $sumc_level4_link ?>]</i><br>
				<!-- US Post Office <i>[<?php echo $sumc_level1_link ?>]</i><br> -->
				Wells Fargo Bank <i> [<?php echo $sumc_level1_link ?>]</i><br>
				Info. Desk/Lost &amp; Found <i> [<?php echo $sumc_level2_link ?>]</i><br>
			</p>
		</div>
		<div class="col">
			<h2 class="map-list-title" style="margin-bottom: 5px !important; font-weight: 500;">ADMINISTRATIVE OFFICES</h2>
			<p class="wrap-map-list">
					Arizona Student Unions <i> [<?php echo $sumc_level4_link ?>]</i><br>
          Arizona Student Unions Marketing & Event Services<i> [<?php echo $sumc_level3_link ?>]</i><br>
					BookStores <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Dining Services <i> [<?php echo $sumc_level1_link ?>]</i><br>
					SAEM/AISS Marketing <i> [<?php echo $sumc_level4_link ?>]</i><br>
			</p>
			<h2 class="map-list-title" style="margin-bottom: 5px !important; font-weight: 500;">LOUNGES</h2>
			<p class="wrap-map-list">	&nbsp;&nbsp;&middot;&nbsp;&nbsp;Alumni Heritage Lounge <i> [<?php echo $sumc_level2_link ?>]</i><br>
				<!-- &nbsp;&nbsp;&middot;&nbsp;&nbsp;Cellar Lounge <i> [<?php echo $sumc_level1_link ?>]</i><br> -->
				&nbsp;&nbsp;&middot;&nbsp;&nbsp;Diamond Atrium <i> [<?php echo $sumc_level3_link ?>]</i><br>
				&nbsp;&nbsp;&middot;&nbsp;&nbsp;Honors Lounge <i> [<?php echo $sumc_level3_link ?>]</i><br>
				&nbsp;&nbsp;&middot;&nbsp;&nbsp;Kachina Lounge <i> [<?php echo $sumc_level3_link ?>]</i><br>
				&nbsp;&nbsp;&middot;&nbsp;&nbsp;TV Lounge <i> [<?php echo $sumc_level1_link ?>]</i><br>
				&nbsp;&nbsp;&middot;&nbsp;&nbsp;U.S.S. Arizona Lounge <i> [<?php echo $sumc_level2_link ?>]</i></p>
			</p>
			<h2 class="map-list-title" style="margin-bottom: 5px !important; font-weight: 500;">MEETING ROOMS</h2>
			<p class="wrap-map-list">		Agave <i> [<?php echo $sumc_level4_link ?>]</i><br>
					Grand Ballroom <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Catalina <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Cholla <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Copper <i> [<?php echo $sumc_level4_link ?>]</i><br>
					<!--Cottonwood <i> [--><?php //echo $sumc_level3_link ?><!--]</i><br>-->
					Gallagher Theater <i> [<?php echo $sumc_level2_link ?>]</i><br>
					Madera <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Mesquite <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Mesa <i> [<?php echo $sumc_level3_link ?>]</i><br>
					<!--Palo Verde <i> [--><? //echo $sumc_level3_link ?><!--]</i><br>-->
					Picacho <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Pima <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Ocotillo <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Presidio <i> [<?php echo $sumc_level4_link ?>]</i><br>
					Rincon <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Sabino <i> [<?php echo $sumc_level3_link ?>]</i><br>
					San Pedro <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Santa Cruz <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Santa Rita <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Tubac <i> [<?php echo $sumc_level4_link ?>]</i><br>
					Tucson <i> [<?php echo $sumc_level3_link ?>]</i><br>
					Union Kiva <i> [<?php echo $sumc_level2_link ?>]</i><br>
					Ventana <i> [<?php echo $sumc_level4_link ?>]</i></p>
	</div>
	<div style="clear:both;"></div>
	</div>
<h1><br>
	<a id="psu" name="psu"></a>Global Center Directory</h1>
<div style="width:100%;">
<div class="col" style="margin-right:20px;">
			<h2 class="map-list-title" style="margin-bottom: 5px !important; font-weight: 500;">FOOD</h2>
			<p class="wrap-map-list">
				Core Plus <i> [<?php echo $park_level1_link ?>]</i><br>
				Bagel Talk <i> [<?php echo $park_level1_link ?>]</i><br>
				La Petite Patisserie <i> [<?php echo $park_level1_link ?>]</i><br>
				Park Ave Market <i> [<?php echo $park_level1_link ?>]</i><br>
				Global Center Food Court <i> [<?php echo $park_level2_link ?>]</i><br>
				&nbsp;&nbsp;&middot;&nbsp;<i>The Den by Denny's</i><br>
				&nbsp;&nbsp;&middot;&nbsp;<i>On Deck Deli 2</i><br>
				&nbsp;&nbsp;&middot;&nbsp;<i>Nosh</i><br>
				&nbsp;&nbsp;&middot;&nbsp;<i>Sweet Sixteen Ice Cream</i><br>
				&nbsp;&nbsp;&middot;&nbsp;<i>N<sup>rich</sup> Urban Market Express</i><br>
				&nbsp;&nbsp;&middot;&nbsp;<i>ATM</i><br>
			</p>
			<!-- <h2 class="map-list-title">INVOLVEMENT &amp; ENTERTAINMENT</h2> -->
			<!-- <p class="wrap-map-list">
				KAMP Radio <i> [<?php echo $park_level1_link ?>]</i><br>
			</p> -->

			<h2 class="map-list-title" style="margin-bottom: 5px !important; font-weight: 500;">SHOPPING &amp; SERVICES</h2>
			<p class="wrap-map-list">
				UA Passport Office <i> [<?php echo $park_level1_link ?>]</i><br>
				UA Study Abroad Store Front <i> [<?php echo $park_level1_link ?>]</i><br>
				UA Study Abroad Office <i> [<?php echo $park_level1_link ?>]</i><br>
				Global Travel Services <i> [<?php echo $park_level1_link ?>]</i><br>
				International Student Services <i> [<?php echo $park_level1_link ?>]</i><br>
				International Recruitment, Admissions, and Marketing <i> [<?php echo $park_level1_link ?>]</i><br>
				International Faculty and Scholars <i> [<?php echo $park_level1_link ?>]</i><br>
				<!-- Arizona Student Media <i> [<?php echo $park_level1_link ?>]</i><br> -->
				ATM <i> [<?php echo $park_level2_link ?>]</i><br>
				UA Global Admin Office <i> [<?php echo $park_level2_link ?>]</i><br>
				<!-- Residence Life Office (West) <i> [<?php echo $park_level1_link ?>]</i><br> -->
				The Think Tank <i> [<?php echo $park_level2_link ?>]</i><br>
				OSCR <i> [<?php echo $park_level2_link ?>]</i><br>
			</p>
		  	<!-- <h2 class="map-list-title" style="margin-bottom: 5px !important; font-weight: 500;">MEETING ROOMS</h2>
			<p class="wrap-map-list">
				Diamondback <i> [<?php echo $park_level2_link ?>]</i><br>
				Javelina <i> [<?php echo $park_level2_link ?>]</i><br>
			</p> -->
</div>
<div style="clear:both"></div>
</div>
<br>
<link rel="StyleSheet" href="/commontools/jslib/shadowbox/shadowbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="/commontools/jslib/jquery.js"></script>
<script type="text/javascript" src="/commontools/jslib/shadowbox/shadowbox.js"></script>

<script type="text/javascript">
  <?php if(!$_SESSION['mobile_browser']) print 'Shadowbox.init();';?>
</script>

</div>


<?php //right_column(); // Creating a right-column using the global template?>
<!-- <div id="right-col">
	<div class="col wrap-right-col p-0">
		<a href="http://union.arizona.edu/mealplans">
			<img src="http://union.arizona.edu/template/images/buttons/mealplan_ad.gif"/>
		</a>
		<?php
			randomFeed(37);
			sequentialFeed(38);
		?>
		<a href="/events"><img src="/template/images/buttons/events_btn.jpg" alt="events" /></a>
		<a href="/about/marketing/ask.php"><img src="/template/images/buttons/feedback_btn.jpg" alt="contact" /></a>
		<a href="/tellus"><img src="/template/images/buttons/tellus_btn.jpg" alt="donate" /></a>
	</div>
</div> -->
<?php 
	infodesk_finish();
?>
