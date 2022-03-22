<?php
	require($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Page Not Found';
  $page_options['styles'] = 'h2, p{font-size:10px;}';
	page_start($page_options);
?>
<table border="0" cellspacing="0" cellpadding="0" gridx="16" gridy="16" showgridx showgridy usegridx usegridy>
	<tr height="48">
		<td rowspan="3" width="64"></td>
		<td width="128" height="48"></td>
		<td rowspan="2"><br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</td>
	</tr>
	<tr height="32">
		<td rowspan="2" align="left" valign="top" width="128" xpos="64"><img src="/template/images/error.gif" alt=" " height="101" width="100" border="0"></td>
	</tr>
	<tr height="144">
		<td align="left" valign="top" height="144" xpos="192">
			<h2><img src="/template/images/oops.gif" alt="oops!" height="39" width="102" border="0"><br>
				<br>
			</h2>
			<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cccccc">
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="16">
							<tr>
								<td bgcolor="white">
									<h2>Not sure what page you're looking for???????? Or is the site supposed to be here, but it's not?</h2>
									<p>Email the <a href="mailto:web@www.union.arizona.edu">webmaster</a> and give the link that you used to get here. <a href="mailto:web@www.union.arizona.edu">web@www.union.arizona.edu</a></p>
									<?php
							if (isset($REQUEST_URI)){
								if (preg_match("(html$)", $REQUEST_URI)) {

									echo "<p>You may have an outdated bookmark, try the following link:<br>";
									$uri_new = preg_replace("(html$)", "php", $REQUEST_URI);
									echo "<a href=\"http://${HTTP_HOST}${uri_new}\">http://${HTTP_HOST}${uri_new}</a></p>";


								}
							}
						?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<p><br>
				<br>
			</p>
			<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cccccc">
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="16">
							<tr>
								<td bgcolor="white">
									<p>Find it!</p>
									<form action="search.php" id="cse-search-box" >
						              	<input type="hidden" name="cx" value="008979135469412661396:3pqmv-1myq4">
						                <input type="hidden" name="cof" value="FORID:10">
						                <input type="hidden" name="ie" value="UTF-8">
						              	<input type="hidden" name="sa" value="Search">

			                            <input type="text" name="q" value="search for ..." onfocus="if (this.value == 'search for ...') this.value = ''" size="35">
			                            <input type="submit" name="submit" value="search" style="margin-left:12px; ">


                      				</form>

									<p>&nbsp;<a href="http://www.arizona.edu/index"><b>Click here to go to the UAInfo search page to search the entire arizona.edu domain.</b></a></p>
									<p>&nbsp;<a href="http://www.union.arizona.edu/clubs/list"><b>Looking for a club? Click to search for clubs on campus.</b></a></p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<p><br>
				<br>
				<br>
				<br>
				<br>
				<br>
			</p>
		</td>
	</tr>
</table>
<?php page_finish() ?>
