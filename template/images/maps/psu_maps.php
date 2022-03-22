<?php 

	require('global.inc');

	 $level=$_GET['level'];
		
	if ($level != 'level1' && 
		$level != 'level2' && 
		$level != 'level3' && 
		$level != 'level4') $level = 'level1';  

?>

<html>

	<head>
		<title>Park Student Union Maps | <?=$level?></title>
		<link href="/common/global.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="mapbox.css" />
	</head>

	<body bgcolor="#ffffff">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#cccccc">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="1" cellpadding="0">
						<tr>
							<td colspan="4" class="title">
								<h1 class="title">
									Park Student Union Maps
								</h1>
							</td>
						</tr>
						<tr>
							<td bgcolor="#e6e6e6" width="25%">
								<img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;
								<a href="<?=$PHP_SELF ?>?level=level1" class="<?= $level == 'level1' ? 'current' : 'selectable'?>">
									Level 1
								</a>
							</td>
							<td bgcolor="#e6e6e6" width="25%">
								<img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;
								<a href="<?=$PHP_SELF ?>?level=level2"  class="<?= $level == 'level2' ? 'current' : 'selectable'?>">
									Level 2
								</a>
							</td>
							<td bgcolor="#e6e6e6" width="25%">&nbsp;</td>
							<td bgcolor="#e6e6e6" width="25%">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<div align="center">
			<br/>
			<table width="600" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><img src="<? echo 'psu_' . $level . '.gif' ?>" alt="sumc map" height="420" width="600" border="0"></td>
				</tr>
			</table>
			<br>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top"><img src="/infodesk/maps/sumc_legend.gif" alt="map legend" height="55" width="326" border="0"></td>
					<td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td valign="top"><img src="/infodesk/maps/psu_notice.gif" alt="" height="100" width="273" border="0"></td>
				</tr>
			</table>
		</div>
	</body>
</html>