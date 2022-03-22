<?php
require_once('involv.inc.php');
$page_options = array();
$page_options['page'] = 'gallagher-viewers-choice';
$page_options['header_image'] = '/involvement/template/images/headers/gallagher.jpg';
involv_start($page_options);


include('gcal.inc');
	
function trim_text($input, $length = 94, $ellipses = true) {
	 
	//no need to trim, already shorter than trim length
	if (strlen($input) <= $length) {
		return $input;
	}
 
	//find last space within length
	$last_space = strrpos(substr($input, 0, $length), ' ');
	$trimmed_text = substr($input, 0, $last_space);
 
	//add ellipses (...)
	if ($ellipses) {
		$trimmed_text .= '...';
	}
 
	return htmlspecialchars($trimmed_text);
}

$query = $service->newEventQuery();
		// Set options on the query
		$query->setVisibility('private');
		$query->setProjection('full');
		$query->setOrderby('starttime');
		//$query->setFutureevents('true');
		$query->setSortorder('ascending');
		$query->setSingleEvents('true');
		$query->setUser($user);
		$start_query = date("Y-m-24");
		$end_query = date("Y-m-31");
		//var_dump($start_query);
		//var_dump($end_query);
$query->setStartMin($start_query);
$query->setStartMax($end_query);



	$cal_id = 'nkj5uavso16ofaf4umvfdlbvd4@group.calendar.google.com';
	try{
	    $eventFeed = $service->getCalendarEventFeed('https://www.google.com/calendar/feeds/'.$cal_id.'/private/full?start-min='.date("Y-m-d").'T07:00:00&start-max='.date("Y-12-29").'T06:59:59&sortorder=ascending&orderby=starttime&singleevents=false');
	} catch (Zend_Gdata_App_Exception $e) {
	    echo "Error: " . $e->getMessage();
	}
	
	//var_dump($eventFeed);
	foreach ($eventFeed as $event) {
		
		if ($event->eventStatus->value!="http://schemas.google.com/g/2005#event.canceled") {
			
				$where =$event->getWhere();
				$where = $where[0]->getValueString();
				$when = $event->getWhen();
				
				
					
				$start = strtotime($when[0]->getStartTime());
				$end = strtotime($when[0]->getEndTime());
			
				if(strpos($event->title.'', "Movie:", 0) === false){
					$title = $event->title.'';
				}
				else{
					$title = substr($event->title.'', 7);
					$days[$title]['movie'] = 1;
				}
				$days[$title]['desc'] = $event->getContent().'';
				//var_dump();
				if($event->recurrence.'' != ''){
					
					$convert_days = array("SU" => "Sundays", "MO" => "Mondays", "TU" => "Tuesdays", "WE" => "Wednesdays", "TH" => "Thursdays", "FR" => "Fridays", "SA" => "Saturdays");
					
					$recurrence = explode("\n",$event->recurrence.'');
					$recurrence = explode(";",substr($recurrence[2], 6));
					foreach($recurrence as $item){
						$temp = explode("=", $item);
						$rec[$temp[0]] = $temp[1];
					}
					//var_dump($rec);
					
					$dow = explode(',',$rec['BYDAY']);
					$when_str = '';
					foreach($dow as $day){
						$when_str .= $convert_days[$day].', ';
					}
					$when_str = substr($when_str, 0, -2);
					//var_dump($when_str);
					$days[$title]['when'][$when_str][] = date("gA", $start).'&nbsp;-&nbsp;'.date("gA", $end);
				}
				else{
					$days[$title]['when'][date("l, F d:", $start)][] = date("gA", $start);
				}
				
		}
	}	
	//var_dump($days);
	



?>

