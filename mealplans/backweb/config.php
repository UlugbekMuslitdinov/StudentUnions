<?php
//include backweb template
require_once('template/mpbackweb.inc');

if(isset($_POST['start'])){
  $query = 'insert into yearly_config set'.
              '   start = "'. $_POST['start'].
              '", can_charge_bursars = "'.  $_POST['can_charge_bursars'].
              '", half_plan_start = "'.     $_POST['half_plan_start'].
              '", spring_term_start = "'.   $_POST['spring_term_start'].
              '", stop_plus_signup = "'.    $_POST['stop_plus_signup'].
              '", end = "'.                 $_POST['end'].
              '"';
  $db->query($query);
}
elseif(isset($_GET['delete'])){
  $query = 'delete from yearly_config where id='.$_GET['delete'];
  $db->query($query);
}

//start page
mpbackweb_start('config');

$query = 'select * from yearly_config order by start';
$result = $db->query($query);
?>
<style>
td{
  text-align: center;
}
</style>
<h2>Configuration</h2>
<form action="" method="post" name="yearly_config" id="yearly_config">
  <table>
    <thead>
      <tr>
        <th></th>
        <th></th>
        <th>Start</th>
        <th>Can start charging bursars</th>
        <th>Begin half plans</th>
        <th>Begin charging spring term(must be by the 31st)</th>
        <th>Stop allowing plus plan signup</th>
        <th>End</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        print '<tr>';
          print '<td>/</td>';
          print '<td onclick="location=\'config.php?delete='.$row[0].'\'">X</td>';
          print '<td>'.$row[1].'</td>';
          print '<td>'.$row[2].'</td>';
          print '<td>'.$row[3].'</td>';
          print '<td>'.$row[4].'</td>';
          print '<td>'.$row[5].'</td>';
          print '<td>'.$row[6].'</td>';
        print '</tr>';
      }
      ?>
      <tr>
        <td></td>
        <td onclick="document.yearly_config.submit();">v</td>
        <td><input type="text" name="start" /></td>
        <td><input type="text" name="can_charge_bursars" /></td>
        <td><input type="text" name="half_plan_start" /></td>
        <td><input type="text" name="spring_term_start" /></td>
        <td><input type="text" name="stop_plus_signup" /></td>
        <td><input type="text" name="end" /></td>
      </tr>
    </tbody>
  </table>
</form>


<?php 
mpbackweb_finish();
?>