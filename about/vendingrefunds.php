<?php
  session_start();
  require_once('about.inc');
  require_once ('includes/mysqli.inc');
  
  $page_options['title'] = 'Vending Machine Refund Request';
  $page_options['page'] = 'mission'; 
  about_start($page_options);
?>
    
 <script type="text/javascript">
 
 function show_form(){
 document.getElementById('initial').style.display = "none";
 
 document.getElementById('form1').style.display = "block";
 
 if(document.getElementById('type1').value=="employee"){
  document.getElementById('workplace').style.display = "block";
 }

 
 
 }
 
 </script>
    <style type="text/css">
	.form_holder{
width:600px;
float:left;
margin:auto 0;
padding:0;
border:0;
}
.form_line{
width:600px;
float:left;
margin: 0 0 10px 0;
color:#003366;
font-family:arial, san-serfi;
font-size:10px;
font-weight:bold;
}

.error_msgs{
color:red;
padding-bottom:15px;
}

#form1{
display:none;
}

#workplace{
display:none;
}
</style>
<?php
$error = false;



if(isset($_POST['submitted'])){


	
	if((!isset($_POST['name']) || $_POST['name'] == "") && (!isset($_SESSION['name']))){
		$error = true;
    	$error_str = "Your Name is required. <br>";
	}
	else if(isset($_POST['name'])){
		$_SESSION['name']= $_POST['name'];
	}
	
	
  if($_POST['type1']=="employee"){	
  	if((!isset($_POST['add']) || $_POST['add'] == "") && (!isset($_SESSION['add']))){
  		$error = true;
      	$error_str .= "Your address is required. <br>";
  	}
  	else if(isset($_POST['add'])){
  		$_SESSION['add']		= $_POST['add'];
  	}
  }
	
	if((!isset($_POST['email']) || $_POST['email'] == "") && (!isset($_SESSION['email']))){
		$error = true;
    	$error_str .= "Your email is required. <br>";
	}
	else if(isset($_POST['email'])){
		$_SESSION['email']		= $_POST['email'];
	}
	if((!isset($_POST['phone']) || $_POST['phone'] == "") && (!isset($_SESSION['phone']))){
		$error = true;
    	$error_str .= "Your phone number is required. <br>";
	}
	else if(isset($_POST['phone'])){
		$_SESSION['phone'] 		= $_POST['phone'];
	}
	if((!isset($_POST['location']) || $_POST['location'] == "") && (!isset($_SESSION['location']))){
		$error = true;
    	$error_str .= "The location of the vending machine is required. <br>";
	}
	else if(isset($_POST['location'])){
	$_SESSION['location'] 	= $_POST['location'];
	}
	if((!isset($_POST['problem']) || $_POST['problem'] == "") && (!isset($_SESSION['problem']))){
		$error = true;
    	$error_str .= "Please let us know the problem you had with the vending machine. <br>";
	}
	else if(isset($_POST['problem'])){
	$_SESSION['problem'] 	= $_POST['problem'];
	}
	if((!isset($_POST['product']) || $_POST['product'] == "") && (!isset($_SESSION['product']))){
		$error = true;
    	$error_str .= "Please let us know what product you were trying to purchase. <br>";
	}
	else if(isset($_POST['product'])){
	$_SESSION['product'] 	= $_POST['product'];
	}
	if((!isset($_POST['amount']) || $_POST['amount'] == "") && (!isset($_SESSION['amount']))){
		$error = true;
    	$error_str .= "Please let us know the amount you lost. <br>";
	}
	else if(isset($_POST['amount'])){
	$_SESSION['amount'] 	= $_POST['amount'];
	}
			
} //end if form was submitted


