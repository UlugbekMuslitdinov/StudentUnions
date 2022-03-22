<?php 

// turn on sessions
@session_start(); 
	
require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
$page_options['title'] = 'Arizona Catering Company';
require_once('deliverance.inc.php');	
require_once('includes/field_validation.inc.php'); 
page_start($page_options);
require_once('contact_us.inc.php');
?>
<?php
require_once('catering_slider.inc.php');
?>
<div id="catering_page" >
<?php
require_once('catering_left_col.inc.php');
?>

<link rel="StyleSheet" href="/template/catering.css" type="text/css" media="screen" /> 
<script type="text/javascript" src="/template/order_online_3.js" ></script>

<?php  
		
	// has the form been submitted?
	if (isset($_POST['submit']))
	{
		// remove any html tags from the input
		
		// event information
		$agave = strip_tags($_POST['agave']);
		$ballroom = strip_tags($_POST['ballroom']);
		$catalina = strip_tags($_POST['catalina']);
		$cholla = strip_tags($_POST['cholla']);
		$copper = strip_tags($_POST['copper']);
		$madera = strip_tags($_POST['madera']);	
		$mesa = strip_tags($_POST['mesa']);
		$mesquite = strip_tags($_POST['mesquite']);
		$ocotillo = strip_tags($_POST['ocotillo']);
		$altToDate = strip_tags($_POST['toDate']);
		$picacho = strip_tags($_POST['picacho']);
		$pima = strip_tags($_POST['pima']);
		$presidio = strip_tags($_POST['presidio']);
		$rincon = strip_tags($_POST['rincon']);
		$sabino = strip_tags($_POST['sabino']);
		$sanPedro = strip_tags($_POST['sanPedro']);
		$santaCruz = strip_tags($_POST['santaCruz']);
		$santaRita = strip_tags($_POST['santaRita']);
		$tubac = strip_tags($_POST['tubac']);
		$tucson = strip_tags($_POST['tucson']);
		$unionKiva = strip_tags($_POST['unionKiva']);
		$ventana = strip_tags($_POST['ventana']);
		$venueOther = strip_tags($_POST['venueOther']);
		$venueDontKnow = strip_tags($_POST['venueDontKnow']);
		$otherVenueDesc = strip_tags($_POST['otherVenueDesc']);
		$banquet = strip_tags($_POST['banquet']);
		$reception = strip_tags($_POST['reception']);
		$theater = strip_tags($_POST['theater']);
		$classroom = strip_tags($_POST['classroom']);
		$hollowSquare = strip_tags($_POST['hollowSquare']);
		$uShape = strip_tags($_POST['uShape']);
		$setupOther = strip_tags($_POST['setupOther']);
		$setupDontKnow = strip_tags($_POST['setupDontKnow']);
		$otherSetupDesc = strip_tags($_POST['otherSetupDesc']);
		$breakout = strip_tags($_POST['breakout']);
		$breakoutNumber = strip_tags($_POST['breakoutNumber']);
		
			
		// initialize the response variable
		$response = "";
			
		require_once('order_online_3_validate.inc.php');
		
		if(!$response)
		{
			// register session variables
			$_SESSION['agave'] = $agave;
			$_SESSION['ballroom'] = $ballroom;
			$_SESSION['catalina'] = $catalina;
			$_SESSION['cholla'] = $cholla;
			$_SESSION['copper'] = $copper;
			$_SESSION['madera'] = $madera;
			$_SESSION['mesa'] = $mesa;
			$_SESSION['mesquite'] = $mesquite;
			$_SESSION['ocotillo'] = $ocotillo;
			$_SESSION['picacho'] = $picacho;
			$_SESSION['pima'] = $pima;
			$_SESSION['presidio'] = $presidio;
			$_SESSION['rincon'] = $rincon;
			$_SESSION['sabino'] = $sabino;
			$_SESSION['sanPedro'] = $sanPedro;
			$_SESSION['santaCruz'] = $santaCruz;
			$_SESSION['santaRita'] = $santaRita;
			$_SESSION['tubac'] = $tubac;
			$_SESSION['tucson'] = $tucson;
			$_SESSION['unionKiva'] = $unionKiva;
			$_SESSION['ventana'] = $ventana;
			$_SESSION['venueOther'] = $venueOther;
			$_SESSION['venueDontKnow'] = $venueDontKnow;
			$_SESSION['otherVenueDesc'] = $otherVenueDesc;
			$_SESSION['banquet'] = $banquet;
			$_SESSION['reception'] = $reception;
			$_SESSION['theater'] = $theater;
			$_SESSION['classroom'] = $classroom;
			$_SESSION['hollowSquare'] = $hollowSquare;
			$_SESSION['uShape'] = $uShape;
			$_SESSION['setupOther'] = $setupOther;
			$_SESSION['setupDontKnow'] = $setupDontKnow;
			$_SESSION['otherSetupDesc'] = $otherSetupDesc;
			$_SESSION['breakout'] = $breakout;
			$_SESSION['breakoutNumber'] = $breakoutNumber;
		}
	}
	else
	{
		// if we are going backward through the screens, we restore the variables
		
		// event information
		if (!isset($_POST['agave']))
		{
			if (isset($_SESSION['agave']))
			{
				$agave = strip_tags($_SESSION['agave']);
				if($agave) {
					$_POST['agave'] = strip_tags($_SESSION['agave']);
				}
			}
		}
		if (!isset($_POST['ballroom']))
		{
			if (isset($_SESSION['ballroom']))
			{
				$ballroom = strip_tags($_SESSION['ballroom']);
				if($ballroom) {
					$_POST['ballroom'] = strip_tags($_SESSION['ballroom']);
				}
			}
		}
		if (!isset($_POST['catalina']))
		{
			if (isset($_SESSION['catalina']))
			{
				$catalina = strip_tags($_SESSION['catalina']);
				if($catalina) {
					$_POST['catalina'] = strip_tags($_SESSION['catalina']);
				}
			}
		}
	    if (!isset($_POST['cholla']))
		{
			if (isset($_SESSION['cholla']))
			{
				$cholla = strip_tags($_SESSION['cholla']);
				if ($cholla) {
					$_POST['cholla'] = strip_tags($_SESSION['cholla']);
				}
			}
		}
		if (!isset($_POST['copper']))
		{
			if (isset($_SESSION['copper']))
			{
				$copper = strip_tags($_SESSION['copper']);
				if ($copper) {
					$_POST['copper'] = strip_tags($_SESSION['copper']);
				}
			}
		}
		if (!isset($_POST['madera']))
		{
			if (isset($_SESSION['madera']))
			{
				$madera = strip_tags($_SESSION['madera']);
				if($madera) {
					$_POST['madera'] = strip_tags($_SESSION['madera']);
				}
			}
		}
		if (!isset($_POST['mesa']))
		{
			if (isset($_SESSION['mesa']))
			{
				$mesa = strip_tags($_SESSION['mesa']);
				if ($mesa) {
					$_POST['mesa'] = strip_tags($_SESSION['mesa']);
				}
			}
		}
		if (!isset($_POST['mesquite']))
		{
			if (isset($_SESSION['mesquite']))
			{
				$mesquite = strip_tags($_SESSION['mesquite']);
				if($mesquite) {
					$_POST['mesquite'] = strip_tags($_SESSION['mesquite']);
				}
			}
		}
		if (!isset($_POST['ocotillo']))
		{
			if (isset($_SESSION['ocotillo']))
			{
				$ocotillo = strip_tags($_SESSION['ocotillo']);
				if ($ocotillo) {
					$_POST['ocotillo'] = strip_tags($_SESSION['ocotillo']);
				}
			}
		}
		if (!isset($_POST['picacho']))
		{
			if (isset($_SESSION['picacho']))
			{
				$picacho = strip_tags($_SESSION['picacho']);
				if ($picacho) {
					$_POST['picacho'] = strip_tags($_SESSION['picacho']);
				}
			}
		}
		if (!isset($_POST['pima']))
		{
			if (isset($_SESSION['pima']))
			{
				$pima = strip_tags($_SESSION['pima']);
				if ($pima) {
					$_POST['pima'] = strip_tags($_SESSION['pima']);
				}
			}
		}
		if (!isset($_POST['presidio']))
		{
			if (isset($_SESSION['presidio']))
			{
				$presidio = strip_tags($_SESSION['presidio']);
				if ($presidio) {
					$_POST['presidio'] = strip_tags($_SESSION['presidio']);
				}
			}
		}
		if (!isset($_POST['rincon']))
		{
			if (isset($_SESSION['rincon']))
			{
				$rincon = strip_tags($_SESSION['rincon']);
				if ($rincon) {
					$_POST['rincon'] = strip_tags($_SESSION['rincon']);
				}
			}
		}
		if (!isset($_POST['sabino']))
		{
			if (isset($_SESSION['sabino']))
			{
				$sabino = strip_tags($_SESSION['sabino']);
				if ($sabino) {
					$_POST['sabino'] = strip_tags($_SESSION['sabino']);
				}
			}
		}
		if (!isset($_POST['sanPedro']))
		{
			if (isset($_SESSION['sanPedro']))
			{
				$sanPedro = strip_tags($_SESSION['sanPedro']);
				if ($sanPedro) {
					$_POST['sanPedro'] = strip_tags($_SESSION['sanPedro']);
				}
			}
		}
		if (!isset($_POST['santaCruz']))
		{
			if (isset($_SESSION['santaCruz']))
			{
				$santaCruz = strip_tags($_SESSION['santaCruz']);
				if ($santaCruz) {
					$_POST['santaCruz'] = strip_tags($_SESSION['santaCruz']);
				}
			}
		}
		if (!isset($_POST['santaRita']))
		{
			if (isset($_SESSION['santaRita']))
			{
				$santaRita = strip_tags($_SESSION['santaRita']);
				if ($santaRita) {
					$_POST['santaRita'] = strip_tags($_SESSION['santaRita']);
				}
			}
		}
		if (!isset($_POST['tubac']))
		{
			if (isset($_SESSION['tubac']))
			{
				$tubac = strip_tags($_SESSION['tubac']);
				if ($tubac) {
					$_POST['tubac'] = strip_tags($_SESSION['tubac']);
				}
			}
		}
		if (!isset($_POST['tucson']))
		{
			if (isset($_SESSION['tucson']))
			{
				$tucson = strip_tags($_SESSION['tucson']);
				if ($tucson) {
					$_POST['tucson'] = strip_tags($_SESSION['tucson']);
				}
			}
		}
		if (!isset($_POST['unionKiva']))
		{
			if (isset($_SESSION['unionKiva']))
			{
				$unionKiva = strip_tags($_SESSION['unionKiva']);
				if ($unionKiva) {
					$_POST['unionKiva'] = strip_tags($_SESSION['unionKiva']);
				}
			}
		}
		if (!isset($_POST['ventana']))
		{
			if (isset($_SESSION['ventana']))
			{
				$ventana = strip_tags($_SESSION['ventana']);
				if ($ventana) {
					$_POST['ventana'] = strip_tags($_SESSION['ventana']);
				}
			}
		}
		if (!isset($_POST['venueOther']))
		{
			if (isset($_SESSION['venueOther']))
			{
				$venueOther = strip_tags($_SESSION['venueOther']);
				if ($venueOther) {
					$_POST['venueOther'] = strip_tags($_SESSION['venueOther']);
				}
			}
		}
		if (!isset($_POST['venueDontKnow']))
		{
			if (isset($_SESSION['venueDontKnow']))
			{
				$venueDontKnow = strip_tags($_SESSION['venueDontKnow']);
				if ($venueDontKnow) {
					$_POST['venueDontKnow'] = strip_tags($_SESSION['venueDontKnow']);
				}
			}
		}
		if (!isset($_POST['otherVenueDesc']))
		{
			if (isset($_SESSION['otherVenueDesc']))
			{
				$otherVenueDesc = strip_tags($_SESSION['otherVenueDesc']);
				$_POST['otherVenueDesc'] = strip_tags($_SESSION['otherVenueDesc']);
			}
		}
		if (!isset($_POST['banquet']))
		{
			if (isset($_SESSION['banquet']))
			{
				$banquet = strip_tags($_SESSION['banquet']);
				if ($banquet) {
					$_POST['banquet'] = strip_tags($_SESSION['banquet']);
				}
			}
		}
		if (!isset($_POST['reception']))
		{
			if (isset($_SESSION['reception']))
			{
				$reception = strip_tags($_SESSION['reception']);
				if ($reception) {
					$_POST['reception'] = strip_tags($_SESSION['reception']);
				}
			}
		}
		if (!isset($_POST['theater']))
		{
			if (isset($_SESSION['theater']))
			{
				$theater = strip_tags($_SESSION['theater']);
				if ($theater) {
					$_POST['theater'] = strip_tags($_SESSION['theater']);
				}
			}
		}
		if (!isset($_POST['classroom']))
		{
			if (isset($_SESSION['classroom']))
			{
				$classroom = strip_tags($_SESSION['classroom']);
				if ($classroom) {
					$_POST['classroom'] = strip_tags($_SESSION['classroom']);
				}
			}
		}
		if (!isset($_POST['hollowSquare']))
		{
			if (isset($_SESSION['hollowSquare']))
			{
				$hollowSquare = strip_tags($_SESSION['hollowSquare']);
				if ($hollowSquare) {
					$_POST['hollowSquare'] = strip_tags($_SESSION['hollowSquare']);
				}
			}
		}
		if (!isset($_POST['uShape']))
		{
			if (isset($_SESSION['uShape']))
			{
				$uShape = strip_tags($_SESSION['uShape']);
				if ($uShape) {
					$_POST['uShape'] = strip_tags($_SESSION['uShape']);
				}
			}
		}
		if (!isset($_POST['setupOther']))
		{
			if (isset($_SESSION['setupOther']))
			{
				$setupOther = strip_tags($_SESSION['setupOther']);
				if ($setupOther) {
					$_POST['setupOther'] = strip_tags($_SESSION['setupOther']);
				}
			}
		}
		if (!isset($_POST['setupDontKnow']))
		{
			if (isset($_SESSION['setupDontKnow']))
			{
				$setupDontKnow = strip_tags($_SESSION['setupDontKnow']);
				if ($setupDontKnow) {
					$_POST['setupDontKnow'] = strip_tags($_SESSION['setupDontKnow']);
				}
			}
		}
		if (!isset($_POST['otherSetupDesc']))
		{
			if (isset($_SESSION['otherSetupDesc']))
			{
				$otherSetupDesc = strip_tags($_SESSION['otherSetupDesc']);
				$_POST['otherSetupDesc'] = strip_tags($_SESSION['otherSetupDesc']);
			}
		}
		if (!isset($_POST['breakout'])) {
			if (isset($_SESSION['breakout'])) {
				$breakout = strip_tags($_SESSION['breakout']);
				if($breakout) {
					$_POST['breakout'] = strip_tags($_SESSION['breakout']);
				}
			}
		}
		if (!isset($_POST['breakoutNumber']))
		{
			if (isset($_SESSION['breakoutNumber']))
			{
				$breakoutNumber = strip_tags($_SESSION['breakoutNumber']);
				$_POST['breakoutNumber'] = strip_tags($_SESSION['breakoutNumber']);
			}
		}
	}
	
