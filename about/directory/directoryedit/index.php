<?php
  session_start();
  require('webauth_access_control/include.php');
	require('about.inc');
  $page_options['title'] = 'Staff Directory';
  $page_options['page'] = 'about'; 
  about_start($page_options);
	
  if (!$_SESSION['access_control']['allowed']) {
    echo 'not allowed';
    about_finish();
    exit();
  }
  $_SESSION['directory_access'] = 1;
	/*
	if($_SESSION['netID'] != "micheleh" && $_SESSION['netID'] != "sanorris" && $_SESSION['netID'] != "ahoefner" && $_SESSION['netID'] != "ddiaz" && $_SESSION['netID'] != "harrisoj" && $_SESSION['netID'] != "jmasson") {  
	
		echo "not allowed";
		
	
	
	}else {
*/
?>
<h2>Arizona Student Unions Staff Directory Backweb</h2>
<p>Search for a union employee by entering his or her name, or if you are just looking for a department in general, just select a department</p>

<input type=button onClick="location.href='directoryinput.php'" value='Add Employee'> 

<!--<br /><br />

<b> If you are trying to ADD an employee to the directory <a href="directoryinput.php"><b>here</b></a>--> 

<br /><br />

<form action="directoryresults.php" method="post">

Last Name: <br />
<input type="text" maxlength="25" size="25" name="directoryLN" /><br /><br />
First Name: <br />
<input type="text" maxlength="25" size="25" name="directoryFN" /><br /><br />

Department: <br />
<select name="directoryDept">
	<option value="">-- --</option>
	<option value="Admin &amp; Business Office">administration &amp; business office</option>
    <option value="CSIL">center for student involvement &amp; leadership</option>
    <option value="Dining Services">dining &amp; information services</option>
    <option value="Event Services">event services &amp; catering</option>
    <option value="FCS">facilities management &amp; computer services</option>
    <option value="Retail">retail services</option>
</select>
<br /><br />
<input type="hidden" name="newSearch" value="true"/>
<input type="submit" value="Search"/> <input type="button" value="Show All Listed Employees" onclick="location.href='directoryresults.php?showAll=true'" />



<?php 


about_finish() ?>