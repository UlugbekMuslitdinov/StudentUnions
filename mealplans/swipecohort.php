<?php
require_once('template/mp.inc');
$page_options['page'] = 'Cohort Meeting';
mp_start('Which Plan', 1);
?>
<style>
#goto-plan{
	float:right;
	margin-right:15px;
}
.goto-links{
	text-decoration:none;
	font-size:11px;
	line-height:33px;
	color:#ffffff;
}
.intro{
	font-size:13px;
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

<h1 style="">Cohort Meeting & Survey Schedule</h1>
<p class="intro">
	Swipe Plan holders are invited to attend one Cohort Meeting (a or b) each month as scheduled below. Cohort Meetings are an opportunity to provide feedback with Student Unions' Leadership and share your Swipe Plan experience. <b>A $10 CatCa$h BONUS</b> will be deposited onto your CatCard for each meeting you attend! 
</p>

<p style="margin-left:-10px;">
<img src="template/images/swipe_cohort_schedule.png" alt="Cohort Meeting & Survey Schedule" />
</p>

<p>
	In addition, all Swipe Plan holders will be sent <b>feedback surveys</b> to complete in September, November, February, and April. Surveys will be emailed to your University of Arizona email address, and <b>a $5 CatCa$h BONUS</b> will be deposited onto your CatCard for each survey you complete!
</p>

<p>
<h2><a href="swipecatalinaplus.php" target="_blank">Catalina Plus Swipe Plan</a></h2>
</p>

<?php
mp_finish();
?>
