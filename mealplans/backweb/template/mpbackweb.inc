<?php 
//log in through webauth
require_once('webauth/include.php');

//include functions for database connectivity
require_once ('includes/mysqli.inc');

//connect to the database
$db = new db_mysqli('mealplans');

//include code to control access to backweb
require_once('../includes/access.inc');


//function to start a meal plans backweb page
function mpbackweb_start($page){
?>
<html>
	<head>
		<script type="text/javascript" src="/commontools/jslib/popupcal2.js"></script>
		<script type="text/javascript" src="/commontools/jslib/jquery.js"></script>
		<link rel="stylesheet" href="/mealplans/backweb/template/mpbackweb.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/mealplans/backweb/template/mpbackweb_print.css" type="text/css" media="print" />
		<script type="text/javascript" src="/mealplans/backweb/template/mpbackweb.js"></script>
		
	</head>
	<body>
		<h1>UA Meal Plans Backweb</h1>
		<ul class="horz-nav">
			<li style="width:207px;" class="<?=$page=='home'?'active':''?>"><a class="nav-button" href="index.php">New &amp; Pending Deposits</a></li>
			<li style="width:147px;" class="<?=$page=='search'?'active':''?>"><a class="nav-button" href="search.php">Search Deposits</a></li>
			<li style="width:137px;" class="<?=$page=='details'?'active':''?>"><a class="nav-button" href="details.php">Deposit Details</a></li>
			<li style="width:125px;" class="<?=$page=='config'?'active':''?>"><a class="nav-button" href="config.php">Configuration</a></li>
			<li style="width:117px;" class="<?=$page=='admin'?'active':''?>"><a class="nav-button" href="admin.php">Admin Tools</a></li>
		</ul>
		<div id="content">
	

<?php 
	
}

//function to end a meal plans backweb page
function mpbackweb_finish(){
?>
		</div>
	</body>
</html>
<?php 
}
?>