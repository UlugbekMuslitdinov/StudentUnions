<?
	if (!isset ($_SESSION)) {
	session_start();
}

	require_once($_SERVER['DOCUMENT_ROOT'] . '/about/template/about.inc');
	$page_options['title'] = 'Tower Demolished';
	about_start($page_options);
	require_once ('/Library/WebServer/commontools/db.inc');
?>
<table border="0" cellpadding="0" cellspacing="0" width="500">
	<tr>
		<td valign="top" align="left">
			<h2>Dome Steel Installed</h2>
			<p><i>Jan 24, 2002</i><br>
				Construction crews installed the steel framework for the large circular staircase that will be a centerpiece of the new Student Union Memorial Center Thursday at around noon.</p>
			<p>The large steel circle was lifted by crane above the fourth floor on the bookstore side of the building.  Crews then began work to attach it to the supports that had already been installed.</p>
			<div align="center">
				<table border="0" cellpadding="1" cellspacing="0" bgcolor="#333333">
					<tr>
						<td>
							<table border="0" cellpadding="4" cellspacing="0" width="100%">
								<tr>
									<td bgcolor="#cccccc"><br>
										
									&gt;&gt; <a href="/construction/news/020124-dome/SUDomeInstallation.mov">Quicktime movie from the webcam</a> 4.2mb<br>
										<br>
									</td>
								</tr>
								<tr>
									<td bgcolor="#ffffff"><a href="http://www.apple.com/quicktime/download" target="_blank"><img height="31" width="88" src="/common/images/getquicktime.gif" border="0" alt="get quicktime"></a>
										<p><a href="/construction/virtualtour/quicktimehelp.php">Need help installing Quicktime?</a></p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<p></p>
			<div align="center">
				<p><img src="/construction/news/020124-dome/dome_c.jpg" width="225" height="300" border="0"></p>
			</div>
		</td>
		<td align="center" valign="top" width="20"><spacer type="block" width="20" height="20"></td>
		<td align="center" valign="top"><img src="/construction/news/020124-dome/dome_b.jpg" width="225" height="300" alt=" " border="0">
			<p><img src="/construction/news/020124-dome/dome_a.jpg" width="225" height="300" alt=" " border="0"></p>
		</td>
	</tr>
</table>            
<? about_finish(); ?>