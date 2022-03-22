<?php

session_start();

// including this requires WebAuth login.
require_once('webauth/include.php');

require_once ('includes/mysqli.inc');


// this include has encapsulates the connection  
// string, especially the userid and password.
include('mysql_link.inc');

// select the surveys database
$db = new db_mysqli("surveys");

// get the netID from WebAuth
$myNetID = $_SESSION['webauth']['netID'];

// Determine if user has already voted.
// Since there is a unique index on netID, this will
// return either one row or zero rows.
$num_rows = mysqli_num_rows($db->query("SELECT * FROM awning_vote WHERE netID='".$myNetID."'"));

// If the user hasn't voted yet, and they are attempting to submit a vote, record it
if($num_rows == 0)
{
	if(isset($_POST["vote"]))
		$db->query("INSERT INTO awning_vote (netID, vote, reason) VALUES ('".$myNetID."', '".$db->escape($_POST["vote"])."', '".$db->escape($_POST["reason"])."')");
	else
	{
		$_SESSION['noselect'] = 1;
		header('Location: index.php');
		exit;
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'Awning Survey Results';
page_start($page_options);
	
?>
<style>
	div.content
	{
		padding: 20px;
		width: 800px;
	}
	div.title
	{
		color: f9b820;
		font-family: Helvetica, sans-serif;
		height: 20px;
	}
	div.bluebox
	{
		background-color: #27426F;
		-moz-border-radius: 15px;
		border-radius: 15px;
		text-align: center;
		margin: 20px 20px 10px 0px;
		height: 260px;
		width: 350px;
		float: left;
		padding: 10px;
	}
	div.borderedsail
	{
		width:175px;
		height:114px;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		background: url('images/sailssmall.jpg');
		cursor: pointer;
	}
	div.borderedwave
	{
		width:175px;
		height:114px;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		background: url('images/wavessmall.jpg');
		cursor: pointer;
	}
	div.radio
	{
		color: white;
		font-size: 18px;
		font-family: Arial Narrow, Helvetica, sans-serif;
		margin: 10px;
	}
	div.explanation
	{
		font-weight: bold;
		font-size: 14px;
		line-height: 17px;
		width: 650px;
	}
	span.reason
	{
		font-weight: bold;
		font-size: 14px;
		line-height: 17px;
	}
	td
	{
		font-family: Arial, Helvetica, sans-serif;
		font-size: 14px;
	}
</style>

<div class="content">
	<div class="explanation">
    	<? if($num_rows == 0) print "Your vote has been recorded. "; ?>
    	Thank you for taking the time to vote. Check back periodically if you would like to see the incoming results.
    </div>
    <?
    	$waveVotes = mysqli_fetch_row($db->query("SELECT count(vote) FROM awning_vote WHERE vote='wave'"));
		$waveVotes = $waveVotes[0];
    	$sailVotes = mysqli_fetch_row($db->query("SELECT count(vote) FROM awning_vote WHERE vote='sail'"));
		$sailVotes = $sailVotes[0];
		
		print "<br/><br/>";
		$total = $waveVotes + $sailVotes;
		?>
        <table>
            <tr><td style="width: 190px"><div class="borderedsail"></div></td><td style="width: 32px; font-weight: bold"><span style="font-size: 18px"><? print $sailVotes;?></span></td><td><div <? print 'style="margin: 1px 0px 1px 0px; background-color: red; height: 10px; width: '.round(300 * $sailVotes / $total).'px"'; ?>></div></td></tr>
            <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
        	<tr><td style="width: 190px"><div class="borderedwave"></div></td><td style="width: 32px; font-weight: bold"><span style="font-size: 18px"><? print $waveVotes;?></span></td><td><div <? print 'style="margin: 1px 0px 1px 0px; background-color: blue; height: 10px; width: '.round(300 * $waveVotes / $total).'px"'; ?>></div></td></tr>
        </table>
</div>
<?php
	page_finish();
?>