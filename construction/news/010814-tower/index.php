<?
	if (!isset ($_SESSION)) {
	session_start();
}

	require_once($_SERVER['DOCUMENT_ROOT'] . '/about/template/about.inc');
	$page_options['title'] = 'Tower Demolished';
	about_start($page_options);
	require_once ('/Library/WebServer/commontools/db.inc');
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td valign="top" align="left">
			<h2>Clock Tower Demolished</h2>
			<p>Wednesday, August 14, 2001 at 10am, Swinerton Builders demolished the old clock tower that has been a landmark on the UA mall for 50 years in order to make room for Phase II of the new Student Union. A new clock tower along with the USS Arizona bell will be built as part of the construction project.</p>
			<table border="0" cellpadding="1" cellspacing="0" bgcolor="#333333">
				<tr>
					<td>
						<table border="0" cellpadding="4" cellspacing="0" width="100%">
							<tr>
								<td bgcolor="#cccccc"><br>
									&gt;&gt; <a href="/construction/news/010814-tower/tower_demolition.mov">Quicktime movie from the webcam</a> 3.5mb<br>
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
			<p></p>
		</td>
		<td align="center" valign="top" width="20"><spacer type="block" width="20" height="20"></td>
		<td align="center" valign="top"><img src="/construction/news/010814-tower/tower_b.jpg" width="225" height="247" alt=" " border="0">
			<p><img src="/construction/news/010814-tower/tower_a.jpg" width="225" height="169" alt=" " border="0"></p>
		</td>
	</tr>
</table>
            
<? about_finish(); ?>