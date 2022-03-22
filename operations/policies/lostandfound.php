<?php
  require($_SERVER['DOCUMENT_ROOT'] . '/operations/policies/template/policies.inc');
  $page_options['title'] = 'Lost &amp; Found Policy';
  $page_options['page'] = 'Lost & Found Policy';
  policies_start($page_options);
?>
<h1>Lost &amp; Found Policy</h1><br />
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cccccc">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="8" bgcolor="white">
				<tr>
					<td><b><a href="/operations/policies/template/resources/LostFoundPolicy.pdf">Click here to download this policy as a printable PDF file.</a></b></td>
					
				</tr>
			</table>
		</td>
	</tr>
</table>
<h2 style="margin-top: 15px; margin-bottom: -5px;">How/Where To Turn In Found Property</h2>
<p>Any found property can be turn into Lost & &amp; Found located at the Information Desk at the Student Union Memorial Center.</p>
<ol style="margin-left:20px; margin-bottom: 15px;">
	<li>Items are held for one month before being boxed and sent to University Surplus with the following exceptions:</li>
		<ul style="list-style-type: lower-alpha; margin-top: 10px; margin-bottom: 10px; line-height: 1em;">
			<li>CatCards are returned to the CatCard office immediately.</li>
			<li>Bank Cards that are not claimed are destroyed after one week.</li>
		</ul>
	<li>The Information staff will make every attempt to contact the owner if email, a phone number or address is located on the item.</li>
	<li>The owner must describe as closely as possible the lost item. If bank/credit card, ID must be presented.</li>	
	<li>All items not claimed will be sent to University Surplus after 30 days.</li>
<p>
	<b>For more information, visit the SUMC Information Desk, 621-7755</b>
</p>
<?php policies_finish() ?>
