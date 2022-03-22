<?php
require_once('template/mp.inc');
$page_options['page'] = 'Catalina Plus Swipe Plan';
mp_start('Which Plan', 1);
?>
<style>
#goto-plan{
	float:right;
	margin-right:15px;
}
.goto-links{
	text-decoration:none;
	/* font-size:11px; */
	line-height:33px;
	color:#ffffff;
}
.intro{
	/* font-size:13px; */
	color:#363636;
}
#mp-content p{
	/* font-size:12px; */
	color:#363636;
	margin:15px;
	line-height: 25px;
}
.red-bar{
	background-color:#cc0033;
	width:525px;
	height:33px;
}
#mp-content .red-bar h2, #mp-content .yellow-bar h2{
	/* font-size:12px; */
	line-height:33px;
	color:#ffffff;
	margin-left:15px;
}
.yellow-bar{
	background-color:#fbb611;
	width:525px;
	height:33px;
	clear:both;
}
#mp-content .info p{
	margin:7px 15px;
}
</style>

<h1 style="">Catalina Plus Swipe Plan</h1>
<p class="intro">
	Your Catalina Plus Swipe Plan comes with a few extra perks! The information below contains more details on each of your perks, so take a look to ensure you’re getting the most out of your plan.
</p>

<h2><u>Nutrition Calculator Training</u></h2>
<p>
	Everyone wants to be in the know, especially when it comes knowing what's inside the food you eat! Join us for your Nutrition Calculator Training and learn how to use the Student Unions' <a href="http://nutrition.union.arizona.edu/nutrition-calculator" target="_blank">Nutrition Calculator</a> to find nutrition facts, ingredients, and foods that are available for dietary restrictions.
</p>

<p style="margin-left:30px;">
<img src="template/images/nutritioncalculatortraining.png" alt="Nutrition Calculator Training" />
</p>

<p>
	<b>All Nutrition Calculator Trainings will be held in the Santa Cruz Room, SUMC 3rd Floor.</b><br />
To sign up for a Nutrition Calculator Training, please email 
your name and the training you wish to attend to <a href="mailto:SU-Nutrition@email.arizona.edu">SU-Nutrition@email.arizona.edu</a>.<br /><br />
	<b>NOTE:</b> Trainings are limited to 20 people per session.
</p>

<h2><u>Student Unions Walking Tours</u></h2>
<p>
We know it can be a challenge to find your way around campus, and it's even worse when you're hungry! Join us for a Walking Tour and be personally escorted to the on-campus dining locations where you can use your Swipe Plan. 
</p>
<p style="margin-left:30px;">
<img src="template/images/walkingtour.png" alt="Student Unions Walking Tours" />
</p>

<p>
	<b>Meet outside the Sonora Room, SUMC Lower Level, for all tours.</b><br /><br />
	To sign up for a Student Unions Walking Tour, please email
your name and the tour you wish to attend to <a href="mailto:SU-Nutrition@email.arizona.edu">SU-Nutrition@email.arizona.edu</a><br /><br />
	<b>NOTE:</b> Walking Tours are limited to 15 people per tour.
</p>

<p>
<h2><a href="culinaryworkshop.php" target="_blank">plantEd Culinary Workshops</a></h2>
</p>

<?php
mp_finish();
?>
