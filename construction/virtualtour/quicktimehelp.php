<?php
	require('../sectioninfo.inc');
	require('global.inc');
	$title = 'Quicktime Install Help';
	pageStart($title);
?>
<h2>Quicktime Install Help</h2>
<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#333333">
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="1" width="100%">
				<tr>
					<td valign="top" bgcolor="#ffffff"><img src="/common/images/number_one.gif" width="20" height="31" border="0" alt="one"></td>
					<td valign="middle" bgcolor="#cccccc"><a href="http://www.apple.com/quicktime/download"><img height="31" width="88" src="/common/images/getquicktime.gif" border="0" alt="get quicktime"></a>
						<p>Go to the <a href="http://www.apple.com/quicktime/download">Quicktime website</a> and download the Quicktime Installer. Be sure to remember the location you saved the installer file to.</p>
					</td>
				</tr>
				<tr>
					<td valign="top" bgcolor="#ffffff"><img src="/common/images/number_two.gif" width="20" height="31" border="0" alt="two"></td>
					<td valign="middle" bgcolor="#cccccc">Quit your web browser, then using Windows Explorer on Windows or the Finder on MacOS, go to the folder that you saved the installer file to.</td>
				</tr>
				<tr>
					<td valign="top" bgcolor="#ffffff"><img src="/common/images/number_three.gif" width="20" height="31" border="0" alt="three"></td>
					<td valign="middle" bgcolor="#cccccc">Double click the installer file and follow the instructions.
						<p class="small">Note: If you are on Windows NT/2000/XP you must have Administrator access to install Quicktime and the browser plugins.</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php pageFinish() ?>