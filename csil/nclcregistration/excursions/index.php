<?
  session_start();
	require_once ('includes/mysqli.inc');
	$db = new db_mysqli("nclc10");
  
  if($_POST['password']=='nclc2011excursions')
      $_SESSION['password'] = 'nclc2011excursions';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>National Collegiate Leadership Conference</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link type="text/css" rel="stylesheet" href="/csil/nclcregistration/common/main.css" />
<script type="text/javascript">
	function testRadio()
	{
		var a;
		for(a = 0; a < document.excursion.selectexcursion.length; a++)
		{
			if(document.excursion.selectexcursion[a].checked)
				return true;
		}
		return false;
	}
</script>
</head>

<div id="header"><img src="/csil/nclcregistration/common/banner_whiteB.gif"></div>

<body style="margin:0px; padding:0px" bgcolor="#DCDDDE">
<div id="container">
  <div id="menu">
    <img src="/csil/nclcregistration/common/NCLC_header_noBar1.jpg" style="width:875px; height:148px" />

    <a href="http://arizonaleadership.orgsync.com/org/nclc/details" style="color:#002D62; font-size:12px; font-weight:bold;">Attend</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/workshops" style="color:#002D62; font-size:12px; font-weight:bold;">Present</a>
    <a href="https://orgsync.com/:nclc/join" style="color:#002D62; font-size:12px; font-weight:bold;">Plan</a>
  </div>

  <div id="navigation">
    <strong><a href="http://arizonaleadership.orgsync.com/org/nclc" style="font-size:12px; color:#333333;">Home</a></strong>

    <strong><a href="http://union.arizona.edu/csil/nclcregistration/index.php" style="color:#002D62; font-size:12px; margin-top: 5px;">Registration</a></strong>

    <h1>Conference Details</h1>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/details">details</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/keynote">keynote</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/excursions">excursions</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/workshops">workshops</a>

    <a href="http://arizonaleadership.orgsync.com/org/nclc/callforprograms">call for programs</a>

    <h1>Accomodations &amp; Travel</h1>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/directions">directions</a>
    <a href="http://www.union.arizona.edu/">venue</a>

    <h1>Support NCLC</h1>

    <a href="http://arizonaleadership.orgsync.com/org/nclc/meet">meet the NCLC team</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/sponsors">our sponsors</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/becomeasponsor">become a sponsor</a>
	
    <h1>Contact Us</h1>
    <a href="mailto:nclc@email.arizona.edu">email us</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/addressandphone">address and phone</a>

    <a href="http://arizonaleadership.orgsync.com/org/ualeadership">leadership programs</a>
  </div>

  <div id="content">
  <?php
  if(!isset($_SESSION['password'])){
  ?>
    Please fill in the password you recieved in the email to continue with you excursion registration.<br />
    <form action="index.php" method="post">
      Password: <input type="text" name="password" length="15" />
      <input type="submit" value="submit" />
    </form> 
  <?php
  }
  else{
  ?>
  

	REFUND POLICY: All transactions are final. No refunds will be issued unless the excursion is cancelled by NCLC. Because there are limited spots, you may only sign up for yourself.<br /><br />
	Please select your excursion:<br/>
    <form name="excursion" action="confirm.php" method="post">
    <table>
    <tbody>
    
    <?
        $excursionsList = $db->query("SELECT * FROM excursions");
        while($row = $result->fetch_array())
        {
            $seatsFullQuery = $db->query("SELECT * FROM excursionguests WHERE excursionID=" . $row[0]);
            $seatsFull = $seatsFullQuery->num_rows;
            if($seatsFull < $row[2])
            print '<tr><td><input id="b' . $row[0] . '" name="selectexcursion" type="radio" value="' . $row[0] . '"/></td><td width="10px">&nbsp;</td>
            <td>' . $row[1] . '</td><td width="30px">&nbsp;</td>
            <td>$' . $row[3] . '</td></tr>';
        }
    ?>
    </tbody>
    </table>
    <br />
    <input type="submit" value="Proceed to Payment" onclick="if(testRadio()) return true; alert('Please Make a Selection'); return false;"/>
    </form>
    <?php } ?>
  </div>

  <div id="footer" align="center">
    <div style="float:left; position:absolute; top:5px; left:220px; padding-right:20px;" align="left">

      NCLC is brought to you by the <br />
      Center for Student Involvement and Leadership at The University of Arizona<br />
      PO Box 210017, Tucson, AZ 85721-0017<br />
    </div>
    <div style="padding-top:10px; padding-right:8px; width:200px; height:30px; border-right:2px solid; position:absolute; top:5px;" align="right">
      520.621.8046<br />
    </div>

  </div>
</div>

</body>
</html>