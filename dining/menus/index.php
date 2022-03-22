<?php
include('../../commontools/webauth/include.php');

$_SESSION['netID'] = $_SESSION['webauth']['netID'];
	
	
	if($_SESSION['netID'] == 'nbischof' || $_SESSION['netID'] == 'bphinney' || $_SESSION['netID'] == 'sanorris' || $_SESSION['netID'] == 'styx' || $_SESSION['netID'] == 'kmbeyer'){


	require('sectioninfo.inc');
	$template = 'sidebar_only';
	require('global.inc');
	$title = 'Editing Unit Menu';
	pageStart($title);

// Database
include('../../commontools/mysql_link.inc');
mysql_select_db('menuboards', $DBlink);

	
	$unit_id=$_GET[unitID];
	
	
?>

<style type="text/css">
	@import url("menuedit.css");
</style>

 <div class="content">
		<div class="pagetitle">
        	<h1 style=" font-size:16px;">Menu Editor Unit Selection</h1>
        </div>
	<form action="na_submit.php" enctype="multipart/form-data" method="post">
    	<div class="subcontent">
	        <h2 style="font-size:12px;">Units</h2>
            <div id="contentlist">
            	<?php
         		   	$current = mysql_query("select * from unit");
					while($row = mysql_fetch_assoc($current)) {
						echo("<a href=\"editunitmenu.php?unitID=".$row['id']."\">".$row['name']."</a><br />");
					}
				?>

<?php
	} else {
		echo 'Your netID is not recognized as a units editor.';
	}
?>

            </div>
        </div>
    </form>
</div>
<?php pageFinish(); ?>