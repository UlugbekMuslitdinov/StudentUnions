<?php
require_once 'template/fw.inc';

// give parents 10 minutes from the time they've clicked the parents plus link to register
$time=(time()/60)%1000-10;
//var_dump($time);
if(isset($_GET['parentID']) && $_GET['parentID']>=$time && $_GET['parentID']<=($time+20)){
	$_SESSION['fw']['PlusParents'] = 1; 
}

if(empty($_SERVER['HTTPS'])){
	header('Location:https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	exit();
}



//variable to track throughout registration to check if session has died
$_SESSION['fw']['active_session'] = 1;
$_SESSION['fw']['stage'] = 0;


fw_start('Registration', 1);
if (true) {
print "<p>We're sorry. Online registration for Family Weekend 2010 has concluded. We hope to see you there!<br /><br />";
print "If you have additional questions, please contact ASUA at 520-621-2782.<br />";

## temporary close notice ##
## print "<p>We're sorry. Online registration for Family Weekend 2009 is temporarily down for system updates.<br /><br />";
## print "Please try again in 15-20 minutes.<br />";

print "<br />Thank You.</p>";
fw_finish();
exit();
}
?>
<style>
	.student-reg{
		display:none;
	}
	#student0{
		display:block;
	}
	.guest-reg{
		display:none;
	}
	.error-message{
		color:red;
	}
</style>
<script>
	function change_num_students(num){
		for(var x=0; x<num; x++)
			document.getElementById('student'+x).style.display = 'block';
		for(x=num; x<3; x++)
			document.getElementById('student'+x).style.display = 'none';
	}

	function change_num_guests(num){
		for(var x=0; x<num; x++)
			document.getElementById('guest'+x).style.display = 'block';
		for(x=num; x<9; x++)
			document.getElementById('guest'+x).style.display = 'none';
	}
</script>
<form action="select_package.php" method="post">
	<h1>Who is Coming?</h1>
	<span class="error-message"><?=$_SESSION['errors'][1]?></span>
	<h2>
		How many UA students will be attending?
		<select name="num_students" onchange="change_num_students(this.options[this.selectedIndex].value)">
			<option value="1" <?=$_SESSION['fw']['num_students']==1?'selected':''?> >1</option>
			<option value="2" <?=$_SESSION['fw']['num_students']==2?'selected':''?> >2</option>
			<option value="3" <?=$_SESSION['fw']['num_students']==3?'selected':''?> >3</option>
		</select>
	</h2>
	<?php for($x=0; $x<3; $x++){?>
	<div class="student-reg" id="student<?=$x?>"  style="float:left; margin-left:50px; margin-bottom:25px; <?=$_SESSION['fw']['num_students'] > $x?' display:block;':''?>">
		<h3>UA Student <?=$x+1?></h3>
		First Name:<input type="text" class="text_input" name="student_first[<?=$x?>]" value="<?=$_SESSION['fw']['student_first'][$x]?>" /><br />
		Last Name: <input type="text" class="text_input" name="student_last[<?=$x?>]" value="<?=$_SESSION['fw']['student_last'][$x]?>" /><br />
		Class Standing: 
			<select name="student_class[<?=$x?>]">
				<option value="Freshman" <?=$_SESSION['fw']['student_class'][$x]=='Freshman'?'selected':''?> >Freshman</option>
				<option value="Sophmore" <?=$_SESSION['fw']['student_class'][$x]=='Sophmore'?'selected':''?> >Sophmore</option>
				<option value="Junior" <?=$_SESSION['fw']['Junior'][$x]=='Freshman'?'selected':''?> >Junior</option>
				<option value="Senior" <?=$_SESSION['fw']['student_class'][$x]=='Senior'?'selected':''?> >Senior</option>
				<option value="Grad Student" <?=$_SESSION['fw']['student_class'][$x]=='Grad Student'?'selected':''?> >Grad Student</option>
			</select>
	</div>
	<?php } ?>
	<h2 style="clear:both;">
		How many guests will be attending?
		<select name="num_guests" onchange="change_num_guests(this.options[this.selectedIndex].value)">
			<option value="0" <?=$_SESSION['fw']['num_guests']==0?'selected':''?> >0</option>
			<option value="1" <?=$_SESSION['fw']['num_guests']==1?'selected':''?> >1</option>
			<option value="2" <?=$_SESSION['fw']['num_guests']==2?'selected':''?> >2</option>
			<option value="3" <?=$_SESSION['fw']['num_guests']==3?'selected':''?> >3</option>
			<option value="4" <?=$_SESSION['fw']['num_guests']==4?'selected':''?> >4</option>
			<option value="5" <?=$_SESSION['fw']['num_guests']==5?'selected':''?> >5</option>
			<option value="6" <?=$_SESSION['fw']['num_guests']==6?'selected':''?> >6</option>
			<option value="7" <?=$_SESSION['fw']['num_guests']==7?'selected':''?> >7</option>
			<option value="8" <?=$_SESSION['fw']['num_guests']==8?'selected':''?> >8</option>
			<option value="9" <?=$_SESSION['fw']['num_guests']==9?'selected':''?> >9</option>
		</select>
	</h2>
	<?php for($x=0; $x<9; $x++){?>
	<div class="guest-reg" id="guest<?=$x?>" style="float:left; margin-left:50px; margin-bottom:25px; <?=$_SESSION['fw']['num_guests'] > $x?' display:block;':''?>">
		<h3>Guest <?=$x+1?></h3>
		First Name:<input type="text" class="text_input" name="guest_first[<?=$x?>]" value="<?=$_SESSION['fw']['guest_first'][$x]?>" /><br />
		Last Name: <input type="text" class="text_input" name="guest_last[<?=$x?>]" value="<?=$_SESSION['fw']['guest_last'][$x]?>" /><br />
		Hometown:<input type="text" class="text_input" name="guest_hometown[<?=$x?>]" value="<?=$_SESSION['fw']['guest_hometown'][$x]?>" />
	</div>
	
<?php } ?>
<p>
		The goal of Family Weekend is to create an enriching experience for students and families while providing a safe and fun environment for all. Family Weekend is proud to offer free registration and meal discounts for honored citizens over 65 and children under six years of age. Please call  Becca at 621-2782 or email us at uabfamw@email.arizona.edu if would wish to apply this discount in your registration. 
	</p>
<div style="clear:both;">
	<input type="submit" value="Save &amp; Continue" name="action" style="float:right; margin-right:150px;" /> <input type="submit" value="Cancel" name="action" />
</div> 
</form>
<?php 
fw_finish();
?>