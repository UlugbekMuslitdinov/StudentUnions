<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'].'/involvement/template/involv.inc.php');
// require_once ($_SERVER['DOCUMENT_ROOT'] . '/events/vendor/autoload.php');
$page_options = array();
$page_options['page'] = 'Games Room';
$page_options['header_image'] = '/template/images/banners/gamesroom_banner.jpg';
involv_start($page_options);


require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('hours2');

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
}	

?>

<link rel="stylesheet" type="text/css" href="/involvement/gamesroom/style.css">

<h1>GO ON, GET YOUR GAME ON!</h1>
<p>
	<span style="font-size:18px;">The Games Room</span> is more than a place to pass time between classes- It's a space to meet people and hone your gaming skills! We have Pool Tables, Ping Pong tables, a X-Box One, PS4, Wii U, Nintendo Switch, Gaming PCs, Foosball, Air Hockey, Darts, Board Games, and Card Games. All you need to play is a CatCard or picture ID, fees may apply, see the dropdown menus below for details.<br/><br/>
	Visit us in the Games Room. GO ON, GET YOUR GAME ON!<br/>
	<br/>
	Contact the Games Room <a href="mailto:SU-GamesRoom@email.arizona.edu">at SU-GamesRoom@email.arizona.edu</a>
	or 520.621.1450.
</p>

<div class="operation_hours">
	<h4 class="operation_hours_header">Today's Hours Of Operation</h4>
	<div class="todays_hours"><span><?=$todays_hours?></span></div>
</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Billiards, Ping Pong, and Console Games<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<?php

	$table1 = [
		"title" => "",
		"description" => "",
		"table_header" => ["Number of Players", "With CatCard (per hour)", "Without CatCard (per hour)"],
		"rows" => [
			["1","$4","$5"],
			["2","$5","$6"],
			["3","$6","$7"],
			["4","$7","$8"]
		]
	];
	printTable($table1,'table_su');
	?>

</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Poker Table Rental<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<p align="center">Includes cards and chip sets! Tables hold a maximum of 10 players.</p>
	<?php
	$table2 = [
		"title" => "",
		"description" => "",
		"table_header" => ["Number of Tables", "With CatCard (per hour)", "Without CatCard (per hour)"],
		"rows" => [
			["1","$10","$12"],
			["2","$18","$22"]
		]
	];
	printTable($table2,'table_su');
	?>

</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Foosball, Darts, and Air Hockey<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<?php
	$table3 = [
		"title" => "",
		"description" => "",
		"table_header" => ["Number of Players", "With CatCard (per half hour)", "Without CatCard (per half hour)"],
		"rows" => [
			["1","$2","$3"],
			["2","$2","$3"],
			["3","$3","$4"],
			["4","$4","$5"]
		]
	];
	printTable($table3,'table_su');
	?>

</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">eSports Computers<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<p align="center">Available only to CatCard holders</p>
	<?php
	$table4 = [
		"title" => "",
		"description" => "",
		"table_header" => ["eSports Computers", "Price"],
		"rows" => [
			["Each","Free!"],
		]
	];
	printTable($table4,'table_su');
	?>

</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Board and Card Games<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<?php
	$table5 = [
		"title" => "",
		"description" => "",
		"table_header" => ["Board and Card Games", "Price (Per hour)"],
		"rows" => [
			["Board and Card Games (with CatCard)","$0.00"],
			["Board and Card Games (Without CatCard)" ,"$1.00"]
		]
	];
	printTable($table5,'table_su');
	?>

</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Console Games Available<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<p align="center">Game selection updated every semester</p>
	<?php
	$table6 = [
		"title" => "",
		"description" => "",
		"table_header" => ["X-Box One", "PS4", "Wii U", "Nintendo Switch"],
		"rows" => [
			["FIFA: 2018",                          "Battlefield 1",                      "Donkey Kong Country: Tropical Freeze",   "The Legend of Zelda: Breath of the Wild"],
			["Forza: Horizon 3",                    "Call of Duty: Infinite Warfare",     "Mario Kart 8",                           "Super Mario Party"],
			["Gears of War 4",                      "Dragonball Fighter Z",               "Mario Party 10",                         "Mario + Rabbids: Kingdom Battle"],
			["Halo: The Master Chief Collection",   "FIFA: 2017",                         "Minecraft",                              "ARMS"],
			["Injustice 2",                         "Grand Theft Auto V",                 "Pokemon Tournament",                     "Mario Kart 8 Deluxe"],
			["Madden 17",                           "Mortal Kombat X",                    "Super Mario 3D World",                   "Kirby: Star Allies"],
			["Lego Marvel Super Heroes 2",          "NBA 2k17",                           "Super Mario Bros. U",                    "Super Smash Bros. Ultimate"],
			["Marvel vs. Capcom: Infinite",         "Overwatch",                          "Super Mario Maker",                      "Mario Tennis Aces"],
			["NBA 2k18",                            "Rocket League",                      "Super Smash Bros",                       ""],
			["Star Wars Battlefront",               "Tekken 7",                           "",                                       ""],
			["Call of Duty: Black Ops4",            "Call of Duty: WWII",                 "",                                       ""],
			["FIFA: 2019",                          "Final Fantasy: Dissidia NT",         "",                                       ""],
			["",                                    "NBA 2k19",                           "",                                       ""],
			["",                                    "Spider-Man",                         "",                                       ""]
		]
	];
	printTable($table6, 'table_su');
	?>

