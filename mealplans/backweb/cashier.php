<?php
//log in through webauth
require_once('webauth/include.php');

//include functions for database connectivity
require_once ('includes/mysqli.inc');

//include functions for accessing eds
require_once('eds/include.inc');

//connect to the database
$db = new db_mysqli('mealplans');

$query = 'select * from cashier_access where value="'.$_SERVER["REMOTE_ADDR"].'"';
$result = $db->query($query);
if(mysqli_num_rows($result)){
	$query = 'select * from cashier_access where value="'.$_SESSION['webauth']['netID'].'"';
	$result = $db->query($query);
	if(mysqli_num_rows($result)){
		$eds = new EDS($_SESSION['webauth']['netID']);
	}
	else{
		print 'access denied';
		exit();
	}
}
else{
	print 'access denied';
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<script type="text/javascript" src="/commontools/jslib/popupcal2.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
var popup_cal = new popupcal({'callback':function(year, month, day){document.info[popup_cal.id].value = year+'-'+month+'-'+day; getTransactions()}, "name":"popup_cal"});
var active = 'trans';
	function getTransactions(){
		$.post("cashier.ajax.php", $("#info").serialize(), getTransactionsReturn, 'json');
		return false;
	}
	function getBucketName(id){
		switch(id){
			case "1":
				return 'commitment';
			case "2":
				return 'studnt non-tax';
			case "3":
				return 'employee tax';
			case "43":
				return 'faculty/staff';
			case "45":
				return 'res life';
			case "46":
				return 'copper';
			case "47":
				//Swap Plus 6 and 7 plans due to BB ID reversal for 2013/14 year. Will fix in next year's updates so BB IDs agree with IDs in our MySQL mealplans DB.
				//return 'plus 6';
				return 'gold';
			case "48":
				//Swap Plus 6 and 7 plans due to BB ID reversal for 2013/14 year. Will fix in next year's updates so BB IDs agree with IDs in our MySQL mealplans DB.
				//return 'plus 7';
				return 'silver';
			case "49":
				return 'enrichment taxable';
			case "50":
				return 'enrichment non-tax';

		}
	}
	var data1;
	function getTransactionsReturn(data){

		data1=data;
		if(data.error==1){
			document.getElementById('results').innerHTML = 'No results match the search criteria';
			return false;
		}
		if(data.numResults == 1){
			//console.log(data);

			var html ='';
			var links = '';
			var found=0;
			if(data.trans){
				active = 'trans';
				links += '<div id="trans_link" class="tab active edge" style="float:left; margin-right:10px;"  onclick="show_plan(\'trans\')"><div class="right"></div><div class="left"></div>Mealplan</div>';
				html += '<div id="trans" class="active2" style=" "><table cellpadding="2"><tr><th>Date</th><th>Location</th><th>Amount</th><th>Ending Balance</th><th>bucket</th></th>';
				for(x in data.trans){
					html += '<tr><td>'+data.trans[x].when+'</td><td>'+data.trans[x].where+'</td><td align="right">'+data.trans[x].debit+data.trans[x].amount.toFixed(2)+'</td><td align="right">'+data.trans[x].balance.toFixed(2)+'</td><td align="right">'+getBucketName(data.trans[x].account_type_id)+'</td></tr>';
				}
				html += '</table></div>';
				found=1;
			}
			if(data.trans_5050){
				if(!found){

					active='trans_5050';
					var classs=' class="tab active edge"';
					var classss=' class="active2"';
					found=1;
				}
				else
					var classs=' class="tab"';
				links += '<div id="trans_5050_link"'+classs+' style="float:left; margin-right:10px;"  onclick="show_plan(\'trans_5050\')"><div class="right"></div><div class="left"></div>50/50</div>';
				html += '<div id="trans_5050"'+classss+' style="  "><table cellpadding="2"><tr><th>Date</th><th>Location</th><th>Amount</th><th>Ending Balance</th></tr>';
				for(x in data.trans_5050){
					html += '<tr><td>'+data.trans_5050[x].when+'</td><td>'+data.trans_5050[x].where+'</td><td align="right">'+data.trans_5050[x].debit+data.trans_5050[x].amount.toFixed(2)+'</td><td align="right">'+data.trans_5050[x].balance.toFixed(2)+'</td></tr>';
				}
				html += '</table></div>';
			}
			if(data.trans_reslife){
				if(!found){
					active='trans_reslife';
					var classs=' class="tab active edge"';
					var classss=' class="active2"';
					found=1;
				}
				else
					var classs=' class="tab"';
				links += '<div id="trans_reslife_link"'+classs+' style="float:left; margin-right:10px;"  onclick="show_plan(\'trans_reslife\')"><div class="right"></div><div class="left"></div>ResLife</div>';
				html += '<div id="trans_reslife"'+classss+' style="  "><table cellpadding="2"><th><th>Date</th><th>Location</th><th>Amount</th><td>Ending Balance</th></tr>';
				for(x in data.trans){
					html += '<tr><td>'+data.trans_reslife[x].when+'</td><td>'+data.trans_reslife[x].where+'</td><td align="right">'+data.trans_reslife[x].debit+data.trans_reslife[x].amount.toFixed(2)+'</td><td align="right">'+data.trans_reslife[x].balance.toFixed(2)+'</td></tr>';
				}
				html += '</table></div>';
			}
			if(data.trans_flex){
				if(!found){
					active='trans_flex';
					var classs=' class="tab active edge"';
					var classss=' class="active2"';
					found=1;
				}
				else
					var classs=' class="tab tab"';
				links += '<div id="trans_flex_link"'+classs+' style="float:left; margin-right:10px;"  onclick="show_plan(\'trans_flex\')"><div class="right"></div><div class="left"></div>CatCash</div>';
				html += '<div id="trans_flex"'+classss+' style="  "><table cellpadding="2"><tr><th>Date</th><th>Location</th><th>Amount</th><th>Ending Balance</th></tr>';
				for(x in data.trans_flex){
					html += '<tr><td>'+data.trans_flex[x].when+'</td><td>'+data.trans_flex[x].where+'</td><td align="right">'+data.trans_flex[x].debit+data.trans_flex[x].amount.toFixed(2)+'</td><td align="right">'+data.trans_flex[x].balance.toFixed(2)+'</td></tr>';
				}
				html += '</table></div>';
			}
			if(!found){
				document.getElementById('results').innerHTML = 'No transactions found';
			}
			else{
				document.getElementById('results').innerHTML = '<br /><image src="template/images/print.png" onclick="window.print()" style="float:right; position:relative; top:37px; z-index:100; cursor:pointer;"/><b>'+data[0].FIRSTNAME+' '+data[0].LASTNAME+' - '+data[0].CUSTNUM.substr(14, 8)+'</b><br /><b>Date: </b>'+data.end+' <img src="template/images/cal.png" onclick="popup_cal.show_cal(event, \'end\')"  /> &nbsp;-&nbsp; '+data.start+' <img src="template/images/cal.png" onclick="popup_cal.show_cal(event, \'start\')"/>&nbsp;&nbsp;<span id="showall">(<a href="javascript:show_all()">show all</a>)</span><br />';
				document.getElementById('results').innerHTML += '<div id="tabs" style="position:relative;	 top:4px; height:30px; ">'+links + '</div><div id="tables"><img id="top" src="template/images/top-tab-box.png" style="position:relative; z-index:2;" /><div id="tabless" style="background-image:url(\'template/images/bg.png\'); background-repeat:no-repeat; background-size:100%;">'+html+'</div></div>';
			}
		}
		else{

			var html = '';
			for(x=0; x<data.numResults; x++){
				html += '<div style="cursor:pointer;" onmouseover="this.style.backgroundColor=\'#C8EEFE\';" onmouseout="this.style.backgroundColor=\'#ffffff\';" onclick="document.info.emplid.value=\''+data[x].CUSTNUM.substr(14,8)+'\'; getTransactions()">'+data[x].CUSTNUM.substr(14,8)+' - '+data[x].FIRSTNAME+' '+data[x].LASTNAME+'</div>';
			}
			document.getElementById('results').innerHTML = html;
		}
	}
	function show_all(){
		document.forms[0].start.value = '';
		document.forms[0].end.value = '2007-01-01';
		getTransactions();
	}
	function show_plan(plan){
		document.getElementById(active+'_link').className = 'tab';
		document.getElementById(active).className = '';

		document.getElementById(plan+'_link').className = 'tab active';
		document.getElementById(plan).className = 'active2';

		active = plan;
	}
</script>
<style>
	#results tr:nth-child(odd) {background: #e7e7e8}
	#caldiv{
		z-index:1000;
	}
	#results .active{
		color:#000000;

	}
	#tables > div > .active2{
		display:block;
	}
	#tables{
		clear:both;
	}
	#tables>div>div{
		display:none;
	}
	#results div{
		color:#999999;
		cursor:pointer;
	}
	#container{
		width:826px;
		margin:0px auto;
	}
	body{
		font-family:Arial, Helvetica, sans-serif;
		font-size:14px;
	}
	input[type="text"]{
		width:95px;
	}
	form{
		padding:0px;
		margin:0px;
	}
	#info{
		line-height:14px;
	}
	.tab {
		background-image: url('template/images/center-inactive-tab.png');
		height: 30px;
		margin: 0px 13px;
		position: relative;
		z-index: 1;
		float: left;
		line-height: 35px;
		color: #997642;
		font-size: 16px;
		text-align: center;
		cursor: pointer;
	}
	.tab.active {
	background-image: url('template/images/center-active-tab.png');
	z-index: 3;
	color: black;
}
.tab .right {
float: right;
margin-right: -13px;
height: 30px;
width: 13px;
background-image: url('template/images/right-inactive-tab.png');
}
.tab .left {
float: left;
margin-left: -13px;
height: 30px;
width: 13px;
background-image: url('template/images/left-inactive-tab.png');
}
.tab.active .right {
background-image: url('template/images/right-active-tab.png');
}
.tab.active .left {
background-image: url('template/images/left-active-tab.png');
}
.tab:first-child .left {
height: 51px;
}
#tabless table{
	margin:0px 15px;
	width:794px;
}
th{
	background-color:#545454;
	color:#ffffff;
	font-weight:bold;
	font-size:13px;
}
td{
	font-size:12px;
	padding:4px 5px;
}
</style>
<style media="print">
	#info, input, #cashier{
		display:none;
	}
	#results img, #showall{
		display:none;
	}
	#results #top{
		display:block;
	}
	.tab{
		display:none;
	}
	.tab.active{
		display:block;
	}
