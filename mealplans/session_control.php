<?php
session_start();

if($_SESSION['webauth']['netID'] != 'jmasson'){
  print 'not allowed';
  exit();
}

if($_POST['debug']){
  $_SESSION['debug'] = 1;
}
elseif($_POST['now']){
  $_SESSION['now'] = strtotime($_POST['now']);
}
elseif($_POST['noplan']){
  $_SESSION['mp_cust']['state'] = 'no plan';
}

print_r($_SESSION);
?>
<form action="" method="post">
  <input type="submit" name="debug" value="Debug" />
</form>
<form action="" method="post">
  <input type="submit" name="noplan" value="No Plan" />
</form>
<form action="" method="post">
  now: <input type="text" name="now" />
  <input type="submit" value="set" />
</form>