<?php 
session_start();
require_once('webauth/include.php');
require_once('includes/mysqli.inc');
include('functions.php');
$db = new db_mysqli('student_hiring');
$result = $db->query('select * from users where app_id=1 and netid="'.$_SESSION['webauth']['netID'].'"');
if($result->num_rows == 0){
	echo 'access denied';
	exit();
}
$user = mysqli_fetch_assoc($result);

// echo "<pre>"; print_r($_SESSION['user']); echo "</pre>";
// echo "<pre>"; print_r($user); echo "</pre>";

//auto escape everthing that's a request.
foreach($_REQUEST as $key => $value)
	$request[$key] = $db->real_escape_string($value);

//Change unit ID to request ID
if ($request['unit']){
	$user['unit_id'] = $request['unit'];
}

$unit = mysqli_fetch_assoc($db->query('select * from units where unit_id='.$user['unit_id']));
$user['unit_name'] = $unit['name'];

$_SESSION['user'] = $user;

$result = $db->query('select * from units where app_id=1 order by name');
while($unit = mysqli_fetch_assoc($result)){
	$units[] = array('id'=>$unit['unit_id'],'name'=>$unit['name'],'active'=>$unit['accepting_applications']);
}

$result = $db->query('select * from semesters where app_id=1 order by stop_hiring desc');
$semester = $result->fetch_assoc();
$semesters[$semester['semester_id']] = $semester;

$current_semester = $semester['semester_id'];

while($semester = $result->fetch_assoc())
	$semesters[$semester['semester_id']] = $semester;
	
if($request['semester_id']){
	$current_semester = $request['semester_id'];
}

$_SESSION['current_semester'] = $current_semester;