</style>
</head>
<body>
<div id="container">
	<a href="http://arizona.edu"><img src="/commontools/UAheaders/UAwhiteblue.gif" style="border:none;" /></a>
	<img src="template/images/header.png" style="margin-bottom:20px;"/>
	<div style="float:right;"><?=date("m/d/Y")?></div>
	<div style="float:left;" id="cashier">Cashier: <?=$eds->getValueForKey('cn')?><span id="logout">(<a href="/commontools/webauth/logout.php?logout_text=Return to mealplans Cashier page">logout</a>)</span></div>

<form id="info" name="info" onsubmit="return getTransactions()" style="clear:both; height:35px;">
	CatCard #: <input type="text" name="catcard" value="" style="margin-right:15px;"/>
	EmplID: <input type="text" name="emplid" value="" style="margin-right:15px;"/>
	First: <input type="text" name="first" value="" style="margin-right:15px;"/>
	Last: <input type="text" name="last" value="" style="margin-right:15px;"/>
	<input type="hidden" name="start" value="" />
	<input type="hidden" name="end" value="" />
	<input type="image" src="template/images/go.png" name="go" value="GO" style="position:relative; top:6px;"/>
	<img src="template/images/reset.png"style="position:relative; top:6px;" onclick="document.info.reset(); document.info.start.value=''; document.info.end.value=''; document.getElementById('results').innerHTML=''" />
</form>
<div id="results" style="position:relative;">

</div>
</div>
</body>
</html>
