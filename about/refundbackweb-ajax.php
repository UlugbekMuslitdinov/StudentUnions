<?php
  require_once ('includes/mysqli.inc');
   $db = new db_mysqli('vendingrefunds');
	
			
	if(isset($_GET['name'])){		
		$query = 'select name from vendingrefunds where refunded=0 and name like "'.$_GET['name'].'%" order by name';
		$result = $db->query($query);
		while($name = $result->fetch_array()){
			$results[] = $name['name'];
		}
		
		if(is_array($results))
			print 'var results = ["'.implode('", "', $results).'"];';
		else 
			print 'var results = [];';
		exit();
	}
	else if(isset($_GET['type'])){
		$query = 'update vendingrefunds set type="'.$_GET['type'].'" where id='.$_GET['id'];
		$db->query($query);
	}
	else{
		$query = 'select * from vendingrefunds where name="'.$_GET['specific'].'"';
		//print $query;
		$result = $db->query($query);
		$row = $result->fetch_array();
		print	'<table style="border-spacing:20px;">';
	 
		print	"	<tr style=' text-align:center; text-decoration:underline; font-size:16;'>";
		print	'		<td id="name">Name</td>';
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
		
		
		
		print	"	<tr>";
		print	'		<td id="name">'.$row['name']."</td>";
		print	"		<td>".$row['class']."</td>";
		print	"		<td>".$row['email']."</td>";
		print	"		<td>".$row['address']."</td>";
		print	"		<td>".$row['phone']."</td>";
		print	"		<td>".$row['location']."</td>";
		print	"		<td>".$row['type']."</td>";
		print	"		<td>".$row['product']."</td>";
		print	"		<td>".$row['problem']."</td>";
		print	"		<td>".$row['amount']."</td>";
		
		
		print	"		<td>";
		if($row['refunded']=="-0"){
			print 	'<input type="box" id="refunded" onBlur="document.getElementById('."'"."resolved".$i."'".').href += this.value">';
		}
		else{
			print	$row['refunded'];
		}
		print 	" 		</td>";
		print	'		<td>';
		if($row['dateresolved']=="-"){
			print 	'<a href="refundbackweb.php?date='.date("m d Y").'&id='.$row['id'].'&amount=" id="resolved'.$i.'" ><input type="button" value="resolved"></a>';
		}
		else{
			print	$row['dateresolved'];
		}
		print 	"		</td>";
		print 	"<td>";
		if($row['reimbursed']=="-"){
			print 	'<a href="refundbackweb.php?dater='.date("m d Y").'&id='.$row['id'].'"><input type="button" value="reimbursed"></a>';
		}
		else{
			print 			$row['reimbursed'];
		}
		print	"</td>";
		print	"	</tr>";
	
		
		print	"</table>";


	}
	
?>