?>


	
<div id="center-col" >
	
	<?php 
	// if the submit button was clicked.
	if (isset($_POST['submit']))
	{
		// if there were no errors go to the next page.
		if(!$response)
	    { ?>
	    	
			<script type="text/javascript" >
					location.href="/catering/order_online_4.php";
			</script>

		<?php } else {
			// if there were errors, display them.
			echo "<h4 class='error-msg sub-nav-left-col'  >There were errors in processing the organization information.</h4><br />";
	
			echo "<p class='error-msg' > $response </p><br /><br />";
			
		}
	}?>
	
	<h2>Event Space Requirements:</h2> 
	
	<p class="top-minus50" style="margin-bottom: 1em;">
		Thank you for considering Arizona Catering for your event. Please complete this online form and one of our 
		Catering Sales Managers will contact you with a proposal.
	</p>
	 
	 
	<!-- the $_SERVER['PHP_SELF'] in the action field always posts back to the same form. -->
	<form class="top-minus10" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
		<h4>Preferred Event Venue (please select all that apply): </h4>
		<ul id="venue" style="list-style-type: none; margin-left: .1em; margin-bottom: 1em; line-height: 1.5em;">
			<li><input type="checkbox" id="agave" name="agave" title="Agave" value="yes"  <?php if(isset($_POST['agave'])) { echo "checked=\"checked\""; } ?> /> Agave</li>
			<li><input type="checkbox" id="ballroom" name="ballroom" title="Ballroom" value="yes"  <?php if(isset($_POST['ballroom'])) { echo "checked=\"checked\""; } ?> /> Ballroom</li>
			<li><input type="checkbox" id="catalina" name="catalina" title="Catalina" value="yes"  <?php if(isset($_POST['catalina'])) { echo "checked=\"checked\""; } ?> /> Catalina</li>
			<li><input type="checkbox" id="cholla" name="cholla" title="Cholla" value="yes"  <?php if(isset($_POST['cholla'])) { echo "checked=\"checked\""; } ?> /> Cholla</li>
			<li><input type="checkbox" id="copper" name="copper" title="Copper" value="yes"  <?php if(isset($_POST['copper'])) { echo "checked=\"checked\""; } ?> /> Copper</li>
			<li><input type="checkbox" id="madera" name="madera" title="Madera" value="yes"  <?php if(isset($_POST['madera'])) { echo "checked=\"checked\""; } ?> /> Madera</li>
			<li><input type="checkbox" id="mesa" name="mesa" title="Mesa" value="yes" <?php if(isset($_POST['mesa'])) { echo "checked=\"checked\""; } ?> /> Mesa</li>
			<li><input type="checkbox" id="mesquite" name="mesquite" title="Mesquite" value="yes"  <?php if(isset($_POST['mesquite'])) { echo "checked=\"checked\""; } ?> /> Mesquite</li>		
			<li><input type="checkbox" id="ocotillo" name="ocotillo" title="Ocotillo" value="yes" <?php if(isset($_POST['ocotillo'])) { echo "checked=\"checked\""; } ?> /> Ocotillo</li>
			<li><input type="checkbox" id="picacho" name="picacho" title="Picacho" value="yes" <?php if(isset($_POST['picacho'])) { echo "checked=\"checked\""; } ?> /> Picacho</li>
			<li><input type="checkbox" id="pima" name="pima" title="Pima" value="yes" <?php if(isset($_POST['pima'])) { echo "checked=\"checked\""; } ?> /> Pima</li>		
			<li><input type="checkbox" id="presidio" name="presidio" title="Presidio" value="yes" <?php if(isset($_POST['presidio'])) { echo "checked=\"checked\""; } ?> /> Presidio</li>
			<li><input type="checkbox" id="rincon" name="rincon" title="Rincon" value="yes" <?php if(isset($_POST['rincon'])) { echo "checked=\"checked\""; } ?> /> Rincon</li>
			<li><input type="checkbox" id="sabino" name="sabino" title="Sabino" value="yes" <?php if(isset($_POST['sabino'])) { echo "checked=\"checked\""; } ?> /> Sabino</li>
			<li><input type="checkbox" id="sanPedro" name="sanPedro" title="San Pedro" value="yes" <?php if(isset($_POST['sanPedro'])) { echo "checked=\"checked\""; } ?> /> San Pedro</li>
			<li><input type="checkbox" id="santaCruz" name="santaCruz" title="Santa Cruz" value="yes" <?php if(isset($_POST['santaCruz'])) { echo "checked=\"checked\""; } ?> /> Santa Cruz</li>
			<li><input type="checkbox" id="santaRita" name="santaRita" title="Santa Rita" value="yes" <?php if(isset($_POST['santaRita'])) { echo "checked=\"checked\""; } ?> /> Santa Rita</li>
			<li><input type="checkbox" id="tubac" name="tubac" title="Tubac" value="yes" <?php if(isset($_POST['tubac'])) { echo "checked=\"checked\""; } ?> /> Tubac</li>
			<li><input type="checkbox" id="tucson" name="tucson" title="Tucson" value="yes" <?php if(isset($_POST['tucson'])) { echo "checked=\"checked\""; } ?> /> Tucson</li>
			<li><input type="checkbox" id="unionKiva" name="unionKiva" title="Union Kiva" value="yes" <?php if(isset($_POST['unionKiva'])) { echo "checked=\"checked\""; } ?> /> Union Kiva</li>
			<li><input type="checkbox" id="ventana" name="ventana" title="ventana" value="yes" <?php if(isset($_POST['ventana'])) { echo "checked=\"checked\""; } ?> /> Ventana</li>
			<li><input type="checkbox" id="venueOther" name="venueOther" title="Other Venue" value="yes" <?php if(isset($_POST['venueOther'])) { echo "checked=\"checked\""; } ?> /> Other Campus Venue</li>
			<li><input type="checkbox" id="venueDontKnow" name="venueDontKnow" title="Don't Know" value="yes" <?php if(isset($_POST['venueDontKnow'])) { echo "checked=\"checked\""; } ?> /> Don't know at this time</li>
		</ul>
		<p id="otherVenuePara" style="margin-left: .25em; margin-top: .1em;">
		<label>If you selected "Other Campus Venue," please specify: <span class="req" >*</span></label><br />
		<input name="otherVenueDesc" type="text" id="otherVenueDesc" size="50" maxlength="50" value="<?php echo (isset($_POST['otherVenueDesc'])) ?  (($result) ? "" : $_POST['otherVenueDesc']) : ""; ?>" >
		</p>
		
		<h4>Preferred Room Setup (please select all that apply): </h4>
		<ul id="setup" style="list-style-type: none; margin-left: .1em; margin-bottom: 1em; line-height: 1.5em;">
			<li><input type="checkbox" id="banquet" name="banquet" title="Banquet" value="yes"  <?php if(isset($_POST['banquet'])) { echo "checked=\"checked\""; } ?> /> Banquet</li>
			<li><input type="checkbox" id="reception" name="reception" title="Reception" value="yes"  <?php if(isset($_POST['reception'])) { echo "checked=\"checked\""; } ?> /> Reception</li>
			<li><input type="checkbox" id="theater" name="theater" title="Theater-style" value="yes"  <?php if(isset($_POST['theater'])) { echo "checked=\"checked\""; } ?> /> Theater-style</li>
			<li><input type="checkbox" id="classroom" name="classroom" title="Classroom" value="yes"  <?php if(isset($_POST['classroom'])) { echo "checked=\"checked\""; } ?> /> Classroom</li>
			<li><input type="checkbox" id="hollowSquare" name="hollowSquare" title="Hollow Square" value="yes"  <?php if(isset($_POST['hollowSquare'])) { echo "checked=\"checked\""; } ?> /> Hollow Square</li>
			<li><input type="checkbox" id="uShape" name="uShape" title="U-Shape" value="yes"  <?php if(isset($_POST['uShape'])) { echo "checked=\"checked\""; } ?> /> U-Shape</li>
			<li><input type="checkbox" id="setupOther" name="setupOther" title="Other Setup" value="yes" <?php if(isset($_POST['setupOther'])) { echo "checked=\"checked\""; } ?> /> Other</li>
			<li><input type="checkbox" id="setupDontKnow" name="setupDontKnow" title="Don't Know" value="yes" <?php if(isset($_POST['setupDontKnow'])) { echo "checked=\"checked\""; } ?> /> Don't know at this time</li>
		</ul>
		<p id="otherSetupPara" style="margin-left: .25em; margin-top: .1em;">
		<label>If you selected "Other," please specify: <span class="req" >*</span></label><br />
		<input name="otherSetupDesc" type="text" id="otherSetupDesc" size="50" maxlength="50" value="<?php echo (isset($_POST['otherSetupDesc'])) ?  (($result) ? "" : $_POST['otherSetupDesc']) : ""; ?>" >
		</p>
		
		<h4>Will your event utilize breakout rooms? </h4>
		<ul style="list-style-type: none; margin-left: .1em; margin-bottom: 1em; line-height: 1.5em;" >
			<li><input type="radio" name="breakout" value="yes"  <?php if(isset($_POST['breakout'])) { if($_POST['breakout'] == "yes") { echo "checked=\"checked\""; }} ?> > Yes</li>
			<li><input type="radio" name="breakout" value="no"  <?php if(isset($_POST['breakout'])) { if($_POST['breakout'] == "no") { echo "checked=\"checked\""; }} ?> > No</li>
			<li><input type="radio" name="breakout" value="dontKnow"  <?php if(isset($_POST['breakout'])) { if($_POST['breakout'] == "dontKnow") { echo "checked=\"checked\""; }} ?> > Don't know at this time</li>
		</ul>
		<p id="breakoutPara" style="margin-left: .25em; margin-top: .1em;">
		<label>Number of breakout rooms needed:  <span class="req" >*</span></label><br />
		<input name="breakoutNumber" type="text" id="breakoutNumber" size="50" maxlength="50" value="<?php echo (isset($_POST['breakoutNumber'])) ?  (($result) ? "" : $_POST['breakoutNumber']) : ""; ?>" >
		</p>
		<br />
		
		
		<!-- the input with type submit, automatically posts the form to the server. -->
		<input type="button" id="previous" name="previous" value="previous" onclick="location.href='/catering/order_online_2.php';" >
		<input type="submit" name="submit" value="save and continue">
		<span class="left225 reg12">  3 of 4</span>
		<br /><br />
		
	</form>
	<br /><br />
</div>


<?php
require_once('catering_right_col.inc.php');
?>
</div>
		 
<div style="clear:both;">
	<br /><br /><br />
</div>

<?php page_finish(); ?>