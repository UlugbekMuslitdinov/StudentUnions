<?php
require_once('webauth/include.php');
$_SESSION['netID'] = $_SESSION['webauth']['netID'];

$allowed_users = array('sanorris',
				'jmasson',
				'amandab',
				'alexis45',
				'brocha31',
				'preston5',
				'krobison',
				'agarcia75',
				'janavoci',
			    'yontaek',
			    'anthonyclarke',
				'chelseao',
				'eotkank87');
if(!in_array($_SESSION['netID'], $allowed_users))
{
	echo "Access Denied";
}
else
{?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Vending machine refund backweb</title>
<style type="text/css">
.notused{
/* display:none; */
}
.highlight{
	background-color:#003366;
	color:#ffffff;
}
div{
	background-color:#ffffff;
	color:#000000;
}
</style>
<script type="text/javascript">
function toggle(id){
var element = document.getElementById(id);
//alert(element.style.display);
if(element.style.display == "none"){
element.style.display = "block";
}
else{
element.style.display = "none";
}
}

function getnames(name){
	var xmlHttp;
		
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  
  xmlHttp.onreadystatechange=function()
{
if(xmlHttp.readyState==4)
  {
  //eval(handler);
  eval(xmlHttp.responseText);
  var container = document.getElementById('names_div');
  document.getElementById('names_div').style.visibility = 'visible';
  container.innerHTML ='';
  for(x in results){
  	var div = document.createElement('div');
	div.innerHTML = results[x];
	div.setAttribute('onclick', "choose('"+results[x]+"')");
	div.setAttribute('onmouseover', "this.className='highlight'");
	div.setAttribute('onmouseout', "this.className=''");
	div.style.cursor = 'pointer';
	container.appendChild(div);
	
  }
  }
}

xmlHttp.open("GET", 'refundbackweb-ajax.php?name='+name.value, true);
xmlHttp.send();
}

function choose(name){
	document.getElementById('names_div').style.visibility = 'hidden';
	var xmlHttp;
		
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  
  xmlHttp.onreadystatechange=function()
{
if(xmlHttp.readyState==4)
  {
  //eval(handler);
  //eval();
 document.getElementById('results').innerHTML = xmlHttp.responseText;
	
  
  }
}

xmlHttp.open("GET", 'refundbackweb-ajax.php?specific='+name, true);
xmlHttp.send();
}

function resolved(row, id){
	var amount = document.getElementById('refunded'+row).value;
	if(amount != '')
		window.location = 'refundbackweb.php?date=<?php print date("m d Y");?>&id='+id+'&amount='+amount;
	else
		alert('Please enter an amount in the refunded box next to this button');
}

function change_type(type, id){
	var xmlHttp;
		
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  
  xmlHttp.onreadystatechange=function()
{
if(xmlHttp.readyState==4)
  {
  //eval(handler);
  //eval();
 // alert(xmlHttp.responseText);
 //document.getElementById('results').innerHTML = xmlHttp.responseText;
	
  
  }
}

xmlHttp.open("GET", 'refundbackweb-ajax.php?type='+type+'&id='+id, true);
xmlHttp.send();	
}
</script>
</head>

<body>
<?php  
      require_once ('includes/mysqli.inc');
	  $db = new db_mysqli('vendingrefunds');
      
				


		if(isset($_GET['date'])){
		$query = "UPDATE vendingrefunds SET refunded='".$_GET['amount']."', dateresolved='".$_GET['date']."' WHERE id='".$_GET['id']."' ";
		
		$resul = $db->query($query);

		if(!$result) {
		//print "<p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later1. </p>";
					
					}
		else{
			print "<p>date resolved has been entered</p>";
			}
			
			}
			
			if(isset($_GET['dater'])){
		$query = "UPDATE vendingrefunds SET reimbursed='".$_GET['dater']."' WHERE id='".$_GET['id']."' ";
		
		$resul = $db->query($query);

		if(!$result) {
		//print "<p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later1. </p>";
					
					}
		else{
			print "<p>date resolved has been entered</p>";
			}
			
			}
			
			
			
			$query = "SELECT refunded, type FROM vendingrefunds WHERE reimbursed='-'";
		
				
		
		$result = $db->query($query);
		
		$soda=0;
		$snack=0;
		
		while($row = $result->fetch_array()){
		if($row['type'] == "soda"){
			$soda += $row['refunded'];
		}
			
		else{
			$snack += $row['refunded'];
		}
		}
		print 'Snack: '.$snack.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name:<br><input style="width:125px; height:14px; position:absolute; top:10px; left:200px;" type="text" name="name" id="name" onBlur="document.getElementById(\'names_div\').style.visibility = \'hidden\'" onKeyUp="getnames(this)"><div style="position:absolute; top:24px; left:200px; width:123px; border:1px solid; visibility:hidden;" id="names_div"></div>';
		
		print "Soda: ".$soda."<br>";
		?>
		<select style="position:absolute; top:10px; left:500px;" onChange="window.location ='refundbackweb.php'+this.value">
			<option value="">any</option>
			<option value="?type=employee" <?php if($_GET['type'] == 'employee') print 'selected'; ?>>Employee</option>
			<option value="?type=visitor" <?php if($_GET['type'] == 'visitor') print 'selected'; ?>>Visitor</option>
			<option value="?type=student" <?php if($_GET['type'] == 'student') print 'selected'; ?>>Student</option>
		</select>
		<?php	
		/*
		print '<input type="checkbox" onChange="toggle('."'".name."'".');" checked>Name&nbsp;&nbsp;';
		print '<input type="checkbox" onChange="toggle('."'".Class1."'".');" checked>Class&nbsp;&nbsp;';
		print '<input type="checkbox" onChange="toggle('."'".email."'".');">Email&nbsp;&nbsp;';
		print '<input type="checkbox" onChange="toggle('."'".address."'".');" checked>Address&nbsp;&nbsp;';
		print '<input type="checkbox" onChange="toggle('."'".phone."'".');">Phone&nbsp;&nbsp;';
		print '<input type="checkbox" onChange="toggle('."'".location."'".');">Location&nbsp;&nbsp;';
		print '<input type="checkbox" onChange="toggle('."'".type."'".');" checked>Type&nbsp;&nbsp;';
		print '<input type="checkbox" onClick="toggle('."'".product."'".');">Product&nbsp;&nbsp;';
		print '<input type="checkbox" onClick="toggle('."'".reason."'".');">Reason&nbsp;&nbsp;';
		print '<input type="checkbox" onClick="toggle('."'".amount."'".');" checked>Amount&nbsp;&nbsp;';
		print '<input type="checkbox" onClick="toggle('."'".refunded."'".');" checked>Refunded&nbsp;&nbsp;';
		print '<input type="checkbox" onClick="toggle('."'".date_resolved."'".');" checked>Date Resolved&nbsp;&nbsp;';
		print '<input type="checkbox" onClick="toggle('."'".date_reimbursed."'".');" checked>Date Reimbursed&nbsp;&nbsp;';
		*/
		
		

	if(!isset($_GET['type']))
		$query = "SELECT * FROM vendingrefunds ORDER BY dateresolved, name";
	else
		$query = 'select * from vendingrefunds where class="'.$_GET['type'].'" ORDER BY dateresolved, name';
				
		
		$result = $db->query($query);
		
					
		if(!$result) {
		//print "<p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later2. </p>";
					
					}
		//print $result
		print '<div id="results">';
	print	'<table style="border-spacing:20px;">';
	 
	print	"	<tr style=' text-align:center; text-decoration:underline; font-size:16;'>";
	print	'		<td id="name">Name</td>';
	print	'		<td id="date_submitted">Date</td>';
	print	'		<td id="Class1">Class</td>';
	print	'		<td id="email" class="notused">Email</td>';
	print	'		<td id="address">address</td>';
	print	'		<td id="phone" class="notused">phone</td>';
	print	'		<td id="location" class="notused">location</td>';
	print   '		<td id="type">type</td>';
	print	'		<td id="product" class="notused">product</td>';
	print	'		<td id="reason" class="notused">reason</td>';
	print	'		<td id="amount">amount</td>';	
	print 	'		<td id="refunded">refunded</td>';
	print	'		<td id="date_resolved">date resolved</td>';
	print	'		<td id="date_reimbursed">date reimbursed</td>';
	print	"	</tr>";
	
	$i=0;			
	while($row = $result->fetch_array()){
	
	print	"	<tr>";
	print	'		<td id="name">'.$row['name']."</td>";
		print	"		<td>".$row['date']."</td>";
	print	"		<td>".$row['class']."</td>";
	print	"		<td>".$row['email']."</td>";
	print	"		<td>".$row['address']."</td>";
	print	"		<td>".$row['phone']."</td>";
	print	"		<td>".$row['location']."</td>";?>
					<td><select onChange="change_type(this.value, <? print $row['id'] ?>)"><option value='snack' <? if($row['type']=='snack') print 'selected' ?>>snack</option><option value='soda' <? if($row['type']=='soda') print 'selected' ?>>soda</option></select></td>
	
	<?php
	print	"		<td>".$row['product']."</td>";
	print	"		<td>".$row['problem']."</td>";
	print	"		<td>".$row['amount']."</td>";
	
	
	print	"		<td>";
	if($row['refunded']=="-0"){
	print 	'<input type="box" id="refunded'.$i.'">';
	}
	else{
	print	$row['refunded'];
	}
	print 	" 		</td>";
	print	'		<td>';
	if($row['dateresolved']=="-"){
	print 	'<input type="button" value="resolved" onClick="resolved('.$i.','.$row['id'].' )">';
	}
	else{
	print	$row['dateresolved'];
	}
	print 	"		</td>";
	print 	"<td>";
	if($row['reimbursed']=="-" && $row['dateresolved']!="-"){
	print 	'<a href="refundbackweb.php?dater='.date("m d Y").'&id='.$row['id'].'"><input type="button" value="reimbursed"></a>';
	}
	else{
	print 			$row['reimbursed'];
	}
	print	"</td>";
	print	"	</tr>";
$i++;
  	}
	
	print	"</table>";
	print '</div>';
}