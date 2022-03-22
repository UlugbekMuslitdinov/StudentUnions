<?php
require($_SERVER['DOCUMENT_ROOT'] . '/operations/policies/template/policies.inc');
$page_options['title'] = 'Smoking Policy';
$page_options['page'] = 'Smoking Policy';
policies_start($page_options);
?>
<h1 style="width: 700px;">University of Arizona Smoking Policy</h1>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cccccc">
	<tr>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="8" bgcolor="white">
			<tr>
				<td><b><a href="/operations/policies/template/resources/SmokingPolicy.pdf">Click here to download this policy as a printable PDF file.</a></b></td>

			</tr>
		</table></td>
	</tr>
</table>
<p>
	The Student Union Memorial Center (SUMC) and Park Student Union (PSU) are non-smoking facilities. The University prohibits the use of products that contain tobacco or nicotine, including cigarettes, cigars, pipes, electronic smoking devices (such as e-cigarettes) bidis, kreteks, hookahs, water pipes, and all forms of smokeless tobacco. This includes all areas of the SUMC and PSU including meeting rooms, dining areas, open walkways, terraces, stairwells, and patios.
</p>
<?php policies_finish() ?>
