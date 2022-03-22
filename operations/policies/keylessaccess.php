<?php
require($_SERVER['DOCUMENT_ROOT'] . '/operations/policies/template/policies.inc');
$page_options['title'] = 'Keyless Access';
$page_options['page'] = 'Keyless Access Policy';
policies_start($page_options);
?>
<style>
	h2 {
		margin-top: 15px !important;
		margin-bottom: -5px !important;
	}
</style>
<h1 style="width: 700px;">Keyless Access Policy</h1>
<h2>Keyless Access for Student Union Employees</h2>
<p>
	<b><a href="/operations/policies/template/resources/KeylessAccessPolicy.pdf">Click here to download this policy as a printable PDF file.</a></b>
</p>
<p>
	The Student Union Memorial Center is equipped with a Keyless Access building system that is tied into the <a href="http://www.uapd.arizona.edu/" target="_blank">UAPD</a> system and contracted through Amer-x Security. Exterior and some interior doors have card swipes, key pads and magnetic locks instead of regular locks. These doors are scheduled to lock and unlock depending upon the designated building hours. Any employee that works before or after regular building hours needs card access to the building.
</p>
<ol style="margin-left:20px;">
	<li>
		Supervisors may request access for their employees by submitting an online Building Access Request <a href="http://sutech.union.arizona.edu/" target="_blank">here</a>.
	</li>
	<li>
		The employees name, CatCard number, department and a 4 digit pin number must be submitted for access.
	</li>
	<li>
		If for any reason an employee gets a new CatCard, that number must be updated in the system in order for that employee to continue to have access.
	</li>
	<li>
		Card access may be revoked at any time.
	</li>
</ol>
<h2>Keyless access for Vendors (off site and in house retail)</h2>
<p>
	Retail Vendors within the Arizona Student Unions that need access before or after regular business hours must purchase a CatCard from the CatCard office for $25, and then have their card activated (as outlined above for Union employees). Off site vendors may request a vendor card that is provided by the Union free of charge. There is a $25 dollar replacement fee for lost or damaged cards.
</p>
<?php 
policies_finish()
?>