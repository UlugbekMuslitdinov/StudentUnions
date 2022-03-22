<?php

//////////////////// DEFINE INTIAL VARIABLE PRICES AND CONSTANTS ///////////////////
$reg_costs = array('Basic Package'=>20, 'Premium Package'=>30);
$tshirt_cost = 10;
$brunch_stu = 10;
$brunch_guest = 20;
$brunch_price = '$20/Adult, $10/Student';
$bbq_stu = 5;
$bbq_guest = 15;
$bbq_price = '$15/Adult, $5/Student';
define("BRUNCH_EVENT", 0);
define("BBQ_EVENT", 7);
define("LEGACY_EVENT", 3);
/////////////////////////////////////////////////////////////////////////////////////

////////////// CREATE EXTRA REGISTRATION PIECES OF SPECIAL EVENTS AND ADJUST PRICES FOR PREMIUM PACKAGE///////////
if($_SESSION['fw']['active_session']){
	
	////////////////////////////////// ADJUST FOR PREIMIUM PACKAGE PRICING  //////////////////////////
	if($_SESSION['fw']['package_type']=='Premium Package'){
		$tshirt_cost = 8;
		$brunch_stu = 8;
		$brunch_guest = 15;
		$brunch_price = '$15/Adult, $8/Student';
		$bbq_stu = 0;
		$bbq_guest = 0;
		$bbq_price = '';
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	

	////////////////////////////////// BRUNCH SEPERATE STUDENT AND GUEST RSVP //////////////////////////
	$brunch_extra = '<br />Students: <select name="brunch_students" onchange="update_attendance()">';
	
	for($i=0; $i<($_SESSION['fw']['num_students']); $i++)
								$brunch_extra.= '<option value="'.$i.'" '.($_SESSION['fw']['sun_events'][BRUNCH_EVENT]['student'] == $i?'selected':'').'>'.$i.'</option>';
	
								$brunch_extra.= '<option value="'.$i.'" '.(!isset($_SESSION['fw']['sun_events'][BRUNCH_EVENT]['student']) || $_SESSION['fw']['sun_events'][BRUNCH_EVENT]['student'] == $i?'selected':'').'>'.$i.'</option>';
	
	$brunch_extra.= '</select> &nbsp;Other Attendees: <select name="brunch_guests" onchange="update_attendance()">';
	
	for($i=0; $i<($_SESSION['fw']['num_guests']); $i++)
								$brunch_extra.= '<option value="'.$i.'" '.($_SESSION['fw']['sun_events'][BRUNCH_EVENT]['guest'] == $i?'selected':'').'>'.$i.'</option>';
	
								$brunch_extra.='<option value="'.$i.'" '.(!isset($_SESSION['fw']['sun_events'][BRUNCH_EVENT]['guest']) || $_SESSION['fw']['sun_events'][BRUNCH_EVENT]['guest'] == $i?'selected':'').'>'.$i.'</option>';
	
	$brunch_extra.= '</select>';
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	
	////////////////////////////////// BBQ SEPERATE STUDENT AND GUEST RSVP //////////////////////////
	$bbq_extra = '<br />Students: <select name="bbq_students" onchange="update_attendance()">';
	
	for($i=0; $i<($_SESSION['fw']['num_students']); $i++)
								$bbq_extra.= '<option value="'.$i.'" '.($_SESSION['fw']['sat_events'][BBQ_EVENT]['student'] == $i?'selected':'').'>'.$i.'</option>';
	
								$bbq_extra.= '<option value="'.$i.'" '.(!isset($_SESSION['fw']['sat_events'][BBQ_EVENT]['student']) || $_SESSION['fw']['sat_events'][BBQ_EVENT]['student'] == $i?'selected':'').'>'.$i.'</option>';
	
	$bbq_extra.= '</select> &nbsp;Other Attendees: <select name="bbq_guests" onchange="update_attendance()">';
	
	for($i=0; $i<($_SESSION['fw']['num_guests']); $i++)
								$bbq_extra.= '<option value="'.$i.'" '.($_SESSION['fw']['sat_events'][BBQ_EVENT]['guest'] == $i?'selected':'').'>'.$i.'</option>';
	
								$bbq_extra.='<option value="'.$i.'" '.(!isset($_SESSION['fw']['sat_events'][BBQ_EVENT]['guest']) || $_SESSION['fw']['sat_events'][BBQ_EVENT]['guest'] == $i?'selected':'').'>'.$i.'</option>';
	
	$bbq_extra.= '</select>';
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	////////////////////////////////// LEGACY LUNCH CHOOSE ALUMNI ////////////////////////////////////////
	$legacy_extra = '<h3>Please check one box for each attending alumni<br /></h3>';
	for($x=0; $x<$_SESSION['fw']['num_guests']; $x++){
		@$legacy_extra .= '<input type="checkbox" name="alumni['.$x.']" value="1" '.(in_array($x, $_SESSION['fw']['alumni'])?'checked':'').'/>'.$_SESSION['fw']['guest_first'][$x].' '.$_SESSION['fw']['guest_last'][$x].'<br />';
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Database
include('../../../commontools/mysql_link.inc');
mysql_select_db('familyweekend09', $DBlink);

################################################################
//       SETUP QUERIES FOR ALL EVENTS THAT HAVE CAPS          //
################################################################
### ALL CAPS ARE SET 5 BELOW MAXIMUM SO THAT A LARGE PARTY   ###
### DOES NOT SIGN-UP NEAR CAP AND SIGNIFICANTLY EXCEED IT    ###
################################################################


################################################################
// CAP #1
// Query and conditions for PARENTS PLUS LUNCH cap of 350 ----->
################################################################
$query = "select * from EventRegistration where event_title=\"UA Parents & Family Association Annual Faculty & Staff Luncheon\";";

$result = mysql_query($query, $DBlink);

if ($result) { 
	$pplusNum = mysql_num_rows($result);
}else {
	$pplusNum = 0;
}

if($_SESSION['fw']['PlusParents']==1 && $pplusNum > 345){
	$lunch_reg = false;
	$lunchdesc	= 'We are sorry, but registration for this event has closed as we have reached the maximum number of participants.';	
}
else{
	$lunch_reg = true;
	$lunch_desc = "<div style=\"float:left; margin-right:10px;\"><center><a href=\"http://www.UAfamily.arizona.edu/php/login.php\" target=\"_BLANK\"><img border=\"0\" src=\"template/images/sponsors/parentwebwht.gif\" alt=\"UA Parents\" target=\"_BLANK\"></a></center></div> <div style=\"float:left; width:830px;\">Parents Plus members, you are invited to the annual UA Parents & Family Association Luncheon. Meet faculty and administration leaders while you dine and listen to a guest speaker.<br /> ".($_SESSION['fw']['PlusParents']==1?"":"Parents Plus members please register for Family Weekend through <a href=\"http://www.UAfamily.arizona.edu/php/login.php\">UA Parents &amp; Family Association website</a>.")."</div><div style=\"clear:both;\"></div>";
}
#####################################################################

################################################################
// CAP #2
// Query and conditions for Legacy Lunch event cap of 75 ------>
################################################################
// 9/17/2009: Barb said today to increase this to 340 since it's
// in the ballroom and can handle the larger group.
################################################################

$queryLegacy = "select * from EventRegistration where event_title=\"Legacy Lunch\";";

$rsLegacy = mysql_query($queryLegacy, $DBlink);

if ($rsLegacy) {
	$legacyNum = mysql_num_rows($rsLegacy);

} else {
	$legacyNum = 0;
}

// SET THE CAP HERE
if ($legacyNum < 335) {

	// allow registration...
	$legacy_desc = "Are one or both of your parents UA Alumni? If so, be a part of the UA tradition by attending this important lunch and ceremony.  The Legacy Lunch is for parent alumni to pass along UA lapel pins to their students in a special ceremony. Lunch and pin are included in this event sponsored by the UA Parents & Family Association and the UA Alumni Association. Lunch will finish in time for you to attend the Tailgate.";
	$legacy_reg = true;

	// ...unless numbers exceed 340
} else {
	$legacy_desc = 'We are sorry, but registration for this event has closed as we have reached the maximum number of participants.';
	$legacy_reg = false;
}
################################################################

################################################################
// CAP #3
// Query and conditions for Send Off Brunch event cap of 500 -->
################################################################
$queryBrunch = "select * from EventRegistration where event_title=\"Send Off Brunch\";";

$rsBrunch = mysql_query($queryBrunch, $DBlink);

if ($rsBrunch) {
	$brunchNum = mysql_num_rows($rsBrunch);

} else {
	$brunchNum = 0;
}

// SET THE CAP HERE
if ($brunchNum < 495) {

	// allow registration...
	$brunch_desc = "Come enjoy some spectacular food and reminisce about the weekend with your student before heading home. Join us for a keynote speaker as we say goodbye to a weekend that will be remembered forever.";
	$brunch_reg = true;

	// ...unless numbers exceed 500
} else {
	$brunch_desc = 'We are sorry, but registration for this event has closed as we have reached the maximum number of participants.';
	$brunch_reg = false;
}
################################################################



$fri_events[0]["title"]		= "Family Weekend Kick-Off Fair";
$fri_events[0]["desc"]		= "Kick-off Family Weekend 2010 on the right foot! Come to the UA mall to check out all of the festivities which include a vendor fair and all of the wonderful and diverse clubs on campus which partake in the Wildcat World Festival. There will be food, performances, and lots of fun!";
$fri_events[0]["time"]		= "10am-3pm";
$fri_events[0]["location"]	= "UA Mall";
$fri_events[0]["price"]		= "";
$fri_events[0]["reg_enabled"]= true;
$fri_events[0]["stu_cost"] 	= 0;
$fri_events[0]["guest_cost"] = 0;

$fri_events[1]["title"]		= "UA Visitor Center";
$fri_events[1]["desc"]		= "A great resource for information, parking, and directions during Family Weekend festivities. Parents stop in at the Visitor Center for a free welcome gift on Friday and Saturday.";
$fri_events[1]["time"]		= "Open 9 a.m.-5 p.m.";
$fri_events[1]["location"]	= "NW corner of Euclid and University";
$fri_events[1]["price"]		= "";
$fri_events[1]["reg_enabled"]= true;
$fri_events[1]["stu_cost"] 	= 0;
$fri_events[1]["guest_cost"] = 0;

$fri_events[2]["title"]		= "Open Classes for UA Families";
$fri_events[2]["desc"]		= "Do you wonder what goes on behind closed doors of your student's classes? Wonder no more! Thanks to our faculty, Parents' Association, and administrations, families can visit a variety of classes on Friday. Students should check with their instructor prior to their class to confirm that there is room for their parents to attend.";
$fri_events[2]["time"]		= "8am-3pm";
$fri_events[2]["location"]	= "All over campus";
$fri_events[2]["price"]		= "";
$fri_events[2]["reg_enabled"]= true;
$fri_events[2]["stu_cost"] 	= 0;
$fri_events[2]["guest_cost"] = 0;

$fri_events[3]["title"]		= "Career Services Tour";
$fri_events[3]["desc"]		= "From a UA student to a career. Stop by Career Services to see what is offered to students in search of a job or career.";
$fri_events[3]["time"]		= "10am, NOON, 2pm";
$fri_events[3]["location"]	= "Student Union: 4th Floor suite 411";
$fri_events[3]["price"]		= "";
$fri_events[3]["reg_enabled"]= true;
$fri_events[3]["stu_cost"] 	= 0;
$fri_events[3]["guest_cost"] = 0;
/*
$fri_events[4]["title"]		= "Tap Cats Performance";
$fri_events[4]["desc"]		= "Stop on by to watch UA students get their tap on!";
$fri_events[4]["time"]		= "12pm";
$fri_events[4]["location"]	= "UA Mall Stage";
$fri_events[4]["price"]		= "";
$fri_events[4]["reg_enabled"]= true;
$fri_events[4]["stu_cost"] 	= 0;
$fri_events[4]["guest_cost"] = 0;
*/



$fri_events[4]["title"]		= "THINK TANK Information Table";
$fri_events[4]["desc"]		= "Looking for some helpful tips, advice and study strategies needed to succeed academically? Stop by the THINK TANK information table to meet all of these needs.";
$fri_events[4]["time"]		= "11 am";
$fri_events[4]["location"]	= "UA Mall";
$fri_events[4]["price"]		= "";
$fri_events[4]["reg_enabled"]= true;
$fri_events[4]["stu_cost"] 	= 0;
$fri_events[4]["guest_cost"] = 0;

$fri_events[5]["title"]		= "SSSP Table on the UA Mall";
$fri_events[5]["desc"]		= "Explore the Scholarship Universe, the Student Scholarship Services Project's (SSSP) innovative scholarship matching system! Based on an individualized profile, The Scholarship Universe matches UA students to scholarship opportunities for which they meet 100% of the eligibility criteria. Find more information on the project by visiting <a href=\"https://financialaid.arizona.edu/SSSP/\">https://financialaid.arizona.edu/SSSP/</a>";
$fri_events[5]["time"]		= "11 am";
$fri_events[5]["location"]	= "UA Mall";
$fri_events[5]["price"]		= "";
$fri_events[5]["reg_enabled"]= true;
$fri_events[5]["stu_cost"] 	= 0;
$fri_events[5]["guest_cost"] = 0;

$fri_events[6]["title"]		= "UA Parents & Family Association Annual Faculty & Staff Luncheon";
$fri_events[6]["desc"]		= $lunch_desc;
$fri_events[6]["time"]		= "12pm";
$fri_events[6]["location"]	= "South Ballroom SUMC";
$fri_events[6]["price"]		= "$5/per person";
$fri_events[6]["reg_enabled"]= $_SESSION['fw']['PlusParents']==1?$lunch_reg:false;
$fri_events[6]["stu_cost"] 	= 5;
$fri_events[6]["guest_cost"] = 5;




$fri_events[7]["title"]		= "THINK TANK";
$fri_events[7]["desc"]		= "Do you want to know how today's college students learn? Ever wonder what students do when faced with a difficult assignment? Professional staff from THINK TANK will give an in depth talk about how college students learn at a large university, how and when students utilize academic support such as tutoring, and what topics regularly come up during one-on-one appointments with learning center staff.";
$fri_events[7]["time"]		= "1pm";
$fri_events[7]["location"]	= "Ventana Room";
$fri_events[7]["price"]		= "";
$fri_events[7]["reg_enabled"]= true;
$fri_events[7]["stu_cost"] 	= 0;
$fri_events[7]["guest_cost"] = 0;

$fri_events[8]["title"]		= "What's It Like To Be In A Lecture Or Online Class? ";
$fri_events[8]["desc"]		= "The Offices of Instruction and Assessment, Student Computing Resources, and the University Libraries offer families the opportunity to experience what it is like to be a student at the University of Arizona in 2010.  Participate in a lecture class where the latest technology is used to engage students. Take a virtual tour of an online course. Meet some of the people who help students with technology.  See what digital resources are available in UA Libraries. Try out the computing systems and electronic resources that students use.";
$fri_events[8]["time"]		= "2pm";
$fri_events[8]["location"]	= "ILC";
$fri_events[8]["price"]		= "";
$fri_events[8]["reg_enabled"]= true;
$fri_events[8]["stu_cost"] 	= 0;
$fri_events[8]["guest_cost"] = 0;

$fri_events[9]["title"]		= "Campus Tours";
$fri_events[9]["desc"]		= "Follow the lead of UA ambassadors to have a look at our picturesque Tucson campus. See not only the highlights of the University of Arizona but also learn some of the rarely known interesting facts and tidbits!";
$fri_events[9]["time"]		= "1pm & 2:15pm";
$fri_events[9]["location"]	= "Old Main";
$fri_events[9]["price"]		= "";
$fri_events[9]["reg_enabled"]= true;
$fri_events[9]["stu_cost"] 	= 0;
$fri_events[9]["guest_cost"] = 0;

$fri_events[10]["title"]		= "Rainbow Family Reception";
$fri_events[10]["desc"]		= "From your rainbow family to ours-drop by this reception to meet campus lesbian, gay, bisexual, transgender and questioning (LGBTQ) staff and students. Learn more about the resources available for LGBTQ and Allied people at the University of Arizona. Come by any time before 5pm for coffee, tea, sweets, and family time!";
$fri_events[10]["time"]		= "3-5pm";
$fri_events[10]["location"]	= "Union Gallery, SUMC 3rd Floor, NE corner ";
$fri_events[10]["price"]		= "";
$fri_events[10]["reg_enabled"]= true;
$fri_events[10]["stu_cost"] 	= 0;
$fri_events[10]["guest_cost"] = 0;

$fri_events[11]["title"]		= "UA College of Nursing's Open House";
$fri_events[11]["desc"]		= "Please join Joan Shaver, Professor and Dean, as she welcomes students and their families to the UA College of Nursing's Family Weekend Open House. We'll gather in the courtyard for refreshments and a short awards presentation. Tours of the Steel Innovative Learning Center will follow the program. If you and your family are able to attend, please RSVP to Jenna Welch (jwelch@nursing.arizona.edu) by September 15th.";
$fri_events[11]["time"]		= "3-5pm";
$fri_events[11]["location"]	= "College of Nursing Courtyard";
$fri_events[11]["price"]		= "";
$fri_events[11]["reg_enabled"]= true;
$fri_events[11]["stu_cost"] 	= 0;
$fri_events[11]["guest_cost"] = 0;

$fri_events[12]["title"]		= "Special Showing Murderball";
$fri_events[12]["desc"]		= "Join us in the special showing of award-winner documentary Murderball!";
$fri_events[12]["time"]		= "3pm";
$fri_events[12]["location"]	= "Gallagher Theater SUMC Main Floor";
$fri_events[12]["price"]		= "";
$fri_events[12]["reg_enabled"]= true;
$fri_events[12]["stu_cost"] 	= 0;
$fri_events[12]["guest_cost"] = 0;

$fri_events[13]["title"]		= "College of Engineering Welcome Cookout";
$fri_events[13]["desc"]		= 'The College of Engineering would like to welcome all Engineering102 and Honors Convocation students, with their families, for some food and fun immediately following the Engineering Honors\' Convocation Ceremony. $12 for family members and Engineering students are free. To register please go <a href="http://engr.arizona.edu/current/index.php?ID=238" target="_blank">here</a>';
$fri_events[13]["time"]		= "4-6pm";
$fri_events[13]["location"]	= "Aerospace and Mechanical Engineering Courtyard";
$fri_events[13]["price"]		= "$12 for family members and Engineering students are free";
$fri_events[13]["reg_enabled"]= true;
$fri_events[13]["stu_cost"] 	= 0;
$fri_events[13]["guest_cost"] = 0;

$fri_events[14]["title"]		= "Read Like a Faculty Member";
$fri_events[14]["desc"]		= "Meet renowned UA Faculty. Buy the books they are reading and writing. A great opportunity to have your personal copy autographed! This event brought to you by the UA Parents & Family Association and the UA Bookstores. Enjoy snacks while you're here.";
$fri_events[14]["time"]		= "4:30 pm";
$fri_events[14]["location"]	= "Main floor of the UA Bookstore";
$fri_events[14]["price"]		= "";
$fri_events[14]["reg_enabled"]= true;
$fri_events[14]["stu_cost"] 	= 0;
$fri_events[14]["guest_cost"] = 0;



$fri_events[15]["title"]		= "Bear Down Friday";
$fri_events[15]["desc"]		= "Get stoked for the game with the old school pep rally on University Boulevard! Wear your UA gear, bring your whole family and prepare to BEAR DOWN! Brought to you by ASUA (Associated Students of the University of Arizona).";
$fri_events[15]["time"]		= "5-7pm";
$fri_events[15]["location"]	= "Main Gain Square (University Blvd)";
$fri_events[15]["price"]		= "";
$fri_events[15]["reg_enabled"]= true;
$fri_events[15]["stu_cost"] 	= 0;
$fri_events[15]["guest_cost"] = 0;

$fri_events[16]["title"]		= "Student Union Gallery open hours";
$fri_events[16]["desc"]		= "Visit the Student Union Gallery on the 3rd floor of the SUMC, located on the north-east corner by the Cactus Grill.  The Union Gallery is a student-run space that is free and open to the public, and offers art exhibitions, lectures and artist talks, and workshops throughout the semester.  For more information contact 520-621-6142.";
$fri_events[16]["time"]		= "5-7pm";
$fri_events[16]["location"]	= " Student Union Gallery on the 3rd floor of the SUMC";
$fri_events[16]["price"]		= "";
$fri_events[16]["reg_enabled"]= true;
$fri_events[16]["stu_cost"] 	= 0;
$fri_events[16]["guest_cost"] = 0;

$fri_events[17]["title"]		= "Family Weekend Shabbat Dinner";
$fri_events[17]["desc"]		= "Hillel offers student-led reform, conservative, and orthodox services. Dinner will be served immediately following services";
$fri_events[17]["time"]		= "5:30pm";
$fri_events[17]["location"]	= "1245 E. 2nd Street";
$fri_events[17]["price"]		= "RSVP at <a href=\"http://www.uahillel.org\">www.uahillel.org</a> or call Charae at 520-624-6561 &#9679; $15 for non-students, $8 for 18 years and older, $5 for full-time college students";
$fri_events[17]["reg_enabled"]= false;
$fri_events[17]["stu_cost"] 	= 0;
$fri_events[17]["guest_cost"] = 0;

$fri_events[18]["title"]		= "Stargazing at Steward";
$fri_events[18]["desc"]		= "Get a first-hand view of Jupiter, Uranus, Neptune, the stars, nebulae, and galaxies through the 21-inch Raymond E. White, Jr. Telescope (weather permitting)!";
$fri_events[18]["time"]		= "7-10pm";
$fri_events[18]["location"]	= "Steward Observatory";
$fri_events[18]["price"]		= "";
$fri_events[18]["reg_enabled"]= true;
$fri_events[18]["stu_cost"] 	= 0;
$fri_events[18]["guest_cost"] = 0;

$fri_events[19]["title"]		= "Double Feature-Gallagher";
$fri_events[19]["desc"]		= "Come to Gallagher Theater for a night of two spectacular movie presentations.  Films TBA";
$fri_events[19]["time"]		= "7pm & 10 pm";
$fri_events[19]["location"]	= "Gallagher Theater";
$fri_events[19]["price"]		= "";
$fri_events[19]["reg_enabled"]= true;
$fri_events[19]["stu_cost"] 	= 0;
$fri_events[19]["guest_cost"] = 0;

$fri_events[20]["title"]		= "An Evening with Mark Zupan";
$fri_events[20]["desc"]		= "Mark Zupan is the star of the 2005 Sundance Film Festival Documentary Audience Award-winner, Murderball. Paralyzed in a car accident during college, Zupan began playing quad rugby in college, and most recently, won gold as part of the US team at the Beijing Paralympic Games in 2008. A graduate of Georgia Tech, a civil engineer, two-time quad rugby national champion, 2004 quad rugby player of the year, Olympian, and spokesman for team USA, Zupan is a powerful example of the power of positive thinking. Learn more about Mark Zupan <a href=\"/csil/uab/familyweekend2010/Zupan_Bio.pdf\">here</a>.";
$fri_events[20]["time"]		= "7:30 pm";
$fri_events[20]["location"]	= "Ballroom SUMC 3rd Floor";
$fri_events[20]["price"]		= "";
$fri_events[20]["reg_enabled"]= true;
$fri_events[20]["stu_cost"] 	= 0;
$fri_events[20]["guest_cost"] = 0;





$sat_events[0]["title"]		= "Rec Center Tournaments";
$sat_events[0]["desc"]		= "Is anyone up for some 2-on-2 basketball? Play in either the recreational or competitive division. Please specify which division (please register two players per team for basketball). How about some racquetball? Open tournaments are available for both singles and doubles. Be sure to specify either singles or doubles (please register yourself and your partner for doubles). This event is open to everyone and is a chance to get bragging rights for the year and showcase your skills at our amazing recreational facilities. The winners of each tournament will win prizes and the honor of being Family Weekend Champion!";
$sat_events[0]["time"]		= "9-2pm";
$sat_events[0]["location"]	= "Rec Center";
$sat_events[0]["price"]		= "Basketball $5 per person, Racquetball $5 per person. Please check-in at the Rec Center lobby no later than 8:30am on Saturday.";
$sat_events[0]["reg_enabled"]= true;
$sat_events[0]["stu_cost"] 	= 5;
$sat_events[0]["guest_cost"] = 5;

$sat_events[1]["title"]		= "What's It Like To Be In A Lecture Or Online Class? ";
$sat_events[1]["desc"]		= "The Offices of Instruction and Assessment, Student Computing Resources, and the University Libraries offer families the opportunity to experience what it is like to be a student at the University of Arizona in 2010.  Participate in a lecture class where the latest technology is used to engage students. Take a virtual tour of an online course. Meet some of the people who help students with technology.  See what digital resources are available in UA Libraries. Try out the computing systems and electronic resources that students use.";
$sat_events[1]["time"]		= "10am";
$sat_events[1]["location"]	= "ILC";
$sat_events[1]["price"]		= "";
$sat_events[1]["reg_enabled"]= true;
$sat_events[1]["stu_cost"] 	= 0;
$sat_events[1]["guest_cost"] = 0;

$sat_events[2]["title"]		= "Honors College-New Student Convocation";
$sat_events[2]["desc"]		= "The convocation includes the induction of new students into The Honors College. The keynote address will focus on \"What makes us human?\", theme of this year's common reading selection \"Ender's Game.\" A reception will follow the ceremony on the lawn outside Social Sciences for students, families, and guests. Visit the Honors College website for more information. <a href=\"http://www.honors.arizona.edu\">www.honors.arizona.edu</a>";
$sat_events[2]["time"]		= "11-12:30pm";
$sat_events[2]["location"]	= "Social Sciences RM 100";
$sat_events[2]["price"]		= "";
$sat_events[2]["reg_enabled"]= true;
$sat_events[2]["stu_cost"] 	= 0;
$sat_events[2]["guest_cost"] = 0;

$sat_events[3]["title"]		= "Legacy Lunch";
$sat_events[3]["desc"]		= $legacy_desc;
$sat_events[3]["time"]		= "11-1pm";
$sat_events[3]["location"]	= "TBA";
$sat_events[3]["price"]		= "$20 per person";
$sat_events[3]["reg_enabled"]= $legacy_reg;
$sat_events[3]["stu_cost"] 	= 20;
$sat_events[3]["guest_cost"] = 20;
$sat_events[3]["extra"]		= $legacy_extra;

$sat_events[4]["title"]		= "UA Visitor Center";
$sat_events[4]["desc"]		= "A great resource for information, parking, and directions during Family Weekend festivities. Parents stop in at the Visitor Center for a free welcome gift on Friday and Saturday.";
$sat_events[4]["time"]		= "Open 10 a.m.-2 p.m.";
$sat_events[4]["location"]	= "NW corner of Euclid and University";
$sat_events[4]["price"]		= "";
$sat_events[4]["reg_enabled"]= true;
$sat_events[4]["stu_cost"] 	= 0;
$sat_events[4]["guest_cost"] = 0;

$sat_events[5]["title"]		= "Zona Zoo Tailgate";
$sat_events[5]["desc"]		= "Experience the tradition of tailgating before Arizona vs. Oregon State football game. Get pumped up for the game in an afternoon filled with live music and entertainment.";
$sat_events[5]["time"]		= "1-4pm";
$sat_events[5]["location"]	= "UA Mall";
$sat_events[5]["price"]		= "";
$sat_events[5]["reg_enabled"]= true;
$sat_events[5]["stu_cost"] 	= 0;
$sat_events[5]["guest_cost"] = 0;

$sat_events[6]["title"]		= "Football Game: Oregon State";
$sat_events[6]["desc"]		= "The game is on! Don't miss the incredible Arizona Wildcats take Oregon State. Tickets are available through Arizona Athletics. Please note that the ZonaZoo section is only for students. If you want your students to sit with you during the game, you MUST purchase a separate ticket for them, which will be available after Oregon State.";
$sat_events[6]["time"]		= "TBA";
$sat_events[6]["location"]	= "Arizona Stadium";
$sat_events[6]["price"]		= "see <a href=\"http://www.arizonawildcats.com\">Arizona Athletics</a> for ticket prices";
$sat_events[6]["reg_enabled"]= false;
$sat_events[6]["stu_cost"] 	= 0;
$sat_events[6]["guest_cost"] = 0;

$sat_events[7]["title"]		= "Family Weekend BBQ";
$sat_events[7]["desc"]		= "This is a MUST ATTEND event for everyone at Family Weekend! Celebrate UA Athletics directly after the football game. Student athletes and their families will be there along with many representatives from Arizona Athletics, the Pride of Arizona Marching Band, Wilbur and Wilma Wildcat, our amazing cheerleaders and of course all of the UA families! With tons of food, music, fun and giveaways you don't want to miss this and you'll love the end of the night fireworks spectacular!";
$sat_events[7]["time"]		= "7pm";
$sat_events[7]["location"]	= "UA Mall";
$sat_events[7]["price"]		= $bbq_price;
$sat_events[7]["reg_enabled"]= true;
$sat_events[7]["stu_cost"] 	= $bbq_stu;
$sat_events[7]["guest_cost"] = $bbq_guest;
$sat_events[7]["extra"]		= $_SESSION['fw']['package_type']=='Premium Package'?'':$bbq_extra;


$sat_events[8]["title"]		= "Double Feature-Gallagher";
$sat_events[8]["desc"]		= "Come to Gallagher Theater for a night of two spectacular movie presentations.  Films TBA";
$sat_events[8]["time"]		= "7pm & 10 pm";
$sat_events[8]["location"]	= "Gallagher Theater";
$sat_events[8]["price"]		= "";
$sat_events[8]["reg_enabled"]= true;
$sat_events[8]["stu_cost"] 	= 0;
$sat_events[8]["guest_cost"] = 0;

$sat_events[9]["title"]		= "Games Night";
$sat_events[9]["desc"]		= "If you like arcade games, shooting pool, or maybe playing a few rounds of ping pong, the Cellar is the place for you. Stop on by to relax and join the fun!";
$sat_events[9]["time"]		= "9pm -12am";
$sat_events[9]["location"]	= "SUMC Cellar";
$sat_events[9]["price"]		= "";
$sat_events[9]["reg_enabled"]= true;
$sat_events[9]["stu_cost"] 	= 0;
$sat_events[9]["guest_cost"] = 0;

$sat_events[10]["title"]		= "Comedy Corner";
$sat_events[10]["desc"]		= "Comedy Corner is the nation's oldest college sketch comedy troupe and is sure to entertain with their show completely focused on the hilarity of parent-student interaction during Family Weekend. You might not want to bring the young ones to this evening of laugh out loud comedy in the Cell";
$sat_events[10]["time"]		= "10pm";
$sat_events[10]["location"]	= "SUMC Cellar";
$sat_events[10]["price"]		= "";
$sat_events[10]["reg_enabled"]= true;
$sat_events[10]["stu_cost"] 	= 0;
$sat_events[10]["guest_cost"] = 0;

$sat_events[11]["title"]		= "UA Hispanic Alumni's Hispanic Heritage Day Tailgate FIESTA";
$sat_events[11]["desc"]		= "On Saturday, October 9, 2010 UAHA will host its annual \"Hispanic Heritage Day Tailgate Fiesta\" beginning approximately four hours prior to kickoff of the football game between the UA and Oregon State. We invite alumni, students, families, and friends of UA alike to join us at our tent located on the UA Mall, immediately west of Cherry Avenue.  UA Athletics also has a new tradition called \"Wildcat Walk\", where the UA football team will arrive at Cherry & University two hours before kickoff and proceed to Arizona Stadium greeted by thousands of fans and you could be one of them.  The UAHA Tailgate Fiesta is open to the general public. Delicious food and refreshments will be sold and plenty of entertainment such as Mariachis, folklorico dancers, a DJ, and award winning author Roni Capin Rivera-Ashford will help us get ready to cheer on the Wildcats. We hope that you will join us in celebrating the rich Hispanic culture. For more information please contact Aaron E. Almada at aealmada@email.arizona.edu or Ocar Lujan at lujano@al.arizona.edu. ";
$sat_events[11]["time"]		= "";
$sat_events[11]["location"]	= "UA Mall";
$sat_events[11]["price"]		= "";
$sat_events[11]["reg_enabled"]= true;
$sat_events[11]["stu_cost"] 	= 0;
$sat_events[11]["guest_cost"] = 0;





$sun_events[0]["title"]		= "Send Off Brunch";
$sun_events[0]["desc"]		= $brunch_desc;
$sun_events[0]["time"]		= "10-1pm";
$sun_events[0]["location"]	= "Student Union Ballroom";
$sun_events[0]["price"]		= $brunch_price;
$sun_events[0]["reg_enabled"]= $brunch_reg;
$sun_events[0]["stu_cost"] 	= $brunch_stu;
$sun_events[0]["guest_cost"] = $brunch_guest;
$sun_events[0]["extra"]		= $brunch_extra.'</div><div style="margin-left:-40px;"><h3>Tucson Walk for Valley Fever</h3><p style="margin-left:-40px;">Join us for a Pupcake Best in Show Contest. Also, try your dog\'s paw over a mini agility course with weaves, tunnels and jumps. Bring lots of treats to help your dog have fun with all the obstacles! All dogs must be leashed. Pupcake contest is $10 per cupcake, mini canine agility course rounds are 1 for $5 or 3 for $10. Funds raised will benefit the Valley Fever Center for Excellence. </p>';

if($_SESSION['fw']['active_session']){
	$sun_events[1]["title"]		= "Pupcake Best in Show Contest";
	$sun_events[1]["desc"]		= '';
	$sun_events[1]["time"]		= "8am";
	$sun_events[1]["location"]	= "University of Arizona Mall";
	$sun_events[1]["price"]		= "$10";
	$sun_events[1]["reg_enabled"]= true;
	$sun_events[1]["stu_cost"] 	= 10;
	$sun_events[1]["guest_cost"] = 10;
}
else{
	$sun_events[1]["title"]		= "Tucson Walk for Valley Fever</h3><p style=\"margin-left:0px;\">Join us for a Pupcake Best in Show Contest. Also, try your dog\'s paw over a mini agility course with weaves, tunnels and jumps. Bring lots of treats to help your dog have fun with all the obstacles! All dogs must be leashed. Pupcake contest is $10 per person, mini canine agility course rounds are 1 for $5 or 3 for $10. Funds raised will benefit the Valley Fever Center for Excellence. </p><h3>Pupcake Best in Show Contest";
	$sun_events[1]["desc"]		= '';
	$sun_events[1]["time"]		= "8am";
	$sun_events[1]["location"]	= "University of Arizona Mall";
	$sun_events[1]["price"]		= "$10";
	$sun_events[1]["reg_enabled"]= true;
	$sun_events[1]["stu_cost"] 	= 10;
	$sun_events[1]["guest_cost"] = 10;	
}

$sun_events[2]["title"]		= "Single Round Canine Agility Fun Course";
$sun_events[2]["desc"]		= '';
$sun_events[2]["time"]		= "8am";
$sun_events[2]["location"]	= "University of Arizona Mall";
$sun_events[2]["price"]		= "$5";
$sun_events[2]["reg_enabled"]= true;
$sun_events[2]["stu_cost"] 	= 5;
$sun_events[2]["guest_cost"] = 5;

$sun_events[3]["title"]		= "Three Rounds Canine Agility Fun Course";
$sun_events[3]["desc"]		= '';
$sun_events[3]["time"]		= "8am";
$sun_events[3]["location"]	= "University of Arizona Mall";
$sun_events[3]["price"]		= "$10";
$sun_events[3]["reg_enabled"]= true;
$sun_events[3]["stu_cost"] 	= 10;
$sun_events[3]["guest_cost"] = 10;

