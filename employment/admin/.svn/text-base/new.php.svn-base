<?php 
session_start();
require_once('webauth/include.php');
require_once('includes/mysqli.inc');
$db = new db_mysqli('student_hiring');
$result = $db->query('select * from users where app_id=1 and netid="'.$_SESSION['webauth']['netID'].'"');
if($result->num_rows == 0){
	echo 'access denied';
	exit();
}
$user = mysqli_fetch_assoc($result);
// query the new unit id and the admin flag
// print_r($_SESSION);
// this gets the query string
$qry_str = $_SERVER['QUERY_STRING'];

// this parses the query string
// into individual variables and
// their values. the variables
// automatically get prefixed with
// the dollar sign ($) and the values 
// get assigned to those variables. 
// pretty slick!
parse_str($qry_str);

// if the user is an admin (the flag = 1) and the 
// $unitVal variable has a value, replace the user's
// default unit_id with the one selected in the 
// dropdown and passed in through the query string.
// in this way, the admin can look at the applications
// in whatever unit he or she wants to.
//
// initially the $unitVal variable will not exist.  
if (($user['admin'] == 1) && ($unitVal))
{
	$user['unit_id'] = $unitVal;
	
	if($filterVal) 
	{
		if($filterVal == 1)
		{
			$_POST['singleUnit'] = 1;
			$_SESSION['filterVal'] = 1;
		}
		else
		{
			unset($_POST['singleUnit']);
			$_SESSION['filterVal'] = 0;
		}
	}
	else
	{
		unset($_POST['singleUnit']);
		$_SESSION['filterVal'] = 0;
	}
	
}

$unit = mysqli_fetch_assoc($db->query('select * from units where unit_id='.$user['unit_id']));
$user['unit_name'] = $unit['name'];
$_SESSION['user'] = $user;

// we are not displaying marketing on option 1 on the online application
// so we set the accepting_applications flag to 0 for marketing. In order 
// to display marketing on the backweb, I made it so that it does not
// check the flag. The option 2 logic does not care about this flag,
// so we are ignoring it here.
// --> this is the old query:
// $query = 'select * from units where accepting_applications=1 and app_id=1';

$result = $db->query('select * from units where app_id=1 order by name');
while($unit = mysqli_fetch_assoc($result))
	$units[$unit['unit_id']] = $unit['name'];


$result = $db->query('select * from semesters where app_id=1 order by stop_hiring desc');
$semester = $result->fetch_assoc();
$semesters[$semester['semester_id']] = $semester;

$current_semester = $semester['semester_id'];

while($semester = $result->fetch_assoc())
	$semesters[$semester['semester_id']] = $semester;
	
if(isset($_GET['semester_id'])){
	$current_semester = $_GET['semester_id'];
}
$_SESSION['current_semester'] = $current_semester;

function get_application($semester,$appID){
	global $db;
	return $application = mysqli_fetch_assoc($db->query('select * from applications join schedules using(application_id) left join resumes using(application_id) where app_id=1 and  semester_id='.$semester.' and application_id='.$appID));
}
function get_jobs($userID, $appID){
	global $db;
	$result = $db->query('select * from applying_for where unit_id='.$userID.' and application_id='.$appID);
	while($job = mysqli_fetch_assoc($result))
		$results[] = $job;
	return $results;
}

function get_work_history($appID){
	global $db;
	$result = $db->query('select * from work_history where application_id='.$appID);
	while($work_history = mysqli_fetch_assoc($result))
		$results[] = $work_history;
	return $results;
}

// I modified the query to exclude hired=1
$result1 = $db->query('select distinct application_id from applying_for left join checkouts using(application_id, unit_id) join applications using(application_id) join schedules using( application_id ) where type="position" OR type="unit" and checkout_id is NULL and active=1 and hired!=1 and applying_for.unit_id='.$user['unit_id'].' and semester_id='.$current_semester);
while($row = mysqli_fetch_assoc($result1)){
	$id = $row['application_id'];

	$application = get_application($current_semester,$id);
	$application['jobs'] = get_jobs($user['unit_id'],$id);
	$application['work_history'] = get_work_history($id);

	$apps[] = $application;
}

