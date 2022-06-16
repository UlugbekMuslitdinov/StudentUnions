<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'].'/involvement/template/involv.inc.php');
// require_once ($_SERVER['DOCUMENT_ROOT'] . '/events/vendor/autoload.php');
$page_options = array();
$page_options['page'] = 'Arizona Esports Arena';
$page_options['header_image'] = '/template/images/banners/esports_banner_2.jpg';
involv_start($page_options);
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

$calendarHTML = "https://outlook.office365.com/owa/calendar/a886f3ad22f044c0aabb37a9afc7fd2f@email.arizona.edu/87b843afab014b9a9c338190e5afe5be16376141383009075123/calendar.html";

if(isset($_GET['form_submitted'])) {
  echo "<center><h2 style='font-weight: bold; color: red;'>The form has been submitted successfully.</h2></center>";
}
?>
<link rel="stylesheet" type="text/css" href="/involvement/arizonaesportsarena/style.css">
<h1><span style="color: #00255a;">Welcome to the Arizona Esports Arena</span></h1>
<!--<img src="./images/tournament.png" alt="Gaming Tournament" style="width: 100%"/><br /><br />-->
<p>
	<!-- <span style="font-size:18px;">The Games Room</span> -->
	Welcome to the campus destination for anyone who loves video games. Whether you are after casual gaming, hanging out with friends, or competitive esports, the Arizona Esports Arena has it all. Play where the Arizona Esports teams practice! We offer a pay-per-hour
	option for ANYONE to game on our state of the art PCs. Want to run an event? We do that too.
	The Arizona Esports Arena is your place to be for all things gaming!<br/><br/>
	Visit us on the lowest level of the SUMC in Rm 138.<br/>
	<br/>
	Contact the Arizona Esports Arena at <a href="mailto:SU-EsportsArena@email.arizona.edu">SU-EsportsArena@email.arizona.edu</a>.<br>
  Contact us at phone number (520) 621-1450.
</p>

<br><img src="./images/esports_3.jpg" style="width: 80%">

<!-- <div class="operation_hours"> -->
<div>
	<h4 class="operation_hours_header">Hours Of Operation</h4>
	<!-- <div class="todays_hours"><span><?=$todays_hours?></span></div> -->
	<p>11am - 9pm Monday - Friday<br>1pm - 8pm Weekends<br><em>Closed on university recognized <a href="https://hr.arizona.edu/employees-affiliates/leaves/holidays" target="_blank">holidays</a></em></p>
    <div style="border: 1px solid black; padding: 5px; margin-top: 5px; width: 80%">
        <h5 style="font-weight: bold">Summer Hours:</h5>
        <p>1pm-5pm from 5/14 - 5/20 <br>
            Closed to walk-ins 5/21 - 8/7<br>
            1pm-5pm from 8/8 - 8/19<br>
            Resume regular hours starting 8/20<br>
			We are open to reservations ALL Summer, please email <a href="mailto:su-esportsarena@email.arizona.edu">su-esportsarena@email.arizona.edu</a> for details.
        </p>
    </div>
</div>

