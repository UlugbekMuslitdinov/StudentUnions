<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'].'/involvement/template/involv.inc.php');
// require_once ($_SERVER['DOCUMENT_ROOT'] . '/events/vendor/autoload.php');
$page_options = array();
$page_options['page'] = 'Games Room';
// $page_options['header_image'] = '/template/images/banners/gamesroom_banner.jpg';
$page_options['header_image'] = '/template/images/banners/Arizona_Esports_Blue-Red.png';
involv_start($page_options);


require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

/*$db = new db_mysqli('hours2');

// convert opening hour to a.m/p.m format
function convert_time($cur_time) {
	$tme=strtotime($cur_time);
	$tme1 = date('g', $tme);
	if(date('i', $tme)!="00"){
		$tme1 .= date(':i', $tme); 
	}
	if(date('a', $tme)=="am"){
		return $tme1 .= "a.m";
	}
	else{
		return $tme1.= "p.m";
	}
}

$cur_date = date("Y-m-d");
$cur_day = date('N');

$query = 'SELECT * FROM location WHERE location_name = "Games Room"';
$result = $db->query($query);
$gamesroom = mysqli_fetch_assoc($result);
$gamesroom['location_id'] = 1;

$query2 = 'select hours.* from hours join periods on hours.type=periods.type join location on hours.location_id=location.location_id where start_date<="'.$cur_date.'" and end_date>="'.$cur_date.'" and location.location_id='.$gamesroom['location_id'];
$result2 = $db->query($query2);
$default_hours = mysqli_fetch_array($result2);

$cur_today_open = $default_hours[(($cur_day*2)-1)];
$cur_today_close = $default_hours[($cur_day*2)];
$result2 = $db->query('select * from exceptions where date_of="'.$cur_date.'" and location_id='.$gamesroom['location_id']);
$gamesroom_exceptions = mysqli_fetch_assoc($result2);

if ($gamesroom_exceptions!=null) {
	$cur_today_open=$gamesroom_exceptions['open'];
	$cur_today_close=$gamesroom_exceptions['close'];
}
if ($cur_today_open==$cur_today_close && $cur_today_open=="00:00:00") {
	$todays_hours = 'closed';
}
else{
	$todays_hours = convert_time($cur_today_open).' - '.convert_time($cur_today_close);
}*/

?>

<link rel="stylesheet" type="text/css" href="/involvement/gamesroom/style.css">

<h1>Welcome to the Arizona Esports Arena</h1>
<p>
	<!-- <span style="font-size:18px;">The Games Room</span> -->
	Welcome to the campus destination for anyone who loves video games. Whether you are after
	casual gaming, hanging out with friends, or competitive esports, the Arizona Esports Arena is
	your place to be. Play where the Arizona Esports teams practice! We offer a pay-per-hour
	option for ANYONE to game on our state of the art PCs. Want to run an event? We do that too.
	The Arizona Esports Arena is your place to be for all things gaming!<br/><br/>
	Visit us on the lowest level of the SUMC in Rm 138.<br/>
	<br/>
	Contact the Arizona Esports Arena at <a href="mailto:SU-EsportsArena@email.arizona.edu">SU-EsportsArena@email.arizona.edu</a>
</p>

<!-- <div class="operation_hours"> -->
<div>
	<h4 class="operation_hours_header">Hours Of Operation</h4>
	<!-- <div class="todays_hours"><span><?=$todays_hours?></span></div> -->
	<p>11am - 11pm 7 days per week. Closed during university recognized holidays</p>
</div>

<div>
	<h4 class="operation_hours_header">Gaming Rates</h4>
	<div>
		<?php

		$table1 = [
			"title" => "Arizona Esports Arena Gaming Rates as of 6/21/21",
			"description" => "",
			"table_header" => ["", "1 Hour", "5 Hours", "10 Hours"],
			"rows" => [
				["With Catcard", "$4.00","$18.00","$30.00"],
				["General", "$7.00","$31.50","$52.50"],
				["Discount %", "N/A","10%","25%"]
			]
		];
		printTable($table1,'table_su');
		?>
	</div>
</div>