</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Board and Card Games Available<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<?php
	$table7 = [
		"title" => "",
		"description" => "",
		"table_header" => [],
		"rows" => [
			["Settlers of Catan","Checkers","Chess(Giant or Regular)"],
			["Cards Against Humanity","Twister","Uno"],
			["Clue","Connect4","Deck of Cards"],
			["Dominoes","Giant Jenga","Monopoly"],
			["Poker","Scene It","Scrabble"],
			["Sorry!","The Game of Life","Twister"]
		]
	];
	printTable($table7, 'table_su');
	?>

</div>

<span class="collapsible">
	<div class="su-card">
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">PC Games Available<i class="su-arrow"></i></div>
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
		<div class="su-card-text"><img src="/template/images/involvement/gamesroom.png" id="icon">Event Space Pricing<i class="su-arrow"></i></div>
	</div>
</span>
<div class="su-content" align="center">
	<?php
	$table9 = [
		"title" => "",
		"description" => "",
		"table_header" => ["Rental Item", "Price per two hours"],
		"rows" => [
			["<b>Full Room</b> (Entire room is closed to public) - UA Price","$225.00"],
			["<b>Full Room</b> (Entire room is closed to public) - Non-UA Price" ,"$340.00"],
			["<b>Electronics Half of Room</b> (Pool half of room still open to public) - UA Price" ,"$115.00"],
			["<b>Electronics Half of Room</b> (Pool half of room still open to public) - Non-UA Price" ,"$175.00"],
			["<b>Pool Table Half of Room</b> (Electronics half of room still open to public) - UA Price" ,"$115.00"],
			["<b>Pool Table Half of Room</b> (Electronics half of room still open to public) - Non-UA Price" ,"$175.00"],
			["<b>Pool Tables</b> - All 5 tables - UA Price" ,"$100.00"],
			["<b>Pool Tables</b> - All 5 tables - Non-UA Price" ,"$150.00"],
			["<b>Pool Tables</b> - Each - UA Price" ,"$25.00"],
			["<b>Pool Tables</b> - Each - Non-UA Price" ,"$40.00"],
			["<b>Ping Pong Tables</b> - All 3 tables - UA Price" ,"$60.00"],
			["<b>Ping Pong Tables</b> - All 3 tables - Non-UA Price" ,"$90.00"],
			["<b>Ping Pong Tables</b> - Each - UA Price" ,"$15.00"],
			["<b>Ping Pong Tables</b> - Each - Non-UA Price" ,"$25.00"],
			["<b>Consoles</b> - All 3 consoles - UA Price" ,"$60.00"],
			["<b>Consoles</b> - All 3 consoles - Non-UA Price" ,"$90.00"],
			["<b>Consoles</b> - Each - UA Price" ,"$15.00"],
			["<b>Consoles</b> - Each - Non-UA Price" ,"$25.00"],
			["<b>Gaming Computers</b> - All 10 Computers - UA Price" ,"$40.00"],
			["<b>Gaming Computers</b> - All 10 Computers - Non-UA Price" ,"$60.00"],
			["<b>Gaming Computers</b> - 5 Computers - UA Price" ,"$25.00"],
			["<b>Gaming Computers</b> - 5 Computers - Non-UA Price" ,"$40.00"],
			["<b>Air Hockey/Darts/Foosball</b> - All 3 games - UA Price" ,"$45.00"],
			["<b>Air Hockey/Darts/Foosball</b> - All 3 games - Non-UA Price" ,"$70.00"],
			["<b>Air Hockey/Darts/Foosball</b> - Each - UA Price" ,"$10.00"],
			["<b>Air Hockey/Darts/Foosball</b> - Each - Non-UA Price" ,"$15.00"]
		]
	];
	printTable2($table9,'table_su');
	?>

</div>

<div id="" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="./images/slides/379-0-20190822.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./images/slides/379-3-20190822.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./images/slides/379-4-20190822.jpg" alt="Third slide">
	</div>
	<div class="carousel-item">
      <img class="d-block w-100" src="./images/slides/379-5-20190822.jpg" alt="Fourth slide">
    </div>
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

<script type="text/javascript" src="/template/common/js/collapse.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
