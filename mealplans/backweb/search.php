<?php
//include backweb template
require_once('template/mpbackweb.inc');

//start page
mpbackweb_start('search');

//most of the work done on this page is actualy done in the javascript file(template/mpbackweb.js) and the ajax-handler file(mpbackweb.ajax.php)
?>
<h2>Search Deposits</h2>
<fieldset id="qr-container">
	<legend>Quick Reports</legend>
	<input type="button" value="Daily Report" onclick="do_report(0)"/> <input type="button" value="Charge" onclick="do_report(1)"/> <br />
	<input type="button" value="Bursras" onclick="do_report(2)"/> <input type="button" value="" /> <br />
	<input type="button" value="" /> <input type="button" value="" /> <br /> 	
</fieldset>
<fieldset id="search-container">
	<legend>Search</legend>
	<form name="search_form" method="post" onsubmit="return get_search_results('deposit_time', 'desc')">
		<div id="search-col1">
			First Name: <input type="text" name="first_name" /><br />
			Last Name: <input type="text" name="last_name" /><br />
			emplID: <input type="text" name="cust_id" /><br />
			Deposit ID: <input type="text" name="deposit_id" /><br />
			<input type="checkbox" name="bursars_hold" value="1" /> Show held bursars
		</div>
		<div id="search-col2">
			Payment Type: 
			<select name="payment_type"><option value=""></option><option value="visa">Visa</option><option value="mc">Master Card</option><option value="amex">American Express</option><option value="charge">All Charge</option><option value="bursars">Bursars</option> </select><br />	
			CC(last 4): <input type="text" name="last_four" /><br />
			Amount: <input type="text" name="amount" />	
		</div>
		<div id="search-col3">
			<fieldset>
				<legend>Date Range</legend>
				<input type="radio" name="date_range" value="30" checked /> Last Month&nbsp;&nbsp;&nbsp;<input type="radio" name="date_range" value="90"/> 3 Months<br />
				<input type="radio" name="date_range" value="0"/> All&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="date_range" value="custom"/> Custom<br />
				<div align="right">
					from:<input type="text" name="from" value="" disabled /><input type="button" value="" onclick="document.search_form.date_range[3].checked = 1; popup_cal_time.show_cal(event, 'from')" /><br />
					to:<input type="text" name="to" value="" disabled /><input type="button" value="" onclick="document.search_form.date_range[3].checked = 1; popup_cal_time.show_cal(event, 'to')" />
				</div> 		
			</fieldset>
			<input id="search-btn" type="button" value="Search" onclick="get_search_results('deposit_time', 'desc')" /> 
		</div>	
	</form>	
</fieldset>
<h2 id="sr-header">Search Results</h2>
<form name="totals_form" onsubmit="return false">
<div id="sandt">
	<input type="radio" name="totals" value="sort" onclick="get_search_results('deposit_time', 'desc')" />Sort &amp; Total by Payment Type
</div>
<div id="show-totals">
	<input type="radio" name="totals" value="total" onclick="get_search_results('deposit_time', 'desc')" />Show Totals
</div>
</form>
<div id="print">
	<input type="button" value="print" onclick="window.print()"/>
</div>
<div id="search-results-div">

</div>
<div id="totals-div">

</div>
<?php 
mpbackweb_finish();
?>