<?php
require_once('template/mp.inc');
$page_options['page'] = 'FAQs';
mp_start('FAQ', 1);
?>
<style>
	#content h2 {
		margin-top: 10px !important;
		/* width:520px !important; */
	}
	#content p {
		/* width:500px !important; */
	}
	#content hr {
		/* width:510px !important; */
	}
	#content a {
		color: #AA3333;
	}
</style>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="/template/expand.css" />
<script  type="text/javascript" src="/template/expand.js"></script>

<script type="text/javascript">
	$(function() {
		// --- Using the default options:
		$("h2.expand").toggler();
		// --- Other options:
		//$("h2.expand").toggler({method: "toggle", speed: 0});
		//$("h2.expand").toggler({method: "toggle"});
		//$("h2.expand").toggler({speed: "fast"});
		//$("h2.expand").toggler({method: "fadeToggle"});
		//$("h2.expand").toggler({method: "slideFadeToggle"});
		$("#content").expandAll({
			trigger : "h2.expand",
			ref : "div.demo",
			localLinks : "p.top a"
		});
	});
</script>

<h1>FAQs</h1>

<a name="top"></a>

<p style="margin-top: 15px;"><b>Click on the questions to display the answers.</b></p>

<div id="content" >

	<h2 class="expand" >Am I required to buy a Meal Plan? </h2>
	<div class="collapse">
		<p>
		Meal Plans are voluntary, but they save you money and they are more convenient than paying cash for every meal.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >How do I decide which Meal Plan to choose?</h2>
	<div class="collapse">
		<p>
		You should decide which Meal Plan is appropriate based on how much you eat over the course of a week. Visit "<a href="http://union.arizona.edu/mealplans/plans.php">What plans are available?</a>" to get an overview of your Meal Plan options.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >How does the 3, 5 or 7% discount work?</h2>
	<div class="collapse">
		<p>
		When you are purchasing food on campus, the register will automatically deduct 3, 5 or 7% from your total bill.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >How do I sign up and make additional deposits?</h2>
	<div class="collapse">
		<p>
		You can sign up using this website or in person at the Meal Plan Office in the Student Union Business Center. You can make additional deposits through this website, in person,
		or over the phone.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Can my parents access my Meal Plan account?</h2>
	<div class="collapse">
		<p>
		Meal Plan balance and transaction information cannot be released to anyone other than the Account Owner. Students can provide families online access to their meal plan information by creating a
		Guest Account through the UAccess (uaccess.arizona.edu) website. Instructions for creating a Guest Account are at <a href="/mealplans/" style="text-decoration: underline;">union.arizona.edu/mealplans</a>.
		Students can also submit a signed "Balance Information Release Form" to the Meal Plan Office, although this will not give online access to information.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Can I change or cancel my plan at any time?</h2>
	<div class="collapse">
		<p>
		You can change plans freely during the first TWO weeks of Fall. After end of the second week of classes in the fall semester,
		you are locked in your Meal Plan for the rest of the academic school year. You can upgrade your Meal Plan throughout the academic year.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What happens if there is money left on my Meal Plan at the end of the school year?</h2>
	<div class="collapse">
		<p>
		All <em>Wildcat Meal Plans</em> expire at the end of the academic year (on the last day of finals). 
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What happens if I run out of money on my Meal Wildcat Plan?</h2>
	<div class="collapse">
		<p>
		You can make additional deposits in any increment of $25 or above for the rest of that academic school year.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What do I do if I lose my card?</h2>
	<div class="collapse">
		<p>
		Report it immediately to the Meal Plan Office so we can freeze your account or go online to
		<a href="/mealplans/" style="text-decoration: underline;">union.arizona.edu/mealplans</a> to freeze your account.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >How do I know how much money I have?</h2>
	<div class="collapse">
		<p>
		You can find out your account balance in several ways: check the Meal Plans website, stop by the Meal Plan Office, or ask any cashier.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >How is the Meal Plan different from CatCash?</h2>
	<div class="collapse">
		<p>
		Meal Plan money can only be used to buy food on campus. CatCash is a separate pool of money that can be used for non-food purchases like
		printing, copying, laundry, parking on campus and off campus locations. See <a href="catcash.arizona.edu" target="_blank">catcash.arizona.edu</a> for a list of all locations that accept catcash.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Can I buy the Commuter Plan even if I live on campus?</h2>
	<div class="collapse">
		<p>
		Yes, the Commuter Plan is available to every student.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Do I have to pay the full amount of the Meal Plan up front?</h2>
	<div class="collapse">
		<p>
		You can pay for your Meal Plan in one lump sum, or you can choose our 2 payment plan option.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >If I have financial aid or scholarship money coming in, how do I make that pay for the Meal Plan?</h2>
	<div class="collapse">
		<p>
		When you are selecting your method of payment, you will want to select the Bursar Account. When financial aid or scholarship
		money comes in, it will pay for tuition first, then housing, then Meal Plan. If you do not receive enough money to cover the
		cost, you will be responsible for paying the difference.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Where can I use the Meal Plan?</h2>
	<div class="collapse">
		<p>
		You can use the Meal Plan at every eatery on campus. Restaurants on University Boulevard are not included.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Can I buy things besides food with my Meal Plan?</h2>
	<div class="collapse">
		<p>
		Meal Plan money can only be used for food.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What should I do if I’m going through Greek Rush?</h2>
	<div class="collapse">
		<p>
		We recommend the Copper Plan or Commuter plan for students going through rush. Most houses require students to buy into their own Meal Plans so they will not be spending as much money in the Student Union restaurants. If they decide not to join a fraternity/sorority, they can upgrade to their plan at any time.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Where is the Meal Plan Office? What are their hours?</h2>
	<div class="collapse">
		<p>
		The Meal Plan Office is located on the lower level of the Student Union. Our hours during the school year
		are Monday - Friday 8am-5pm.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>
    
    <h2 class="expand" >Am I required to open a Wells Fargo account to use my Meal Plan?</h2>
	<div class="collapse">
		<p>
		No, you are not required to open a Wells Fargo account in order to use your Meal Plan. The University community has the option to use their CatCard for ATM access when linked to a Wells Fargo checking account. For more details about the CatCard association with Wells Fargo, please see the documents below:
        <div style="margin-left:10px; margin-right:10px;">
        	<li><a href="template/resources/Wells_Fargo_CatCard_Association_Agreement.pdf" target="_blank"><u>Wells Fargo CatCard Association Agreement</u></a>: this document details the terms and conditions of the CatCard association with Wells Fargo.</li>
            <li><a href="template/resources/WellsFargo_UA_CatCardAmendment.pdf" target="_blank"><u>Wells Fargo UA CatCard Amendment</u></a>: this document details updates to the agreement above.</li>
			<li><a href="template/resources/Wells_Fargo_Campus_Card_Contract_Data.pdf" target="_blank"><u>Contract Data</u></a>: this document provides contract data for the award year period of July 1, 2019 – June 30, 2020.</li>
        </div>
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>
</div>
<br /><br />

<?php
mp_finish();
?> 