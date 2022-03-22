<?php
require_once('template/mp.inc');
$page_options['page'] = 'Terms & Condition';
mp_start('Terms and Conditions', 1);
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('hours2');
?>
	<style>
		#content h2 {
			margin-top: 10px !important;
			width: 520px !important;
		}

		#content p {
			width: 500px !important;
		}

		#content hr {
			width: 510px !important;
		}

		#content a {
			color: #AA3333;
		}
	</style>
	<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/template/expand.css" />
	<script type="text/javascript" src="/template/expand.js"></script>

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
				trigger: "h2.expand",
				ref: "div.demo",
				localLinks: "p.top a"
			});
		});
	</script>
	<style>
		#mp-content li {
			margin-top: 3px;
		}

		#mp-content h2 {
			margin-top: 12px;
		}
	</style>

	<h1>Terms and Conditions</h1>

	<p>Acceptance of a Meal Plan constitutes a binding contract between the student, faculty, staff (Account Owner) and the University of Arizona Student Unions as stipulated in the Meal Plan <u><a href="/mealplans/template/resources/TermsConditions.pdf" target="_blank">Terms and Conditions</a></u>.
	</p>

	<a name="top"></a>

	<p style="margin-top: 15px;"><b>Click on the topics to display the content.</b></p>

	<div id="content">

		<h2 class="expand">CatCard</h2>
		<div class="collapse">
			<p>
				Treat your CatCard as if it were cash. Report lost cards immediately to the Meal Plan office in the Business Center (Student Union Memorial Center, 621-7043) at which time a freeze can be placed on your Meal Plan. You can also freeze your card online
				at <a href="http://union.arizona.edu/mealplans">union.arizona.edu/mealplans</a>. On weekends and evenings leave a message on the voice mail or report to the Information Desk in the Student Union. Replacement cards are issued by the CatCard office
				in the Business Center (Student Union Memorial Center, 626-9162). Replacement cards cost $25. 
			</p>
			<p class="top">
				<a href="#top" style="color: #C00;">&#9650; TOP</a>
			</p>
			<br class="clear" />
			<hr />
			<br />
		</div>

		<h2 class="expand">Privacy of Information</h2>
		<div class="collapse">
			<p>
				Meal Plan balance and transaction information cannot be released to anyone other than the Account Owner. However, anonymous deposits can be made online with the Account Owner’s Student or Employee ID and last name. Students can provide families online
				access to their meal plan information by creating a Guest Account through the UAccess (<a href="http://uaccess.arizona.edu">uaccess.arizona.edu</a>) website. Instructions for creating a Guest Account are at <a href="http://union.arizona.edu/mealplans">union.arizona.edu/mealplans</a>.
				Students can also submit a signed “Balance Information Release Form” to the Meal Plan Office, although this will not give online access to information.
			</p>
			<p class="top">
				<a href="#top" style="color: #C00;">&#9650; TOP</a>
			</p>
			<br class="clear" />
			<hr />
			<br />
		</div>

		<h2 class="expand">Unused Balances at Semester End</h2>
		<div class="collapse">
			<p>
				All Wildcat Meal Plans expire at the end of the academic year.
			</p>
			<p class="top">
				<a href="#top" style="color: #C00;">&#9650; TOP</a>
			</p>
			<br class="clear" />
			<hr />
			<br />
		</div>

		<h2 class="expand">Inactive Accounts</h2>
		<div class="collapse">
			<p>
				Funds deposited to a Meal Plan account should be used in full before leaving the University of Arizona. Accounts unused for six months will enter inactive status and any funds left on deposit will be forfeited. Notification of forfeiture
				for accounts over $50 will be sent to the last known permanent address.
			</p>
			<p class="top">
				<a href="#top" style="color: #C00;">&#9650; TOP</a>
			</p>
			<br class="clear" />
			<hr />
			<br />
		</div>

		<h2 class="expand">Wildcat Meal Plans</h2>
		<div class="collapse">
			<p>
				Wildcat Meal Plans are specifically designed for students living on campus. As with all University Meal Plans, Wildcat meal plans are exempt from state sales tax of 6.1% per campus transaction. Wildcat Meal Plan options and savings are as follows:
				<ul style="font-size:12px;margin-left:30px; margin-bottom: 15px;">
					<li>With the Wildcat Gold Meal Plan, you deposit $4,950 for the academic year, never pay state sales tax and receive 7% off every purchase.</li>
					<li>With the Wildcat Silver Meal Plan, you deposit $3,550 for the academic year, never pay state sales tax and receive 5% off every purchase.</li>
					<li>With the Wildcat Copper Meal Plan, you deposit $2,150 for the academic year, never pay state sales tax and receive 3% off every purchase.</li>
				</ul>
				Additional deposits have a $25 minimum per transaction. All Wildcat Meal Plans expire at the end of the Spring Semester.
			</p>
			<p class="top">
				<a href="#top" style="color: #C00;">&#9650; TOP</a>
			</p>
			<br class="clear" />
			<hr />
			<br />
		</div>

		<h2 class="expand">Refunds</h2>
		<div class="collapse">
			<p>
				Refunds of unused Wildcat Meal Plans are permitted only for students who have withdrawn from the university.
			</p>
			<p class="top">
				<a href="#top" style="color: #C00;">&#9650; TOP</a>
			</p>
			<br class="clear" />
			<hr />
			<br />
		</div>

		<h2 class="expand">Wildcat Meal Plan Conversions</h2>
		<div class="collapse">
			<p>
				Wildcat Meal Plans may be converted during the first two weeks of the fall semester at no additional charge. After that two week grace period, no conversions will be permitted.
			</p>
			<p class="top">
				<a href="#top" style="color: #C00;">&#9650; TOP</a>
			</p>
			<br class="clear" />
			<hr />
			<br />
		</div>

		<h2 class="expand">Payment Options</h2>
		<div class="collapse">
			<p>
				For Wildcat Meal Plans only, you may elect to pay your Wildcat Meal Plan in two equal installments through your Bursar’s account. With the 2-Payment option: first half is funded and due at the start of Fall semester and the second half funded during the
				middle of December with payment due at the start of Spring semester.
			</p>
			<p class="top">
				<a href="#top" style="color: #C00;">&#9650; TOP</a>
			</p>
			<br class="clear" />
			<hr />
			<br />
		</div>

		<h2 class="expand">Meal Plan Processing Fee</h2>
		<div class="collapse">
			<p>
				A non-refundable $50 processing fee is added to all Meal Plan applications, at sign-up.
			</p>
			<p class="top">
				<a href="#top" style="color: #C00;">&#9650; TOP</a>
			</p>
			<br class="clear" />
			<hr />
			<br />
		</div>

		<h2 class="expand">Participating Meal Plan Locations</h2>
		<div class="collapse">
			<p>
				All campus dining locations accept University of Arizona Meal Plans*:
			</p>
			<ul style="font-size:14px; list-style-type:none;">
				<li>Student Union</li>
				<li>
					<ul style="font-size:14px; list-style-type:none; margin-left:15px;">
						<?php
         				$query = 'select location_name, location_url from location where group_id=1 and subgroup="Dining" and accept_plus_discount and active = 1 order by location_name';
          				$result = $db->query($query);
          				while($location = mysqli_fetch_assoc($result)){
           					print '<li><a href="'.$location['location_url'].'">'.$location['location_name'].'</a></li>';
          				}
          			?>
					</ul>
				</li>
				<br />
				<li>Global Center</li>
				<li>
					<ul style="font-size:14px; list-style-type:none; margin-left:15px;">
						<?php
	          			$query = 'select location_name, location_url from location where group_id=2 and subgroup="Dining" and accept_plus_discount and active = 1 order by location_name';
	          			$result = $db->query($query);
	          			while($location = mysqli_fetch_assoc($result)){
	            				print '<li><a href="'.$location['location_url'].'">'.$location['location_name'].'</a></li>';
	          			}
	    				?>
					</ul>
				</li>
				<br />
				<li>Other Dining Locations</li>
				<li>
					<ul style="font-size:14px; list-style-type:none; margin-left:15px;">
						<li>85N (Honors Village)</li>
						<li>Catalyst Café</li>
						<li>Coffee Carts</li>
						<li><a href="/dining/other/highland">Highland Market</a></li>
						<li>Hot Dog Carts</li>
						<li>Ikes Coffee & Marketplace</li>
						<li>Shake Smart @ Campus Rec</li>
						<li>Shake Smart @ North Rec</li>
						<li>Slot Canyon Café</li>
						<li>Starbucks at the Library</li>
						<li>Vending Machines</li>
					</ul>
				</li>
			</ul>
			<br />
			<p><b>*locations subject to change</b></p>
			<p class="top">
				<a href="#top" style="color: #C00;">&#9650; TOP</a>
			</p>
			<br class="clear" />
			<hr />
			<br />
		</div>

		<h2 class="expand">User Responsibility</h2>
		<div class="collapse">
			<p>
				The CatCard is the property of the University of Arizona, but it is entrusted to you for your convenience while enrolled or affiliated. Although Meal Plan accounts linked to your CatCard are voluntary, once a Meal Plan account is initiated, Account Owners will be held responsible for the proper use of their Meal Plan. All Meal Plan accounts are monitored on a regular basis, and the University of Arizona Student Unions reserves the right to freeze, cancel, or deny future use of the Meal Plan account if any fraudulent behavior or account abuse is detected. Fraudulent behavior/abuse includes but is not limited to unauthorized use, alteration or duplication. No Meal Plan account should be accessed by anyone other than the intended cardholder. Only the person pictured on the CatCard is entitled to spend money within the Meal Plan account. Unauthorized use, fraudulent behavior or abuse warrants termination of the Meal Plan account and/or disciplinary action.
			</p>
			<p class="top">
				<a href="#top" style="color: #C00;">&#9650; TOP</a>
			</p>
			<br class="clear" />
			<hr />
			<br />
		</div>
		<style>
		#content h2, #content p, #content hr {
			width: 100% !important;	
		}		
		</style>

	</div>

		<?php mp_finish();?>
