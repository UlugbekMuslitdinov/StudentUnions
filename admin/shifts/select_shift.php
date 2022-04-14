<?php
// Display Locations for Dining/Catering/Other.
$num = $_GET['num'];

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');	

// Display the list of available shifts.
$query = "SELECT * FROM Locations WHERE category = " . $num . " ORDER BY location ASC";	// category 1 = Dining
$locations = $db->query($query);

if ($num == 1) { 	// For Dining
?>
  <select name="location" id="location" class="text">
	  <option value="0">Select Location</option>
	  <option value="0">=====================</option>
	  <?php
		while($row = mysqli_fetch_array($locations, MYSQLI_ASSOC)) { 
	  ?>
	  <option value="<?=$row['id']?>"><?=$row['location']?></option>
	  <?php } ?>
  </select> 
<?php
} else {		// Just one location for the others.
	?><div class="text">
	  <?php
		while($row = mysqli_fetch_array($locations, MYSQLI_ASSOC)) { 
	  ?>
	  <?=$row['location']?>
	  <input type="hidden" name="location" value="<?=$row['id']?>">
	  <?php } ?>
	  </div> <?php
}
?>