//if no errors and form was submitted save data and send appropriate emails
if(!$error&& isset($_POST['submitted'])){
	
	require_once('phplib/mimemail/htmlMimeMail5.php');
  $mail = new htmlMimeMail5();
 

  //Set the From and Reply-To headers
  $mail->setFrom('Arizona Student Union<no-reply@email.arizona.edu>');
  $mail->setReturnPath('no-reply@email.arizona.edu');
  
  //Set the subject
  $mail->setSubject('Vending Refund Request');
  
  
  
  $body = "<h2>Vending Refund Request:</h2><br>";
  
  $body .= 
  			 "<br> name : " 					. $_POST['name']
  			. "<br> email : " 					. $_POST['email']
  			. "<br> amount : " 					. $_POST['amount']
  			. "<br> product : " 					. $_POST['product'];
  			if(isset($_POST['add'])){
  			$body .=
  			 "<br> address : " 					. $_POST['add'];
  			 }
  			$body .=
  			 "<br> phone : " 						. $_POST['phone']
  			. "<br> location : " 						. $_POST['location']
  			. "<br> type : "					. $_POST['type']
  			. "<br> problem : " 					. $_POST['problem']
  			. "<br> class : " 					. $_POST['type1']
  			."";
  
  
  
  $mail->setHTML($body);
  if($_POST['type']==soda){
  //$result=$mail->send(array('mealplan@email.arizona.edu', 'baedwards@cokecce.com', 'aurias@cokecce.com'));
  //$result=$mail->send(array('kbeyer@email.arizona.edu'));
  }
  else{
  //$result=$mail->send(array('mealplan@email.arizona.edu', 'todd@tomdra.com'));
  }

	$db = new db_mysqli('vendingrefunds');
	
		
	
	$query = "INSERT INTO vendingrefunds SET"
			. "   name = '" 					  .$db->escape($_POST['name'], 50)
			. "', email = '" 					  .$db->escape($_POST['email'], 50)
			. "', date = '" 					  .date("Y-m-d")
			. "', amount = '" 					.$db->escape($_POST['amount'], 10)
			. "', product = '" 					.$db->escape($_POST['product'], 20)
			. "', address = '" 					.$db->escape($_POST['add'], 50)
			. "', phone = '" 						.$db->escape($_POST['phone'], 15)
			. "', location = '" 				.$db->escape($_POST['location'], 20)
			. "', type = '"					    .$db->escape($_POST['type'], 20)
			. "', dateresolved = '"     .'-'
			. "', reimbursed = '"       .'-'
			. "', refunded = '"         .'-0'
			. "', problem = '" 					.$db->escape($_POST['problem'], 100)
			. "', class = '" 					  .$db->escape($_POST['type1'], 20)
			."'";
			
			$result = $db->query($query);
			
			if(!$result) {
				print "<p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later. </p>";
			}
			else{
			print '<h2>Thank you for submitting your refund request.</h2>';
			
			/*
			if($_POST['type1']=="student"){
			print '<h1>Please stop by the Meal Plans office to pick up your refund.</h1>';
			}
			else */ if($_POST['type1']=="employee"){
			print '<h2>Your refund will be delivered to you at work via U. of A. mail system.</h2>';
			}
			else{
			print '<h2>Please stop by the Meal Plans office to pick up your refund.</h2>';
			}
			}
			session_destroy();
			
	
	
	}
	else{
	
	
	
	
	
	
	
	
	
	
	if($error){
		echo "We encountered the following errors:<br><br>";
		echo '<div class="error_msgs">';
		echo $error_str;
		echo '</div>';
		$_SESSION['type1']=$_POST['type1'];
	
}
print '

	
	
	



<h2>Vending Refund Request Form</h2>



<form method="post" action="vendingrefunds.php" id="rform">
<div id="initial" style="display:block;">
Are You a <select name="type1" onchange="show_form();" id="type1" >
<option>Please choose</option>
<option value="student"'; if($_SESSION['type1']=="student"){print "selected";} print '>UA student</option>
<option value="employee"'; if($_SESSION['type1']=="employee"){print "selected";} print '>UA employee</option>
<option value="visitor"'; if($_SESSION['type1']=="visitor"){print "selected";} print '>Visitor</option>
</select>
</div>
<div id="form1">
<div class="form_line">
    	Name:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" width="40" maxlength="50" value="'. htmlentities($_SESSION['name']).'" />    	
    </div>
<div class="form_line">
    	Email:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email" width="40" maxlength="50" value="'. htmlentities($_SESSION['email']).'" />    	
    </div>
	<span id="workplace">
<div class="form_line">
    	Work&nbsp;Address:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="add" width="40" maxlength="50" value="'.htmlentities($_SESSION['add']).'" />    	
    </div></span>
	
<div class="form_line">
    	Phone number:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="phone" width="40" maxlength="15" value="'.htmlentities($_SESSION['phone']).'" />    	
    </div>
 <div class="form_line">
    	Type of vending machine:&nbsp;&nbsp;&nbsp;&nbsp;<select name="type">
        	<option value="soda" selected="selected">soda machine</option>
        	<option value="snack"'; if($_SESSION['type']=="snack"){print "selected";} print '>snack machine</option>
            </select>        	  	
    </div>
	<div class="form_line">
    	Item being purchased:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="product" width="40" maxlength="20" value="'.htmlentities($_SESSION['product']).'" />    	
    </div>
	    <div class="form_line">
    	Amount lost:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="amount" width="40" maxlength="10" value="'.htmlentities($_SESSION['amount']).'" />   	
    </div>
    
    <div class="form_line">
    	Location of vending machine:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="location" width="40" maxlength="20" value="'.htmlentities($_SESSION['location']).'" />    	
    </div>
    
   
    
    <div class="form_line">
    	Problem with vending machine:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="problem" width="40" maxlength="100" value="'.htmlentities($_SESSION['problem']).'" />    	
    </div>
    <input type="hidden" name="submitted" value="submitted">
    <div class="form_line">
    <input type="submit" value="submit">
	</div>
</form>';

if(isset($_SESSION['type1'])){
print '

<script type="text/javascript">
show_form();
</script>';
}




}
 about_finish(); ?>