<div>
	<h4 class="operation_hours_header">Gaming Rates</h4>
	<div>
		<?php

		$table1 = [
			"title" => "",
			"description" => "",
			"table_header" => ["", "1 Hour", "5 Hours"],
			"rows" => [
				["With Catcard", "$4.00","$18.00"],
				["General", "$7.00","$31.50"],
				["Discount %", "N/A","10%"]
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
    information at <a href="http://esports.arizona.edu">esports.arizona.edu</a>.</p>
</div>

<div>
    <h4 class="operation_hours_header">Rules</h4>
    <p>All customers at the Arizona Esports Arena will be required to read, understand, and sign our
    user agreement form the first time they create an account with us. A copy of that agreement
    can be found below. We will have copies available to sign in person but feel free to read and fill
    out the <a href="./form" target="_blank">form</a> ahead of time!</p>
</div><br>

<!-- <span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/monitor.png" id="icon">Rules<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
	<p>All customers at the Arizona Esports Arena will be required to read, understand, and sign our
	user agreement form the first time they create an account with us. A copy of that agreement
	can be found below. We will have copies available to sign in person but feel free to read and fill
	out the form ahead of time!</p>
</div> -->

<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
    <div class="mySlides fade1">
        <!-- <div class="numbertext">1 / 3</div> -->
        <img src="./images/slides/ESports_16.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">2 / 3</div> -->
        <img src="./images/slides/ESports_17.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">3 / 3</div> -->
        <img src="./images/slides/ESports_18.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">4 / 3</div> -->
        <img src="./images/slides/ESports_4.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">5 / 3</div> -->
        <img src="./images/slides/ESports_5.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">6 / 3</div> -->
        <img src="./images/slides/ESports_6.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Text</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">7 / 3</div> -->
        <img src="./images/slides/ESports_7.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Two</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">8 / 3</div> -->
        <img src="./images/slides/ESports_8.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">9 / 3</div> -->
        <img src="./images/slides/ESports_9.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">10 / 3</div> -->
        <img src="./images/slides/ESports_10.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">11 / 3</div> -->
        <img src="./images/slides/ESports_11.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">12 / 3</div> -->
        <img src="./images/slides/ESports_12.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">13 / 3</div> -->
        <img src="./images/slides/ESports_13.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">14 / 3</div> -->
        <img src="./images/slides/ESports_14.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

    <div class="mySlides fade1">
        <!-- <div class="numbertext">15 / 3</div> -->
        <img src="./images/slides/ESports_15.jpg" style="height: 1000px">
        <!-- <div class="text">Caption Three</div> -->
    </div>

  <!-- Next and previous buttons -->
  <a class="prev" style="color: white;" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" style="color: white;" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
    <span class="dot" onclick="currentSlide(4)"></span>
    <span class="dot" onclick="currentSlide(5)"></span>
    <span class="dot" onclick="currentSlide(6)"></span>
    <span class="dot" onclick="currentSlide(7)"></span>
    <span class="dot" onclick="currentSlide(8)"></span>
    <span class="dot" onclick="currentSlide(9)"></span>
    <span class="dot" onclick="currentSlide(10)"></span>
    <span class="dot" onclick="currentSlide(11)"></span>
    <span class="dot" onclick="currentSlide(12)"></span>
    <span class="dot" onclick="currentSlide(13)"></span>
    <span class="dot" onclick="currentSlide(14)"></span>
    <span class="dot" onclick="currentSlide(15)"></span>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/monitor.png" id="icon">PC Specs<i class="su-arrow"></i></div>
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
        Headphones: <i>Currently Unavailable</i><br>
	Running on Windows 10<br>
	<i>*Gamers are encouraged to bring their own peripherals if they choose!</i></p><br>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/monitor.png" id="icon">Games Available<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
	<p>The games listed below are pre-downloaded on every system. Customers may choose to use some of their time to download and install other games they own</p><br>
	
	<h5 style="color:#00255a; font-weight:bold;">PC Preinstalled</h5>
	<?php
	//tables rows must be length of 4 max so that the tables render correctly on mobile device viewers
	$table8 = [
		"title" => "",
		"description" => "",
		"table_header" => [],
		"rows" => [
			["Aim Lab", "Apex Legends", "Battlefield 2042<span style='font-weight:bold; color:red;'>*</span>", "Call of Duty: Warzone"], 
			["Call of Duty: Vanguard<span style='font-weight:bold; color:red;'>*</span>", "CS:GO", "Destiny 2", "Dota 2"],
			["Fortnite", "Halo: Infinite", "Hearthstone", "League of Legends"], 
			["Lost Ark", "Overwatch", "Rainbow 6: Siege<span style='font-weight:bold; color:red;'>*</span>", "Rocket League"],
			["Splitgate", "Valorant"]
		]
	];
	printTable($table8, 'table_su');
	?><h6 style="border:-30,0,10,0;">&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-weight:bold; color:red;'>*</span>: Indicates that we have premade accounts available for these games that customers do not have to pay for.</h6><br>
	
	<h5 style="color:#00255a; font-weight:bold;">Playstation Games</h5>
	<?php
	//tables rows must be length of 4 max so that the tables render correctly on mobile device viewers
	$table9 = [
		"title" => "",
		"description" => "",
		"table_header" => [],
		"rows" => [
			["Battlefield 1", "Call of Duty: Vanguard",  "Call of Duty: Infinite Warfare",  "Call of Duty: WWII"], 
			[ "Dissidia Final Fantasy NT", "Dragon Ball FighterZ", "FIFA 17", "Mortal Kombat XL"], 
			["NBA 2K17", "NBA 2K19", "Overwatch Origins Edition", "Rocket League"],
			[ "Spider-Man", "Tekken 7"]
		]
	];
	printTable($table9, 'table_su');
	?><br>
	
	<h5 style="color:#00255a; font-weight:bold;">Xbox Games</h5>
	<?php
	//tables rows must be length of 4 max so that the tables render correctly on mobile device viewers
	$table10 = [
		"title" => "",
		"description" => "",
		"table_header" => [],
		"rows" => [
			["Call of Duty: Black Ops IIII", "FIFA 18", "FIFA 19", "Forza Horizon 3"], 
			["Gears of War 4", "Halo: The Master Chief", "Injustice 2", "Lego Marvel Super Heroes 2"], 
			["Madden NFL 17", "Marvel vs Capcom: Infinite", "NBA 2K18", "Star Wars Battlefront II"]
		]
	];
	printTable($table10, 'table_su');
	?><br>
	
	<h5 style="color:#00255a; font-weight:bold;">Nintendo Switch Games</h5>
	<?php
	//tables rows must be length of 4 max so that the tables render correctly on mobile device viewers
	$table11 = [
		"title" => "",
		"description" => "",
		"table_header" => [],
		"rows" => [
			["ARMS", "Kirby Star Allies", "Mario Kart 8 Deluxe"], 
			["Mario + Rabbids Kingdom Battle", "Mario Tennis Aces", "New Super Mario Bros. U Deluxe"], 
			["Super Mario Party", "Super Smash Bros. Ultimate", "The Legend of Zelda: Breath of the Wild"]
		]
	];
	printTable($table11, 'table_su');
	?><br>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/monitor.png" id="icon">Calendar<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center"> 
	<iframe class="responsive-iframe" width="100%" height="700px" src="<?=$calendarHTML?>"></iframe><br>
	<br>
	<p align="left" style="font-size:18px;">
		You can also 
		<a href="<?=$calendarHTML?>" target="_blank">
			click here to open this calendar in a new window
		</a>
	</p>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/monitor.png" id="icon">History<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
    There will be a history of the events that have occurred at the SU.
    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Name</th>
                <th>Game</th>
                <th>Winner</th>
                <th>Pictures</th>
                <th>Stream</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/monitor.png" id="icon">Core Values<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
	<p>[Coming Soon]</p>
<br><img src="./images/esports_1.jpg" style="width: 80%"><br><br>

</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/monitor.png" id="icon">Event Reservations<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
	<p>The Arizona Esports Arena is the perfect place for gaming related events! It is also great for clubs to do meetings or gatherings! Please contact our Event Planning Office using the links below for pricing, availability, and reservations.</p>
	<br><a href="https://union.arizona.edu/rooms/reserving.php" target="_blank"><button type="submit" value="Guidelines" style="background-color:#ac051f; color:white;" />Guidelines</button></a><br>
	<br><a href="https://union.arizona.edu/catering/request/event/" target="_blank"><button type="submit" value="Event Request Form" style="background-color:#ac051f; color:white;" />Event Request Form</button></a><br><br>
	<p>We ask for a minimum of 2 weeks' notice from the date of the event. Reservations are subject to availability. Please mention that you are requesting the Esports Arena in the comments of the form.</p><br>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/monitor.png" id="icon">Looking to get involved?<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
	<p>Look no further than the student run esports club! You will find a welcoming community full of
	people who love all things gaming and esports. They also run events throughout the year with
	fun competitions and giveaways. Connect with them <a href="https://esports.arizona.edu/esports-student-club">here.</a></p>
<br><img src="./images/esports_2.jpg" style="width: 80%"><br><br>

</div>



<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/monitor.png" id="icon">Parking Information<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
	<p><a href="https://parking.arizona.edu/parking/maps">Parking information</a></p>
<br><img src="./images/esports_4.jpg" style="width: 80%"><br><br>

</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/monitor.png" id="icon">FAQs<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
	<p>[Coming Soon]</p>
<br><img src="./images/esports_5.jpg" style="width: 80%"><br><br>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/monitor.png" id="icon">Useful Links<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="">
    <p>
    	<ul>
            <li><a href="./form/" target="_blank">User Agreement Form</a></li>
            <li><a href="./pdf/UserAgreementForm.pdf" target="_blank">Download User Agreement Form in PDF</a></li>
            <li><a href="./pdf/Policy-Book.pdf" target="_blank">Download Policy Book</a></li>
        </ul>
    </p>
<br><img src="./images/esports_6.jpg" style="width: 80%"><br>
</div>

<!-- <div class="container" style="width:100%;">
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
    </ol> -->

    <!-- <div class="carousel-inner">
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
  </div> -->
<!-- </div> -->


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

<script type="text/javascript" src="./index.js"></script>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/template/common/js/collapse.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorizgin="anonymous"></script>
