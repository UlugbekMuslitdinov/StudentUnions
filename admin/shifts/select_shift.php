<?php
// Display Locations for Dining/Catering/Other.
$num = $_GET['num'];

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');	

// Display the list of available shifts.
$query = "SELECT * FROM Locations WHERE id NOT IN (998, 999) ORDER BY location ASC";
// 998 - Catering Dock
// 999 - Other
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
} elseif ($num == 2) {		// For Catering
	?><div class="text">
			  Catering Dock
			  <input type="hidden" name="location" value="998">
	  </div> <?php
} else {		// For Other
	?><div class="text">
			  Other
			  <input type="hidden" name="location" value="999">
	  </div> <?php
}
?>

