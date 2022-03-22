<?php
session_start();
require_once('includes/mysqli.inc');
$db = new db_mysqli('student_hiring');


$action = $_POST["action"];

// foreach($_REQUEST as $key => $value)
// 	$request[$key] = $db->real_escape_string($value);
	
// $action = $request["action"];


if(!isset($_SESSION['user'])){
	echo 'Not Authorized';
	exit();
}

require_once('functions.php');

switch($action){
	case 'debug':
		echo "<pre>" ; print_r($_SESSION); echo "</pre>";
	break;
	case 'search':
		
		$i=0;
		//var_dump($_POST['schedule'][0][0]);
		foreach($_POST['schedule'][0][0] as $day){ 
		    $days[$i][0] = bindec(substr(implode('',$day), 0, 24));
		    $days[$i++][1] = bindec(substr(implode('', $day), 24, 24));
		  }

		

		//var_dump($days);
		$query = 'select distinct applications.*, schedules.*, resume_id, (BIT_COUNT(mon & '.$days[0][0].') + BIT_COUNT(mon2 & '.$days[0][1].') + BIT_COUNT(tue & '.$days[1][0].') + BIT_COUNT(tue2 & '.$days[1][1].') + BIT_COUNT(wed & '.$days[2][0].') + BIT_COUNT(wed2 & '.$days[2][1].') + BIT_COUNT(thu & '.$days[3][0].') + BIT_COUNT(thu2 & '.$days[3][1].') + BIT_COUNT(fri & '.$days[4][0].') + BIT_COUNT(fri2 & '.$days[4][1].') + BIT_COUNT(sat & '.$days[5][0].') +BIT_COUNT( sat2 & '.$days[5][1].') + BIT_COUNT(sun & '.$days[6][0].') + BIT_COUNT(sun2 & '.$days[6][1].')) as matchdegree from applications join schedules using(application_id) left join resumes using(application_id) join applying_for using(application_id) left join work_history using (application_id) where active=1 and app_id=1 and semester_id='.$_POST['semester'];
		
		if($_POST['resume'] == 'true'){
			$query .= ' and resume_id is not NULL';
		}

		if($_POST['work_exp'] == 'true'){
			$query .= ' and work_history_id is NOT NULL';
		}

		if($_POST['hss'] == 'true'){
			$query .=' and studentType <> "high_school_student"';
		}
		if($_POST['freshman'] == 'true'){
			$query .=' and classStanding <> "Freshman"';
		}
		  
		if($_POST['sophomore'] == 'true'){
		$query .=' and classStanding <> "Sophomore"';
		}
		  
		if($_POST['junior'] == 'true'){
		$query .=' and classStanding <> "Junior"';
		}
		  
		if($_POST['senior'] == 'true'){
		$query .=' and classStanding <> "Senior"';
		}
		  
		if($_POST['grad'] == 'true'){
		$query .=' and classStanding <> "Grad Student"';
		}
		  
		if($_POST['fname'] != ''){
		$query .= ' and firstName like "'.$_POST['fname'].'%"';
		}
		  
		if($_POST['lname'] != ''){
		$query .= ' and lastName like "'.$_POST['lname'].'%"';
		}

		if($_POST['workStudy'] == 'true'){
			$query .= ' and workStudy = 1';
		}
		
		$query .= ' order by matchdegree desc';
		// echo "<pre>"; print_r($days); echo "</pre>";
		// die();




		// die();
		$results = $db->query($query);
		
		while($application = mysqli_fetch_assoc($results)){
			// echo "<pre>"; print_r($application['matchdegree']); echo "</pre>";
			// echo "<pre>"; print_r($application); echo "</pre>";
			$id = $application['application_id'];

			$managers = $db->query('SELECT manager, phase_date FROM checkouts where application_id ='.$id);
				while($m = mysqli_fetch_assoc($managers)){
					if($m['manager'] == $_SESSION['user']['netid'])
						$application['saved'] = '1';
					$application['checked_out'][] = array('manager'=>$m['manager'],'date'=>date('M d, Y ', strtotime($m['phase_date'])));
				}
			$application['jobs'] = get_jobs($id);
			$application['work_history'] = get_work_history($id);
			
			$apps[] = $application;
		}
		// die();
		if(!is_array($apps)){
			echo 'no matching results';
		}
		else{
		?>
		<table width="100%" cellspacing="0" class="table table-bordered table-responsive">
			<thead>
				<th>Information</th>
				<th>Schedule</th>
				<th>Work History</th>
				<th>Comments</th>
			</thead>
			<?php
			
			foreach($apps as $app){
				echo '<tr >';
					echo '<td><div>';
						if($app['hired'] == 1){
							echo '<div class="alert alert-danger">Note: This student has already been hired.</div>';
						}
						echo $app['firstName'].' '.$app['lastName'].'<br />'.'Student ID: '.$app['emplid'].'<br />'.$app['classStanding'].'<br />'.($app['previouslyWorked']?'Worked for Union<br />':'');
						echo "<h6>Interested In:</h6>";
						foreach($app['jobs'] as $job){
							if($job['type'] == 'unit'){
								$result = $db->query('select * from units where unit_id='.$job['unit_id'].' order by name ASC');
								$units = $result->fetch_assoc();
								echo "<label>Unit:</label> " . $units['name'].'<br />';
							}else{
								echo "<label>Position:</label> " . $job['title'].'<br />';
							}
						}
						echo '<br />'.preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3",$app['phoneNumber']).'<br /><span>'.$app['email'].'</span></br />';
						echo '<span>Date Submitted: '.date("F j, Y, g:i a",strtotime($app['date_submitted'])).'</span></br />';
						echo '<span>Date Updated: '. (strtotime($app['date_updated']) == strtotime('0000-00-00 00:00:00') ? "Never" : date("F j, Y, g:i a",strtotime($app['date_updated']))) .'</span></br />';
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
						
						echo '<div class="btn-group btn-group-justified">';
							if($app['hired'] != 1){
								if($app['saved'] != 1){
									echo '<div class="btn-group"><input type="button" class="btn btn-primary" value="Save App" onclick="save_app(this,'.$app['application_id'].',0,' .$job['unit_id'] .')"/></div>';
								}else{
									echo '<div class="btn-group"><button class="btn btn-default" disabled>Saved</button></div>';
								}
							}else{
								echo '<div class="btn-group"><button class="btn btn-default" disabled>Already Hired</button></div>';
							}

							echo '<div class="btn-group"><input type="button" class="btn btn-danger" value="Disregard App" onclick="disregard_app(this,'.$app['application_id'].',\''.$app['email'].'\',\''.$app['job_titles'].'\')"/></div>';
						echo '</div>';
					echo '</div>';
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
		<br /><br />
		<?php
		}
	break;
	//checks out app, fix so can only be checked out once.
	case 'saveApp':
		$results = $db->query('select * from checkouts where application_id='.intval($_POST['application_id']).' and manager="'.$_SESSION['webauth']['netID'].'"');
		if($results->num_rows > 0){
			$return = array('title'=>'danger','message'=>'You have already saved this application.');
		}else{
			$db->query('insert into checkouts set application_id='.intval($_POST['application_id']).', app_id=1, unit_id='.$_POST['unit_id'].', general="'.intval($_POST['general']).'", manager="'.$_SESSION['webauth']['netID'].'", phase=1');
			$return = array('title'=>'success','message'=>'Application saved');
		}
		echo json_encode($return);
	break;
	//removes applied app all together
	case 'removeApp':
		// if both variables are set, send the email.
		if ((isset($_POST['email'])) && (isset($_POST['job_titles'])))
		{
			#uncomment this to send rejection email. 1.3.14
			// rejectionEmail($_POST['email'], $_POST['job_titles']);
		}
		// unset the two variables, after  
		// sending the email, just to be safe.
		if (isset($_POST['email']))
		{
			unset($_POST['email']);
		}
		if (isset($_POST['job_titles']))
		{
			unset($_POST['job_titles']);
		}
		// delete the record(s) for the position(s) applied for.
		$db->query('delete from applying_for where application_id='.intval($_POST['application_id']).' and  type="position" and unit_id='.$_SESSION['user']['unit_id']);
	break;

	//delete checked out app, will likely name to something better.
	case 'returnApp':
		$db->query('delete from checkouts where application_id='.intval($_POST['application_id']).' and manager="'.$_SESSION['user']['netid'] . '"');
		$return = array('title'=>'success','message'=>'Application removed');
		echo json_encode($return);
	break;
	case 'hiredApp':
		
		if (isset($_POST['email'])) 
		{
			// hiredEmail($_POST['email']);
		}
		
		// unset the variable, after sending 
		// the email, just to be safe.
		if (isset($_POST['email']))
		{
			unset($_POST['email']);
		}
		
		// hired applicant is a combination of remove application 
		// and disregard application (without the rejection email).
		// we also need to set the hired flag in the application table to 1.
		$query = 'delete from checkouts where application_id='.intval($_POST['application_id']).' and unit_id='.$_SESSION['user']['unit_id'];
		$db->query($query);
		$query = 'delete from applying_for where application_id='.intval($_POST['application_id']).' and  type="position" and unit_id='.$_SESSION['user']['unit_id'];
		$db->query($query);
		$query = 'update applications set hired=1 where application_id='.intval($_POST['application_id']).'';
		$db->query($query);
	break;
}
