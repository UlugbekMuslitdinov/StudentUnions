<?php

	require($_SERVER['DOCUMENT_ROOT'] . '/template/global.inc');

	 $level=$_GET['level'];

	if ($level != 'level1' &&
		$level != 'level2' &&
		$level != 'level3' &&
		$level != 'level4') $level = 'level1';

?>

<html>

	<head>
		<title>Global Center Maps | <?=$level?></title>
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
									Global Center Maps
								</h1>
							</td>
						</tr>
						<tr>
							<td bgcolor="#e6e6e6" width="25%">
								<img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;
								<a href="<?=$_SERVER['SCRIPT_NAME'] ?>?level=level1" class="<?= $level == 'level1' ? 'current' : 'selectable'?>">
									Level 1
								</a>
							</td>
							<td bgcolor="#e6e6e6" width="25%">
								<img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;
								<a href="<?=$_SERVER['SCRIPT_NAME'] ?>?level=level2"  class="<?= $level == 'level2' ? 'current' : 'selectable'?>">
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
			<img src="<?php echo 'psu_' . $level . '.jpg' ?>" alt="Global Center map" width="675" border="0">
		</div>
	</body>
</html>
