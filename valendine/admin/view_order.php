<?php
	// header("Location: ../index.php");
	// die();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Thanksgiving Orders';
	page_start($page_options);	

require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$id = $_GET['id'];
$db = new db_mysqli('su');

// Get order details for the ID.
$query = "SELECT * FROM forms WHERE id =" . $id . "";
$result = $db->query($query);
$form = mysqli_fetch_assoc($result);
$message = $form['emailmessage'];
?>

<body>
<table width="800" style="margin-top:50px;">
<tr>
	<td>
	<?php
	print($message);
	?>
	</td>
</tr>	
</table>

</body>
<?php page_finish(); ?>
