<?php
	require($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Traditions';
  $page_options['styles'] = 'p{margin:10px 0px;} table.display td{ padding:4px;} table.nospace td{ padding:0px;}';
  page_start($page_options);
?>
<table border="0" cellpadding="4" cellspacing="0" frame="" width="100%" style="padding-top:20px;" >
	<tr>
		<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#333333" >
				<tr>
					<td>
						<table border="0" cellpadding="4" cellspacing="1" width="100%" class="display">
							<tr>
								<td bgcolor="#cccccc"><a href="/traditions/scrapbook/index.php"><b>Student Unions Scrapbook</b></a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<p>Have you ever wondered about the history of the Unions? Learn a little of the Union's history from this <a href="/traditions/scrapbook/index.php">online scrapbook</a>.</p>
			<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#333333">
				<tr>
					<td>
						<table border="0" cellpadding="4" cellspacing="1" width="100%" class="display">
							<tr>
								<td bgcolor="#cccccc"><a href="/about/index.php"><b>About the Unions</b></a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<p>Find out about the <a href="/about/index.php">Union as it is today</a>.</p>
			<!--table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#333333">
				<tr>
					<td>
						<table border="0" cellpadding="4" cellspacing="1" width="100%" class="display">
							<tr>
								<td bgcolor="#cccccc"><a href="/construction/index.php"><b>A New U</b></a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<p>To find out <a href="/construction/index.php">where the Union is going</a> and make a link from the past to the future.</p-->
		</td>
		<td valign="top" style="padding:4px;">
			<p><img height="321" width="265" src="/traditions/indexPic.jpg"></p>
			<div align="center">
				<p>Front entrance of the Union during the mid 50's</p>
			</div>
		</td>
	</tr>
</table>
<?php page_finish() ?>