// I modified the query to exclude hired=1
$result1 = $db->query('select distinct application_id from applying_for join checkouts using(application_id, unit_id) join applications using(application_id) join schedules using( application_id ) where type="position" and active=1 and hired!=1 and general=0 and applying_for.unit_id='.$user['unit_id'].' and semester_id='.$current_semester);
while($row = mysqli_fetch_assoc($result1)){

	$id = $row['application_id'];

	$application = get_application($current_semester,$id);
	$application['jobs'] = get_jobs($user['unit_id'],$id);
	$application['work_history'] = get_work_history($id);
	
	$apps2[] = $application;
}

$result1 = $db->query('select distinct application_id from applying_for join checkouts using(application_id, unit_id) join applications using(application_id) join schedules using( application_id ) where type="unit" and active=1 and applying_for.unit_id='.$user['unit_id'].' and semester_id='.$current_semester);
while($row = mysqli_fetch_assoc($result1)){
	$id = $row['application_id'];

	$application = get_application($current_semester,$id);
	$application['jobs'] = get_jobs($user['unit_id'],$id);
	$application['work_history'] = get_work_history($id);
	
	$apps3[] = $application;
}

?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="schedule.js" ></script>

<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.css">
<script src="bootstrap/js/bootstrap.js"></script>

<script>
	function load_schedules(){
		schedule = [[[[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]]]];
		init( 'schedule', 'vertical', 1, 26, 26, 18, 7, 2, 12, '', '', 1, 1);
	}

	function search_apps(form){
		$("#search_arrow").click();
		$('#results').html('loading...');	  
		data = {'action':'search', 'fname':form.fname.value, 'lname':form.lname.value, 'schedule':schedule, 'resume':form.resume.checked, "freshman":form.freshman.checked, "sophomore":form.sophomore.checked, "junior":form.junior.checked, "senior":form.senior.checked, "grad":form.grad.checked};
		$.post("index.ajax.php", data, function(data){$('#results').html(data);}); 
		return false;
	}
	function clear_search(){
		document.search_form.reset();
		schedule = [[[[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]]]];
		init( 'schedule', 'vertical', 1, 26, 26, 18, 7, 2, 12, '', '', 0, 0);
	}

	function save_app(elem, id, general){
		elem.parentNode.innerHTML = 'Application Saved';
		data = {'action':'saveApp', 'application_id':id, 'general':general};
		$.post("index.ajax.php", data); 
	}
	// I added email and job_titles to this function for the rejection email.
	// these functions post variables to the index.ajax.php page. They are 
	// then available to PHP as $_POST variables.
	function disregard_app(elem, id, email, job_titles){
		elem.parentElement.innerHTML = 'Application Removed';
		data = {'action':'removeApp', 'application_id':id, 'email':email, 'job_titles':job_titles};
		$.post("index.ajax.php", data); 
	}
	function remove_app(elem, id){
		elem.parentElement.innerHTML = 'Application Removed';
		data = {'action':'removeApp2', 'application_id':id};
		$.post("index.ajax.php", data); 
	}
	function hired_app(elem, id, email){
		elem.parentElement.innerHTML = 'Applicant Hired';
		data = {'action':'hiredApp', 'application_id':id, 'email':email};
		$.post("index.ajax.php", data); 
	}

	$(document).ready(function(){
		load_schedules();

		$('#menu a').click(function(){
			id = $(this).attr('id');
			if(!$(this).parent().hasClass('active')){
				$('.nav li').removeClass('active');
				$(this).parent().addClass('active');
				$('#apps-'+id).addClass('active').siblings().removeClass('active');
			}
			if(id == 'search'){
				if(!$('#search_arrow').hasClass('active')){
					$('#search_arrow').click();
				}
			}
		})

		$('#search_arrow').click(function(){
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$('#search_arrow img').attr('src','expand.png');
				$('#search_arrow span').text('show');
				$('#search_form').animate({height:'0px'});
			}else{
				$(this).addClass('active');
				$('#search_arrow img').attr('src','collapse.png');
				$('#search_arrow span').text('hide');
				$('#search_form').animate({height:'600px'});
			}
		});

		$("#unit_select").change(function() { 
	   		checkUnit();
		});
		
		$("#singleUnit").change(function() {
			checkUnit();
		});
	});

	function checkUnit() {
			
		// get the unit value of the current selected unit.
		var unitVal = $("#unit_select option:selected").val();	
		
		var filterVal = 0;
		if ($("#singleUnit").is(':checked'))
		{
			 filterVal = 1;
		}		
		
		// re-post this page with the value of the
		// unitVal from the dropdown in the query string.
		// you will be able to see the query string in
		// the address bar of the browser. PHP can then
		// process the variable in the query string.
		// window.location='index.php?unitVal=' + unitVal;
		window.location = 'index.php?unitVal=' + unitVal + '&filterVal=' + filterVal;
			
	}
	
