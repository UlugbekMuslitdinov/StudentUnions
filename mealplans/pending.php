<?php
require_once('template/mp.inc');
require_once ('includes/mysqli.inc');

$db = new db_mysqli('mealplans');

$query = 'select * from signup_pending where emplid='.$_SESSION['mp_login']['id'];
$result = $db->query($query);
$plan = mysqli_fetch_assoc($result);
$page_options['page'] = 'pending';
mp_start('Account Sign-up Pending', 0, 1);
?>
Your account signup is still pending. You have signed up for a <?=$plan['plan']?>. Your plan should become active within 15 minutes of sign up or at the beginning of the school year if you are signing up during summer. If this time has elapsed and your account is still pending please contact the meal plans office at (520) 621-7043 or (800) 374-7379.
<?php mp_finish();?>
