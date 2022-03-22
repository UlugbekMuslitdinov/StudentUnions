<?php
	session_start();
	if ($error != true) {
	 require('global.inc');
  $page_options['title'] = 'Maintenance Request Forms:';
  page_start($page_options);
	}
?>

<div style="padding-left:20px; padding-top:30px; padding-bottom:30px;">
<table border="0" cellpadding="4" cellspacing="0" frame="" width="100%">
	<tr>
		<td width="75" valign="top">
			<div align="left" style="padding-right:15px;">
				<font face="Verdana,Arial,Helvetica,sans-serif" size="2"><img height="75" width="75" src="./reqPic.gif"></font>
      </div>
		</td>
		<td valign="top"><b>Maintenance Request Form</b>
			<p style="padding-top:10px;">Chose which department you would like to send your request to:</p>
			&#x2022; <a href="http://150.135.72.231/MX4/_private/RequestWork1.asp?ID=15" target="_blank">Housekeeping</a> (Clean
			it)<br>
			&#x2022; <a href="http://150.135.72.231/MX4/_private/RequestWork1.asp?ID=18" target="_blank">Event
			Services</a> (Move it)<br>
			&#x2022; <a href="http://150.135.72.231/MX4/_private/RequestWork1.asp?ID=13" target="_blank">Maintenance</a> (Fix
			it)<br>
			&#x2022; <a href="http://150.135.72.231/MX4/_private/RequestWork1.asp?ID=14" target="_blank">Computer Support</a>
			<p align="left" style="padding-top:10px;"><a href="http://150.135.72.231/MX4/_private/RequestWorkSearch.asp" target="_blank">Check the status of an existing Maintenance Request</a></p>
			<p align="left" style="padding-top:10px;">Download a project request form:</p>
			<p align="left">&#x2022; <a href="UnionPRF.doc?ID=15" target="_blank">Union Project Request Form (doc)<br>
				</a>&#x2022; <a href="UnionPRF.pdf?ID=13" target="_blank">Union Project Request Form (pdf)<br>
				</a></p>
		</td>
	</tr>
</table>
</div>

<?php 
if ($error != true) {
page_finish(); 
}
?>
