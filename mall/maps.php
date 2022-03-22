<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/mall/template/mall.inc');
$page_options['title'] = 'Available Space Maps';
$page_options['header_image'] = '/template/images/banners/ua_mall_banner.jpg';
$page_options['page'] = 'Available Space Maps';
mall_start($page_options);
?>
<style>
	.menu-tbl {
		margin-top: 10px;
		width: 780px;
	}
	.menu-tbl th h2 {
		/* margin-left: 10px; */
		background-color: #E6E6E6;
		padding: 10px;
	}
	.menu-tbl a {
		font-size: 12px !important;
		font-weight: bold !important;
		line-height: 1.25em !important;
		margin-left: 10px !important;
		margin-right: 10px !important;
	}
	.menu-tbl a:link {
		color: #C42840 !important;
	}
	.menu-tbl a:hover {
		color: #E5808F !important;
	}
</style>
<h1>Mall Maps</h1>

<table border="0" cellpadding="0" cellspacing="0"  width="100%" class="menu-tbl" >
	<tr>
		<td>
		<table border="0" cellpadding="4" cellspacing="1" width="100%">
			<tr>
				<th align="left"  ><h2>Mall Maps Menu</h2></th>
			</tr>
			<tr>
				<td>
					<a href="/mall/maps.php?location=central" title="Central Mall Map" >Central Mall</a> | 
					<a href="/mall/maps.php?location=west" title="West Mall Map"  >West Mall</a> | 
					<a href="/mall/maps.php?location=east" title="East Mall Map" >East Mall</a> | 
					<a href="/mall/maps.php?location=park" title="Park Student Union Map" >Park Student Union</a> | 
					<a href="/mall/maps.php?location=highl" title="Highland Green Map" >Highland Green</a> | 
					<a href="/mall/maps.php?location=greek" title="Greek Heritage Map" >Greek Heritage</a> | 
					<a href="/mall/maps.php?location=ilc" title="ILC Map" >ILC</a> | 
					<a href="/mall/maps.php?location=map_key" title="Map Key" >Map Key</a> 
				</td>
			</tr>
		</table></td>
	</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cccccc" class="menu-tbl" >
	<tr>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="4">
			<tr>
				<td bgcolor="white"><a href="template/resources/Mall_Scheduling_Map.pdf" title="Mall Maps PDF" style="font-size: 14px; margin-left: 10px;" target="_blank">Download all the maps as a PDF file</a></td>
			</tr>
		</table></td>
	</tr>
</table>

<br />
<table border="0" cellpadding="4" cellspacing="0" width="100%" bgcolor="#666666">
	<tr>
		<td bgcolor="#E6E6E6" style="padding: 10px; font-weight: bold;" >
		<div align="center" >
			Available Mall Space is Temporary and Subject To Change
		</div></td>
	</tr>
</table>

<?php

$location = isset($_GET['location']) ? $_GET['location'] : 'central';

if (!isset($location)) $location = 'central';

if ($location == 'central') {

?>
<div align="left">
<p><img src="/mall/template/images/CentralMall.jpg" alt="central mall map" width="700" height="543"></p>
</div>
<div align="left">
<p><img alt="map key" src="/mall/template/images/mapKey.jpg" width="300" height="224">
</p>
</div>
<?php

} else if ($location == 'west') {
?>
<div align="center">
	<p><img height="568" width="800" src="/mall/template/images/WestMall.jpg" alt="west mall map">
	</p>
</div><?php

} else if ($location == 'east') {
?>
<div align="center">
	<p><img height="533" width="800" src="/mall/template/images/EastMall.jpg" alt="east mall map">
	</p>
</div><?php

} else if ($location == 'park') {
?>
<div align="center">
	<p><img height="603" width="651" src="/mall/template/images/ParkStudentUnion.jpg" alt="park mall map">
	</p>
</div>

<?php

} else if ($location == 'highl') {
?>
<div align="center">
	<p><img src="/mall/template/images/HighlandGreen.jpg" alt="Highland mall map" width="400" height="355">
	</p>
</div>
<?php

} else if ($location == 'greek') {
?>
<div align="center">
	<p><img src="/mall/template/images/GreekHeritage.jpg" alt="Greek Heritage map" width="800" height="628">
	</p>
</div>
<?php

} else if ($location == 'ilc') {
?>
<div align="center">
	<p><img src="/mall/template/images/ILC.jpg" alt="ILC map" width="700" height="530">
	</p>
</div>
<?php

} else if ($location == 'map_key') {
?>
<div align="center">
	<p><img src="/mall/template/images/mapKey.jpg" alt="map key" width="300" height="224">
	</p>
</div>
<?php
	
} else {
?><
p>Don't do that!</p><?php

}
?>

<?php mall_finish()
?>