</script>

<style>
	td{
		vertical-align:top;
		max-width:250px;
	}
	body{
		font-size: 12px;
	}
	.app{
		display:none;
	}
	.app.active{
		display:block;
	}
</style>
 
</head>
<body>
	<div class="container">

		<header class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
	          	</button>
				<a class="navbar-brand">Intra</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav" id="menu">
					<li class="active">
						<a href="#" id="new">New Applications</a>
					</li>
					<li>
						<a href="#" id="your">Your Applications</a>
					</li>
					<li>
						<a href="#" id="search">Search Applications</a>
					</li>
					<?php if($user['admin'] == 1){?>
				      <li>
				        <a href="#" id="users">Users</a>
				      </li>
				    <? } ?>
				</ul>

			</div>
			
		</header>

		<div class="navbar navbar-inverse">
			<div id="admin_select" class="navbar-left">
				<input type="checkbox" name="singleUnit" id="singleUnit" value="1" <?php if(isset($_POST['singleUnit'])) { echo "checked=\"checked\""; } ?>><label style="color:#fff;" for="singleUnit">Single Unit Search</label>
			</div>
			<div class="navbar-left">
				<ul>
					<li>
						<label style="color:#fff;">Select Unit:</label>
				<select id="unit_select" class="form-control">
					<option value="" disabled selected>Select A Unit</option>
					<?php
						foreach($units as $key => $unit){	
							echo '<option value="'.$key.'" '.($unit==$user['unit_name']?'selected':'').'>'.$unit.'</option>';
						} ?>
				</select>
					</li>
				</ul>
				
			</div>
			<div class="navbar-right">
				<ul>
					<li>
						<label style="color:#fff;">Semester:</label>
				<select class="form-control" onchange="window.location = 'index.php?semester_id='+this.options[this.selectedIndex].value">
					<?php
						foreach($semesters as $semester_id => $semester)
							echo '<option value="'.$semester_id.'" '.($semester_id==$current_semester?'selected':'').'>'.$semester['name'].'</option>';
					?>
				</select>
					</li>
				</ul>
				
			</div>
		</div>
  
		<section>

			<?php if($user['admin'] == 1){?>
				<div id="apps-users" class="app">
					<h1>User Management</h1>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>NetID</th>
								<th>Unit</th>
								<th>Admin</th>
							</tr>
						</thead>

					<?php 
						$result = $db->query('select * from users u join units un using(unit_id) where u.app_id = 1');
						while($user_info = mysqli_fetch_assoc($result))

							echo "<tr>" . 
									 "<td>" . $user_info['netid']."</td>".
									 "<td>" . $user_info['name']."</td>".
									 "<td>" . ($user_info['admin'] == 1 ? 'Yes' : 'No')."</td>".
								"</tr>";
					?>
					</table>

				</div>
			<? } ?>

			<div id="apps-new" class="app active">
				<h1>Applications for: <?= $user['unit_name']; ?></h1>
				<br />
				<?php if(is_array($apps)): ?>
				<table width="100%" cellspacing="0" class="table table-bordered">
					<thead>
						<tr>
							<th>Information</th>
							<th>Schedule</th>
							<th>Work History</th>
							<th>Comments</th>
						</tr>
					</thead>
				<?php
					foreach($apps as $app){
					
						// create another variable
						// for job titles.
						$app['job_titles'] = "";
					
						echo '<tr>
								<td>' .
								    '<div>'. 
										'<label>Name:</label> <span>' . $app['firstName'] . ' ' . $app['lastName'] . '</span><br/>' .  
										'<label>Class Standing:</label> <span>' . $app['classStanding'].'</span><br/>' .  
										
										($app['previouslyWorked']?'Worked for Union<br/>':'');

										foreach($app['jobs'] as $job){

											if($job['type'] == 'unit')
												echo "<label>Unit:</label> " . $_SESSION['user']['unit_name'].'<br/>';
											else
												echo $job['title'].'<br/>';
												if($job['unit_id'] == $_SESSION['user']['unit_id'])
												{
													if($job['title'] > "")
													{
														// string the job titles together into the variable.
														$app['job_titles'] .= str_replace(" ", "#", trim($job['title'])).'|';
													}
												}

										}

									echo '<br />
										<label>Phone: </label> <span>'.$app['phoneNumber'].'</span><br />
										<label>Email:</label> <span>'.$app['email'].'</span></br />
										<label>Date Submitted:</label> <span>'.date("F j, Y, g:i a",strtotime($app['date_submitted'])).'</span></br />
										<label>Date Updated:</label> <span>'. (strtotime($app['date_updated']) == strtotime('0000-00-00 00:00:00') ? "Never" : date("F j, Y, g:i a",strtotime($app['date_updated']))) .'</span></br />';
									echo '<a href="application.php?id='.$app['application_id'].'">Download Application</a><br />';
										if($app['resume_id'])
											echo '<a href="resume.php?id='.$app['resume_id'].'">Download Resume</a><br />';
									
									echo '</div><br /><div class="btn-group">
									<input type="button" class="btn btn-primary" value="Save App" onclick="save_app(this,'.$app['application_id'].',0)"/>';
									// I added the email and job_titles value to the call to disregard_app, so that we have those variables for the rejection email.	
									// the individual strings have to be quoted in order to work, so we have some additional escaped single quotes before and after, 
									// which makes this onclick statement look kind of strange.
									echo '<input type="button" class="btn btn-danger" value="Disregard App" onclick="disregard_app(this,'.$app['application_id'].',\''.$app['email'].'\',\''.$app['job_titles'].'\')"/></div>
							</td>';
						echo '<td>' . build_mini_schedule(str_pad(decbin($app['mon']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['mon2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['tue']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['tue2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['wed']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['wed2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['thu']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['thu2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['fri']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['fri2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['sat']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['sat2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['sun']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['sun2']), 24, '0', STR_PAD_LEFT)) . '</td>';
						echo '<td>';
							if(is_array($app['work_history']))
								foreach($app['work_history'] as $work_history){
									echo $work_history['company'].'<ul><li>'.$work_history['job_duties'].'</li><li>'.$work_history['reason_leave'].'</li></ul>';
								}
						echo '</td>
							<td >
								<p>'.substr($app['comments'], 0, 200).'</p>
							</td>
						</tr>';
					}
				?>
			</table>
				<?php else:?>
					No new applications
				<?php endif;?>
			</div>

			<div id="apps-your" class="app">
			<h1>Applications for Specific Jobs</h1>
			<br />
			<?php
				if(is_array($apps2)):
				?>
				<table width="100%" cellspacing="0" class="table table-bordered">
					<thead>
						<tr>
							<th>Information</th>
							<th>Schedule</th>
							<th>Work History</th>
							<th>Comments</th>
						</tr>
					</thead>
				<?php
				foreach($apps2 as $app){
					echo '<tr >';
						echo '<td><div>';
							echo $app['firstName'].' '.$app['lastName'].'<br />'.$app['classStanding'].'<br />'.($app['previouslyWorked']?'Worked for Union<br />':'');
							foreach($app['jobs'] as $job){
								if($job['type'] == unit)
									echo $_SESSION['user']['unit_name'].'<br />';
								else
									echo $job['title'].'<br />';
							}
							echo '<br />'.$app['phoneNumber'].'<br /><span>'.$app['email'].'</span></br />';
							echo '<span>Date Submitted: '.$app['date_submitted'].'</span></br />';
							echo '<span>Date Updated: ' . (strtotime($app['date_updated']) == strtotime('0000-00-00 00:00:00') ? "Never" : date("F j, Y, g:i a",strtotime($app['date_updated']))) .'</span></br />';
								echo '<a href="application.php?id='.$app['application_id'].'">Download Application</a><br />';
							if($app['resume_id'])
								echo '<a href="resume.php?id='.$app['resume_id'].'">Download Resume</a><br />';
							echo '<br /><div><input type="button" value="Remove App" onclick="remove_app(this,'.$app['application_id'].')"/>
							</div></td>';
						echo '<td style=""><div>';
							echo build_mini_schedule(str_pad(decbin($app['mon']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['mon2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['tue']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['tue2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['wed']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['wed2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['thu']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['thu2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['fri']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['fri2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['sat']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['sat2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['sun']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['sun2']), 24, '0', STR_PAD_LEFT));
						echo '</div></td>';
						echo '<td><div>';
							if(is_array($app['work_history']))
								foreach($app['work_history'] as $work_history){
									echo $work_history['company'].'<ul><li>'.$work_history['job_duties'].'</li><li>'.$work_history['reason_leave'].'</li></ul>';
								}
						echo '</div></td>';
						echo '<td><div>';
							echo '<p>'.substr($app['comments'], 0, 200).'</p><br />';
							
						echo '</div></td>';
					echo '</tr>';
				}
				?>
			</table>
				<?php else:?>
					No Saved Applications.
				<?php endif;?>
			<br />
			<h1>General Applications You are Interested in</h1>
			<br />
			<?php
				if(is_array($apps3)):
				?>
				<table width="100%" cellspacing="0" class="table table-bordered">
				<tr>
					<td>Information</td>
					<td>Schedule</td>
					<td>Work History</td>
					<td>Comments</td>
				</tr>
				<?php
				foreach($apps3 as $app){
					echo '<tr >';
						echo '<td><div>';
							echo $app['firstName'].' '.$app['lastName'].'<br />'.$app['classStanding'].'<br />'.($app['previouslyWorked']?'Worked for Union<br />':'');
							foreach($app['jobs'] as $job){
								if($job['type'] == unit)
								{
									if ($job['unit_id'] == $_SESSION['user']['unit_id'])
									{
										echo $_SESSION['user']['unit_name'].'<br />';
									} else {
										$query = 'select * from units where unit_id='.$job['unit_id'];
										$result = $db->query($query);
										$units = $result->fetch_assoc();
										echo $units['name'].'<br />';
									}
								} else {
									echo $job['title'].'<br />';
								}
							}
							echo '<br />'.$app['phoneNumber'].'<br /><span>'.$app['email'].'</span></br />';
							echo '<span>Date Submitted: '.$app['date_submitted'].'</span></br />';
							echo '<span>Date Updated: '. (strtotime($app['date_updated']) == strtotime('0000-00-00 00:00:00') ? "Never" : date("F j, Y, g:i a",strtotime($app['date_updated']))) .'</span></br />';
							if($app['hired'] == 1) {
								echo '<span>Hired</span></br />';
							}
							echo '<a href="application.php?id='.$app['application_id'].'">Download Application</a><br />';
							if($app['resume_id'])
								echo '<a href="resume.php?id='.$app['resume_id'].'">Download Resume</a><br />';
							echo '<br /><div><input type="button" value="Remove App" onclick="remove_app(this,'.$app['application_id'].')"/>';
							
						echo '</div></td>';
						echo '<td><div>';
							echo build_mini_schedule(str_pad(decbin($app['mon']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['mon2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['tue']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['tue2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['wed']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['wed2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['thu']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['thu2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['fri']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['fri2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['sat']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['sat2']), 24, '0', STR_PAD_LEFT), str_pad(decbin($app['sun']), 24, '0', STR_PAD_LEFT).str_pad(decbin($app['sun2']), 24, '0', STR_PAD_LEFT));
						echo '</div></td>';
						echo '<td><div>';
							if(is_array($app['work_history']))
								foreach($app['work_history'] as $work_history){
									echo $work_history['company'].'<ul><li>'.$work_history['job_duties'].'</li><li>'.$work_history['reason_leave'].'</li></ul>';
								}
						echo '</div></td>';
						echo '<td ><div>';
							echo '<p>'.substr($app['comments'], 0, 200).'</p><br />';
							
						echo '</div></td>';
					echo '</tr>';
				}
				?>
			</table>
				<?php else:?>
					No Saved Applications.
				<?php endif;?>
			</div>

			<div id="apps-search" class="app">
				<h1 style="float:left;">Search Applications</h1>

				<div id="search_arrow" class="active" style="cursor:pointer; float:left; font-size:12px; font-weight:normal; height:14px; margin-top:8px; width:110px;">&nbsp;<span>hide</span> search &nbsp;&nbsp;<img src="collapse.png" height="8" style="margin-top:3px;"/></div>
				<br />
				<form id="search_form" name="search_form" onsubmit="return search_apps(this)" style="height:600px; overflow:hidden; clear:both;">
					<div style="float:left; width:300px;">
						First Name:<br />
						<input type="text" name="fname" /><br />
						<br />
						
						Last Name:<br />
						<input type="text" name="lname" /><br />
						<br />
						
						Include only those with:<br />
						<div style="margin-left:30px;">
							<input type="checkbox" name="resume" id="edit-resume" value="1" > A Resume<br>
							<input type="checkbox" name="work_exp" id="edit-work-experience" value="1" class="form-checkbox"> Work Experience<br>
							<input type="checkbox" name="work_study" id="edit-work-experience" value="1" class="form-checkbox"> Work Study<br>
							<input type="checkbox" name="not_checked" id="edit-work-experience" value="1" class="form-checkbox"> Not Checked Out<br>
						</div>
						<br/>
			 			Exclude the following:
						 <div style="margin-left:30px;">
						  <input type="checkbox" name="hss" id="edit-work-experience" value="1" class="form-checkbox"> High School Students<br>
						  <input type="checkbox" name="ps" id="edit-work-experience" value="1" class="form-checkbox"> Pima Students<br>
						  <input type="checkbox" name="freshman" id="edit-work-experience" value="1" class="form-checkbox"> Freshmen<br>
						  <input type="checkbox" name="sophomore" id="edit-work-experience" value="1" class="form-checkbox"> Sophomores<br>
						  <input type="checkbox" name="junior" id="edit-work-experience" value="1" class="form-checkbox"> Juniors<br>
						  <input type="checkbox" name="senior" id="edit-work-experience" value="1" class="form-checkbox"> Seniors<br>
						  <input type="checkbox" name="grad" id="edit-work-experience" value="1" class="form-checkbox"> Grad Students<br>
						</div>
						<br />
						<input type="submit" value="search" />
						<input type="button" value="reset" onclick="clear_search()"/>
					</div>
					<div style="float:left">
						<br />
						<br />
						<div id="schedule" style="position:relative;">
							
						</div>
					</div>
				</form>
				<div id="results" style="padding-top:20px;">
					
				</div>
			</div>
		</section>
	
	</div>

</body>
</html>
<?php

	function build_mini_schedule($mon, $tue, $wed, $thu, $fri, $sat, $sun){

		for($i=0; $i<48; $i++){
		  if($mon[$i] == "1"){
		    $start = $i;
		    $length = 1;
		    while($mon[++$i] == "1"){
		      $length++;
		    }
		    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; _width:6px; top:'.($start*6).'px; left:0px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #C01525;">
		    <div style="width:100%; height:100%; background-color:#C01525; opacity: .75; filter:alpha(opacity=75);"></div></div>';
		  }
		}

		for($i=0; $i<48; $i++){
		  if($tue[$i] == "1"){
		    $start = $i;
		    $length = 1;
		    while($tue[++$i] == "1"){
		      $length++;
		    }
		    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; _width:6px; top:'.($start*6).'px; left:12px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #C01525;">
		    <div style="width:100%; height:100%; background-color:#C01525; opacity: .75; filter:alpha(opacity=75);"></div></div>';
		  }
		}

		for($i=0; $i<48; $i++){
		  if($wed[$i] == "1"){
		    $start = $i;
		    $length = 1;
		    while($wed[++$i] == "1"){
		      $length++;
		    }
		    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; _width:6px; top:'.($start*6).'px; left:24px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #C01525;">
		    <div style="width:100%; height:100%; background-color:#C01525; opacity: .75; filter:alpha(opacity=75);"></div></div>';
		  }
		}

		for($i=0; $i<48; $i++){
		  if($thu[$i] == "1"){
		    $start = $i;
		    $length = 1;
		    while($thu[++$i] == "1"){
		      $length++;
		    }
		    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; _width:6px; top:'.($start*6).'px; left:36px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #C01525;">
		    <div style="width:100%; height:100%; background-color:#C01525; opacity: .75; filter:alpha(opacity=75);"></div></div>';
		  }
		}

		for($i=0; $i<48; $i++){
		  if($fri[$i] == "1"){
		    $start = $i;
		    $length = 1;
		    while($fri[++$i] == "1"){
		      $length++;
		    }
		    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; _width:6px; top:'.($start*6).'px; left:48px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #C01525;">
		    <div style="width:100%; height:100%; background-color:#C01525; opacity: .75; filter:alpha(opacity=75);"></div></div>';
		  }
		}

		for($i=0; $i<48; $i++){
		  if($sat[$i] == "1"){
		    $start = $i;
		    $length = 1;
		    while($sat[++$i] == "1"){
		      $length++;
		    }
		    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; _width:6px; top:'.($start*6).'px; left:60px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #C01525;">
		    <div style="width:100%; height:100%; background-color:#C01525; opacity: .75; filter:alpha(opacity=75);"></div></div>';
		  }
		}

		for($i=0; $i<48; $i++){
		  if($sun[$i] == "1"){
		    $start = $i;
		    $length = 1;
		    while($sun[++$i] == "1"){
		      $length++;
		    }
		    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; _width:6px; top:'.($start*6).'px; left:72px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #C01525;">
		    <div style="width:100%; height:100%; background-color:#C01525; opacity: .75; filter:alpha(opacity=75);"></div></div>';
		  }
		}

		return '<div style="width:100px; height:300px; margin-top:40px; margin-left:75px; position:relative; ">'.$sched.'
				<div style=" position:absolute; vertical-align:center; height:25px; width:75px; text-align:center; z-index:1000; left:-75px; top:-25px; padding-top:7px;">
					<strong>Time</strong>
				</div>
				<div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:0px; top:-25px; padding-top:7px;">
				<strong>M</strong>
				</div>
				<div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:12px; top:-25px; padding-top:7px;">
				<strong>T</strong>
				</div>
				<div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:24px; top:-25px; padding-top:7px;">
				<strong>W</strong>
				</div>
				<div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:36px; top:-25px; padding-top:7px;">
				<strong>R</strong>
				</div>
				<div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:48px; top:-25px; padding-top:7px;">
				<strong>F</strong>
				</div>
				<div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:60px; top:-25px; padding-top:7px;">
				<strong>S</strong>
				</div>
				<div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:72px; top:-25px; padding-top:7px;">
				<strong>S</strong>
				</div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:159px; left:-75px; top:-25px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:159px; left:-75px; top:-1px; font-size:0px; overflow:hidden;"></div>
				<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:-75px; top:-25px;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:162px; left:-76px; top:-26px; font-size:0px; overflow:hidden;"></div>
				<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:316px; left:-76px; top:-26px;"></div>
				<div style="height:313px;  background-color:#DEE3C4; position:absolute; z-index:10; width:12px; left:0px; top:-25px; font-size:0px; overflow:hidden;"></div>
				<div style="height:313px;  background-color:#DEE3C4; position:absolute; z-index:10; width:12px; left:24px; top:-25px; font-size:0px; overflow:hidden;"></div>
				<div style="height:313px;  background-color:#DEE3C4; position:absolute; z-index:10; width:12px; left:48px; top:-25px; font-size:0px; overflow:hidden;"></div>
				<div style="height:313px;  background-color:#DEE3C4; position:absolute; z-index:10; width:12px; left:72px; top:-25px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:161px; left:-75px; top:289px; font-size:0px; overflow:hidden;"></div>
				<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:315px; left:85px; top:-25px;"></div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:0px;">12am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:12px;">1am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:24px;">2am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:36px;">3am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:48px;">4am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:60px;">5am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:72px;">6am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:84px;">7am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:96px;">8am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:108px;">9am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:120px;">10am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:132px;">11am</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:144px;">12pm</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:156px;">1pm</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:168px;">2pm</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:180px;">3pm</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:192px;">4pm</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:204px;">5pm</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:216px;">6pm</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:228px;">7pm</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:240px;">8pm</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:252px;">9pm</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:264px;">10pm</div>
				<div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:276px;">11pm</div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:0px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:12px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:24px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:36px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:48px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:60px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:72px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:84px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:96px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:108px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:120px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:132px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:144px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:156px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:168px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:180px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:192px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:204px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:216px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:228px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:240px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:252px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:264px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:276px; font-size:0px; overflow:hidden;"></div>
				<div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:288px; font-size:0px; overflow:hidden;"></div>
				<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:0px; top:-25px;"></div>
				<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:12px; top:-25px;"></div>
				<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:24px; top:-25px;"></div>
				<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:36px; top:-25px;"></div>
				<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:48px; top:-25px;"></div>
				<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:60px; top:-25px;"></div>
				<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:72px; top:-25px;"></div>
				<div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:84px; top:-25px;"></div>
				<div style="height:300px; width:150px; position:absolute; top:0px; left:-25; z-index:10000;"></div>
			</div>';
		 
	}