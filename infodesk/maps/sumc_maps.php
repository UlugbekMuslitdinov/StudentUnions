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
		<title>Student Union Memorial Center Maps | <?=$level?></title>
		<link rel="stylesheet" type="text/css" href="mapbox.css" />
	</head>

	<body bgcolor="#ffffff">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#cccccc">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="1" cellpadding="4">
						<tr>
							<td colspan="4" style="padding: 8px">
								<h1 style="color: #765; font-family: Helvetica, Arial, sans-serif; font-size: 28px; display: inline">
									Student Union Memorial Center Map
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
								<a href="<?=$PHP_SELF ?>?level=level2" class="<?= $level == 'level2' ? 'current' : 'selectable'?>">
									Main Level 2
								</a>
							</td>
							<td bgcolor="#e6e6e6" width="25%">
								<img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;
								<a href="<?=$PHP_SELF ?>?level=level3" class="<?= $level == 'level3' ? 'current' : 'selectable'?>">
									Level 3
								</a>
							</td>
							<td bgcolor="#e6e6e6" width="25%">
								<img src="/template/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;
								<a href="<?=$PHP_SELF ?>?level=level4" class="<?= $level == 'level4' ? 'current' : 'selectable'?>">
									Level 4
								</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<div align="center">
			<br/>
			<img src="<?php echo 'UnionMap/sumc_' . $level . '.jpg' ?>" alt="sumc map" width="600" border="0">
		</div>
	</body>
</html>
