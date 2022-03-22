<?php include($_SERVER["DOCUMENT_ROOT"]."/admin/forms/config/forms.php"); ?>
<html>
	<head>
		<title>Catering Hub Event Order Lookup Frame</title>
		<link rel="stylesheet" type="text/css" href="./style/hub_frame.css" />
		<link rel="stylesheet" type="text/css" href="./style/web2point0.css" />
		<script type="text/javascript" src="./scripts/reframe.js"></script>
	</head>
	<body>
		<table style="width: 100%; height: 100%;">
			<tbody>
				<tr>
					<td style="text-align: left; vertical-align: top;">
						<h1>Banquet Event Orders</h1>
					</td>
					<td style="text-align: right; vertical-align: top;">
						<div id="admin-subheader-user">
							<?//=admin_displayname()?> | 
							<a class="fake-link" href="<?//=create_logout_link("Log out")?>"><!--Log Out--></a>
						</div>
					</td>
				</tr>

				<?php if(form_authorized($form_cfg["event_orders"], "view")){ ?>
				<tr>
					<td style="text-align: center; vertical-align: center;" colspan="2">
						<h2>Search by Event ID Number</h2>
						<form action="search_id.php" method="GET" style="margin-top: 10px;">
							<b>E-</b><input type="number" min="0" name="event_id" placeholder="12345" required />
							<input type="submit" value="Go" style="margin-left: 4px;" />
						</form>
						
						<div class="hr-text"><span>or</span></div>
						
						<h2>Search by Day of Week</h2>
						<div style="max-width: 850px; margin: 0 auto;">
							<a href="search_id.php?day=1" class="web2point0-button">Monday		</a>
							<a href="search_id.php?day=2" class="web2point0-button">Tuesday	</a>
							<a href="search_id.php?day=3" class="web2point0-button">Wednesday	</a>
							<a href="search_id.php?day=4" class="web2point0-button">Thursday	</a>
							<a href="search_id.php?day=5" class="web2point0-button">Friday		</a>
							<a href="search_id.php?day=6" class="web2point0-button">Saturday	</a>
							<a href="search_id.php?day=7" class="web2point0-button">Sunday		</a>
						</div>
					</td>
				</tr>
				<tr>
					<td style="text-align: center; vertical-align: bottom;" colspan="2">
						<?php if(form_authorized($form_cfg["event_orders"], "add")){ ?>
						<h2>
							<a href="upload_orders.php">
								Upload Event Orders
							</a>
							&nbsp;|
							<a href="add_user.php">
								Add Catering Hub User
							</a>
						</h2>
						<br/>
						<?php } ?>
						<h3>
							<span style="color: #c00;">Please note:</span>
							BEOs are uploaded on Friday morning for the next week. They are updated frequently, so check back to see if something has changed.
						</h3>
					</td>
				</tr>
				<?php }else{ ?>
				<tr>
					<td style="height: 85%; text-align: center; vertical-align: top;" colspan="2">
						<h2>You are not authorized to view this page. Please contact your supervisor for access.</h2>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</body>
</html>