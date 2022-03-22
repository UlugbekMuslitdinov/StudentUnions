<div id="login-box">
<div id="login-wrapper" style="position:relative;">
<?php 
//check if mealplans is turned off currently
$query = "select * from control";
$result = db_query($query); 
$control = mysql_fetch_assoc($result);

if(!$control['online'] && $_SERVER['SCRIPT_NAME'] != '/mealplans/viewtransactions.php'){
  print '<p>'.$control['online_message'].'</p>';
}
//if user is not logged in display login options
else if(!isset($_SESSION['mp_cust']['id']) && !isset($_SESSION['5050mp_cust']['id'])){
?>
   
	<h1>LOG IN!</h1>
	<p>Add funds or check your plan balance&hellip;</p>
	<div id="login-buttons">
		<form action="login.php" method="get"><input type="hidden" value="netID" name="login_type" /><input type="image" src="template/images/LoginSignUp.png" value="netID Login" /></form>
		<p align="center">or</p>
		<form action="login.php" method="get"><input type="hidden" value="UAGuest" name="login_type" /><input type="image" src="template/images/GuestLogin.png" value="GuestAuth" /></form>
		<p id="form-login-btn" class="learn-more" onclick="this.parentNode.style.display='none'; document.guest_form.style.display='block';">No Guest Center or NetID?</p>
	</div>
	<form action="login.php" method="post" style="display:none; color:#ffffff;" name="guest_form">
		StudentID/EmplID<input type="text" name="sid" /><br />
		Patron Last Name<input type="text" name="last_name" /><br />
		<input type="hidden" value="Guest" name="login_type" />	<br />
		<input type="submit" value="Login" /><span class="learn-more" style="float:right;" onclick="this.parentNode.style.display='none'; document.getElementById('login-buttons').style.display='block';">Cancel</span>
	</form>
	
	 <!-- 
	<p>
		The meal plans application is down for the next couple of minutes for upgrades. Sorry for the inconvenience.
	</p>
	-->
<?php 
}
else{
	switch($_SESSION['mp_cust']['state']){
		case 'active':
?>
			<h1>HELLO!<a id="form-login-btn" href="index.php?logout=1" class="learn-more" style="font-size:11px; font-weight:bold;">Log out</a></h1>
			<?php 
			 if(strpos($_SERVER['REQUEST_URI'], '/mealplans/viewtransactions5050.php', 0) === false){
			    if($_SESSION['5050mp_cust']['id']){
			      print '<a href="/mealplans/viewtransactions.php" style="position:absolute; left:213px; top:20px;"><img src="template/images/mp_light_grn.png" /></a><a href="/mealplans/viewtransactions5050.php" style="position:absolute; left:213px; top:110px;"><img src="template/images/5050_light_gray.png" /></a>';
			    } 
			?>
			<p><?=$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname']?></p>
			<?
				// Swap Plus 6 and 7 plans due to BB ID reversal for 2013/14 year. Will fix in next year's updates so BB IDs agree with IDs in our MySQL mealplans DB.
				if ($_SESSION['mp_cust']['plan']['NAME'] == 'Plus 7') { 
					$plan = 'Plus 6';
					echo '<p>Plan: <b>' . $plan . '</b></p>';
				} else if ($_SESSION['mp_cust']['plan']['NAME'] == 'Plus 6') {
					$plan = 'Plus 7';
					echo '<p>Plan: <b>' . $plan . '</b></p>';
				} else {
					echo '<p>Plan: <b>' . $_SESSION['mp_cust']['plan']['NAME'] . '</b></p>';
				}
			?>
			<!--<p>Plan: <b>--><?//=$_SESSION['mp_cust']['plan']['NAME']?><!--</b></p>-->
			<!--<p>Plan Expires: <b><?=$_SESSION['mp_cust']['plan']['EXPIRES']?></b></p>-->
			<p>Balance: <span style="font-size:16px;"><b>$<?php printf("%0.2f",getBalanceForCustID($_SESSION['mp_cust']['id']))?></b></span></p>
            <p>&nbsp;</p>
			<div id="login-buttons" style="margin-top:0px;">
				<a href="deposit.php?new=1" rel="shadowbox;width=400;height=320"><input type="image" src="template/images/AddFunds.png" value="add funds" style="margin-bottom:5px;"/></a><br />
				<a style="float:right;" href=viewtransactions.php class="learn-more">Transaction History</a><br />
				<a style="float:right;" href="deactivate.php" class="learn-more">Deactivate Card</a>				
			</div>
			<?php
			}
      else{
        
            print '<a href="/mealplans/viewtransactions.php" style="position:absolute; left:213px; top:20px;"><img src="template/images/mp_light_gray.png" /></a><a href="/mealplans/viewtransactions5050.php" style="position:absolute; left:213px; top:110px;"><img src="template/images/5050_light_grn.png" /></a>';
          
      ?>
      <p><?=$_SESSION['5050mp_cust']['firstname'].' '.$_SESSION['5050mp_cust']['lastname']?></p>
      <p>Plan: <b><?=$_SESSION['5050mp_cust']['plan']['NAME']?></b></p>
      <!--<p>Plan Expires: <b><?=$_SESSION['5050mp_cust']['plan']['EXPIRES']?></b></p>-->
      <p>Balance: <span style="font-size:16px;"><b>$<?php printf("%0.2f",getBalanceForCustID($_SESSION['5050mp_cust']['id']))?></b></span></p>
      <div id="login-buttons" style="margin-top:0px;">
        <a href="deposit5050.php?new=1" rel="shadowbox;width=400;height=320"><input type="image" src="template/images/AddFunds.png" value="add funds" style="margin-bottom:5px;"/></a><br />
        <a style="float:right;" href=viewtransactions5050.php class="learn-more">Transaction History</a>
      </div>
      <?php
      }
      ?>
<?php 
		break;
		case 'deactive':
?>
			<h1>HELLO!<a id="form-login-btn" href="index.php?logout=1" class="learn-more"  style="font-size:11px; font-weight:bold;">Log out</a></h1>
			<p><?=$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname']?></p>
			<?
				// Swap Plus 6 and 7 plans due to BB ID reversal for 2013/14 year. Will fix in next year's updates so BB IDs agree with IDs in our MySQL mealplans DB.
				if ($_SESSION['mp_cust']['plan']['NAME'] == 'Plus 7') { 
					$plan = 'Plus 6';
					echo '<p>Plan: <b>' . $plan . '</b></p>';
				} else if ($_SESSION['mp_cust']['plan']['NAME'] == 'Plus 6') {
					$plan = 'Plus 7';
					echo '<p>Plan: <b>' . $plan . '</b></p>';
				} else {
					echo '<p>Plan: <b>' . $_SESSION['mp_cust']['plan']['NAME'] . '</b></p>';
				}
			?>
			<!--<p>Plan: <b>--><?//=$_SESSION['mp_cust']['plan']['NAME']?><!--</b></p>-->
			<!--<p>Plan Expires: <b><?=$_SESSION['mp_cust']['plan']['EXPIRES']?></b></p>-->
			<p>Balance: <span style="font-size:16px;"><b>$<?php printf("%0.2f",getBalanceForCustID($_SESSION['mp_cust']['id']))?></b></span></p>
			<div id="login-buttons" style="margin-top:0px;">
				<form action="deactivate.php" method="post"><input type="image" src="template/images/reactivate_btn.jpg" value="activate" name="activate" style="margin-bottom:5px;" /><input type="hidden" name="activate" value="1" /></form>
	
				<a style="float:right;" href=viewtransactions.php class="learn-more">Transaction History</a>
			</div>
<?php 			
		break;
		case 'pending':
?>
			<h1>HELLO!<a id="form-login-btn" href="index.php?logout=1" class="learn-more">Log out</a></h1>
			<p><?=$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname']?></p>
			<p>Your meal plan sign up is still pending</p>
<?php 	
		break;
		
		case 'deposit':
?>
			<h1>HELLO!<a id="form-login-btn" href="index.php?logout=1" class="learn-more">Log out</a></h1>
			<p>Guest of <?=$_SESSION['mp_cust']['firstname'].' '.$_SESSION['mp_cust']['lastname']?></p>
<?php 				
		break;	
		
    case '50/50':
       print '<a href="/mealplans/chooseplan.php" style="position:absolute; left:214px; top:20px;"><img src="template/images/5050tab.png" /></a>';
          
      ?>
      <h1>HELLO!<a id="form-login-btn" href="index.php?logout=1" class="learn-more">Log out</a></h1>
      <p><?=$_SESSION['5050mp_cust']['firstname'].' '.$_SESSION['5050mp_cust']['lastname']?></p>
      <p>Plan: <b><?=$_SESSION['5050mp_cust']['plan']['NAME']?></b></p>
      <!--<p>Plan Expires: <b><?=$_SESSION['5050mp_cust']['plan']['EXPIRES']?></b></p>-->
      <p>Balance: <span style="font-size:16px;"><b>$<?php printf("%0.2f",getBalanceForCustID($_SESSION['5050mp_cust']['id']))?></b></span></p>
      
      <p>&nbsp;</p>
      <div id="login-buttons" style="margin-top:0px;">
        <a href="deposit5050.php?new=1" rel="shadowbox;width=400;height=320"><input type="image" src="template/images/AddFunds.png" value="add funds" style="margin-bottom:5px;"/></a><br />
        <a style="float:right;" href=viewtransactions5050.php class="learn-more">Transaction History</a>
      </div>
     <?php
    break;     
	}
  
	
	
?>
	
<?php 
}
?>
</div>
</div>