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

	$_SESSION['fw']['sat_events'] = array();
		
	for($x=0; $x<sizeof($sat_events); $x++){
		if($_POST['event_selected'][$x]){
			$_SESSION['fw']['sat_events'][$x] = intval($_POST['event_attendance'][$x]);
		}
	}
	
	$_SESSION['fw']['alumni'] = array();
	if($_POST['event_selected'][LEGACY_EVENT]){
		
		foreach($_POST['alumni'] as $key => $value){
			$_SESSION['fw']['alumni'][] = $key;
		}
	}
	
	if($_POST['event_selected'][BBQ_EVENT] && $_SESSION['fw']['package_type']=='Basic Package'){
		$_SESSION['fw']['sat_events'][BBQ_EVENT] = array('student'=>intval($_POST['bbq_students']), 'guest'=>intval($_POST['bbq_guests']));
	}
	
if($_POST['editing']==1){
		header("Location:confirm.php");
		exit();
	}
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

//define("BRUNCH_EVENT", 0);
$_SESSION['fw']['stage'] = max($_SESSION['fw']['stage'], 4);

if(empty($_SERVER['HTTPS'])){
	header('Location:https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	exit();
}


fw_start('Sunday Events', 0);
?>
<script>
	function displayNumBox(visible, id, extra){
		if(visible.checked){
			document.getElementById('label_'+id).style.visibility = 'visible';
			document.getElementById('atten_sel_'+id).style.visibility = 'visible';
			if(extra){
				document.getElementById('extra_'+id).style.visibility = 'visible';
			}
				
		}
		else{
			document.getElementById('label_'+id).style.visibility = 'hidden';
			document.getElementById('atten_sel_'+id).style.visibility = 'hidden';
			if(extra){
				document.getElementById('extra_'+id).style.visibility = 'hidden';
			}
		}
	}

	function update_attendance(){
		var form = document.sun_form;
		var count = form.brunch_students.selectedIndex + form.brunch_guests.selectedIndex;
		//alert(count);
		form["event_attendance[0]"].selectedIndex = --count;
	}
</script>
<form action="tshirts.php" method="post" name="sun_form">
	<h1>Select the events you plan to attend</h1>
	<h2>Sunday Events</h2>
	<table>
		<tbody>
		<?php 
			for($x=0; $x < sizeof($sun_events); $x++){		
		?>
			<tr valign="top">
				<td>
				<?php if($sun_events[$x]['reg_enabled']){?>
						<input type="checkbox" style="text-align:right" name="event_selected[<?=$x?>]" value="1" onClick="displayNumBox(this, <?=$x?>, <?=$x==BRUNCH_EVENT?'1':'0'?>)" <?=$_SESSION['fw']['sun_events'][$x]?'checked':''?>/><br>
						<label id="label_<?=$x?>" style="visibility:<?=$_SESSION['fw']['sun_events'][$x]?'visible':'hidden'?>" for="event_attendance_<?=$x?>">number of <br>attendees 
						<select id="atten_sel_<?=$x?>" style="visibility:<?=$_SESSION['fw']['sun_events'][$x]?'visible':'hidden'?>" name="event_attendance[<?=$x?>]" <?=$x==BRUNCH_EVENT?'disabled':''?>>
							<?php 
							$num_attendees = $_SESSION['fw']['sun_events'][BRUNCH_EVENT]['guest'] + $_SESSION['fw']['sun_events'][BRUNCH_EVENT]['student'];
							for($i=1; $i<($_SESSION['fw']['num_students']+$_SESSION['fw']['num_guests']); $i++)
								print '<option value="'.$i.'" '.($num_attendees == $i?'selected':'').'>'.$i.'</option>';
	
								print '<option value="'.$i.'" '.($num_attendees==0 || $num_attendees == $i?'selected':'').'>'.$i.'</option>';
							?>
						</select>
						</label>
						<br><br>
				<?php }?>
				</td>
				<td>
					<h3><?=$sun_events[$x]['title']?></h3>
					<div style="padding:0 0 0 20px;">
						<?=$sun_events[$x]['desc']?><br />
						<b><?=$sun_events[$x]['time']?> &#9679; <?=$sun_events[$x]['location']?> &#9679; <?=$sun_events[$x]['price']==''?'Included with Registration':$sun_events[$x]['price']?></b>
					</div>
					<div id="extra_<?=$x?>" style="visibility:<?=$_SESSION['fw']['sun_events'][BRUNCH_EVENT]>0?'visible':'hidden'?>;"><?=$sun_events[$x]['extra']?></div>
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
		<input type="submit" name="action" value="Save &amp; Continue" style="float:right;" /><input type="button" value="Back" onclick="window.location='sat.php'" />
		
	</div>
</form>
<?php 
fw_finish();
?>