<style>
	div.result
	{
	margin: 0px 20px 0px 0px;
	height: 60px;
	line-height: 40px;
	display: inline-block;
	color: rgb(109, 110, 113);
	font-family: Arial, sans-serif;
	font-weight: bold;
	font-size: 12px;
	}
	div.bluebar
	{
	  margin: 0px 6px 0px 0px;
	  background-color: rgb(114, 201, 236);
	  width: 8px;
	  height: 50px;
	  display: inline-block;
	  vertical-align: baseline;
	}
	div.dkbluebar
	{
	  margin: 0px 6px 0px 0px;
	  background-color: rgb(38, 172, 226);
	  width: 8px;
	  height: 50px;
	  display: inline-block;
	  vertical-align: baseline;
	}
	div.tablebar
	{
	  display: inline-block;
	}
	input.long
	{
	  width: 250px;
	  background-color: rgb(243, 243, 243);
	  border: none;
	}
	
	#form
	{
		margin: 10px 0px;
	}
	
	#form .formEl
	{
		float: left;
		width: 230px;
		margin-bottom: 15px;
		height: 36px;
		font-weight: bold
	}
	
	#form .formEl:nth-child(odd)
	{
		margin-right: 20px;
	}
	
	#form .formEl .textInput
	{
		margin-top: 2px;
		width: 100%;
		height: 18px;
		background-color: #f0f0f0;
		border: solid 2px white;
	}
	span.block
	{
		font-weight: normal;
		display: inline-block;
	}
</style>

<?php
  /* Record vote and determine relative distribution of votes.
   * The votes will be displayed in a bar graph, so we scale
   * the results so that the tallest result is 50px high
   */
  require_once ('includes/mysqli.inc');
$db = new db_mysqli('gallagher_poll');
  // mysql_select_db('gallagher_poll', $DBlink) or die(mysql_error());
  
  $poll_id = intval($_POST['movieanswer']);
  // Record vote
  $db->query("UPDATE options SET votes = votes + 1 WHERE id=".$poll_id." AND active=1");
  // Grab updated results
  $query = $db->query("SELECT name, votes FROM options WHERE active=1");
  while($row = mysqli_fetch_row($query))
  {
    if($row[1] > $max_votes)
      $max_votes = $row[1];
    $results[] = $row;
  }
  if($max_votes == 0)
  	$max_votes = 1; // To prevent division by 0
  foreach($results as $row)
  {
    $num = floor($row[1] * 50 / $max_votes);
    $text .= '<div class="result">';
    if($row[1] == $max_votes)
      $text .= '<div class="dkbluebar">';
    else $text .= '<div class="bluebar">';
    $text .= '<div style="background-color: white; width: 8px; height: '.(50-$num).'px;"></div>
    			</div>'.$row[0].'</div>';    
  }
  $text .= '<br style="clear: both"/>';
?>
<img src="images/ViewersChoiceBanner" />
<br/><br/>
<div style="text-align: center">
<?php
  print $text;
?>
</div>
<div style="width: 100%; border-style: dotted; border-width: 1px 0px 0px 0px; border-color: rgb(176, 176, 176); padding: 5px">
When you become a Viewer’s Choice member, you will be able to help select what you watch at the Gallagher Theater!<br/><br/>
<span style="font-weight: bold; font-style:italic">But wait! There's more.</span> You will also receive:
<ul>
  <li>Reduced and/or free admission to Viewer’s Choice events</li>
  <li>Free popcorn on select Viewer’s Choice days</li>
  <li>Reduced admission to blockbuster movies</li>
  <li>And special concession deals</li>
</ul>
<br/>
So what we're saying is that Viewer's Choice members not only make sure we're showing what people want to watch,
they also get perks. Sort of like the owners.
</div>

<script type="text/javascript">
function validateFields()
{
  var valid = true;
  if($.trim($('#form_name')[0].value) == '')
  {
    $('#form_name').css('border-color', '#A00');
    valid = false;
  }
  else $('#form_name').css('border-color', 'white');
  
  if($.trim($('#form_email')[0].value) == '')
  {
    $('#form_email').css('border-color', '#A00');
    valid = false;
  }
  else if(checkEmail())
  {
  	$('#form_email').css('border-color', 'white');
  }
  else 
  {
  	$('#form_email').css('border-color', '#A00');
    valid = false;
  }
  
  if($.trim($('#form_address')[0].value) == '')
  {
    $('#form_address').css('border-color', '#A00');
    valid = false;
  }
  else $('#form_address').css('border-color', 'white');
  
  if($.trim($('#form_favmov')[0].value) == '')
  {
    $('#form_favmov').css('border-color', '#A00');
    valid = false;
  }
  else $('#form_favmov').css('border-color', 'white');
  
  if($.trim($('#form_movrec')[0].value) == '')
  {
    $('#form_movrec').css('border-color', '#A00');
    valid = false;
  }
  else $('#form_movrec').css('border-color', 'white');
  if(!valid)
    alert("Please fill out the missing sections of the form so we can include you in our Viewer's Choice group.");
  else {
  	 return valid && submit(this.form);
  }
 
}

