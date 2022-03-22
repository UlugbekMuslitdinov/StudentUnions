<?php
	session_start();
	
	require('sectioninfo.inc');
	$template = 'sidebar_only';
	require('global.inc');
	$title = 'Editing Unit Menu';
	pageStart($title);

// Database
include('../../commontools/mysql_link.inc');
mysql_select_db('menuboards', $DBlink);

//	$db_name = "menuboards";
//	$db_host = "trinity.sunion.arizona.edu";
//	$db_user = "web";
//	$db_pass = "viv3nij";
	
//	$link = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
//	mysql_select_db($db_name, $link) or die(mysql_error());
	
	$unit_id=$_GET[unitID];
?>

<style type="text/css">
	@import url("menuedit.css");
</style>

 <div class="content">
		<div class="pagetitle">
        	<?php
				// Get the name of the current unit based on the current ID
            	$current = mysql_query("select name from unit where id='".$unit_id."'");
				$current = mysql_fetch_assoc($current);
			?>
        	<h1 style=" font-size:16px;">Editing <?php echo $current['name']; ?>'s Menu</h1>
        </div>
	<form action="na_submit.php" enctype="multipart/form-data" method="post">
    	<div class="subcontent">
	        <h2 style="font-size:12px;">Menus</h2>
            <div id="contentlist">
            	<?php
         		   	$current = mysql_query("select name from panel where unitID='".$unit_id."'");
					while($row = mysql_fetch_assoc($current)) {
						if($row['locked']==1) {
							echo("".$row['name']." (contact the Marketing Department to change this menu)<br />");
						}
						else {
							$panelID = mysql_query("select id from panel where name='".$row['name']."'");
							$panelID = mysql_fetch_assoc($panelID);
							$panelID = $panelID['id'];
							echo("<a href=\"editpanel.php?unitID=".$unit_id."&panelID=".$panelID."\">".$row['name']."</a><br />");
						}
					}
				?>
            </div>
        </div>
    </form>
</div>
<?php pageFinish(); ?>