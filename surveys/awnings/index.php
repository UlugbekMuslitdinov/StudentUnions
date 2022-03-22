<?php

session_start();

// including this requires WebAuth login.
require_once('webauth/include.php');

// this include has encapsulates the connection  
// string, especially the userid and password.
include('mysql_link.inc');

require_once ('includes/mysqli.inc');

// select the surveys database
$db = new db_mysqli("surveys");

// get the netID from WebAuth
$myNetID = $_SESSION['webauth']['netID'];

// Determine if user has already voted.
// Since there is a unique index on netID, this will
// return either one row or zero rows.
$num_rows = mysqli_num_rows($db->query("SELECT * FROM awning_vote WHERE netID='".$myNetID."'"));

// if we got a row, that means they already voted.
if($num_rows == 1)
{
	// if they already voted, redirect to results page
	header('Location: complete.php');
	exit;
}

require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'Awning Survey';
page_start($page_options);

// the html for each choice is put into an array, so that we can randomly switch them; so that voters aren't influenced by the order.
$cellArray = array('<div class="bluebox"><a href="images/lightsail1.jpg" rel="lightbox[1]" title="Option A (Aerial)" ><div class="borderedsail"></div></a>
					<a href="images/lightsail2.jpg" rel="lightbox[1]" title="Option A (Ground)"></a>
					<a href="images/lightwave1.jpg" rel="lightbox[1]" title="Option B (Aerial)"></a>
					<a href="images/lightwave2.jpg" rel="lightbox[1]" title="Option B (Ground)"></a>
					<div class="radio"><input type="radio" name="vote" value="sail" /> I Want This</div></div>',
					
				   '<div class="bluebox"><a href="images/lightwave1.jpg" rel="lightbox[2]" title="Option B (Aerial)"><div class="borderedwave"></div></a>
					<a href="images/lightwave2.jpg" rel="lightbox[2]" title="Option B (Ground)"></a>
					<a href="images/lightsail1.jpg" rel="lightbox[2]" title="Option A (Aerial)"></a>
					<a href="images/lightsail2.jpg" rel="lightbox[2]" title="Option A (Ground)"></a>
					<div class="radio"><input type="radio" name="vote" value="wave" /> I Want This</div></div>');
// Shuffle the array so that the two options appear in a random order
shuffle($cellArray);
	
?>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<link rel="stylesheet" href="/commontools/jslib/lightbox2/css/lightbox.css" type="text/css"/>
<script type="text/javascript" src="/commontools/jslib/lightbox2/js/prototype.js"></script>
<script type="text/javascript" src="/commontools/jslib/lightbox2/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="/commontools/jslib/lightbox2/js/lightbox.js"></script>

<style>
	div.content
	{
		padding: 20px;
		width: 800px;
	}
	div.title
	{
		color: #f9b820;
		font-family: Helvetica, sans-serif;
		font-size: 25px;
		font-weight: bold;
		margin: 10px 0px 15px 0px;
	}
	div.bluebox
	{
		color: white;
		background-color: #27426F;
		-moz-border-radius: 15px;
		border-radius: 15px;
		text-align: center;
		margin: 20px 20px 10px 0px;
		height: 260px;
		width: 350px;
		float: left;
		padding: 5px 10px 10px 10px;
	}
	div.borderedsail
	{
		width:350px;
		height:228px;
		-moz-border-radius:10px;
		-webkit-border-radius:10px;
		background: url('images/sailsmall.jpg');
		cursor: pointer;
		margin: 3px 0px 0px 0px;
	}
	div.borderedwave
	{
		width:350px;
		height:228px;
		-moz-border-radius:10px;
		-webkit-border-radius:10px;
		background: url('images/wavesmall.jpg');
		cursor: pointer;
		margin: 3px 0px 0px 0px;
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
</style>

<div class="content">
	<div class="title">
    	How Do You Take Your Shade?
    </div>
	<div class="explanation">
    	Click on an option below to pick the shade awning structure you prefer for the Student Union's north side,
    	outside Boost and the CatCard office. You know, that place you would go sit for a little peace and quiet. If only there were shade!
    </div>
    <?
		if(isset($_SESSION['noselect']))
		{
			print '<div style="color:red; font-weight: bold; padding: 15px 5px 0px 5px;">Please select an option before submitting</div>';
			unset($_SESSION['noselect']);
		}
	?>
    <form method="post" action="complete.php" >
        
        <?php echo $cellArray[0] ?>
        <?php echo $cellArray[1] ?>
        <br style="clear: both"/>
        <br/>
        <span class="reason">What Influenced Your Decision?</span>
        <br/>
        <textarea name="reason" style="width: 500px; height: 150px"></textarea>
        <input type="hidden" name="netID" value="<?php echo $_SESSION['webauth']['netID']; ?>" />
        <br/><br/><br/>
        <input type="submit" name="submit" value="Submit">	
    </form>
    <br/><br/>
</div>
<?php
	page_finish();
?>