function checkEmail() {
	var email = document.getElementById('form_email');
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(email.value)) {
		alert('Please provide a valid email address');
		email.focus();
		return false;
	}
	else return true;
}

</script>

<form id="form" action="viewers_choice_submit.php" method="post">
		<div class="formEl">
			NAME<br/>
			<input id="form_name" class="textInput" name="name" />
		</div>
		<div class="formEl" style="margin-left: 10px;" >
			EMAIL<br/>
			<input id="form_email" class="textInput" name="email" />
		</div>
		<div style="width:400px;" class="formEl">
			ADDRESS<br/>
			<input id="form_address" class="textInput" name="address" />
		</div>
		<div class="formEl">
			FAVORITE MOVIE<br/>
			<input id="form_favmov" class="textInput" name="faveMovie" />
		</div>
		<div class="formEl" style="margin-left: 30px; margin-bottom: 30px;" >
			AFFILIATION<br/>
			<span class="block"><input type="radio" id="un" name="year" value="Undergraduate" selected="selected">Undergraduate</span>
			<span class="block"><input type="radio" id="grad" name="year" value="Graduate"/>Graduate</span>
			<span class="block"><input type="radio" id="staff" name="year" value="Staff"/>Staff</span>
			<span class="block"><input type="radio" id="fac" name="year" value="Faculty"/>Faculty</span>
			<span class="block"><input type="radio" id="tures" name="year" value="Tucson Resident"/>Tucson Resident</span>
		</div>
		
		<div style="width:0px;" class="formEl"></div>
		<div class="formEl" >
			FAVORITE GENRE<br/>
			<select class="textInput" name="genre"  style="font-size: 14px; height: 24px; width: 235px;">
				<option value="Action">Action</option>
				<option value="Adventure">Adventure</option>
				<option value="Comedy">Comedy</option>
				<option value="Crime">Crime</option>
				<option value="Drama">Drama</option>
				<option value="Historical">Historical</option>
				<option value="Horror">Horror</option>
				<option value="Musical">Musical</option>
				<option value="Sci-Fi">Sci-Fi</option>
				<option value="Western">Western</option>
			</select>
		</div>
		<div class="formEl"  style="margin-left: 10px;" >
			HOW DID YOU HEAR ABOUT US?<br/>
			<span class="block"><input type="radio" id="online" name="aboutUs" value="Online" selected="selected"/>Online</span>
			<span class="block"><input type="radio" id="print" name="aboutUs" value="Print"/>Print</span>
			<span class="block"><input type="radio" id="friend" name="aboutUs" value="Friend"/>Friend</span>
			<span class="block"><input type="radio" id="gallList" name="aboutUs" value="Gallagher List"/>Gallagher Listserv</span>
			<span class="block"><input type="radio" id="other" name="aboutUs" value="Other"/>Other</span>
		</div>
		
		<div class="formEl" style="margin-top: 10px; margin-bottom: 20px; width: 235px;">
			MOVIE RECOMMENDATION<br/>
			<select id="form_movrec" class="textInput" name="movieSelection" style="font-size: 14px; height: 24px;">
				<option value="The Grinch">The Grinch</option>
				<option value="Love Actually">Love Actually</option>
				<option value="Christmas Carol (2009, Jim Carrey version)">Christmas Carol (2009, Jim Carrey version)</option>
				<option value="Christmas Story (1983)">Christmas Story (1983)</option>
			</select>
		</div>
		<div style="width:0px;" class="formEl"></div>
		<br style="clear: both;" />
		<input type="image" name="submit" src="images/ViewersChoiceSubmit.jpg" alt="Submit" onclick="validateFields();return false;">
	</form>
	<img src="images/ViewersChoiceGraphic.jpg" width="320" style="float: right" alt="">
	<br style="clear: both"/>



<?php 
involv_finish();