function is_admin(){
	global $user;
	return ($user['admin'] == 1 ? TRUE : FALSE); 
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Intra - Arizona Student Unions</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="schedule.js" ></script>

<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.css">
<script src="bootstrap/js/bootstrap.js"></script>

<script src="http://redbar.arizona.edu/sites/default/files/ua-banner/ua-web-branding/js/ua-web-branding.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://redbar.arizona.edu/sites/default/files/ua-banner/ua-web-branding/css/ua-web-branding.css"/>

<script>
	function load_schedules(){
		schedule = [[[[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]]]];
		init( 'schedule', 'vertical', 1, 26, 26, 18, 7, 2, 12, '', '', 1, 1);
	}

	function search_apps(form){
		$("#search_arrow").click();
		$('#results').html('loading...');	  
		data = {'action':'search', 'fname':form.fname.value, 'lname':form.lname.value, 'schedule':schedule, 'resume':form.resume.checked, "freshman":form.freshman.checked, "sophomore":form.sophomore.checked, "junior":form.junior.checked, "senior":form.senior.checked, "grad":form.grad.checked, "workStudy":form.workStudy.checked, "workExp":form.workExp.checked, "semester":form.semester.value };
		$.ajax({
			type:"post",
			url:"index.ajax.php",
			data:data, 
			success:function(data) {
				$('#results').html(data);
			}
		});

		return false;
	}
	function clear_search(){
		document.search_form.reset();
		schedule = [[[[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]]]];
		init( 'schedule', 'vertical', 1, 26, 26, 18, 7, 2, 12, '', '', 0, 0);
	}

	function save_app(elem, id, general, unit_id){
		data = {'action':'saveApp', 'application_id':id, 'general':general, 'unit_id':unit_id};
		$.ajax({
			type:"post",
			url:"index.ajax.php",
			data:data, 
			dataType: "json",
			success:function(data) {
				elem.parentElement.parentElement.className = 'alert alert-'+data.title;
				elem.parentElement.parentElement.innerHTML = data.message;
				// this.html(data.message);
			}
		});
	}
	// I added email and job_titles to this function for the rejection email.
	// these functions post variables to the index.ajax.php page. They are 
	// then available to PHP as $_POST variables.
	function disregard_app(elem, id, email, job_titles){
		elem.parentElement.parentElement.innerHTML = 'Application Removed';
		data = {'action':'removeApp', 'application_id':id, 'email':email, 'job_titles':job_titles};
		$.post("index.ajax.php", data); 
	}
	function return_app(elem, id){
		elem.parentElement.parentElement.innerHTML = 'Application Removed';
		data = {'action':'returnApp', 'application_id':id};
		$.post("index.ajax.php", data); 
	}
	function hired_app(elem, id, email){
		elem.parentElement.parentElement.innerHTML = 'Applicant Hired';
		data = {'action':'hiredApp', 'application_id':id, 'email':email};
		$.post("index.ajax.php", data); 
	}

	$(document).ready(function(){

		<?php if($_GET['page'] == 'search'){ ?>
			load_schedules();

			$('#search_arrow').click(function(){
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$('#search_arrow .glyphicon').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
				
				$('#search_arrow .text').text('show');
				$('#search_form').animate({height:'0px'});
			}else{
				$(this).addClass('active');
				$('#search_arrow .glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
				$('#search_arrow .text').text('hide');
				$('#search_form').animate({height:'600px'});
			}
		});
		<?php } ?>

		$('.menu a').click(function(){
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
			// return false;
		})

		$("#unit_select").change(function() { 
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
		
		// re-post this page with the value of the unitVal from the dropdown in the query string. you will be able to see the query string in the address bar of the browser. PHP can then process the variable in the query string.
		// window.location='index.php?unitVal=' + unitVal;
		window.location = 'index.php?unit=' + unitVal;
		 // + '&filterVal=' + filterVal;
			
	}
	
</script>

<style>
	[class*="icon-"]:before {display:block;}
	select{margin-top:10px;}
	td{
		max-width:250px;
		vertical-align:top;
	}
	body{
		font-size: 12px;
		background-color:#C8CDB9;
	}
	
	#ua_banner{
		background-color:#;
	}

	.app{
		display:block;
		padding: 5px 15px;
		border-color: #e7e7e7;
		border-radius:4px;
		background-color: #f8f8f8;
		-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 5px rgba(0, 0, 0, 0.075);
		box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 5px rgba(0, 0, 0, 0.075);
	}
	.navbar-default{
		border-top-left-radius: 0;
		border-top-right-radius: 0;
	}
	.navbar-red{
		background-color: rgb(171,5,32); /* Old browsers */
	  /* IE9 SVG, needs conditional override of 'filter' to 'none' */
	  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2FiMDUyMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM3NzAzMTUiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
	  background-image: -moz-linear-gradient(top,  rgba(171,5,32,1) 0%, rgba(119,3,21,1) 42px); /* FF3.6+ */
	  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(171,5,32,1)), color-stop(42px,rgba(119,3,21,1))); /* Chrome,Safari4+ */
	  background-image: -webkit-linear-gradient(top,  rgba(171,5,32,1) 0%,rgba(119,3,21,1) 42px); /* Chrome10+,Safari5.1+ */
	  background-image: -o-linear-gradient(top,  rgba(171,5,32,1) 0%,rgba(119,3,21,1) 42px); /* Opera 11.10+ */
	  background-image: -ms-linear-gradient(top,  rgba(171,5,32,1) 0%,rgba(119,3,21,1) 42px); /* IE10+ */
	  background-image: linear-gradient(to bottom,  rgba(171,5,32,1) 0%,rgba(119,3,21,1) 42px); /* W3C */
	  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ab0520', endColorstr='#770315',GradientType=0 ); /* IE6-8 */
	}

</style>
 
</head>
<body>
	<div class="container">
		<header class="navbar navbar-default" role="navigation">
		
			<div id="ua-web-branding-banner-v1" class="ua-wrapper bgDark red-grad">
				<a class="ua-home asdf" href="http://arizona.edu" title="The University of Arizona">
					<p>The University of Arizona</p>
				</a>
			</div>

		  	<div id="img_banner">
		  		<img src="/intra_new/themes/union_intra2/images/SUMC-southwest-exterior.jpg" style="width:100%">
		  	</div>

			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
	          	</button>
				<a class="navbar-brand" href="http://union.arizona.edu/intra_new">Union: Intra</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav menu">
					<li <?= $_GET['page'] == "" ? "class='active'" : NULL; ?>>
						<a href="/employment/admin/" id="new" ><span class="glyphicon glyphicon-th-list"></span> New Applications</a>
					</li>
					<li <?= $_GET['page'] == "your-apps" ? "class='active'" : NULL; ?>>
						<a href="/employment/admin/index.php?page=your-apps" id="your"><span class="glyphicon glyphicon-floppy-disk"></span> Your Applications</a>
					</li>
					<li <?= $_GET['page'] == "search" ? "class='active'" : NULL; ?>>
						<a href="/employment/admin/index.php?page=search" id="search"><span class="glyphicon glyphicon-search"></span> Search Applications</a>
					</li>
				</ul>
				<?php if(is_admin()){?>
					<div class="navbar-right">
						<ul class="nav navbar-nav menu">
						      <li <?= $_GET['page'] == "users" ? "class='active'" : NULL; ?>>
						        <a href="/employment/admin/index.php?page=users" id="users"><span class="glyphicon glyphicon-user"></span> Users</a>
						      </li>
						      <li <?= $_GET['page'] == "units" ? "class='active'" : NULL; ?>>
						      	<a href="/employment/admin/index.php?page=units" id="units"><span class="glyphicon glyphicon-briefcase"></span> Units</a>
						      </li>
						</ul>
					</div>
			    <? } ?>
			</div>

		</header>

		
		<section class="container-fluid">
			<?php switch($_GET['page']) { 
				case "your-apps": ?>
					<div id="apps-your" class="app table-responsive">
					<?php  
						$result1 = $db->query('select distinct application_id from applying_for join checkouts using(application_id, unit_id) join applications using(application_id) join schedules using( application_id ) where applications.active=1 and schedules.semester_id='.$current_semester.' and checkouts.manager = "'.$_SESSION['user']['netid'].'"');
						while($row = mysqli_fetch_assoc($result1)){
							$id = $row['application_id'];
							$application = get_application($current_semester,$id);
							$managers = $db->query('SELECT manager, phase_date FROM checkouts where application_id ='.$id);
							while($m = mysqli_fetch_assoc($managers)){
								$application['checked_out'][] = array('manager'=>$m['manager'],'date'=>date('M d, Y ', strtotime($m['phase_date'])));
							}
							$application['jobs'] = get_jobs($id);
							$application['work_history'] = get_work_history($id);
							
							$apps3[] = $application;
						} 
					?>

					<h1>Your Saved Applications</h1>
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
							// echo "<pre>"; print_r($app); echo "</pre>";
							echo '<tr >';
								echo '<td><div>';
									if($app['hired'] == 1){
										echo '<div class="alert alert-danger">Note: This student has already been hired.</div>';
									}
									echo ucwords($app['firstName']).' '.ucwords($app['lastName']).'<br />'.
										$app['classStanding'].'<br />'.
										($app['previouslyWorked']?'Worked for Union<br />':'');
									echo "<h6>Interested In:</h6>";
										foreach($app['jobs'] as $job){
											if($job['type'] == 'unit'){
												$result = $db->query('select * from units where unit_id='.$job['unit_id'].' order by name ASC');
												$units = $result->fetch_assoc();
												echo "<label>Unit:</label> " . $units['name'] . '<br />';
											}else{
												echo "<label>Position:</label> " . $job['title'].'<br />';
											}
										}
									echo "</ul>";
									echo '<br /><span><label>Phone:</label> ' .preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3",$app['phoneNumber']).'</span><br />
									<span><label>Email:</label> '.$app['email'].'</span></br />';
									echo '<span><label>Date Submitted:</label> '.date("F j, Y, g:i a",strtotime($app['date_submitted'])).'</span></br />';
									echo '<span><label>Date Updated:</label> '. (strtotime($app['date_updated']) == strtotime('0000-00-00 00:00:00') ? "Never" : date("F j, Y, g:i a",strtotime($app['date_updated']))) .'</span></br />';
									echo '<a href="application.php?id='.$app['application_id'].'">Download Application</a><br />';
									if($app['resume_id'])
										echo '<a href="resume.php?id='.$app['resume_id'].'">Download Resume</a><br />';

									if(is_array($app['checked_out'])){
										echo "<h6>History</h6>";
										echo "<ul>";
										foreach ($app['checked_out'] as $c){
											if($_SESSION['user']['netid'] !== $c['manager'])
												echo "<li>Saved by " . $c['manager'] . " on " . $c['date'] . "</li>";
											else
												echo "<li>You saved this on " . $c['date'] . "</li>";
										}
										echo "</ul>";
									}

									echo '<br /><div class="btn-group btn-group-justified">
									<div class="btn-group">' . 
										($app['hired'] != 1 ? '<input type="button" class="btn btn-success" value="Hire" onclick="hired_app(this,'.$app['application_id'].',\''.$app['email'].'\')"/>' : '<input type="button" class="btn btn-default" value="Already Hired" disabled/>' ) . 
									'</div>';
									echo '<div class="btn-group"><input type="button" value="Remove App" onclick="return_app(this,'.$app['application_id'].')" class="btn btn-danger"/></div>';
									
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

			<?php break; ?>

			<?php case "search": ?>
				<div id="apps-search" class="app table-responsive">
					<div class="header">
						<h1 style="float:left;">Search Applications</h1>

						<div id="search_arrow" class="active btn btn-default" style="cursor:pointer; float:left; font-size:12px; font-weight:normal; height:14px; margin-top:25px; margin-left: 10px;">&nbsp;<span class="text">hide</span> search &nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-up"></span></div>
						<br />
						<br/>
					</div>
					
					<form id="search_form" name="search_form" onsubmit="return search_apps(this)" style="height:600px; overflow:hidden; clear:both;">
						<div style="float:left; width:300px;">
							<label for="fname">First Name:</label><br />
							<input type="text" name="fname" /><br />
							<br />
							
							<label for="lname">Last Name:</label><br />
							<input type="text" name="lname" /><br />
							<br />
							
							<div>
								<label for="">Semester:</label>  
								<select name="semester">
									<?php
										foreach($semesters as $semester_id => $semester)
											echo '<option value="'.$semester_id.'" '.($semester_id==$current_semester?'selected':'').'>'.$semester['name'].'</option>';
									?>
								</select>
							</div><br/>

							Include only those with:<br />
							<div>
								<div class="checkbox">
								  <label>
								    <input type="checkbox" name="resume" value="1">
								   	A Resume
								  </label>
								</div>
								<div class="checkbox">
								  <label>
								    <input type="checkbox" name="workExp" value="1">
								    Work Experience
								  </label>
								</div>
								<div class="checkbox">
								  <label>
								    <input type="checkbox" name="workStudy" value="1">
								    Work Study
								  </label>
								</div>
							</div>
							<br/>
				 			Exclude the following:
							 <div>
							 	<div class="checkbox">
								  <label>
								   	<input type="checkbox" name="hss" value="1"> High School Students
								  </label>
								</div>
								  <div class="checkbox">
								  <label>
								    <input type="checkbox" name="freshman" value="1"> Freshmen
								  </label>
								</div>
								  <div class="checkbox">
								  <label>
								    <input type="checkbox" name="sophomore" value="1"> Sophomores
								  </label>
								</div>
								  <div class="checkbox">
								  <label>
								     <input type="checkbox" name="junior" value="1"> Juniors
								  </label>
								</div>
								  <div class="checkbox">
								  <label>
								   <input type="checkbox" name="senior" value="1"> Seniors
								  </label>
								</div>
								  <div class="checkbox">
								  <label>
								    <input type="checkbox" name="grad" value="1"> Grad Students
								  </label>
							  </div>
							</div>
							<br />
							<div class="btn-group btn-group-justified">
								<div class="btn-group"><input type="submit" value="search" class='btn btn-default'/></div>
								<div class="btn-group"><input type="button" value="reset" class="btn btn-default" onclick="clear_search()"/></div>
							</div>
						</div>
						<div style="float:left;margin-left:150px;">
							<br />
							<br />
							<div id="schedule" style="position:relative;">
								
							</div>
						</div>
					</form>
					<div id="results" style="padding-top:20px;">
						
					</div>
				</div>
			<?php break; ?>
			
			<?php case 'users': ?>

				<div id="apps-users" class="app table-responsive">
					<h1>User Management</h1>
					<?php if(is_admin()){ //check admin ?>

						<?php 
							if($request['action'] == 'saveUser'){
								if(isset($request['netid']) && $request['netid'] != ""){
									$return = array('title'=>'success','message'=>'Successfully added '.$request['netid']);
									$db->query('insert into users set netid="'.$request['netid'].'", app_id = 1, unit_id='.$request['unit'].', admin='.($request['admin'] == 'on' ? 1 : 0));
								}else{
									$return = array('title'=>'danger','message'=>'Please completely fill out the form');
								}
							}elseif($request['action'] == 'confirmDelete'){
								$return = array('title'=>'danger','message'=>'Are You Sure? <a href="/employment/admin/index.php?page=users&action=deleteUser&id='.$request['id'].'">Yes</a> / <a href="/employment/admin/index.php?page=users">No</a>');
							}elseif($request['action'] == 'deleteUser'){
								$user = mysqli_fetch_assoc($db->query('select user_id,admin from users where user_id='.$request['id']));
								if($user['user_id'] == $_SESSION['user']['user_id']){
									$return= array('title'=>'danger','message'=>'You can\'t delete yourself...');
								}else{
									$db->query('delete from users where user_id='.$request['id']);
									$return= array('title'=>'success','message'=>'Successfully deleted');
								}
							}elseif($request['action'] == 'updateUser'){
								if(isset($request['netid']) && $request['netid'] != ""){
									$db->query('update users set netid="'.$request['netid'].'", unit_id='.$request['unit'].', admin='.($request['admin'] == 'on' ? 1 : 0).' where user_id='.$request['id']);
									$return = array('title'=>'success','message'=>'Successfully Changed');
								}else{
									$return = array('title'=>'danger','message'=>'Please completely fill out the form');
								}
							}
						?>

						<?php if($return){ ?>
							<div class="alert alert-<?= $return['title']; ?>"><?= $return['message']; ?></div>
						<? } ?>

						<?php if($request['action'] == 'editUser') { ?>
							<? $user = mysqli_fetch_assoc($db->query('select * from users u join units un using(unit_id) where u.app_id = 1 and u.user_id='.$request['id'])); ?>
							<form action="/employment/admin/index.php?page=users" method="post" role="form">
								<table class="table table-bordered">
									<tr>
										<th>NetID:</th>
										<td><input type="text" name="netid" value="<?= $user['netid']; ?>"></td>
									</tr>
									<tr>
										<th>Unit:</th>
										<td>
											<select name="unit">
												<?php
													foreach($units as $unit){	
														echo '<option name="unit" value="'.$unit['id'].'" '.($unit['name']==$user['name']?'selected':'').'>'.$unit['name'].'</option>';
													} 
												?>
											</select>
										</td>
									</tr>
									<tr>
										<th>Admin:</th>
										<td><input type="checkbox" name="admin" <?= ($user['admin'] == 1 ? "checked" : NULL);?>></td>
									</tr>
								</table>

								<input type="submit" value="Save" class="btn btn-default">
								<a href="/employment/admin/index.php?page=users" class="btn btn-default">Cancel</a>
								<input type="hidden" name="id" value="<?= $user['user_id'];?>">
								<input type='hidden' value='updateUser' name='action' />
							</form>
						<?php }else{ ?>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>NetID</th>
										<th>Unit</th>
										<th>Admin</th>
										<th>Options</th>
									</tr>
								</thead>

							<?php 
								$result = $db->query('select * from users u join units un using(unit_id) where u.app_id = 1');
								while($user_info = mysqli_fetch_assoc($result)){
									echo "<tr>" . 
											 "<td>" . $user_info['netid'].($user_info['user_id'] == $_SESSION['user']['user_id'] ? " - <span class='badge'>You</span>" : NULL)."</td>".
											 "<td>" . $user_info['name']."</td>".
											 "<td>" . ($user_info['admin'] == 1 ? 'Yes' : 'No')."</td>".
											 "<td>
											 	<a href='/employment/admin/index.php?page=users&action=editUser&id=".$user_info['user_id']."' class='btn btn-default'>Edit</a>" . ($user_info['user_id'] != $_SESSION['user']['user_id'] ? "
											 	<a href='/employment/admin/index.php?page=users&action=confirmDelete&id=".$user_info['user_id']."' class='btn btn-default'>Delete</a>" : NULL) . 
											 "</td>
										</tr>";
								}
							?>
								<form method='post' action='/employment/admin/index.php?page=users' enctype='multipart/form-data'>
									<tr>
										<td><input type="text" name="netid"></td>
										<td>
											<select name="unit" style="width:200px;">
												<?php
													foreach($units as $unit){	
														echo '<option name="unit" value="'.$unit['id'].'" '.($unit['name']==$user['unit_name']?'selected':'').'>'.$unit['name'].'</option>';
													} ?>
											</select>
										</td>
										<td><input type="checkbox" name="admin"></td>
										<td><input type="submit" value="Save" class="btn btn-default"></td>
									</tr>
									<input type="hidden" name="action" value="saveUser">
								</form>
							</table>
						<?php } ?>
					

					<?php 
						}else{ 
							echo '<div class="alert alert-danger">You\'re not authorized to use this portion.</div>';
						} 
					?>
				</div>

			<?php break; ?>

			<?php case 'units': ?>

				<div id="apps-units" class="app">
					<h1>Units</h1>

					<?php if(is_admin()){ //check admin ?>
						<?php
							if($request['action'] == 'updateUnit'){
								$db->query('update units set name="'.$request['name'].'", accepting_applications='.($request['active'] == 'on' ? 1 : 0) . ' where unit_id='.$request['id']);
								$return = array('title'=>'success','message'=>'Successfully changed.');
							}elseif($request['action'] == 'confirmDeleteUnit'){
								$return = array('title'=>'danger','message'=>'Are You Sure? <a href="/employment/admin/index.php?page=units&action=deleteUnit&id='.$request['id'].'">Yes</a> / <a href="/employment/admin/index.php?page=units">No</a>');
							}elseif($request['action'] == 'deleteUnit'){
								$db->query('delete from units where unit_id='.$request['id']);
								$return= array('title'=>'success','message'=>'Successfully deleted');

							}
						?>

						<?php if($return){ ?>
							<div class="alert alert-<?= $return['title']; ?>"><?= $return['message']; ?></div>
						<? } ?>

						<?php if($request['action'] == 'editUnit') { ?>
							<?php $unit = mysqli_fetch_assoc($db->query('select * from units where unit_id ='.$request['id'])); ?>
							<form action="/employment/admin/index.php?page=units" method="post" role="form">
								<table class="table table-bordered">
									<tr>
										<th>Name:</th>
										<td><input type="text" name="name" value="<?= $unit['name']; ?>"></td>
									</tr>
									<tr>
										<th>Active:</th>
										<td><input type="checkbox" name="active" <?= ($unit['accepting_applications'] == 1 ? "checked" : NULL);?>></td>
									</tr>
								</table>

								<input type="submit" value="Save" class="btn btn-default">
								<a href="/employment/admin/index.php?page=units" class="btn btn-default">Cancel</a>
								<input type="hidden" name="id" value="<?= $unit['unit_id'];?>">
								<input type='hidden' value='updateUnit' name='action' />
							</form>
						<?php }else { ?>

							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Unit</th>
										<th>Active</th>
										<th>Options</th>
									</tr>
								</thead>
							<?php
								foreach($units as $unit){	
									echo "<tr>" .

										"<td>" . $unit['name'] . ($unit['name']==$user['unit_name']? " - <span class='badge'>Your Unit</span>":'')."</td>
										<td>" . ($unit['active'] == 1 ? "Yes" : "No") . "</td>
										<td><a class='btn btn-default' href='/employment/admin/index.php?page=units&action=editUnit&id=".$unit['id']."'>Edit</a>
										<a class='btn btn-default' href='/employment/admin/index.php?page=units&action=confirmDeleteUnit&id=".$unit['id']."'>Delete</a></td>
									</tr>";
								} ?>

							</table>

						<?php } ?>

					<?php 
						}else{ 
							echo '<div class="alert alert-danger">You\'re not authorized to use this portion.</div>'; 
						} //echo not authorized 
					?>
				</div>

			<?php break; ?>

			<?php default: //this is default ?>
				<?php 
					$result1 = $db->query('select distinct application_id from applying_for left join checkouts using(application_id, unit_id) join applications using(application_id) join schedules using( application_id ) where active=1 and hired!=1 and applying_for.unit_id='.$user['unit_id'].' and semester_id='.$current_semester);
					while($row = mysqli_fetch_assoc($result1)){
						$id = $row['application_id'];

						$application = get_application($current_semester,$id);
						$managers = $db->query('SELECT manager, phase_date FROM checkouts where application_id ='.$id);
							while($m = mysqli_fetch_assoc($managers)){
								if($m['manager'] == $_SESSION['user']['netid'])
									$application['saved'] = '1';
								$application['checked_out'][] = array('manager'=>$m['manager'],'date'=>date('M d, Y ', strtotime($m['phase_date'])));
							}
						$application['jobs'] = get_jobs_by_unit($user['unit_id'],$id);
						$application['work_history'] = get_work_history($id);
						$apps[] = $application;
					}
				?>	
				<nav class="navbar navbar-inverse navbar-red">
					<div id="admin_select" class="navbar-left">
						<!-- <input type="checkbox" name="singleUnit" id="singleUnit" value="1" <?php if(isset($_POST['singleUnit'])) { echo "checked=\"checked\""; } ?>><label style="color:#fff;" for="singleUnit">Single Unit Search</label> -->
						<a class="navbar-brand"><label style="color:#fff;">Select Unit:</label></a>
					</div>
					<div class="navbar-left">
						<ul class="nav">
							<li>
								<select id="unit_select" class="form-control">
									<option value="" disabled selected>Select A Unit</option>
									<?php
										foreach($units as $unit){	
											echo '<option value="'.$unit['id'].'" '.($unit['name']==$user['unit_name']?'selected':'').'>'.$unit['name'].'</option>';
										} ?>
								</select>
							</li>
						</ul>
						
					</div>
					
					<div class="navbar-right">
						<ul class="nav">
							<li>
								<select class="form-control" onchange="window.location = 'index.php?semester_id='+this.options[this.selectedIndex].value">
									<?php
										foreach($semesters as $semester_id => $semester)
											echo '<option value="'.$semester_id.'" '.($semester_id==$current_semester?'selected':'').'>'.$semester['name'].'</option>';
									?>
								</select>
							</li>
						</ul>
						
					</div>
					<div class="navbar-right">
						<a class="navbar-brand"><label style="color:#fff;">Semester:</label></a>
					</div>
					
				</nav>
  
				<div id="apps-new" class="app active table-responsive">
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
							// echo "<pre>"; print_r($app); echo "</pre>";
							$app['job_titles'] = "";
						
							echo '<tr>
									<td>' .
									    '<div>'. 
											'<span>' . ucwords($app['firstName']) . ' ' . ucwords($app['lastName']) . '</span><br/>' .  
											'<span>' . $app['classStanding'].'</span><br/>' .  
											($app['previouslyWorked']?'Worked for Union<br/>':'');
											echo "<h6>Interested In:</h6>";
											foreach($app['jobs'] as $job){
												if($job['type'] == 'unit')
													echo "<label>Unit:</label> " . $_SESSION['user']['unit_name'].'<br/>';
												else
													echo "<label>Position:</label> " . $job['title'].'<br/>';
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
											<label>Phone: </label> <span>'.preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3",$app['phoneNumber']).'</span><br />
											<label>Email:</label> <span>'.$app['email'].'</span></br />
											<label>Date Submitted:</label> <span>'.date("F j, Y, g:i a",strtotime($app['date_submitted'])).'</span></br />
											<label>Date Updated:</label> <span>'. (strtotime($app['date_updated']) == strtotime('0000-00-00 00:00:00') ? "Never" : date("F j, Y, g:i a",strtotime($app['date_updated']))) .'</span></br />';
										echo '<a href="application.php?id='.$app['application_id'].'">Download Application</a><br />';
											if($app['resume_id'])
												echo '<a href="resume.php?id='.$app['resume_id'].'">Download Resume</a><br />';
										
										echo '</div><br />';

										if(is_array($app['checked_out'])){
											echo "<h6>History</h6>";
											echo "<ul>";
											foreach ($app['checked_out'] as $c){
												if($_SESSION['user']['netid'] !== $c['manager'])
													echo "<li>Saved by " . $c['manager'] . " on " . $c['date'] . "</li>";
												else
													echo "<li>You saved this on " . $c['date']. "</li>";
											}
											echo "</ul>";
										}
										echo '<div class="btn-group btn-group-justified">';
											if($app['saved'] != 1){
												echo '<div class="btn-group"><input type="button" class="btn btn-primary" value="Save App" onclick="save_app(this,'.$app['application_id'].',0,' .$job['unit_id'] .')"/></div>';
											}else{
												echo '<div class="btn-group"><button class="btn btn-default active">Saved</button></div>';
											}
											echo '<div class="btn-group"><input type="button" class="btn btn-danger" value="Disregard App" onclick="disregard_app(this,'.$app['application_id'].',\''.$app['email'].'\',\''.$app['job_titles'].'\')"/></div>';
										echo '</div>';
										
										// I added the email and job_titles value to the call to disregard_app, so that we have those variables for the rejection email.	
										// the individual strings have to be quoted in order to work, so we have some additional escaped single quotes before and after, 
										// which makes this onclick statement look kind of strange.
								echo '</td>';
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
				
			<?php break; } //end switch ?>
				
		</section>
	
	</div>

</body>
</html>