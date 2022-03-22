<?php
$form1 ='
<form action="application.php" name="page1" method="post">

	<input type="hidden" name="page1_submitted" value="true">

	<h2>Personal Information</h2>
    	<table style="color:#404965; font-family:Georgia, Verdana, Times New Roman, Times, serif; font-size:14px;">
        <tr>
			<td>First Name:</td>
        	<td><input type="text" name="firstName" size="20" maxlength="30" value="' . $_POST['firstName'] . '"/></td>
      		<td>Last Name: <input type"text" name="lastName" size="20" maxlength="40" value="' . $_POST['lastName'] . '"/></td>
        </tr>
        <tr>
			<td>Address:</td>
        	<td colspan="2"><input type="text" name="address" size="53" maxlength="75" value="' . $_POST['address'] . '"/></td>
        </tr>
        <tr>
			<td>City:</td>
        	<td colspan="2"><input type="text" name="city" size="53" maxlength="40"  value="' . $_POST['city'] . '"/></td>
        </tr>
        <tr>
            <td>State:</td>
            <td><select name="state"> 
					<option value="AL">Alabama</option> 
					<option value="AK">Alaska</option> 
					<option value="AZ">Arizona</option> 
					<option value="AR">Arkansas</option> 
					<option value="CA">California</option> 
					<option value="CO">Colorado</option> 
					<option value="CT">Connecticut</option> 
					<option value="DE">Delaware</option> 
					<option value="DC">District Of Columbia</option> 
					<option value="FL">Florida</option> 
					<option value="GA">Georgia</option> 
					<option value="HI">Hawaii</option> 
					<option value="ID">Idaho</option> 
					<option value="IL">Illinois</option> 
					<option value="IN">Indiana</option> 
					<option value="IA">Iowa</option> 
					<option value="KS">Kansas</option> 
					<option value="KY">Kentucky</option> 
					<option value="LA">Louisiana</option> 
					<option value="ME">Maine</option> 
					<option value="MD">Maryland</option> 
					<option value="MA">Massachusetts</option> 
					<option value="MI">Michigan</option> 
					<option value="MN">Minnesota</option> 
					<option value="MS">Mississippi</option> 
					<option value="MO">Missouri</option> 
					<option value="MT">Montana</option> 
					<option value="NE">Nebraska</option> 
					<option value="NV">Nevada</option> 
					<option value="NH">New Hampshire</option> 
					<option value="NJ">New Jersey</option> 
					<option value="NM">New Mexico</option> 
					<option value="NY">New York</option> 
					<option value="NC">North Carolina</option> 
					<option value="ND">North Dakota</option> 
					<option value="OH">Ohio</option> 
					<option value="OK">Oklahoma</option> 
					<option value="OR">Oregon</option> 
					<option value="PA">Pennsylvania</option> 
					<option value="RI">Rhode Island</option> 
					<option value="SC">South Carolina</option> 
					<option value="SD">South Dakota</option> 
					<option value="TN">Tennessee</option> 
					<option value="TX">Texas</option> 
					<option value="UT">Utah</option> 
					<option value="VT">Vermont</option> 
					<option value="VA">Virginia</option> 
					<option value="WA">Washington</option> 
					<option value="WV">West Virginia</option> 
					<option value="WI">Wisconsin</option> 
					<option value="WY">Wyoming</option>
				</select>
             </td>
             <td>Zip: <input type="text" name="zip" size="6" maxlength="5" value="' . $_POST['zip'] . '" /></td>
        </tr>
        <tr>
			<td>Phone Number:</td>
        	<td><input type="text" name="phone" size="13" maxlength="12" value="' . $_POST['phone'] . '" /></td>
            <td>Cell Number:<input type="text" name="cell" size="13" maxlength="12" value="' . $_POST['cell'] . '"/></td>
        </tr>
        <tr>
			<td>Email:</td>
        	<td colspan="2"><input type="text" name="email" size="53" maxlength="75" value="' . $_POST['email'] . '"/></td>
        </tr>
        <tr>
			<td>College/University:</td>
        	<td colspan="2"><input type="text" name="school" size="53" maxlength="75" value="' . $_POST['school'] . '"/></td>
        </tr>
		<tr>
			<td>Dietary Needs:</td>
			<td colspan="2"><input type="text" name="specdiet" size="53" maxlength="75" value="' . $_POST['specdiet'] . '"/></td>
		</tr>
		<tr>
			<td>Disability Accommodations:</td>
			<td colspan="2"><input type="text" name="specneeds" size="53" maxlength="75" value="' . $_POST['specneeds'] . '"/></td>
		</tr>
		<tr>
			<td>Undergraduate Major:</td>
			<td colspan="2"><input type="text" name="major" size="53" maxlength="75" value="' . $_POST['major'] . '"/></td>
		</tr>
		<tr>
			<td>Career Aspiration as Undergrad:</td>
			<td colspan="2"><input type="text" name="career" size="53" maxlength="75" value="' . $_POST['career'] . '"/></td>
		</tr>
			
       
        </table>
		
	
    
    <h2>Please answer the following questions as thoroughly as possible:<br />
    	<span style="font-size:11px;">1800 characters or less for each answer please.</span>
    </h2>
    <p>
    	1. How do you define culture?  And how does culture shape the way you see leadership?<br />
     	<textarea name="q_one" id="q_one_textarea" cols="70" rows="8" onkeyup="textLimit(this.form.q_one_textarea, 1800);">' . $_POST['q_one'] . '</textarea>
    </p>
    <p>
      	2. Why do humans make assumptions? How do assumptions and stereotypes perpetuate oppression?<br />
        <textarea name="q_two" id="q_two_textarea" cols="70" rows="8" onkeyup="textLimit(this.form.q_two_textarea, 1800);">' . $_POST['q_two'] . '</textarea>
    </p>
    <p>
      	3. Please respond to the following statement: "Multiculturalism is conflict."<br />
        <textarea name="q_three" id="q_three_textarea" cols="70" rows="8" onkeyup="textLimit(this.form.q_three_textarea, 1800);">' . $_POST['q_three'] . '</textarea>
    </p>
    
    <input type="submit" value="Submit" />
