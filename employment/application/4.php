<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/studentapp.inc');
session_start();
if (!is_object($_SESSION['employment_app'])) {
	header("Location: /employment/application/index.php");
	exit();
}
if(isset($_POST['stage']) && $_POST['stage']){
	$_SESSION['employment_app'] -> validate();
	$_SESSION['employment_app'] -> save();
}
// echo "<pre>"; print_r($_SESSION['employment_app']); echo "</pre>";
$years[] = '';
for ($x = 1980; $x <= date("Y"); $x++) {
	$years[] = $x;
}
$page_options['title'] = 'Arizona Student Union employee application:';
$page_options['header_image'] = 'images/student_employment.png';
page_start($page_options);
?>
<style type="text/css">
	
	@import url("forms.css");
	textarea {
		width: 390px;
		height: 80px;
	}
	p {
		font-size: 13px;
		margin-top: 15px;
		_margin-top: 14px;
		margin-bottom: 0px;
		line-height: 15px;
	}
	.cloud {
		float: left;
		margin-bottom: 20px;
		display: block;
	}
	.active {
		cursor: pointer;
	}
	div {
		font-size: 13px;
	}
	.textbox {
		background-color: #FCF9D0;
		border: none;
		width: 100%;
	}
	.label {
		font-size: 13px;
		width: 1px;
		padding-right: 10px;
		white-space: nowrap;
	}
	td #form4 {
		width: auto;
		white-space: nowrap;
	}
	textarea {
		resize: none;
	}
	#saved_jobs p {
		color: #859245;
		font-size: 13px;
	}
	#saved_jobs p span {
		color: green;
		text-decoration: underline;
		cursor: pointer;
	}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	load_work_history();
});
var jobs = [];
var current_profile = -1;

	function load_work_history(){
	<?php
	foreach ($_SESSION['employment_app']->application->work_histories as $work_history) {
		print 'jobs.push(new prev_job_profile( "' . $work_history->company . '", "' . $work_history->address . '", "' . $work_history->city_state_zip . '", "' . $work_history->phone_number . '", "' . $work_history->supervisor_name . '", "' . $work_history->job_duties . '", "' . $work_history->fromm . '", "' . $work_history->fromy . '", "' . $work_history->tom . '", "' . $work_history->toy . '", "' . $work_history->pay_rate . '", "' . $work_history->reason_leave . '", jobs.length));';
		print 'jobs[jobs.length-1].add_profile();';
	}
	?>
		document.stage4.onsubmit = function() {
			return submit_page();
		};
	}

	function prev_job_profile(com_name, addr, add2, phone, super_name, duties, fm, fy, tm, ty, pay, leaving, id) {

		this.company = com_name;
		this.address = addr;
		this.city_state_zip = add2;
		this.phone_number = phone;
		this.supervisor_name = super_name;
		this.job_duties = duties;
		this.fromm = fm;
		this.fromy = fy;
		this.tom = tm;
		this.toy = ty;
		this.pay_rate = pay;
		this.reason_leave = leaving;
		this.id = id;
		this.add_profile = add_profile;
		this.remove_profile = remove_profile;
		this.load_profile = load_profile;
		this.save_profile = save_profile;
	}

	function add_profile() {

		document.getElementById('saved_jobs').innerHTML += '<p><span style="float:right; margin-right:25px;" onclick="jobs[' + this.id + '].load_profile();">edit</span>' + (this.id + 1) + ') ' + this.company + '</p>';

	}

	function remove_profile() {
		var i = 0;

		while (jobs[i] != this) {
			i++;
		}

		jobs.splice(i, 1);

		while (jobs[i]) {
			jobs[i++].id--;
		}
		document.getElementById('saved_jobs').innerHTML = '';
		i = 0;
		while (jobs[i]) {
			jobs[i++].add_profile();
		}

		document.stage4["company"].value = '';
		document.stage4["com_address"].value = '';
		document.stage4["com_address2"].value = '';
		document.stage4["com_phone"].value = '';
		document.stage4["com_supervisor"].value = '';
		document.stage4["com_duties"].value = '';
		document.stage4["com_from_month"].options.selectedIndex = 0;
		document.stage4["com_from_year"].options.selectedIndex = 0;
		document.stage4["com_to_month"].options.selectedIndex = 0;
		document.stage4["com_to_year"].options.selectedIndex = 0;
		document.stage4["com_pay"].value = '';
		document.stage4["com_leave"].value = '';

		document.getElementById('save_changes').style.display = 'none';

		current_profile = -1;
	}

	function load_profile() {

		document.stage4["company"].value = this.company;
		document.stage4["com_address"].value = this.address;
		document.stage4["com_address2"].value = this.city_state_zip;
		document.stage4["com_phone"].value = this.phone_number;
		document.stage4["com_supervisor"].value = this.supervisor_name;
		document.stage4["com_duties"].value = this.job_duties;
		document.stage4["com_from_month"].options.selectedIndex = this.fromm;
		document.stage4["com_from_year"].options.selectedIndex = this.fromy;
		document.stage4["com_to_month"].options.selectedIndex = this.tom;
		document.stage4["com_to_year"].options.selectedIndex = this.toy;
		document.stage4["com_pay"].value = this.pay_rate;
		document.stage4["com_leave"].value = this.reason_leave;

		current_profile = this.id;

		document.getElementById('save_changes').style.display = 'block';

	}

	function save_profile() {

		this.company = document.stage4["company"].value;
		this.address = document.stage4["com_address"].value;
		this.city_state_zip = document.stage4["com_address2"].value;
		this.phone_number = document.stage4["com_phone"].value;
		this.supervisor_name = document.stage4["com_supervisor"].value;
		this.job_duties = document.stage4["com_duties"].value;
		this.fromm = document.stage4["com_from_month"].options.selectedIndex;
		this.fromy = document.stage4["com_from_year"].options.selectedIndex;
		this.tom = document.stage4["com_to_month"].options.selectedIndex;
		this.toy = document.stage4["com_to_year"].options.selectedIndex;
		this.pay_rate = document.stage4["com_pay"].value;
		this.reason_leave = document.stage4["com_leave"].value;

		document.stage4["company"].value = '';
		document.stage4["com_address"].value = '';
		document.stage4["com_address2"].value = '';
		document.stage4["com_phone"].value = '';
		document.stage4["com_supervisor"].value = '';
		document.stage4["com_duties"].value = '';
		document.stage4["com_from_month"].options.selectedIndex = 0;
		document.stage4["com_from_year"].options.selectedIndex = 0;
		document.stage4["com_to_month"].options.selectedIndex = 0;
		document.stage4["com_to_year"].options.selectedIndex = 0;
		document.stage4["com_pay"].value = '';
		document.stage4["com_leave"].value = '';

		document.getElementById('save_changes').style.display = 'none';
		current_profile = -1;

	}

	function save_work_history() {

		if (current_profile == -1) {

			jobs.push(new prev_job_profile(document.stage4["company"].value, document.stage4["com_address"].value, document.stage4["com_address2"].value, document.stage4["com_phone"].value, document.stage4["com_supervisor"].value, document.stage4["com_duties"].value, document.stage4["com_from_month"].options.selectedIndex, document.stage4["com_from_year"].options.selectedIndex, document.stage4["com_to_month"].options.selectedIndex, document.stage4["com_to_year"].options.selectedIndex, document.stage4["com_pay"].value, document.stage4["com_leave"].value, jobs.length));

			jobs[jobs.length - 1].add_profile();
		} else {
			jobs[current_profile].save_profile();
		}

		document.stage4["company"].value = '';
		document.stage4["com_address"].value = '';
		document.stage4["com_address2"].value = '';
		document.stage4["com_phone"].value = '';
		document.stage4["com_supervisor"].value = '';
		document.stage4["com_duties"].value = '';
		document.stage4["com_from_month"].options.selectedIndex = 0;
		document.stage4["com_from_year"].options.selectedIndex = 0;
		document.stage4["com_to_month"].options.selectedIndex = 0;
		document.stage4["com_to_year"].options.selectedIndex = 0;
		document.stage4["com_pay"].value = '';
		document.stage4["com_leave"].value = '';
		return true;

	}

	function submit_page() {
		if (document.stage4["company"].value != '') {
			save_work_history();
		}

		var allofthem = '';

		for ( i = 0; i < jobs.length; i++) {
			allofthem += '<input type="hidden" name="company[' + (i + 1) + ']" value="' + jobs[i].company.replace(/"/g, '&quot;') + '">';
			allofthem += '<input type="hidden" name="com_address[' + (i + 1) + ']" value="' + jobs[i].address.replace(/"/g, '&quot;') + '">';
			allofthem += '<input type="hidden" name="com_address2[' + (i + 1) + ']" value="' + jobs[i].city_state_zip.replace(/"/g, '&quot;') + '">';
			allofthem += '<input type="hidden" name="com_phone[' + (i + 1) + ']" value="' + jobs[i].phone_number.replace(/"/g, '&quot;') + '">';
			allofthem += '<input type="hidden" name="com_supervisor[' + (i + 1) + ']" value="' + jobs[i].supervisor_name.replace(/"/g, '&quot;') + '">';
			allofthem += '<input type="hidden" name="com_duties[' + (i + 1) + ']" value="' + jobs[i].job_duties.replace(/"/g, '&quot;') + '">';
			allofthem += '<input type="hidden" name="com_from_month[' + (i + 1) + ']" value="' + jobs[i].fromm + '">';
			allofthem += '<input type="hidden" name="com_from_year[' + (i + 1) + ']" value="' + jobs[i].fromy + '">';
			allofthem += '<input type="hidden" name="com_to_month[' + (i + 1) + ']" value="' + jobs[i].tom + '">';
			allofthem += '<input type="hidden" name="com_to_year[' + (i + 1) + ']" value="' + jobs[i].toy + '">';
			allofthem += '<input type="hidden" name="com_pay[' + (i + 1) + ']" value="' + jobs[i].pay_rate.replace(/"/g, '&quot;') + '">';
			allofthem += '<input type="hidden" name="com_leave[' + (i + 1) + ']" value="' + jobs[i].reason_leave.replace(/"/g, '&quot;') + '">';

			document.getElementById('save_changes').innerHTML += allofthem;
		}

		//document.page5.submit();

		return true;
	}
</script>
<div style="padding-left:0px; width:100%; z-index:2; position:relative; top:-10;">
<div style="margin-top:15px; width:950px;">
      	<div style="float:left; width:75px;">
			<?php
				switch($_SESSION['employment_app']->stage){
					case 5:
			?>
		       			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
		                <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
		                <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
		                <img class="cloud active" src="images/4_red.gif" onclick="window.location='./4.php'"/>
		                <img class="cloud active" src="images/5_green.gif" onclick="window.location='./5.php'"/>
             	<?php
					break;  
				
					default:
        		 ?>
	        			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
	                    <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
	                    <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
	                    <img class="cloud active" src="images/4_red.gif" onclick="window.location='./4.php'"/>
	                    <img class="cloud" src="images/5_grey.gif" />
             	<?php
					break; 
				}			
			 ?>
      	</div>
<div style="float:left; margin-left:30px; width:800px;">

	<div>
		<img src="images/work_history.gif" />
	    <p style="white-space:normal;">
	    	Please give work history information either by submitting a resume(preferred) or by filling in past job history in the fields provided. You may also check "I do not wish to submit any work history at this time". Then click "Save and Continue" to proceed to the next step of the application.
	    </p>
	</div>
	<br />

	<?php $_SESSION['employment_app'] -> form_start(4); ?>
	<div style="float:left;">

		<div id="f" style="background-color:#D2E5CA; width:525px; _width:545px; padding: 10px 10px 10px 10px;">
	    	<table cellpadding="0" cellspacing="0" width="100%">
	        	<tr>
	            	<td style="width:auto; font-size:13px;">
	                	<?= $_SESSION['employment_app'] -> checkbox('work_history', 'none'); ?>
						<label for="work_history">I do not have or wish to submit any work history at this time.</label>
	                </td>
	            </tr>
	        </table>                    
	    </div>

		<br />

		<div style="font-size:14px; margin:10px 0 10px 0;">OR</div>

		<div id="f" style="background-color:#D2E5CA; width:525px; _width:545px; padding: 10px 10px 10px 10px;">
			<span style="font-size:14px; font-weight:bold;">Resume:</span><br>
			<?= $_SESSION['employment_app'] -> file_upload('resume'); ?>
			<br /><br />
			<?php if ($_SESSION['employment_app']->application->resume->has_resume) {
				echo $_SESSION['employment_app']->application->resume->name;
			}?>
		</div>
		<br />

		<div style="font-size:14px; margin:10px 0 10px 0;">OR</div>

		<div style="float:left; background-color:#D2E5CA; width:525px; padding: 10px 10px 10px 10px;">

			<span style="font-size:14px; font-weight:bold;">
            	Present/Past Work History
            </span><br/><br/>
			
			<label>Company:</label>
			<?= $_SESSION['employment_app'] -> text('company', 50); ?>
			<br /><br />
			Address:<br /> 
			<?= $_SESSION['employment_app'] -> long_text('com_address', 50); ?>
			<br /><br />
			City/State/Zip: <br />
			<?= $_SESSION['employment_app'] -> long_text('com_address2', 50); ?>
			<br /><br />
			Phone: <br />
			<?= $_SESSION['employment_app'] -> text('com_phone', 16); ?>
			<br /><br />
			Supervisor: <br />
			<?= $_SESSION['employment_app'] -> text('com_supervisor', 30); ?>
			<br /><br />
			Duties: <br />
			<?php
			$com_duties = ( isset($_SESSION['employment_app']->application->application_values['com_duties']) ? $_SESSION['employment_app']->application->application_values['com_duties'] : '' );
			?>
			<?= $_SESSION['employment_app'] -> textArea('com_duties', $com_duties); ?>
			<br /><br />
			Employed From: 
			<?= $_SESSION['employment_app'] -> dropdown('com_from_month', array('', 'January', 'Februrary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')); ?>
			<?= $_SESSION['employment_app'] -> dropdown('com_from_year', $years); ?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: 
			<?= $_SESSION['employment_app'] -> dropdown('com_to_month', array('', 'January', 'Februrary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')); ?>
			<?= $_SESSION['employment_app'] -> dropdown('com_to_year', $years);?>
			<br /><br />
			Last Pay Rate:  <br />
			<?= $_SESSION['employment_app'] -> text('com_pay', 20); ?>
			<br /><br />
			Reason for Leaving: <br /> 
			<?php
			$cum_leave = ( isset($_SESSION['employment_app']->application->application_values['com_leave']) ? $_SESSION['employment_app']->application->application_values['com_leave'] : '' );
			?>
			<?= $_SESSION['employment_app'] -> textArea('com_leave', $cum_leave); ?>
			<br /><br />
			<input type="button" value="Add Another Employer" onclick="save_work_history()"/>
		</div>

		<div id="saved_jobs" style="float:left; width:200px; margin-left:30px;">
			<img src="images/employers.gif"/>
		</div>
		<div id="save_changes" style="display:none;">
			<input id="delete" type="button" value="remove" onclick="jobs[current_profile].remove_profile();" style="float:right;">
            <input id="save" type="button" value="save changes" onclick="jobs[current_profile].save_profile();" style="float:right;" /><br />
		</div>

		
		

		<br style="clear:both" />
		<br />
		<p>
			<input type="button" id="previous" name="previous" value="Previous" onclick="location.href='/employment/application/3.php';" >
			<?php $_SESSION['employment_app'] -> submit('Save and Continue'); ?>
		</p>
		<?php $_SESSION['employment_app'] -> form_finish(4); ?>
	</div>
</div>
</div>
</div>

<?php  page_finish(); ?>  