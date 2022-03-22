<?php
require_once('template/mp.inc');
$page_options['page'] = 'What Plans Are Available';
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
.plans-link > a {
	text-decoration: underline;
}
</style>



<h1 style="">What Plans Are Available?</h1>

<div class="plans-link">
	<a style="margin-left: 15px;" href="#wildcat" >Wildcat Meal Plans</a>
	<a style="margin-left: 15px;" href="#commuter" >Commuter Plan</a>
	<a style="margin-left: 15px;" href="#staff" >Faculty/Staff Plan</a>
</div>

<p class="intro">
	The Arizona Student Unions provides several Meal Plans, so you're certain to find the Meal Plan that matches your needs.
</p>

<a name="wildcat">
</a><h2>WILDCAT MEAL PLANS</h2>

<p>
Wildcat Meal Plans are  recommended for incoming students living on-campus.
</p>
<p>
With a Wildcat Meal plan, you never pay state sales tax and you receive 3%, 5%, or 7% discount off every food and beverage purchase.
</p>
<p style="margin-bottom:0px;">
Please note:
</p>
<ul style="margin-left:30px; font-size: 14px;" >
	<li>Wildcat Meal Plans expire at the end of the academic year.</li>
	<li>Please review the <a href="terms.php">terms and conditions</a> for University of Arizona Meal Plans.</li>
</ul>

<p>
<b>Payment Plan</b><br />
For Wildcat Meal Plans only, you may elect to pay your Wildcat Meal Plan in installments. All payments will be billed to the Student's Bursar account as follows: 50% of the total cost for the Wildcat Meal Plan you selected is funded in the Fall semester and the remaining 50% is funded in the Spring semester. For Fall and Spring due dates and additional information see: <a href="https://bursar.arizona.edu" target="_blank">Bursar's Office.</a>
</p>

<br style="clear:both;" /><br />
<h2>Wildcat Gold Meal Plan</h2>

<div>
	<div style="float:left;" class="info">

		<p>spend?<br /><b>$4,950/year</b></p>
	</div>
	<div style="float:left; width:475px; margin-left:40px;">
		<p>
		With the <b>Wildcat Gold Meal Plan</b> you commit to spending $4,950 for the academic year, pay no state sales tax and receive a 7% discount off every food and beverage purchase. This plan is designed for students who typically eat 3 meals a day, plus a snack.
		</p>
	</div>
</div>

<br style="clear:both;" /><br />
	<h2>Wildcat Silver Meal Plan</h2>

<div>
	<div style="float:left;" class="info">

		<p>spend?<br /><b>$3,550/year</b></p>
	</div>
	<div style="float:left; width:475px; margin-left:40px;">
		<p>
		With the <b>Wildcat Silver Meal Plan</b> you commit to spending $3,550 for the academic year, pay no state sales tax and receive a 5% discount off every food and beverage purchase. This plan is designed for students who typically eat 2 meals a day, plus a snack.
		</p>
	</div>
</div>

<br style="clear:both;" />
<h2>Wildcat Copper Meal Plan</h2>

<div>
	<div style="float:left;" class="info">

		<p>spend?<br /><b>$2,150/year</b></p>
	</div>
	<div style="float:left; width:475px; margin-left:40px;">
		<p>
		With the <b>Wildcat Copper Meal Plan</b> you commit to spending $2,150 for the academic year, pay no state sales tax and receive a 3% discount off every food and beverage purchase. This plan is designed for students who typically eat 1 meal a day, plus a snack.
		</p>
	</div>
</div>

<br style="clear:both;" /><br />
<a name="commuter"></a>
<h2>COMMUTER PLAN</h2>

<p>
The Commuter Meal Plan is recommended for students living off-campus or in a fraternity or a sorority, or students who eat only occasionally on campus.
</p><p>
You can add funds to your account at any time and the plan is exempt from the 6.1% state sales tax.
</p><p>
The Commuter Meal Plan requires an initial deposit of $500 and the unused balance expires at the end of the academic year.
</p><p>
Please review the <a href="terms.php">terms and conditions</a> for University of Arizona Meal Plans.
</p>

<br style="clear:both;" /><br />
<a name="staff"></a>
<h2>FACULTY/STAFF PLAN</h2>

<p>
With the UA Faculty/Staff meal plan, you will receive a <b>10% bonus</b> on every deposit - use it at over 38 campus eateries! All UA Faculty and Staff can participate.
</p><p>
 For more information, call (520) 621-7043.
</p>

<?php
mp_finish();
?>
