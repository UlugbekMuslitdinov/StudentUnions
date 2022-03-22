<?php
//include template files
require_once('template/mpbackweb.inc');

//make extra check that user is allowed in this area. variable is set in access.inc
if(!$_SESSION['user']['admin']){
	print 'you do not have access to this section.';
	exit();
}

//grab all current users allowed in backweb
$query = 'select * from user_access';
$result1 = $db->query($query);

//grab all current users allowed in cashier page
$query = 'select * from cashier_access where type="netID"';
$result2 = $db->query($query);

//grab all current ips allowed in cashier page
$query = 'select * from cashier_access where type="IP"';
$result3 = $db->query($query);

//start page
mpbackweb_start('admin');
?>
<h2>Admin Tools</h2>
<fieldset id="user-access">
	<legend>Backweb Access</legend>
	<table cellspacing="0">
		<thead>
			<tr>
				<th></th>
				<th>netID</th>
			</tr>
		</thead>
		<tbody>
			<?php
				//cycle through users creating a row for each with button to delete and the netID
				while($user = mysqli_fetch_assoc($result1)){
			?>
					<tr class="row<?=$i++%2?>">
						<td onclick="remove_user(<?=$user['ID']?>, this)" style="cursor:pointer;">X</td>
						<td><?=$user['netID']?></td>
					</tr>
			<?php
				}
			?>
					<!--  add final row with form give another netID access to the backweb -->
					<tr class="row<?=$i++%2?>">
						<td><input type="button" value="add" onclick="add_user(document.getElementById('new_user_id').value)" /></td>

						<td><form onsubmit="return add_user(document.getElementById('new_user_id').value)"><input type="text" name="netID" id="new_user_id" /></form></td>
					</tr>
		</tbody>
	</table>
</fieldset>

<fieldset id="cashier-access">
	<legend>Cashier Access</legend>
	<table cellspacing="0">
		<thead>
			<tr>
				<th></th>
				<th>netID</th>
			</tr>
		</thead>
		<tbody>
			<?php
				//cycle through users creating a row for each with button to delete and the netID
				while($user = mysqli_fetch_assoc($result2)){
			?>
					<tr class="row<?=$i++%2?>">
						<td onclick="remove_user2(<?=$user['id']?>, this)" style="cursor:pointer;">X</td>
						<td><?=$user['value']?></td>
					</tr>
			<?php
				}
			?>
					<!--  add final row with form give another netID access to the backweb -->
					<tr class="row<?=$i++%2?>">
						<td><input type="button" value="add" onclick="add_user2(document.getElementById('new_user_id2').value)" /></td>

						<td><form onsubmit="return add_user2(document.getElementById('new_user_id2').value)"><input type="text" name="netID" id="new_user_id2" /></form></td>
					</tr>
		</tbody>
	</table>
</fieldset>

<fieldset id="ip-access">
	<legend>Cashier IPs</legend>
	<table cellspacing="0">
		<thead>
			<tr>
				<th></th>
				<th>IP Address</th>
			</tr>
		</thead>
		<tbody>
			<?php
				//cycle through users creating a row for each with button to delete and the netID
				while($user = mysqli_fetch_assoc($result3)){
			?>
					<tr class="row<?=$i++%2?>">
						<td onclick="remove_user2(<?=$user['id']?>, this)" style="cursor:pointer;">X</td>
						<td><?=$user['value']?></td>
					</tr>
			<?php
				}
			?>
					<!--  add final row with form give another netID access to the backweb -->
					<tr class="row<?=$i++%2?>">
						<td><input type="button" value="add" onclick="add_ip(document.getElementById('new_ip_id').value)" /></td>

						<td><form onsubmit="return add_ip(document.getElementById('new_ip_id').value)"><input type="text" name="ip" id="new_ip_id" /></form></td>
					</tr>
		</tbody>
	</table>
</fieldset>

<?php
mpbackweb_finish();
?>
