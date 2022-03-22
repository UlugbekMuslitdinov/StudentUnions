<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/rooms/template/rooms.inc');
$page_options['title'] = 'Equipment Rental Pricing';
$page_options['page'] = 'Equipment Rental Pricing';
$page_options['header_image'] = '/template/images/banners/room_reservation_banner.jpg';
$page_options['styles'] = 'table.display td, table.display th{ padding: 10px; }';
rooms_start($page_options);
?>
<style>
table tr th {
	text-transform: uppercase;
	font-weight: bold;
}
table th {
	font-size: 1rem;
}
b {
	font-weight: bold;
}
</style>
<h1>Equipment Rental Pricing</h1>
<table border="0" cellspacing="2" cellpadding="4" class="display" >
	<tr>
		<th width="600" align="left" bgcolor="#333366" style="color:#ffffff;">Equipment</th>
		<th width="300" align="right" bgcolor="#333366" style="color:#ffffff;">Pricing</th>
	</tr>

	<tr style="background-color: #C7C7C7;">
		<td><b style="font-size:1rem;"><em>Audio</em></b></td>
		<td align="right" >&nbsp;</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >Wired Microphone</td>
		<td align="left" >$15</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >Wireless Microphone</td>
		<td align="left" >$25</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >Headset Microphone</td>
		<td align="left" >$25</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Headset microphone, Countryman</td>
	  <td align="left" >$50</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Mixer Board, 6ca</td>
	  <td align="left" >$50</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Road Box </td>
	  <td align="left" >$125</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Portable Sound System</td>
	  <td align="left" >$150</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Portable Anchor Microphone</td>
	  <td align="left" >$25</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >XLR Cable feed</td>
	  <td align="left" >$20</td>
  </tr>

	<tr style="background-color: #C7C7C7;">
		<td><b style="font-size:1rem;"><em>Display</em></b></td>
		<td align="right" >&nbsp;</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >Laptop</td>
		<td align="left" >$175</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >Scaler/Switcher</td>
		<td align="left" >$90</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >HDMI Cable</td>
		<td align="left" >$10</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >VGA Cable </td>
		<td align="left" >$10</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Video Projector</td>
	  <td align="left" >$90</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >South ballroom-Video Projector</td>
	  <td align="left" >$295</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >North ballroom-Video Projector</td>
	  <td align="left" >$150</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Kiva Room-Video Projector</td>
	  <td align="left" >$120</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >LCD Monitor and Cart</td>
	  <td align="left" >$90</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Movie Screen 8X8</td>
	  <td align="left" >$20</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Movie Screen 10X10</td>
	  <td align="left" >$30</td>
  </tr>

	<tr style="background-color: #C7C7C7;">
		<td><b style="font-size:1rem;"><em>Power</em></b></td>
		<td align="right" >&nbsp;</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Extension Cord</td>
	  <td align="left" >$7.50</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Power Strip</td>
	  <td align="left" >$7.50</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >Power Access per table</td>
		<td align="left" >$15</td>
	</tr>

	<tr style="background-color: #C7C7C7;">
		<td><b style="font-size:1rem;"><em>Room Enhancement</em></b></td>
		<td align="right" >&nbsp;</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >Easels</td>
		<td align="left" >$7.50</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Internet Cord</td>
	  <td align="left" >$7.50</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Uplight LED</td>
	  <td align="left" >$30</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >Uplight PAR</td>
		<td align="left" >$15</td>
	</tr>

	<tr style="background-color: #C7C7C7;">
		<td><b style="font-size:1rem;"><em>Communications</em></b></td>
		<td align="right" >&nbsp;</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >Phone Line </td>
		<td align="left" >$60</td>
	</tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >Conference Phone</td>
		<td align="left" >$25</td>
	</tr>
	<tr style="background-color: #C7C7C7;">
	  <td><b style="font-size:1rem;"><em>Labor</em></b></td>
	  <td align="right" >&nbsp;</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >AV personnel Labor Charge</td>
	  <td align="left" >$50 an hour/2 hour minimum</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Electric Access Labor</td>
	  <td align="left" >$100 miminum</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
	  <td style="padding-left: 20px;" >Conference Services Labor</td>
	  <td align="left" >$250</td>
  </tr>
	<tr style="background-color: #E6E6E6;">
		<td style="padding-left: 20px;" >Overtime Charge</td>
		<td align="left" >$150 to $250 charge</td>
	</tr>

</table>
<?php 
rooms_finish()
?>
