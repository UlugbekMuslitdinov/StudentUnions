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
	
	$_SESSION['fw']['fri_events'] = array();
	
	for($x=0; $x<sizeof($fri_events); $x++){
		if($_POST['event_selected'][$x]){
			$_SESSION['fw']['fri_events'][$x] = intval($_POST['event_attendance'][$x]);
		}
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

$_SESSION['fw']['stage'] = max($_SESSION['fw']['stage'], 3);

if(empty($_SERVER['HTTPS'])){
	header('Location:https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	exit();
}

fw_start('Saturday Events', 0);
?>
<script>
	function displayNumBox(visible, id, extra){
		if(visible.checked){
			document.getElementById('label_'+id).style.visibility = 'visible';
			document.getElementById('atten_sel_'+id).style.visibility = 'visible';
			if(extra)
				document.getElementById('extra_'+id).style.display = 'block';
		}
		else{
			document.getElementById('label_'+id).style.visibility = 'hidden';
			document.getElementById('atten_sel_'+id).style.visibility = 'hidden';
			if(extra)
				document.getElementById('extra_'+id).style.display = 'none';
		}
	}

	function update_attendance(){
		var form = document.sat_form;
		var count = form.bbq_students.selectedIndex + form.bbq_guests.selectedIndex;
		//alert(count);
		form["event_attendance[<?=BBQ_EVENT?>]"].selectedIndex = --count;
	}
</script>
<form action="sun.php" method="post" name="sat_form">
	<h1>Select the events you plan to attend</h1>
	<h2>Saturday Events</h2>
	<table>
		<tbody>
		<?php 
			for($x=0; $x < sizeof($sat_events); $x++){
			
				if($x==LEGACY_EVENT || ($x==BBQ_EVENT && $_SESSION['fw']['package_type']=='Basic Package'))
					$has_extra = 1;
				else
					$has_extra = 0;	

				if(($x==LEGACY_EVENT && $_SESSION['fw']['sat_events'][LEGACY_EVENT]>0) || ($x==BBQ_EVENT && $_SESSION['fw']['package_type']=='Basic Package' && $_SESSION['fw']['sat_events'][BBQ_EVENT]>0))
					$extra_display = 'block';
				else
					$extra_display = 'none';
					
				if($x==BBQ_EVENT && $_SESSION['fw']['package_type']=='Basic Package')
					$disable_rsvp = 'disabled';
				else
					$disable_rsvp = '';
				
				
				
				if(is_array($_SESSION['fw']['sat_events'][$x]))
					$rsvp_count = $_SESSION['fw']['sat_events'][$x]['student'] + $_SESSION['fw']['sat_events'][$x]['guest'];
				elseif(isset($_SESSION['fw']['sat_events'][$x]))
					$rsvp_count = $_SESSION['fw']['sat_events'][$x];
				else
					$rsvp_count = $_SESSION['fw']['num_students']+$_SESSION['fw']['num_guests'];
		?>
			<tr valign="top">
				<td>
				<?php if($sat_events[$x]['reg_enabled']){?>
						<input type="checkbox" style="text-align:right" name="event_selected[<?=$x?>]" value="1" onClick="displayNumBox(this, <?=$x?>, <?=$has_extra?>)" <?=$_SESSION['fw']['sat_events'][$x]?'checked':''?>/><br>
						<label id="label_<?=$x?>" style="visibility:<?=$_SESSION['fw']['sat_events'][$x]?'visible':'hidden'?>" for="event_attendance_<?=$x?>">number of <br>attendees 
						<select id="atten_sel_<?=$x?>" style="visibility:<?=$_SESSION['fw']['sat_events'][$x]?'visible':'hidden'?>" name="event_attendance[<?=$x?>]" <?=$disable_rsvp?>>
							<?php 
							for($i=1; $i<=($_SESSION['fw']['num_students']+$_SESSION['fw']['num_guests']); $i++)
								print '<option value="'.$i.'" '.($rsvp_count == $i?'selected':'').'>'.$i.'</option>';
							?>
						</select>
						</label>
						<br><br>
				<?php }?>
				</td>
				<td>
					<h3><?=$sat_events[$x]['title']?></h3>
					<div style="padding:0 0 0 20px;">
						<?=$sat_events[$x]['desc']?><br />
						<b><?=$sat_events[$x]['time']?> &#9679; <?=$sat_events[$x]['location']?> &#9679; <?=$sat_events[$x]['price']==''?'Included with Registration':$sat_events[$x]['price']?></b>
					</div>
					
					<?php if($has_extra){?>
					<div id="extra_<?=$x?>" style="display:<?=$extra_display?>;"><?=$sat_events[$x]['extra']?></div>
					<?php }?>
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
		<input type="submit" name="action" value="Save &amp; Continue" style="float:right;" /><input type="button" value="Back" onclick="window.location='fri.php'" />
		
	</div>
</form>
<?php 
fw_finish();
?>