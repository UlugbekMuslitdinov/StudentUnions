<?php
	require('sectioninfo.inc');
	require('global.inc');
	$title = 'Views of the Union';
	pageStart($title);
?>
<?php

global $pic;

$indexPage = "index.php";

$description =  array ('FrontNE.jpg' => 'Looking northeast from the Mall',
					   'FrontNW.jpg' => 'Looking northwest from the Mall',
					   'sketch2.jpg' => 'Looking South from Mountain Ave',
					   'elevations.jpg' => 'Elevations',
					   'sitemap.jpg' => 'Sitemap',
					   'SUMC-LEVEL1.gif' => 'Level 1 Floor Plan',
					   'SUMC-LEVEL2.gif' => 'Level 2 Floor Plan',
					   'SUMC-LEVEL3.gif' => 'Level 3 Floor Plan',
					   'SUMC-LEVEL4.gif' => 'Level 4 Floor Plan',
					   'canyonEW.jpg' => 'East and West views of the Canyon.',
					   'CrossSect.jpg' => 'Cross sections of the interior',
					   'model1s.jpg' => 'The Canyon, Looking South',
					   'model2s.jpg' => 'ÊTop down view of Canyon and main staircase',
					   'model3s.jpg' => 'Front of building facing mall, looking west',
					   'model4.jpg' => 'View, Looking North',
					   'model5.jpg' => 'View, Looking South',
					   'model6.jpg' => 'View, Looking west from the mall',
					   'model7.jpg' => 'View, Looking southeast',
					   'model8.jpg' => 'Model View',
					   'INTER1.jpg' => 'Third Level Looking South',
					   'INTER2.jpg' => 'Third Level, Canyon',
					   'INTER5.jpg' => 'Fourth Level Looking South',
					   'INTER14.jpg' => 'View Down the Staircase',
					   'INTER10.jpg' => 'The Canyon, Main Level',
					   'INTER9.jpg' => 'Second Level, Facing West',
					   'CanyonDrumS.jpg' => 'Canyon and Drum looking South',
					   'canyonS.jpg' => 'Canyon looking South',
					   'Kiva1.jpg' => 'The Kiva',
					   'Kiva2.jpg' => 'The Kiva',
					   'Kiva3.jpg' => 'The Kiva',
					   'Kiva4.jpg' => 'The Kiva',
					   'lounge1.jpg' => 'The Memorial Lounge',
					   'lounge2.jpg' => 'The Memorial Lounge'
					   );

if (!isset($pic) || $pic == '') $pic = 'FrontNE';
					   
$akeys = array_keys ($description);

$currentKey = array_search ($pic, $akeys);					

if ($currentKey - 1 < 0) {
	$previous = $indexPage;
} else {
	$previous = $PHP_SELF . "?pic=" . $akeys[$currentKey - 1];
}
	
if ($currentKey + 1 > count ($description) - 1) {
	$next = $indexPage;
} else {
	$next = $PHP_SELF . "?pic=" . $akeys[$currentKey + 1];
}	
					
?>
<table border="0" cellpadding="0" cellspacing="0" bgcolor="#333333" width="100%">
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="1" width="100%">
				<tr>
					<th bgcolor="#666666" align="left"><?php echo $description[$pic] ?></th>
				</tr>
				<tr>
					<td bgcolor="#cccccc">navigation :: <a href="<?php echo $previous ?>">previous</a> | <a href="/construction/views/index.php">index</a> | <a href="<?php echo $next ?>">next</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<p><img src="<?php echo $pic ?>" alt="<?php echo $description[$pic] ?>"></p><?php pageFinish() ?>