</form>';

function register_page1_variables() {

	$_SESSION['firstName']	= $_POST['firstName'];
	$_SESSION['lastName'] 	= $_POST['lastName'];
	$_SESSION['address'] 	= $_POST['address'];
	$_SESSION['city'] 		= $_POST['city'];
	$_SESSION['state']		= $_POST['state'];
	$_SESSION['zip']		= $_POST['zip'];
	$_SESSION['phone']		= $_POST['phone'];
	$_SESSION['cell']		= $_POST['cell'];
	$_SESSION['email']		= $_POST['email'];
	$_SESSION['school']		= $_POST['school'];
	
	$_SESSION['specdiet']	= $_POST['specdiet'];
	$_SESSION['specneeds']	= $_POST['specneeds'];
	$_SESSION['major']		= $_POST['major'];
	$_SESSION['career']		= $_POST['career'];
	
	$_SESSION['q_one']		= $_POST['q_one'];
	$_SESSION['q_two']		= $_POST['q_two'];
	$_SESSION['q_three']	= $_POST['q_three'];
	
}

function verify_personal_info() {
	
	$error_string = "";
	
	if($_POST['firstName'] == "") {
		$error_string = "First Name is a required field.<br>";
	}
	
	if($_POST['lastName'] == "") {
		$error_string .= "Last Name is a required field.<br>";
	}
	
	if($_POST['address'] == "") {
		$error_string .= "Address is a required field.<br>";
	}
	
	if($_POST['city'] == "") {
		$error_string .= "City is a required field.<br>";
	}
	
	if($_POST['state'] == "") {
		$error_string .= "State is a required field.<br>";
	}
	
	if($_POST['zip'] == "") {
		$error_string .= "Zip is a required field.<br>";
	}
	
	if($_POST['phone'] == "") {
		$error_string .= "Phone Number is a required field.<br>";
	}
	
	if($_POST['email'] == "") {
		$error_string .= "Email is a required field.<br>";
	}
	
	if($_POST['school'] == "") {
		$error_string .= "College/Univ is a required field.<br>";
	}
	
	return $error_string;
}

function verify_questions() {

	$error_string = "";
	
	if($_POST['q_one'] == "") {
		$error_string = "You did not answer question #1.  It is required. <br>";
	}elseif(strlen($_POST['q_one']) > 1800) {
		$error_string = "Your answer to question #1 was longer then 1800 characters.  Please revise. <br>";
	}
	
	if($_POST['q_two'] == "") {
		$error_string .= "You did not answer question #2.  It is required. <br>";
	}elseif(strlen($_POST['q_two']) > 1800) {
		$error_string .= "Your answer to question #2 was longer then 1800 characters.  Please revise. <br>";
	}
	
	if($_POST['q_three'] == "") {
		$error_string .= "You did not answer question #3.  It is required. <br>";
	}elseif(strlen($_POST['q_three']) > 1800) {
		$error_string .= "Your answer to question #3 was longer then 1800 characters.  Please revise. <br>";
	}
	
	return $error_string;

}

?>
