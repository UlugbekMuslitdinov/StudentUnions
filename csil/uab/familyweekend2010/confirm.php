<?php
require_once 'template/fw.inc';
require_once 'events.inc';

//chech that session hasn't died
if($_SESSION['fw']['active_session'] != 1){
	$_SESSION['errors']['1'] = "We're sorry you session has timed out.";
	header("Location:reg.php");
}


//check if canceling registration
if($_POST['action']=='Cancel'){
	unset($_SESSION['fw']);			//unset saved variables
	header('Location:index.php');	//go back to lanfing page
}

////////////////////////////// ERROR CHECKING ///////////////////////////////////////////////////

//check if submitting previous page
else if(isset($_POST['action'])){
	$error_message = '';
	
	$_SESSION['fw']['xsmall'] = intval($_POST['xsmall']);
	$_SESSION['fw']['small'] = intval($_POST['small']);
	$_SESSION['fw']['medium'] = intval($_POST['medium']);
	$_SESSION['fw']['large'] = intval($_POST['large']);
	$_SESSION['fw']['xlarge'] = intval($_POST['xlarge']);
	$_SESSION['fw']['x2large'] = intval($_POST['x2large']);
	//var_dump($_SESSION['fw']['fri_events']);
		
	/*
	//check to see if any errors were found by seeing if the error message string is empty
	if(!empty($error_message)){
		$_SESSION['errors']['2'] = $error_message; 	//set the error message
		header("Location:select_package.php");					//take user back to reg page to fix errors
		exit();										//stop execution of this page
	}
	else{
		unset($_SESSION['errors']['2']);			//no errors were found make sure this is reflected in the session
	}
	*/
}


////////////////////////////// END ERROR CHECKING ///////////////////////////////////////////////////


//////////////////////////////Calculate Total Cost ///////////////////////////////////////////////////

$total = 0; 																										//start with 0 cost

$total += $reg_costs[$_SESSION['fw']['package_type']]*$_SESSION['fw']['num_guests']; 								//add guest registration costs

foreach($_SESSION['fw']['fri_events'] as $key => $value){
	$total += $fri_events[$key]['price']==''?0:$_SESSION['fw']['fri_events'][$key]*$fri_events[$key]['stu_cost'];	//add posssible friday event costs
}

foreach($_SESSION['fw']['sat_events'] as $key => $value){
	
	if($sat_events[$key]['stu_cost'] == $sat_events[$key]['guest_cost'])
		$total += $sat_events[$key]['price']==''?0:$_SESSION['fw']['sat_events'][$key]*$sat_events[$key]['stu_cost'];	//add posssible satday event costs
	else{
		$total += $_SESSION['fw']['sat_events'][$key]['student']*$sat_events[$key]['stu_cost'];
		$total += $_SESSION['fw']['sat_events'][$key]['guest']*$sat_events[$key]['guest_cost'];
	}
}

foreach($_SESSION['fw']['sun_events'] as $key => $value){
	if($sun_events[$key]['stu_cost'] == $sun_events[$key]['guest_cost'])
		$total += $sun_events[$key]['price']==''?0:$_SESSION['fw']['sun_events'][$key]*$sun_events[$key]['stu_cost'];	//add posssible sunday event costs
	else{
		$total += $_SESSION['fw']['sun_events'][$key]['student']*$sun_events[$key]['stu_cost'];
		$total += $_SESSION['fw']['sun_events'][$key]['guest']*$sun_events[$key]['guest_cost'];
	}
}

$total += $tshirt_cost*$_SESSION['fw']['xsmall'];																	//add xsmall tshirt costs

$total += $tshirt_cost*$_SESSION['fw']['small'];																	//add small tshirt costs

$total += $tshirt_cost*$_SESSION['fw']['medium'];																	//add medium tshirt costs

$total += $tshirt_cost*$_SESSION['fw']['large'];																	//add large tshirt costs

$total += $tshirt_cost*$_SESSION['fw']['xlarge'];																	//add xlarge tshirt costs

$total += $tshirt_cost*$_SESSION['fw']['x2large'];																	//add x2large tshirt costs

if($_SESSION['fw']['PlusParents'] == 1)
	$total -= 5;																									//if Parents Plus get $5 discount

$_SESSION['fw']['total'] = $total;																					//save total to session for payment page

//////////////////////////////End Calculate Total Cost ///////////////////////////////////////////////////
$_SESSION['fw']['stage'] = max($_SESSION['fw']['stage'], 6);

