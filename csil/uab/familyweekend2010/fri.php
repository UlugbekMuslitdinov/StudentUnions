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
	
	if($_POST['package_type']=='Basic Package')
		$_SESSION['fw']['package_type'] = 'Basic Package';
	else
		$_SESSION['fw']['package_type'] = 'Premium Package';
		
	
	//check to see if any errors were found by seeing if the error message string is empty
	if(!empty($error_message)){
		$_SESSION['errors']['2'] = $error_message; 	//set the error message
		header("Location:select_package.php");					//take user back to reg page to fix errors
		exit();										//stop execution of this page
	}
	else{
		unset($_SESSION['errors']['2']);			//no errors were found make sure this is reflected in the session
	}
}


////////////////////////////// END ERROR CHECKING ///////////////////////////////////////////////////
$_SESSION['fw']['stage'] = max($_SESSION['fw']['stage'], 2);

if(empty($_SERVER['HTTPS'])){
	header('Location:https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	exit();
}


fw_start('Friday Events', 0);
?>
<script>
	function displayNumBox(visible, id){
		if(visible.checked){
			document.getElementById('label_'+id).style.visibility = 'visible';
			document.getElementById('atten_sel_'+id).style.visibility = 'visible';
		}
		else{
			document.getElementById('label_'+id).style.visibility = 'hidden';
			document.getElementById('atten_sel_'+id).style.visibility = 'hidden';
		}
	}
</script>
<form action="sat.php" method="post">
	<h1>Select the events you plan to attend</h1>
	<h2>Friday Events</h2>
	<table>
		<tbody>
		<?php 
			for($x=0; $x < sizeof($fri_events); $x++){		
		?>
			<tr valign="top">
				<td>
				<?php if($fri_events[$x]['reg_enabled']){?>
						<input type="checkbox" style="text-align:right" name="event_selected[<?=$x?>]" value="1" onClick="displayNumBox(this, <?=$x?>)" <?=$_SESSION['fw']['fri_events'][$x]?'checked':''?>/><br>
						<label id="label_<?=$x?>" style="visibility:<?=$_SESSION['fw']['fri_events'][$x]?'visible':'hidden'?>" for="event_attendance_<?=$x?>">number of <br>attendees 
						<select id="atten_sel_<?=$x?>" style="visibility:<?=$_SESSION['fw']['fri_events'][$x]?'visible':'hidden'?>" name="event_attendance[<?=$x?>]" >
							<?php 
							for($i=1; $i<($_SESSION['fw']['num_students']+$_SESSION['fw']['num_guests']); $i++)
								print '<option value="'.$i.'" '.($_SESSION['fw']['fri_events'][$x] == $i?'selected':'').'>'.$i.'</option>';
	
								print '<option value="'.$i.'" '.(!isset($_SESSION['fw']['fri_events'][$x]) || $_SESSION['fw']['fri_events'][$x] == $i?'selected':'').'>'.$i.'</option>';
							?>
						</select>
						</label>
						<br><br>
				<?php }?>
				</td>
				<td>
					<h3><?=$fri_events[$x]['title']?></h3>
					<div style="padding:0 0 0 20px;">
						<?=$fri_events[$x]['desc']?><br />
						<b><?=$fri_events[$x]['time']?> &#9679; <?=$fri_events[$x]['location']?> &#9679; <?=$fri_events[$x]['price']==''?'Included with Registration':$fri_events[$x]['price']?></b>
					</div>
					<br />
				</td>
			</tr>
		<?php 
			}
		?>
		</tbody>
	</table>
	<div style="clear:both;">
		<input type="hidden" name="editing" value="<?=isset($_GET['edit'])?'1':'0'?>" />
		<input type="submit" name="action" value="Save &amp; Continue" style="float:right;" /><input type="button" value="Back" onclick="window.location='select_package.php'" />
		
	</div>
</form>
<?php 
fw_finish();
?>