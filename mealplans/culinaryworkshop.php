<?php
require_once('template/mp.inc');
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
}
.red-bar{
	background-color:#cc0033;
	width:525px;
	height:33px;
}
#mp-content .red-bar h2, #mp-content .yellow-bar h2{
	font-size:12px;
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

<h1 style="">plantEd Culinary Workshops</h1>
<p class="intro">
	All Catalina Plus Swipe Plan holders receive a one-year membership to our plantEd Culinary Workshops! We hope you can join us for the workshops on the dates as scheduled below. Please be sure to sign up for each plantEd Culinary Workshop you plan to attend <a href="http://nutrition.union.arizona.edu/planted" target="_blank">ONLINE</a> or at Nrich Urban Market.
</p>

<p style="margin-left:10px;">
<img src="template/images/culinaryworkshop.png" alt="plantEd Culinary Workshops" style="width: 100%;" />
<b>All plantEd Culinary Workshops will be held in the Culinary Studio, SUMC Lower Level.</b>
</p>

<h2><u>Dietitian Consultation</u></h2>
<p>
Want to learn more about nutrition and healthier habits? Please email <a href="mailto:SU-Nutrition@email.arizona.edu">SU-Nutrition@email.arizona.edu</a> with three dates and times that you would be available for a 30 minute consultation with a Registered Dietitian. 
</p>

<h2><u>Campus Recreation Health Coach Consultation</u></h2>
<p>
Hoping to integrate physical activity into your daily routine? Please email Dana Santoro at <a href="mailto:dsantoro@email.arizona.edu">dsantoro@email.arizona.edu</a> with three dates and times that you would be available for a 30 minute consultation with a Campus Recreation Health Coach.
</p>

<h2><u>Guest Swipes</u></h2>
<p>
All Catalina Plus Swipe Plan holders receive 6 Guest Swipes per semester so that parents and family members can eat with you for free! To use your Guest Swipe(s), bring your parents and family members to any participating Swipe Plan location and inform the cashier that you'd like to use a Guest Swipe(s) before completing your order.
</p>

<?php
mp_finish();
?>