<div>
	<h4 class="operation_hours_header">Varsity Esports</h4>
	<p>The University of Arizona is proud to have launched the Arizona Esports program! This program
	includes academic courses that are available now! They also have varsity esports teams for a
	variety of different games. Interested in taking a class or trying out for a team? Find more
	information at <a href="http://esports.arizona.edu">esports.arizona.edu</a></p>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Rules<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
	<p>All customers at the Arizona Esports Arena will be required to read, understand, and sign our
	user agreement form the first time they create an account with us. A copy of that agreement
	can be found below. We will have copies available to sign in person but feel free to read and fill
	out the form ahead of time!</p>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">PC Specs<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
	<p>CPU: Intel Core i7-10700f<br>
	Graphics card: MSI GeForce RTX 3060<br>
	*20% of our systems have RTX 3070s and are "competition" machines<br>
	Memory: 16 GB running at 3200 MHz<br>
	Monitor: ViewSonic XG2705 144hz<br>
	Keyboard: Viper Gaming V770 RGB Mechanical<br>
	Mouse: Viper Gaming V570 Blackout<br>
	Headphones: Viper Gaming<br>
	Running on Windows 10<br>
	<i>*Gamers are encouraged to bring their own peripherals if they choose!</i></p>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Games Available<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<p align="center">Games listed below are pre-downloaded on eSports computers. <br>
								More PC games are available through steam.</p>
	<?php
	$table8 = [
		"title" => "",
		"description" => "",
		"table_header" => [],
		"rows" => [
			["League of Legends","Minecraft","Counter Strike"],
			["Dota 2","Team Fortress 2","Heroes of The Storm"],
			["Heroes of Newerth","Hearthstone Heroes of Warcraft","Terraria"],
			["Fortnite","",""]
		]
	];
	printTable($table8, 'table_su');
	?>

</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Core Values<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<p>[Coming Soon]</p>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Looking to get involved?<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<p>Look no further than the student run esports club! You will find a welcoming community full of
	people who love all things gaming and esports. They also run events throughout the year with
	fun competitions and giveaways. Connect with them at <a href="https://esports.arizona.edu/esports-student-club">here.</a></p>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Parking Information<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
	<p><a href="https://parking.arizona.edu/parking/maps">Parking information</a></p>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">FAQs<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<p>[Coming Soon]</p>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Useful Links<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
    <p>
    	<ul>
            <li><a href="./pdf/UserAgreementForm.pdf" target="_blank">User Agreement Form</a></li>
            <li>Policy Book</li>
        </ul>
    </p>
</div>

<div class="container" style="width:100%;">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
	  <li data-target="#myCarousel" data-slide-to="3"></li>
	  <li data-target="#myCarousel" data-slide-to="4"></li>
	  <li data-target="#myCarousel" data-slide-to="5"></li>
	  <li data-target="#myCarousel" data-slide-to="6"></li>
	  <li data-target="#myCarousel" data-slide-to="7"></li>
	  <li data-target="#myCarousel" data-slide-to="8"></li>
	  <li data-target="#myCarousel" data-slide-to="9"></li>
	  <li data-target="#myCarousel" data-slide-to="10"></li>
	  <li data-target="#myCarousel" data-slide-to="11"></li>
	  <li data-target="#myCarousel" data-slide-to="12"></li>
    </ol>

    <div class="carousel-inner">
      <div class="item active">
        <img src="./images/slides/ESports_1.jpg" alt="First Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_2.jpg" alt="Second Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_3.jpg" alt="Second Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_4.jpg" alt="Second Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_5.jpg" alt="Second Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_6.jpg" alt="Second Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_7.jpg" alt="Second Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_8.jpg" alt="Second Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_9.jpg" alt="Second Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_10.jpg" alt="Second Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_11.jpg" alt="Second Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_12.jpg" alt="Second Slide" style="width:100%;">
      </div>

      <div class="item">
        <img src="./images/slides/ESports_13.jpg" alt="Last Slide" style="width:100%;">
      </div>
    </div>

    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>


<?php

involv_finish();


function printTable($table, $border=null){
	$print = '<div class="su_table_wrap">'.
				'<h4 class="table_title">'.$table['title'].'</h4>';

	if ($table['description'] != ''){
		$print .= '<div class="table_description">'.$table['description'].'</div>';
	}

	$print .= '<table  class="su_table '.$border.'" >';

	if (count($table["table_header"])!=0){
		$print .= '<tr>';
		foreach ($table["table_header"] as $value) {
			$print .= '<th>'.$value.'</th>';
		}
		$print .= '</tr>';
	}

	foreach ($table["rows"] as $rows) {
		$print .= '<tr>';
		foreach ($rows as $col) {
			$print .= '<td>'.$col.'</td>';
		}
		$print .= '</tr>';
	}

	$print .= '</table>'.
			'</div>';

	echo $print;
}

function printTable2($table, $border=null){
	$print = '<div class="su_table_wrap">'.
				'<h4 class="table_title">'.$table['title'].'</h4>';

	if ($table['description'] != ''){
		$print .= '<div class="table_description">'.$table['description'].'</div>';
	}

	$print .= '<table class="su_table '.$border.'">';

	if (count($table["table_header"])!=0){
		$print .= '<tr>';
		foreach ($table["table_header"] as $value) {
			$print .= '<th>'.$value.'</th>';
		}
		$print .= '</tr>';
	}

	foreach ($table["rows"] as $rows) {
		$print .= '<tr class="pattern2">';
		foreach ($rows as $col) {
			$print .= '<td class="pattern">'.$col.'</td>';
		}
		$print .= '</tr>';
	}

	$print .= '</table>'.
			'</div>';

	echo $print;
}

?>

<!--<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->

<script type="text/javascript" src="/template/common/js/collapse.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
