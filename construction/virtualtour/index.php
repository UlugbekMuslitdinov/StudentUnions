<?php 
	
	global $movie;
	
	$movie_root = "/www/construction/virtualtour/movies";
	
	if (!isset($movie) || $movie == '') $movie = 'exterior';

	
	function HumanSize($size) {

		$mult = floor($size = log($size) / log(1024));	
		return round(pow(1024, $size - $mult) * 100) / 100 . substr(" kmgt", $mult, min(1, $mult)) . "b";

	}

?>
<?php
	require('../sectioninfo.inc');
	require('global.inc');
	$title = 'Virtual Tours | ' . $movie;
	pageStart($title);
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#333333">
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="1" width="100%">
				<tr>
					<th align="left" bgcolor="#666666">tours &gt;&gt;</th>
				</tr>
				<tr>
					<td bgcolor="#cccccc"><a href="/construction/virtualtour/index.php?movie=exterior">exterior</a> | <a href="/construction/virtualtour/index.php?movie=canyon">canyon</a> | <a href="/construction/virtualtour/index.php?movie=canyonflyby">canyon flyby</a> | <a href="/construction/virtualtour/index.php?movie=ballroom">ballroom</a> | <a href="/construction/virtualtour/index.php?movie=foodcourt">foodcourt</a> | <a href="/construction/virtualtour/index.php?movie=marketplace">cactus grill</a> | <a href="/construction/virtualtour/index.php?movie=bookstore">bookstore</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table><p>
<?php

echo "<object width=\"320\" height=\"256\" classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab\">";
echo "		<param name=\"bgcolor\" value=\"#ffffff\">";
echo "		<param name=\"cache\" value=\"true\">";
echo "		<param name=\"autoplay\" value=\"true\">";
echo "		<param name=\"controller\" value=\"true\">";
echo "		<param name=\"src\" value=\"movies/${movie}/${movie}_MSTR.mov\">";
echo "		<embed src=\"movies/${movie}/${movie}_MSTR.mov\" width=\"320\" height=\"256\" type=\"video/quicktime\" controller=\"true\" autoplay=\"true\" cache=\"true\" bgcolor=\"#ffffff\" pluginspage=\"http://www.apple.com/quicktime/download/\">";
echo "</object>";

?></p>
<table border="0" cellpadding="0" cellspacing="2">
	<tr>
		<td><a href="/construction/virtualtour/quicktimehelp.php">Need help installing Quicktime?</a>
			<p>To save a copy of this movie on your computer, right-click (windows) or control-click (mac) then select Save As and select a location.<br>
				<?php 

	echo "(<a href=\"movies/${movie}/${movie}_288.mov\">low quality ";
	echo humansize(filesize("${movie_root}/${movie}/${movie}_288.mov"));
	echo "</a>)";
	
	echo "(<a href=\"movies/${movie}/${movie}_56K.mov\">med quality " . humansize(filesize("movies/${movie}/${movie}_56K.mov")) . "</a>)";
	echo "(<a href=\"movies/${movie}/${movie}_LAN.mov\">high quality " . humansize(filesize("movies/${movie}/${movie}_LAN.mov")) . "</a>)";
	
?></p>
		</td>
		<td valign="top"><a href="http://www.apple.com/quicktime/download"><img height="31" width="88" src="/common/images/getquicktime.gif" border="0" alt="get quicktime"></a></td>
	</tr>
</table>
<?php pageFinish() ?>