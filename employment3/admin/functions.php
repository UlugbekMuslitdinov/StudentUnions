<?php

//returns application of student
function get_application($semester,$appID){
	global $db;
	return $application = mysqli_fetch_assoc($db->query('select * from applications join schedules using(application_id) left join resumes using(application_id) where app_id=1 and  semester_id='.$semester.' and application_id='.$appID));
}

//returns array of jobs applied for
function get_jobs($appID){
	global $db;
	$result = $db->query('select * from applying_for where application_id='.$appID);
	while($job = mysqli_fetch_assoc($result))
		$results[] = $job;
	return $results;
}
//returns array of jobs applied for
function get_jobs_by_unit($unitID, $appID){
	global $db;
	$result = $db->query('select * from applying_for where unit_id = '.$unitID.' and application_id='.$appID);
	while($job = mysqli_fetch_assoc($result))
		$results[] = $job;
	return $results;
}
//returns array of work history
function get_work_history($appID){
	global $db;
	$result = $db->query('select * from work_history where application_id='.$appID);
	while($work_history = mysqli_fetch_assoc($result))
		$results[] = $work_history;
	return $results;
}



// function to generate rejection email
function rejectionEmail($email, $job_titles) {
	$job_titles = str_replace("#", " ", $job_titles);
	$job_titles = str_replace("|", ", ", $job_titles);

	require_once ("phplib/mimemail/htmlMimeMail5.php");
	$mail1 = new htmlMimeMail5();

	//Set the From and Reply-To headers
	$mail1 -> setFrom('Arizona Student Union<no-reply@email.arizona.edu>');
	$mail1 -> setReturnPath('no-reply@email.arizona.edu');

	//Set the subject
	$mail1 -> setSubject('Thank you for applying for a student job at the Arizona Student Unions!');

	$body = '<p><h2>Thank you for applying for a student job at the Campus Recreation Center!</h2></p>
		<p>Recent Applicant to the Arizona Student Unions,</p> 
		<p>Thank you for applying to work for the position(s): ';

	$body .= $job_titles;

	$body .= 'at the Arizona Student Unions.  We have come to the conclusion that another candidate\'s 
		qualifications are more suitable for our requirements. We sincerely regret that we cannot offer you 
		employment with our organization at this time.</p>
		
		<p>We encourage you to resubmit your application to the various other open positions at the Arizona Student Unions. The full list of openings can be found at the <a href="http://union.arizona.edu/employment/available.php" >Employment page</a> listed under Available Positions. At any time you may log back into your application with your NetID and password. This will take you to your status page where you can edit your application, deactivate it, or reactivate it in our system. When editing your application you may change your personal information,  schedule, or job position preferences. This may increase your chances of being hired.</p>
		
		<p>We wish you all the luck with your job search and thank you again for your interest in our organization.</p>
		<p>Please do not hesitate to contact us at <a href="mailto:unionshr@email.arizona.edu">unionshr@email.arizona.edu</a>, should you have any questions about your application.</p>

		<p>For technical assistance or problems with the online application, please call 520-626-9205 or email <a href="mailto:unionshr@email.arizona.edu">unionshr@email.arizona.edu</a>.</p>
		<p>
		Thank you, <br />
        Arizona Student Unions <br />
        Human Resources
		</p>';

	$mail1 -> setHTML($body);

	$result = $mail1 -> send(array($email));
}
// function to generate hired email
function hiredEmail($email) {

	require_once ("phplib/mimemail/htmlMimeMail5.php");
	$mail1 = new htmlMimeMail5();

	//Set the From and Reply-To headers
	$mail1 -> setFrom('Arizona Student Union<no-reply@email.arizona.edu>');
	$mail1 -> setReturnPath('no-reply@email.arizona.edu');

	//Set the subject
	$mail1 -> setSubject('Congratulations! We are pleased to confirm you have been selected to work for the University of Arizona Student Unions.');

	$body = '<p><h2>Congratulations! We are pleased to confirm you have been selected to work for the University of Arizona Student Unions.</h2></p>
		
		<p>Please contact University of Arizona Student Unions Human Resources @ (520) 626-9205 to schedule a new-hire appointment.</p>

		<p>Please note your employment with University of Arizona Student Unions is contingent on verification of academic enrollment, and US Citizenship or Right to Work status. </p>

		<p>Please complete the UA forms and USCIS I9 documentation which can be obtained from the URL links below. Please bring the completed forms as well the identification necessary to fulfill the I9 requirements to your new-hire appointment.</p>

		<ul style="list-style-type:none; margin-left: 20px;" >
			<li><a href="http://www.hr.arizona.edu/files/Person_Information_Form_07_19_11.pdf">Personal Information Form</a></li>
			<li><a href="http://www.uscis.gov/files/form/i-9.pdf">Employment Eligibility Verification</a></li>
			<li><a href="http://www.hr.arizona.edu/files/Oath_12_2009.pdf">State of Arizona Loyalty Oath</a></li>
			<li><a href="http://www.hr.arizona.edu/files/selfid082010.pdf">Race/Ethnicity and Sex</a></li>
			<li><a href="http://www.hr.arizona.edu/files/vselfid.pdf">Veteran Status</a></li>
		</ul>
		
		<p>
		Thank you, <br />
        University of Arizona Student Unions<br />
        Human Resources
		</p>';

	$mail1 -> setHTML($body);

	$result = $mail1 -> send(array($email));
}
function build_mini_schedule($mon, $tue, $wed, $thu, $fri, $sat, $sun){


	for($i=0; $i<48; $i++){
	  if($mon[$i] == "1"){
	    $start = $i;
	    $length = 1;
	    while($mon[++$i] == "1"){
	      $length++;
	    }
	    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; top:'.($start*6).'px; left:0px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #FF6600;">
	    <div style="width:100%; height:100%; background-color:#FF6600; opacity: .75; filter:alpha(opacity=75);"></div></div>';
	  }
	}

	for($i=0; $i<48; $i++){
	  if($tue[$i] == "1"){
	    $start = $i;
	    $length = 1;
	    while($tue[++$i] == "1"){
	      $length++;
	    }
	    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; top:'.($start*6).'px; left:12px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #FF6600;">
	    <div style="width:100%; height:100%; background-color:#FF6600; opacity: .75; filter:alpha(opacity=75);"></div></div>';
	  }
	}

	for($i=0; $i<48; $i++){
	  if($wed[$i] == "1"){
	    $start = $i;
	    $length = 1;
	    while($wed[++$i] == "1"){
	      $length++;
	    }
	    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; top:'.($start*6).'px; left:24px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #FF6600;">
	    <div style="width:100%; height:100%; background-color:#FF6600; opacity: .75; filter:alpha(opacity=75);"></div></div>';
	  }
	}

	for($i=0; $i<48; $i++){
	  if($thu[$i] == "1"){
	    $start = $i;
	    $length = 1;
	    while($thu[++$i] == "1"){
	      $length++;
	    }
	    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; top:'.($start*6).'px; left:36px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #FF6600;">
	    <div style="width:100%; height:100%; background-color:#FF6600; opacity: .75; filter:alpha(opacity=75);"></div></div>';
	  }
	}

	for($i=0; $i<48; $i++){
	  if($fri[$i] == "1"){
	    $start = $i;
	    $length = 1;
	    while($fri[++$i] == "1"){
	      $length++;
	    }
	    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; top:'.($start*6).'px; left:48px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #FF6600;">
	    <div style="width:100%; height:100%; background-color:#FF6600; opacity: .75; filter:alpha(opacity=75);"></div></div>';
	  }
	}

	for($i=0; $i<48; $i++){
	  if($sat[$i] == "1"){
	    $start = $i;
	    $length = 1;
	    while($sat[++$i] == "1"){
	      $length++;
	    }
	    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; top:'.($start*6).'px; left:60px; height:'.($length*6-6).'px; _height:'.($lengtht*6-6).'px; border:3px solid #FF6600;">
	    <div style="width:100%; height:100%; background-color:#FF6600; opacity: .75; filter:alpha(opacity=75);"></div></div>';
	  }
	}

	for($i=0; $i<48; $i++){
	  if($sun[$i] == "1"){
	    $start = $i;
	    $length = 1;
	    while($sun[++$i] == "1"){
	      $length++;
	    }
	    $sched .= '<div class="col" style=" z-index:50; position:absolute; width:6px; top:'.($start*6).'px; left:72px; height:'.($length*6-6).'px; _height:'.($length*6-6).'px; border:3px solid #FF6600;">
	    <div style="width:100%; height:100%; background-color:#FF6600; opacity: .75; filter:alpha(opacity=75);"></div></div>';
	  }
	}
	return '<div style="width:100px; height:300px; margin-top:40px; margin-left:75px; position:relative; ">'.$sched.'<div style=" position:absolute; vertical-align:center; height:25px; width:75px; text-align:center; z-index:1000; left:-75px; top:-25px; padding-top:7px;"><strong>Time</strong></div><div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:0px; top:-25px; padding-top:7px;"><strong>M</strong></div><div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:12px; top:-25px; padding-top:7px;"><strong>T</strong></div><div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:24px; top:-25px; padding-top:7px;"><strong>W</strong></div><div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:36px; top:-25px; padding-top:7px;"><strong>R</strong></div><div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:48px; top:-25px; padding-top:7px;"><strong>F</strong></div><div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:60px; top:-25px; padding-top:7px;"><strong>S</strong></div><div style=" position:absolute; height:25px; width:12px; text-align:center; z-index:1000; left:72px; top:-25px; padding-top:7px;"><strong>S</strong></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:159px; left:-75px; top:-25px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:159px; left:-75px; top:-1px; font-size:0px; overflow:hidden;"></div><div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:-75px; top:-25px;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:162px; left:-76px; top:-26px; font-size:0px; overflow:hidden;"></div><div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:316px; left:-76px; top:-26px;"></div><div style="height:313px;  background-color:#99ccFF; position:absolute; z-index:10; width:12px; left:0px; top:-25px; font-size:0px; overflow:hidden;"></div><div style="height:313px;  background-color:#99ccFF; position:absolute; z-index:10; width:12px; left:24px; top:-25px; font-size:0px; overflow:hidden;"></div><div style="height:313px;  background-color:#99ccFF; position:absolute; z-index:10; width:12px; left:48px; top:-25px; font-size:0px; overflow:hidden;"></div><div style="height:313px;  background-color:#99ccFF; position:absolute; z-index:10; width:12px; left:72px; top:-25px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:161px; left:-75px; top:289px; font-size:0px; overflow:hidden;"></div><div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:315px; left:85px; top:-25px;"></div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:0px;">12am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:12px;">1am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:24px;">2am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:36px;">3am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:48px;">4am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:60px;">5am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:72px;">6am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:84px;">7am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:96px;">8am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:108px;">9am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:120px;">10am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:132px;">11am</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:144px;">12pm</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:156px;">1pm</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:168px;">2pm</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:180px;">3pm</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:192px;">4pm</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:204px;">5pm</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:216px;">6pm</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:228px;">7pm</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:240px;">8pm</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:252px;">9pm</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:264px;">10pm</div><div valign="center" style=" position:absolute; z-index:1000; left:-75px; width:75px; text-align:center; font-size:12px; top:276px;">11pm</div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:0px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:12px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:24px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:36px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:48px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:60px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:72px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:84px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:96px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:108px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:120px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:132px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:144px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:156px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:168px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:180px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:192px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:204px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:216px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:228px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:240px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:252px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:264px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:276px; font-size:0px; overflow:hidden;"></div><div style="height:1px;  background-color:#000000; position:absolute; z-index:1000; width:160px; left:-75px; top:288px; font-size:0px; overflow:hidden;"></div><div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:0px; top:-25px;"></div><div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:12px; top:-25px;"></div><div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:24px; top:-25px;"></div><div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:36px; top:-25px;"></div><div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:48px; top:-25px;"></div><div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:60px; top:-25px;"></div><div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:72px; top:-25px;"></div><div style="width:1px;  background-color:#000000; position:absolute; z-index:1000; height:313px; left:84px; top:-25px;"></div><div style="height:300px; width:150px; position:absolute; top:0px; left:-25; z-index:10000;"></div></div>';
	 
}

?>