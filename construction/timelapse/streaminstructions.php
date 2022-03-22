<?php
	require('../sectioninfo.inc');
	//require('global.inc');
	//$title = 'Timelapse Video';
	//pageStart($title);
	require_once($_SERVER['DOCUMENT_ROOT'] . '/template/about.inc');
	$page_options['title'] = 'Timelapse Video';
	about_start($page_options);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#e6e6e6">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="1" cellpadding="8">
				<tr>
					<td>
						<p><b>Quicktime Setup Instructions</b></p>
						<p><a href="#mac">Windows</a> | <a href="#mac">Mac</a></p>
					</td>
				</tr>
				<tr>
					<td bgcolor="white">
						<p><a name="windows"></a><b>Windows</b></p>
						<ol>
							<li>Install Quicktime Player 6 if you don't already have it. Any version less than Quicktime 6 will not work.You can download it from <a href="http://www.apple.com/quicktime/download">http://www.apple.com/quicktime/download<br>
									<br>
								</a>
							<li>Start the Quicktime Player application.<br>
								<br>
							<li>Go to Edit | Preferences | Quicktime Preferences...<br>
								<br>
								<img src="/construction/timelapse/win_qt1.gif" alt="" height="209" width="338" border="0"><br>
								<br>
							<li>Select Streaming Transport from the pulldown box.<br>
								<br>
								<img src="/construction/timelapse/win_qt2.gif" alt="" height="375" width="341" border="0"><br>
								<br>
							<li>Enter the information in the boxes as shown. Select &quot;Use this protocol and port ID:&quot;, select &quot;Use HTTP, Port ID:&quot; and then click on the box and enter &quot;8000&quot;.<br>
								<br>
								<img src="/construction/timelapse/win_qt3.gif" alt="" height="375" width="342" border="0"><br>
								<br>
							<li>Use the close button at the top to save your changes.<br>
								<br>
							<li><a href="rtsp://www.union.arizona.edu/construction.sdp">Then click here to view the stream</a>.<br>
								<br>
							<li>If the link opens with another application besides Quicktime Player, you may need to start the player and then select File | Open URL in New Player... Then enter the URL: rtsp://www.union.arizona.edu/construction.sdp<br>
								<br>
							
						</ol>
					</td>
				</tr>
				<tr>
					<td bgcolor="white"><a name="mac"></a><b>Mac</b>
						<ol>
							<li>Install Quicktime Player 6 if you don't already have it.  Any version less than Quicktime 6 will not work.You can download it from <a href="http://www.apple.com/quicktime/download">http://www.apple.com/quicktime/download<br>
									<br>
								</a>
							<li>Start the Quicktime Player application.<br>
								<br>
							<li>Go to Preferences | Quicktime Preferences...<br>
								<br>
								<img src="/construction/timelapse/mac_qt1.gif" alt="" height="248" width="503" border="0"><br>
								<br>
							
							
							<li>Select the Connections tab<br>
								<br>
								<img src="/construction/timelapse/mac_qt2.gif" alt="" height="221" width="300" border="0"><br>
								<br>
							<li>Click on Transport Setup...<br>
								<br>
							
							
							<li>Enter the information in the boxes as shown. Set Transport Protocol to HTTP and Port ID: to 8000.<br>
								<br>
								<img src="/construction/timelapse/mac_qt3.gif" alt="" height="249" width="455" border="0"><br>
								<br>
							<li>Click OK to save the changes and quit the Quicktime Preferences.<br>
								<br>
							<li><a href="rtsp://www.union.arizona.edu/construction.sdp">Then click here to view the stream</a>.<br>
								<br>
							<li>If the link opens with another application besides Quicktime Player, you may need to start the player and then select File | Open URL in New Player...  Then enter the URL: rtsp://www.union.arizona.edu/construction.sdp<br>
								<br>
							
							
						</ol>
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