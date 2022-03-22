<?php
if ($_POST['ident1'] == true) {
$sel1 = "checked";
}

if ($_POST['ident2'] == true) {
$sel2 = "checked";
}

if ($_POST['ident3'] == true) {
$sel3 = "checked";
}

if ($_POST['ident4'] == true) {
$sel4 = "checked";
}

if ($_POST['ident5'] == true) {
$sel5 = "checked";
}

if ($_POST['ident6'] == true) {
$sel6 = "checked";
}

if ($_POST['ident7'] == true) {
$sel7 = "checked";
}

if ($_POST['ident8'] == true) {
$sel8 = "checked";
}

if ($_POST['ident9'] == true) {
$sel9 = "checked";
}

if ($_POST['ident10'] == true) {
$sel10 = "checked";
}

if ($_POST['ident11'] == true) {
$sel11 = "checked";
}

if ($_POST['ident12'] == true) {
$sel12 = "checked";
}

if ($_POST['ident13'] == true) {
$sel13 = "checked";
}

if ($_POST['shuttle'] == "yes1") {
$shut1 = "checked";
}elseif ($_POST['shuttle'] == "yes2"){
$shut2 = "checked";
}elseif ($_POST['shuttle'] == "no"){
$shut3 = "checked";
}



$form2 ='
<form action="application.php" name="page2" method="post">

	<input type="hidden" name="page2_submitted" value="true">

	<h2>Please complete the below inventory in order for diverse teams to be created for the retreat.  This information is confidential and required for retreat activities; all privacy will be protected.</h2>
    
    	<p>
    		Date of Birth: <input type="text" name="DOB" size="11" maxlength="10" value="' . $_POST['DOB'] . '"/>  (MM/DD/YYYY) <br>
			Age (at time of retreat): <input type="text" name="age" size="3" maxlength="2" value="' . $_POST['age'] . '"/>
        </p>
    	<table style="color:#404965; font-family:Georgia, Verdana, Times New Roman, Times, serif; font-size:14px;">
        <tr>
			<td>I would identify my race/ethnicity as:</td>
            <td><input type="text" name="race" size="30" maxlength="50" value="' . $_POST['race'] . '"/></td>
        </tr>
        <tr>
			<td>I would identify my gender as:</td>
            <td><input type="text" name="gender" size="30" maxlength="50" value="' . $_POST['gender'] . '"/></td>
        </tr>
        <tr>
			<td>I would identify my religion as:</td>
            <td><input type="text" name="religion" size="30" maxlength="50" value="' . $_POST['religion'] . '"/></td>
        </tr>
        <tr>
			<td>I would identify my sexual orientation as:</td>
            <td><input type="text" name="orientation" size="30" maxlength="50" value="' . $_POST['orientation'] . '"/></td>
        </tr>
        <tr>
			<td>I would identify my socio-economic class as:</td>
            <td><input type="text" name="economic" size="30" maxlength="50" value="' . $_POST['economic'] . '"/></td>
        </tr>
        </table>
    	
        <p>
			<b>Please Check all that apply.</b><br /><br />
            <input type="checkbox" value="physical disability"			name="ident1" ' . $sel1 . '/>  I identify as having a physical disability.<br />
            <input type="checkbox" value="emotional disability" 		name="ident2" ' . $sel2 . '//>  I identify as having an emotional disability.<br />
            <input type="checkbox" value="learning disability"			name="ident3" ' . $sel3 . '//>  I identify as having a learning disability.<br />
            <input type="checkbox" value="seriously or terminally ill" 	name="ident4" ' . $sel4 . '//>  I identify as having been seriously or terminally ill.<br />
            <input type="checkbox" value="adopted or foster care" 		name="ident5" ' . $sel5 . '//>  I identify as adopted or as having been in to foster care system.<br />
            <input type="checkbox" value="English language learner" 	name="ident6" ' . $sel6 . '//>  I identify as an English language learner.<br />
            <input type="checkbox" value="veteran" 						name="ident7" ' . $sel7 . '//>  I identify as a veteran of the armed forces.<br />
            <input type="checkbox" value="immigrant"	 				name="ident8" ' . $sel8 . '//>  I identify as having immigrated to the United States.<br />
            <input type="checkbox" value="emancipated minor" 			name="ident9" ' . $sel9 . '//>  I identify as having been an emancipated minor.<br />
            <input type="checkbox" value="non-average body type"	 	name="ident10" ' . $sel10 . '//> I identify as having a body type that is not considered average by mainstream society.<br />
            <input type="checkbox" value="non-traditional college aged" name="ident11" ' . $sel11 . '//> I identify as being a non-traditional college aged student.<br />
            <input type="checkbox" value="parent" 						name="ident12" ' . $sel12 . '//> I identify as a parent.<br />
            <input type="checkbox" value="recovering alcoholic or drug" name="ident13" ' . $sel13 . '//> I identify as a recovering alcoholic or drug addict.<br />
   		</p>
        
    <h2>Shuttles</h2>
    	<p>Anyone needing transportation from The University of Arizona to the retreat site can pay an additional $10 through the online registration form to reserve a spot on the shuttle. This shuttle also includes return service to The University of Arizona. For those participants needing transportation from the airport to the retreat site and return transportation to The University of Arizona, the Tucson airport, or an airport hotel on Wednesday can pay an additional $20 through the online registration form to reserve a spot on the shuttle.</p>
            <p>$10 <input type="radio" name="shuttle" value="yes1"' . $shut1 . '/> Yes, I will need shuttle service from The University of Arizona ($10 per person).</p>
            <p>$20 <input type="radio" name="shuttle" value="yes2"' . $shut2 . '/> Yes, I will need shuttle service from the airport to the retreat site and return transportation to The University of Arizona, the Tucson airport or an airport hotel ($20 per person).</p>
            <p><input type="radio" name="shuttle" value="no"' . $shut3 . '/>  No, I will not need shuttle service and will be providing my own transportation. I agree that I am providing my own transportation to this event or am riding with another person and am responsible for my own risk involved in traveling to and from <a href="http://www.girlscoutssoaz.org/properties-rentals/whispering-pines/" target="_blank">the Whispering Pines Camp</a>. By selecting this option and submitting my registration online, I am releasing The University of Arizona from any risk associated with this transportation and the transportation of others in this vehicle.</p>
            	
    
     <input type="submit" value="Submit" />
    
