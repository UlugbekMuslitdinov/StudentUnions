<?php
	if (!isset ($_SESSION)) {
	session_start();
}

	require_once($_SERVER['DOCUMENT_ROOT'] . '/about/template/about.inc');
	$page_options['title'] = 'SUMC Timelapse';
	about_start($page_options);
?>
<p><b>During the three years of construction to build the new student union, we captured images day and night of the construction process. The archive of more than a quarter million images has been compressed into a short movie you can view below.</b></p>
<!-- <p>Also! <a href="/about/gallery/gallery.php?basedir=2003grandopening_main">Photos from the Grand Opening</a></p> -->
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#e6e6e6">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="1" cellpadding="8">
				<tr>
					<td><img src="/construction/timelapse/timelapse.gif" alt="choose your viewing size" height="31" width="338" border="0"><br>
					</td>
				</tr>
				<tr>
					<td bgcolor="white">
						<p><b>Short movie</b></p>
						<p>This two and a half minute video was created from images taken during the day. </p>
						<p>&nbsp;<a href="/construction/timelapse/sumc_timelapse_large.mov"><font size="+1">Large</font></a><font size="+1"><br>
								
								&nbsp;&nbsp;&nbsp;</font>720x480 26.9 mb</p>
						<p>&nbsp;<a href="/construction/timelapse/sumc_timelapse_small.mov"><font size="+1">Small</font></a><font size="+1"><br>
								&nbsp;&nbsp;&nbsp;</font>320x240 7.9 mb</p>
					</td>
				</tr>
				<tr>
					<td bgcolor="white"><b>Complete stream</b>
						<p>You can also view a stream of every image taken by our webcam during the construction.  This stream is approximately a three hour loop that you join in progress.</p>
						<p>&nbsp;<a href="rtsp://www.union.arizona.edu/construction.sdp"><font size="+1">View Stream</font></a></p>
						<p>You will need to follow the instructions for setting up Quicktime Player to properly view the stream.</p>
						<p><a href="/construction/timelapse/streaminstructions.php">instructions for viewing the stream</a></p>
						<p>If the link opens with another application besides Quicktime Player, you may need to start the player and then select &quot;File&quot; | &quot;Open URL in New Player...&quot; Then enter the URL: rtsp://www.union.arizona.edu/construction.sdp</p>
					</td>
				</tr>
				<tr>
					<td bgcolor="white"><a href="http://www.apple.com/quicktime/download/"><img src="/common/images/getquicktime.gif" alt="Get Quicktime" height="31" width="88" border="0"></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? about_finish(); ?>