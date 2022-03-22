<script language="javascript"> 
function limit(what,chars,counter) {

if (what.value.length > chars) { 
what.value=what.value.substr(0,chars); 
//alert(max +chars+' chars!'); 
}

counting = (chars - what.value.length); 
c = document.getElementById(counter); 
c.innerHTML = counting; 
}
</script>




<div style="background-color:#F2F2F2; padding: 10px; border-radius: 4px; border-color:#000000; border-width:2px; width:550px;">
<?php
$current = time();
$start_date = mktime(0, 0, 0, 1, 17, date("Y"));
$end_date = mktime(17, 0, 0, 4, 8, date("Y"));

// echo "Start Date: ".$start_date."<br />";
// echo "Current Date: ".$current."<br />";
// echo "End Date: ".$end_date."<br />";

if ($current < $start_date || $current > $end_date):
?>

<p style="color:#525252; padding:10px;">Online Nominations are available January 17th - April 7th.</p>

<?php else: ?>
<form action="/csil/Accolades/GroupAwards/thankyougroup.php" enctype="multipart/form-data" method="post">

	<!--<input type="hidden" name="AN" value=" <?// print $title ?> "/>-->
<table>
		<tr>
			<td style="color:#525252;">Name of Nominator<span class="req" >*</span><br />
			<input type="text" name="NON" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['NON'] . "\""; } ?> /></td>
		</tr>
		<tr>
 			<td style="color:#525252;">Current Mailing Address<span class="req" >*</span><br />
			<input type="text" name="CMA" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CMA'] . "\""; } ?>/></td>
		</tr>
        <td style="color:#525252;">Current Mailing Address Line 2<br />
			<input type="text" name="CMA2" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CMA2'] . "\""; } ?>/></td>
		</tr>
        <td style="color:#525252;">City, State, ZIP<span class="req" >*</span><br />
			<input type="text" name="CSZ" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CSZ'] . "\""; } ?>/></td>
		</tr>
</table>

<table>
		<tr>
 			<td style="color:#525252;">Phone Number<span class="req" >*</span></td> 
            <td style="color:#525252;">Email<span class="req" >*</span></td>
        </tr>
        <tr>
        	<td style="color:#525252;">
			<input type="text" name="PHN" maxlength="15" size="18" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['PHN'] . "\""; } ?>/>
            </td>
            <td style="color:#525252;">
            <input type="text" name="EMA" maxlength="45" size="47" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['EMA'] . "\""; } ?>/>
            </td>
		</tr>
</table>
<table>
		<tr>
 			<td style="color:#525252;">Relation to Nominee<span class="req" >*</span><br />
			<input type="text" name="RTN" maxlength="70" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['RTN'] . "\""; } ?>/></td>
		</tr>
</table>
<br />
<hr />
<br />




<table>
		<tr>
			<td style="color:#525252;">Name of Organization, Department or Program<span class="req" >*</span><br />(Please verify that you have the nominee's name spelled correctly as it will appear on their certificate as it was entered.)<br />
			<input type="text" name="NOO" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['NOO'] . "\""; } ?>/></td>
		</tr>
		<tr>
 			<td style="color:#525252;">Contact Individual<span class="req" >*</span><br />
			<input type="text" name="CI" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CI'] . "\""; } ?>/></td>
		</tr>
        <tr>
 			<td style="color:#525252;">Current Mailing Address<span class="req" >*</span><br />
			<input type="text" name="CMAO" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CMAO'] . "\""; } ?>/></td>
		</tr>
        <td style="color:#525252;">Current Mailing Address Line 2<br />
			<input type="text" name="CMAO2" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CMAO2'] . "\""; } ?>/></td>
		</tr>
        <td style="color:#525252;">City, State, ZIP<span class="req" >*</span><br />
			<input type="text" name="CSZO" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CSZO'] . "\""; } ?>/></td>
		</tr>
</table>

<table>
		<tr>
 			<td style="color:#525252;">Phone Number<span class="req" >*</span></td> 
            <td style="color:#525252;">Email<span class="req" >*</span></td>
        </tr>
        <tr>
        	<td style="color:#525252;">
			<input type="text" name="PHOO" maxlength="15" size="18" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['PHOO'] . "\""; } ?>/>
            </td>
            <td style="color:#525252;">
            <input type="text" name="EMAO" maxlength="45" size="47" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['EMAO'] . "\""; } ?>/>
            </td>
		</tr>
</table>

<table>

<?

require_once('groupqs.php');

if (isset($_GET['groupq'])) {
$_SESSION['grp'] = $_GET['groupq'];
}

	for ($i=1; $i <= 4; $i++) {
	
	print "<tr>";
    print "<td style=\"color:#525252; padding-right:30px\">";

	print $groupques[$_SESSION['grp']][$i];
	print "<br>";
	
	if ($error == true) {
	print "<textarea cols=\"55\" rows=\"5\" onkeyup=\"limit(this,6000,'count1')\" onkeypress=\"limit(this,6000,'count1')\" name=\"q" . $i . "\">" . $_POST['q' . $i] . "</textarea>";
	}else {
	print "<textarea cols=\"55\" rows=\"5\" onkeyup=\"limit(this,6000,'count1')\" onkeypress=\"limit(this,6000,'count1')\" name=\"q" . $i . "\">Enter Answer Here</textarea>";
	}
	print "<br>";
	print "<br>";
	print "</td>";
    print "</tr>";

	}
	
print "<input type=\"hidden\" name=\"awardTitle\" value=\"". $groupques[$_SESSION['grp']][5] . "\">";

?>

</table>

<center><input type="submit" /></center><br />

</form>

<br />
<hr />
<br />

<font style="color:#525252;">&nbsp;<span class="req" >*</span> indicates a required field</font><br />
<?php endif; ?>

</div>