if(empty($_SERVER['HTTPS'])){
	header('Location:https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	exit();
}

fw_start('Confirm Selection', 0);
?>
<form action="payment.php" method="post">
<h1>Confirm your selections.</h1>
<table>
	<tbody>
		<tr>
			<td width="400"><h2>Registrations</h2></td>
			<td width="180"></td>
			<td width="100"><h2>Cost</h2></td>
		</tr>
		<tr>
			<td><h3>Students</h3></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			for($x=0; $x<$_SESSION['fw']['num_students']; $x++){
		?>
				<tr>
					<td><?=$_SESSION['fw']['student_first'][$x].' '.$_SESSION['fw']['student_last'][$x]?></td>
					<td></td>
					<td>Free</td>
				</tr>
		<?php
			} 
		?>
		<tr>
			<td><h3>Other Guests</h3></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			if($_SESSION['fw']['num_guests']==0){
		?>
			<tr>
				<td>You registered no guests.</td>
				<td></td>
				<td></td>
			</tr>
			
		<?php 
			}
		
			else{
		?>
			<?php 
				for($x=0; $x<$_SESSION['fw']['num_guests']; $x++){
			?>
					<tr>
						<td><?=$_SESSION['fw']['guest_first'][$x].' '.$_SESSION['fw']['guest_last'][$x]?></td>
						<td><?=$_SESSION['fw']['package_type']?></td>
						<td>$<?=$reg_costs[$_SESSION['fw']['package_type']]?></td>
					</tr>
			<?php
				} 
			?>
		<?php 
			}
		?>
		<tr>
			<td><h2>Events</h2></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><h3>Friday <input type="button" onclick="location='fri.php?edit=1'" value="Change Friday Selections"/></h3></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			if(sizeof($_SESSION['fw']['fri_events']) == 0){
		?>
			<tr>
				<td>You made no event selections for Friday.</td>
				<td></td>
				<td></td>
			</tr>
			
		<?php 
			}
		
			else{
		?>
			<?php 
				foreach($_SESSION['fw']['fri_events'] as $key => $value){
			?>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$fri_events[$key]['title']?></td>
					<td><?= $_SESSION['fw']['fri_events'][$key].' Attendees '?><?=$fri_events[$key]['price']==''?'':'@ $'.$fri_events[$key]['stu_cost']?></td>
					<td><?=$fri_events[$key]['price']==''?'Included':'$'.($_SESSION['fw']['fri_events'][$key]*$fri_events[$key]['stu_cost'])?></td>
				</tr>
			<?php 
				}
			?>
		<?php 
			}
		?>
		<tr>
			<td><h3>Saturday <input type="button" onclick="location='sat.php?edit=1'" value="Change Saturday Selections"/></h3></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			if(sizeof($_SESSION['fw']['sat_events']) == 0){
		?>
			<tr>
				<td>You made no event selections for Saturday.</td>
				<td></td>
				<td></td>
			</tr>
		<?php 
			}
		
			else{
		?>
			<?php 
				foreach($_SESSION['fw']['sat_events'] as $key => $value){
			?>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$sat_events[$key]['title']?></td>
					<td>
						<?php 
						if($sat_events[$key]['stu_cost']==$sat_events[$key]['guest_cost']){					
							print $_SESSION['fw']['sat_events'][$key].' Attendees '.($sat_events[$key]['price']==''?'':'@ $'.$sat_events[$key]['stu_cost']);
						}
						else{
							print $_SESSION['fw']['sat_events'][$key]['student'].' Students @ $'.$sat_events[$key]['stu_cost'].'<br />';
							print $_SESSION['fw']['sat_events'][$key]['guest'].' Guests @ $'.$sat_events[$key]['guest_cost'];
						}
						?>
					</td>
					<td>
						<?php 
						if($sat_events[$key]['stu_cost']==$sat_events[$key]['guest_cost']){
							print $sat_events[$key]['price']==''?'Included':'$'.($_SESSION['fw']['sat_events'][$key]*$sat_events[$key]['stu_cost']);
						}
						else{
							print '$'.($_SESSION['fw']['sat_events'][$key]['student']*$sat_events[$key]['stu_cost']).'<br />';
							print '$'.($_SESSION['fw']['sat_events'][$key]['guest']*$sat_events[$key]['guest_cost']).'<br />';
						}
						?>
					</td>
				</tr>
			<?php 
				}
			?>
		<?php 
			}
		?>
		<tr>
			<td><h3>Sunday <input type="button" onclick="location='sun.php?edit=1'" value="Change Sunday Selections"/></h3></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			if(sizeof($_SESSION['fw']['sun_events']) == 0){
		?>
			<tr>
				<td>You made no event selections for Sunday.</td>
				<td></td>
				<td></td>
			</tr>
		<?php 
			}
		
			else{
		?>
			<?php 
				foreach($_SESSION['fw']['sun_events'] as $key => $value){
			?>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$sun_events[$key]['title']?></td>
					<td>
						<?php 
						if($sun_events[$key]['stu_cost']==$sun_events[$key]['guest_cost']){					
							print $_SESSION['fw']['sun_events'][$key].' Attendees '.($sun_events[$key]['price']==''?'':'@ $'.$sun_events[$key]['stu_cost']);
						}
						else{
							print $_SESSION['fw']['sun_events'][$key]['student'].' Students @ $'.$sun_events[$key]['stu_cost'].'<br />';
							print $_SESSION['fw']['sun_events'][$key]['guest'].' Guests @ $'.$sun_events[$key]['guest_cost'];
						}
						?>
					</td>
					<td>
						<?php 
						if($sun_events[$key]['stu_cost']==$sun_events[$key]['guest_cost']){
							print $sun_events[$key]['price']==''?'included':'$'.($_SESSION['fw']['sun_events'][$key]*$sun_events[$key]['stu_cost']);
						}
						else{
							print '$'.($_SESSION['fw']['sun_events'][$key]['student']*$sun_events[$key]['stu_cost']).'<br />';
							print '$'.($_SESSION['fw']['sun_events'][$key]['guest']*$sun_events[$key]['guest_cost']).'<br />';
						}
						?>
					</td>
				</tr>
			<?php 
				}
			?>
		<?php 
			}
		?>
		<tr>
			<td><h2>T-Shirts <input type="button" onclick="location='tshirts.php?edit=1'" value="Change T-Shirt Selections"/></h2></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			if($_SESSION['fw']['xsmall']==0 && $_SESSION['fw']['small']==0 && $_SESSION['fw']['medium']==0 && $_SESSION['fw']['large']==0 && $_SESSION['fw']['xlarge']==0 && $_SESSION['fw']['x2large']==0){
		?>
			<tr>
				<td>You made no T-shirt selections.</td>
				<td></td>
				<td></td>
			</tr>
		<?php 
			}
		
			else{
		?>
			<?php if($_SESSION['fw']['xsmall'] != 0){?>
				<tr>
					<td>Kids Size 6</td>
					<td><?=$_SESSION['fw']['xsmall']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['xsmall']?></td>
				</tr>
			<?php }?>
			
			<?php if($_SESSION['fw']['small'] != 0){?>
				<tr>
					<td>Small</td>
					<td><?=$_SESSION['fw']['small']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['small']?></td>
				</tr>
			<?php }?>
			
			<?php if($_SESSION['fw']['medium'] != 0){?>
				<tr>
					<td>Medium</td>
					<td><?=$_SESSION['fw']['medium']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['medium']?></td>
				</tr>
			<?php }?>
			
			<?php if($_SESSION['fw']['large'] != 0){?>
				<tr>
					<td>Large</td>
					<td><?=$_SESSION['fw']['large']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['large']?></td>
				</tr>
			<?php }?>
			
			<?php if($_SESSION['fw']['xlarge'] != 0){?>
				<tr>
					<td>XL</td>
					<td><?=$_SESSION['fw']['xlarge']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['xlarge']?></td>
				</tr>
			<?php }?>
			
			<?php if($_SESSION['fw']['x2large'] != 0){?>
				<tr>
					<td>XXL</td>
					<td><?=$_SESSION['fw']['x2large']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['x2large']?></td>
				</tr>
			<?php }?>
		<?php }?>
		<?php if($_SESSION['fw']['PlusParents'] == 1){ ?>
		<tr>
			<td><h2>Parents Plus Discount</h2></td>
			<td></td>
			<td>-$5</td>
		</tr>
		<?php }?>		
		<tr>
			<td></td>
			<td style="font-size:16px;"><b>Total Cost:</b></td>
			<td style="font-size:16px;"><b>$<?=$total?></b></td>
		</tr>
	</tbody>
</table>

<div style="clear:both">
	<input type="submit" name="action" value="Save &amp; Continue" style="float:right;" /><input type="button" value="Back" onclick="location='tshirts.php'" />
</div> 
</form>
<?php 
fw_finish();
?>