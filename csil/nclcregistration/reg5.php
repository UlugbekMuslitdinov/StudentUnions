<?php	
	session_start();
	
	if ($error != 'true') {
	
	$_SESSION['hostType'] = $_POST['hostType'];
	
	if ($_SESSION['hostType'] == "host") {
		$_SESSION['hostPref'] = $_POST['hostPref'];
		$_SESSION['hostCap'] = $_POST['hostCap'];
		$_SESSION['hostGen'] = $_POST['hostGen'];
	} elseif ($_SESSION['hostType'] == "guest") {
		$_SESSION['guestPref'] = $_POST['guestPref'];
		$_SESSION['guestGen'] = $_POST['guestGen'];
		$_SESSION['guestNum'] = $_POST['guestNum'];
		$_SESSION['guestTrans'] = $_POST['guestTrans'];
	}
	
	}
	include_once("common/page_start.php");
	
	
?>

<div class="content_block">

<h1>NCLC 2009 Online Registration</h1>

<?

if ($error == 'true') {
	print "<font style=\"font-size:14px; color:red;  font-weight:normal\">Registration cannot be completed until the terms of the photo release are agreed to</font>";
	print "<br><br>";
	}

?>


<b>Photo Release:</b> <br />

<p>I understand that upon check in to the National Collegiate Leadership Conference, it is my responsibility to ensure that all of the members of my group (including myself) sign a photo release form prior to attending any workshops or conference events.</p>
<!--
<p>In addition to the registration form, all participants are asked to agree to the following: </p>

<p>I, hereby give the National Collegiate Leadership Conference (NCLC) the absolute right and permission to copyright, publish, or use photographs of me-which I may be included in whole or in part or composite or distorted in character or form, in conjunction with my own or fictitious name, or reproductions thereof in color or otherwise, made through any media that the National Collegiate Leadership Conference chooses or hires someone to create and/or reproduce thereof in color or otherwise, made through any media that the NCLC chooses or hires someone to create and/r reproduce, for art, advertising, use on the NCLC website, in publications, trade or any other lawful purpose whatsoever.</p>

<p>I hereby waive my right to inspect, and/or approve the finished product of the advertising copy that may be used in connection therewith, or the use to which it may be applied.</p>

<p>I am 18 years of age or older and I am competent to contract my own name. I have read this release before signing it and understand the contents, meanings, and impact of this release. </p>

<p>Once you have agreed to the terms above please click I agree and type your first and last name.</p>-->

<form name="photo" action="reg6.php" method="post">
	<input type="checkbox" name="photoRel" value="Yes" /> I Understand<br />
	<br /><br />
    <input type="Submit" value="Save &amp; Continue">
     
</form>
    
</div>

<?
	include_once("common/page_end.php");
?>