</form>

';


function register_page2_variables() {

	$_SESSION['DOB']		= $_POST['DOB'];
	$_SESSION['age']		= $_POST['age'];
	$_SESSION['race'] 		= $_POST['race'];
	$_SESSION['gender'] 	= $_POST['gender'];
	$_SESSION['religion'] 	= $_POST['religion'];
	$_SESSION['orientation']= $_POST['orientation'];
	$_SESSION['economic']	= $_POST['economic'];

	
	$identities = array();
	
	if(isset($_POST['ident1'])) {
		array_push($identities, $_POST['ident1']);
	}
	if(isset($_POST['ident2'])) {
		array_push($identities, $_POST['ident2']);
	}
	if(isset($_POST['ident3'])) {
		array_push($identities, $_POST['ident3']);
	}
	if(isset($_POST['ident4'])) {
		array_push($identities, $_POST['ident4']);
	}
	if(isset($_POST['ident5'])) {
		array_push($identities, $_POST['ident5']);
	}
	if(isset($_POST['ident6'])) {
		array_push($identities, $_POST['ident6']);
	}
	if(isset($_POST['ident7'])) {
		array_push($identities, $_POST['ident7']);
	}
	if(isset($_POST['ident8'])) {
		array_push($identities, $_POST['ident8']);
	}
	if(isset($_POST['ident9'])) {
		array_push($identities, $_POST['ident9']);
	}
	if(isset($_POST['ident10'])) {
		array_push($identities, $_POST['ident10']);
	}
	if(isset($_POST['ident11'])) {
		array_push($identities, $_POST['ident11']);
	}
	if(isset($_POST['ident12'])) {
		array_push($identities, $_POST['ident12']);
	}
	if(isset($_POST['ident13'])) {
		array_push($identities, $_POST['ident13']);
	}
	
	$_SESSION['identities'] = $identities;
	
	$_SESSION['shuttle']	= $_POST['shuttle'];
	
}

function verify_page2_info() {
	
	$error_string = "";
	
	if($_POST['DOB'] == "") {
		$error_string = "Date of Birth is a required field.<br>";
	}
	
	if($_POST['age'] == "") {
		$error_string .= "You did not specify your age at the time of the retreat<br>";
	}
	
	if($_POST['race'] == "") {
		$error_string .= "You did not specify your race/ethnicity<br>";
	}
	
	if($_POST['gender'] == "") {
		$error_string .= "You did not specify your gender<br>";
	}
	
	if($_POST['religion'] == "") {
		$error_string .= "You did not specify your religion<br>";
	}
	
	if($_POST['orientation'] == "") {
		$error_string .= "You did not provide your sexual orientation<br>";
	}
	
	if($_POST['economic'] == "") {
		$error_string .= "You did not specify the socioeconomic class you define yourself as<br>";
	}
	
	if(!isset($_POST['shuttle'])) {
		$error_string .= "You did not indicate whether or not you will need to use the shuttle service<br>";
	}
	
	return $error_string;
}

?>