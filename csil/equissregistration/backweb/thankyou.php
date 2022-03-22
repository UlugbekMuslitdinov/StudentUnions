<?php
require_once('password_protect.php');
require_once('page_start.php');

	$_SESSION = clean_string($_SESSION);
	
	$query = "INSERT INTO registration SET"
			. " firstName = \"" 					. $_SESSION['firstName']
			. "\", lastName = \"" 					. $_SESSION['lastName']
			. "\", address = \"" 					. $_SESSION['address']
			. "\", city = \"" 						. $_SESSION['city']
			. "\", state = \"" 						. $_SESSION['state']
			. "\", ZIP = \"" 						. $_SESSION['zip']
			. "\", phoneNumber = \"" 				. $_SESSION['phone']
			. "\", cell = \"" 						. $_SESSION['cell']
			. "\", email = \"" 						. $_SESSION['email']
			. "\", school = \"" 					. $_SESSION['school']
			. "\", specdiet = \"" 					. $_SESSION['specdiet']
			. "\", specneeds = \"" 					. $_SESSION['specneeds']
			. "\", major = \"" 						. $_SESSION['major']
			. "\", career = \"" 					. $_SESSION['career']
			. "\", DOB = \"" 						. $_SESSION['DOB']
			. "\", age = \"" 						. $_SESSION['age'] 
			. "\", race = \"" 						. $_SESSION['race']
			. "\", gender = \"" 					. $_SESSION['gender']
			. "\", religion = \"" 					. $_SESSION['religion']
			. "\", orientation = \"" 				. $_SESSION['orientation']
			. "\", economic = \"" 					. $_SESSION['economic']
			. "\", shuttle = \"" 					. $_SESSION['shuttle']
			. "\", printedName = \"" 				. $_SESSION['printedName']
			. "\", sigDate = \"" 					. $_SESSION['sigDate']
			. "\", conditionsAgreement = \"" 		. $_SESSION['conditionsAgreement']
			. "\", q_1 = \"" 						. $_SESSION['q_one']
			. "\", q_2 = \"" 						. $_SESSION['q_two']
			. "\", q_3 = \"" 						. $_SESSION['q_three'] . "\"";

			
			$result = mysql_query($query, $DBlink);
			
			if(!$result) {
				print "<p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later. </p>";
			} else{
				
				//Get the id of the registration we just inserted
    			$result = mysql_query("SELECT MAX(id) AS maxid FROM registration");
    			$stuff = mysql_fetch_assoc($result);
						 			
				$idents = $_SESSION['identities'];
				$nid = count($idents);
					
				if($nid != 0) {
					//Save the Identify statements that were selected in "identities" table
					foreach($idents as $ix) {	
					
						$query = "INSERT INTO identities SET"
						. " reg_id = "			 				. $stuff['maxid']
						. ", identity_text = \"" 				. $ix . "\"";	
					
						$result = mysql_query($query, $DBlink);
					} 
				}
			
				//Save the payment information
				$query = "INSERT INTO payment SET"
				. " reg_id = "			 			. $stuff['maxid']
				. ", firstName = \"" 				. $_SESSION['firstName']
				. "\", lastName = \""				. $_SESSION['lastName']
				. "\", address = \""				. $_SESSION['address']
				. "\", city = \""					. $_SESSION['city']
				. "\", state = \""					. $_SESSION['state']
				. "\", zip = \""					. $_SESSION['zip']
				. "\", email = \""					. $_SESSION['email']
				. "\", phoneNumber = \""			. $_SESSION['phone']
				. "\", paymentID = \""			. $_SESSION['paymentID']
				. "\", total = "					. 199.00
				. ", status = \"approved\"";		
		
				//print $query;
		
				$result = mysql_query($query, $DBlink) or die(mysql_error());
			}
			
?>

<!--h1>Equiss Social Justice Retreat</h1-->

<p>Thank you for registering!<br />
Your information has been received!</p>


<?php 

session_destroy();

require_once('page_end.php');
?>