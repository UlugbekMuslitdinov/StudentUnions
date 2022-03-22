<?php
require_once('includes/mysqli.inc');

$db = new db_mysqli('student_hiring');

require_once('end_of_semester_email.inc.php');

$result = $db->query('select * from applications where app_id=2 and active=1 and hired=0');
 
if($result) {
	while($row = $result->fetch_assoc()) {
		endOfSemesterEmail($row['email']);
	}
}

?>