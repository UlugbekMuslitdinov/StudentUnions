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
<style>
	hr {
		border: 1px solid #9C9C9C; 
	}
</style>
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

<p style="color:#525252; padding:10px;">Nominations deadline is April 7th</p>

<?php else: ?>
<form action="/csil/Accolades/indvawards/thankyouindv.php" enctype="multipart/form-data" method="post">

<!--<input type="hidden" name="AN" value="<?// print $title ?> "/>-->

<table>
		<tr>
			<td style="color:#525252">Name of Nominator<span class="req" >*</span><br />
			<input type="text" name="NON" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['NON'] . "\""; } ?>/></td>
		</tr>
		<tr>
 			<td style="color:#525252">Current Mailing Address<span class="req" >*</span><br />
			<input type="text" name="CMA" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CMA'] . "\""; } ?>/></td>
		</tr>
        <td style="color:#525252">Current Mailing Address Line 2<br />
			<input type="text" name="CMA2" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CMA2'] . "\""; } ?>/></td>
		</tr>
        <td style="color:#525252">City, State, ZIP<span class="req" >*</span><br />
			<input type="text" name="CSZ" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CSZ'] . "\""; } ?>/></td>
		</tr>
</table>

<table>
		<tr>
 			<td style="color:#525252">Phone Number<span class="req" >*</span></td> 
            <td style="color:#525252">Email<span class="req" >*</span></td>
        </tr>
        <tr>
        	<td style="color:#525252">
			<input type="text" name="PHN" maxlength="15" size="18" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['PHN'] . "\""; } ?>/>
            </td>
            <td style="color:#525252">
            <input type="text" name="EMA" maxlength="45" size="47" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['EMA'] . "\""; } ?>/>
            </td>
		</tr>
</table>
<table>
		<tr>
 			<td style="color:#525252">Relation to Nominee<span class="req" >*</span><br />
			<input type="text" name="RTN" maxlength="70" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['RTN'] . "\""; } ?>/></td>
		</tr>
</table>
<br />
<hr />
<br />


<input type="hidden" name="formSubmitted" value="true" />

<table>
		<tr>
			<td style="color:#525252">First Name of Nominee<span class="req" >*</span><br />(Please verify that you have the nominee's name spelled correctly as it will appear on their certificate as it was entered.)<br />
			<input type="text" name="FNM" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['FNM'] . "\""; } ?>/></td>
        </tr>
        <tr>
            <td style="color:#525252">Last Name of Nominee<span class="req" >*</span><br />
			<input type="text" name="LNM" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['LNM'] . "\""; } ?>/></td>
		</tr>
		<tr>
 			<td style="color:#525252">Current Mailing Address<span class="req" >*</span><br />
			<input type="text" name="CMAN" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CMAN'] . "\""; } ?>/></td>
		</tr>
        <td style="color:#525252">Current Mailing Address Line 2<br />
			<input type="text" name="CMAN2" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CMAN2'] . "\""; } ?>/></td>
		</tr>
        <td style="color:#525252">City, State, ZIP<span class="req" >*</span><br />
			<input type="text" name="CSZN" maxlength="60" size="70" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['CSZN'] . "\""; } ?>/></td>
		</tr>
</table>

<table>
		<tr>
 			<td style="color:#525252">Phone Number<span class="req" >*</span></td> 
            <td style="color:#525252">Email<span class="req" >*</span></td>
        </tr>
        <tr>
        	<td style="color:#525252">
			<input type="text" name="PHON" maxlength="15" size="18" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['PHON'] . "\""; } ?>/>
            </td>
            <td style="color:#525252">
            <input type="text" name="EMAN" maxlength="45" size="47" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['EMAN'] . "\""; } ?>/>
            </td>
		</tr>
</table>
<table>
		<tr>
 			<td style="color:#525252">College<span class="req" >*</span></td> 
            <td style="color:#525252">Dept<span class="req" >*</span></td>
        </tr>
        <tr>
        	<td style="color:#525252">
			<input type="text" name="COL" maxlength="37" size="34" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['COL'] . "\""; } ?>/>
            </td>
            <td style="color:#525252">
            <input type="text" name="DEPT" maxlength="37" size="31" autocomplete="off" <? if ($error == true) { print "value=\"".  $_POST['DEPT'] . "\""; } ?>/>
            </td>
		</tr>
</table>

<table>
	
<?

require_once('indvqs.php');

if (isset($_GET['indvq'])) {
$_SESSION['indvVal'] = $_GET['indvq'];
}
	
	for ($i=1; $i <= 4; $i++) {
	
	print "<tr>";
    print "<td style=\"color:#525252\">";

	
	print $individualq[$_SESSION['indvVal']][$i];
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

print "<input type=\"hidden\" name=\"AN\" value=\"". $individualq[$_SESSION['indvVal']][5] . "\">";

?>

</table>

<center><input type="submit" /></center><br />

</form>

<br />
<hr />
<br />

<font style="color:#525252">&nbsp;<span class="req" >*</span> indicates a required field</font><br />
<?php endif; ?>

</div>