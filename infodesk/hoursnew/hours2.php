<?php
require('hours_db.inc');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
body {
font-size:26px;
}



</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body style="margin-left:30px; width:2680px; margin-top:55px; margin-bottom:auto;" >
<div style="background-color:#000000; color:#FFFFFF; font-size:48px">ARIZONA STUDENT UNIONS HOURS OF OPERATION<br /></div>
<div style="background-color:#999999;"><span style="padding-left:15px;">
<?php 
	if(isset($_POST['title'])){
		print $_POST['title'];	
	}
	else
		print 'Summer 2009';
	?>
</span></div><br />
<div style="width:2600px;" id="main">
<div style="float:left; width:auto" id="sub1" >
<table cellpadding="3px" cellspacing="0px" >
	<tr align="center" style="background-color:#999999;">
		<td rowspan="2" style="color:#FFFFFF; background-color:#000000; border-top: 2px solid #000000; width:385px;">STUDENT UNION<br />&nbsp;&nbsp;Building Hours</td>
        <td style="border-top: 2px solid #000000; width:115px;">MON</td>
        <td style="border-top: 2px solid #000000; width:115px;">TUE</td>
        <td style="border-top: 2px solid #000000; width:115px;">WED</td>
        <td style="border-top: 2px solid #000000; width:115px;">THU</td>
        <td style="border-top: 2px solid #000000; width:115px;">FRI</td>
        <td style="border-top: 2px solid #000000; width:115px;">SAT</td>
        <td style="border-top: 2px solid #000000;  width:115px; border-right:1px solid #000000;">SUN</td>
	</tr>
    <!--
    <tr align="center">
    	<td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px; ">6:30a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px;">6:30a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px;">6:30a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px;">6:30a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px;">6:30a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px;">8a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px;">8a-10p</td>
    </tr>
    -->
    
<?php
if(isset($_GET['week'])){
	$time = (time()+604800);
}
else{
	$time = time();
}
$date = date("Y-m-d", $time);

$dow = (date("N")-1);

$week_start = date("Y-m-d", ($time-$dow*86400));
$week_end = date("Y-m-d", ($time+(6-$dow)*86400));
		
		print '<tr align="center">';
		$query1 = 'select * from hours join periods on hours.type=periods.type where start_date <= "'.$date.'" and end_date>"'.$date.'" and location_id=58';
		$result1 = $db->query($query1);
		$location1 = $result1->fetch_array(MYSQLI_NUM);
		
		$subquery = 'select * from exceptions where date_of>="'.$week_start.'" and date_of<="'.$week_end.'" and location_id=58';
		//print $subquery;
		$subresult = $db->query($subquery);
		//print mysql_error($DBlink);
		//print $subquery;
		while($exception = $subresult->fetch_array()){
			
			$temp = (date("N", strtotime($exception['date_of']))-1);
			//print $temp;
			$location1[$temp*2+1]=$exception['open'];
			$location1[$temp*2+2]=$exception['close'];			
		}
		for($x=1; $x<15; $x++){
			if($location1[$x] == $location1[$x+1] && $location1[$x]=='00:00:00'){
				print '<td style="border-right:1px solid #000000; font-size:19px;">closed</td>';
				$x++;
			}
			else{
				$tms=strtotime($location1[$x++]);
				$tms1 = date('g', $tms);
				if(date('i', $tms)!="00"){
				$tms1 .= date(':i', $tms); 
				}
				if(date('a', $tms)=="am"){
				$tms1 .= "a";
				}else{
				$tms1.= "p";
				}
				
				
				$tme=strtotime($location1[$x]);
				$tme1 = date('g', $tme);
				if(date('i', $tme)!="00"){
				$tme1 .= date(':i', $tme); 
				}
				if(date('a', $tme)=="am"){
				$tme1 .= "a";
				}else{
				$tme1.= "p";
				}
				print '<td style="border-right:1px solid #000000; font-size:19px;">'.$tms1.'-'.$tme1.'</td>';
			}
		}
		print '</tr>';
	
print '<tr>'.
    	'<td colspan="8" bgcolor="#999999" style="border-right:1px solid #000000;">SERVICES</td>'.
    '</tr>';

$query = 'select * from location where group_id=1 and subgroup="Services" order by location_name';

$result= $db->query($query);

$i=0;

while($location = mysqli_fetch_assoc($result)){

	if(!($location['location_id']>=15 && $location['location_id']<=19)){
	
		if($i&1){
			//do this on odds  - every other time
			print '<tr bgcolor="#ffffff" align="center"><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].' </td>';
		}
		else{
			//do this on evens  - every other time
			print '<tr bgcolor="#dddddd" align="center"><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].'</td>';
		}
		$i++;
		$query1 = 'select * from hours join periods on hours.type=periods.type where start_date <= "'.$date.'" and end_date>"'.$date.'" and location_id='.$location['location_id'];
		$result1 = $db->query($query1);
		$location1 = $result1->fetch_array(MYSQLI_NUM);
		
		$subquery = 'select * from exceptions where date_of>="'.$week_start.'" and date_of<="'.$week_end.'" and location_id='.$location['location_id'];
		//print $subquery;
		$subresult = $db->query($subquery);
		while($exception = $subresult->fetch_array()){
			$temp = (date("N", strtotime($exception['date_of']))-1);
			$location1[$temp*2+1]=$exception['open'];
			$location1[$temp*2+2]=$exception['close'];			
		}
		for($x=1; $x<15; $x++){
			if($location1[$x] == $location1[$x+1] && $location1[$x]=='00:00:00'){
				print '<td style="border-right:1px solid #000000; font-size:19px;">closed</td>';
				$x++;
			}
			else{
				$tms=strtotime($location1[$x++]);
				$tms1 = date('g', $tms);
				if(date('i', $tms)!="00"){
				$tms1 .= date(':i', $tms); 
				}
				if(date('a', $tms)=="am"){
				$tms1 .= "a";
				}else{
				$tms1.= "p";
				}
				
				
				$tme=strtotime($location1[$x]);
				$tme1 = date('g', $tme);
				if(date('i', $tme)!="00"){
				$tme1 .= date(':i', $tme); 
				}
				if(date('a', $tme)=="am"){
				$tme1 .= "a";
				}else{
				$tme1.= "p";
				}
				print '<td style="border-right:1px solid #000000; font-size:19px;">'.$tms1.'-'.$tme1.'</td>';
			}
		}
		print '</tr>';
	}
}


	
	
	
	$query = 'select * from location where group_id=1 and subgroup="Services" order by location_name';

$result= $db->query($query);

$i=0;

while($location = mysqli_fetch_assoc($result)){

	if(($location['location_id']>15 && $location['location_id']<=19)){
	
		if($i&1){
		print '<tr bgcolor="#ffffff" align="center" ><td style="border-right:1px solid #000000;" align="left"><span><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].'</span> </td>';
		}
		else{
		print '<tr bgcolor="#dddddd" align="center" ><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].'</span> </td>';
		}
		$i++;
		if($location['location_name']=="Restaurant"){
		$location['location_id']="23";
		}
		$query1 = 'select * from hours join periods on hours.type=periods.type where start_date <= "'.$date.'" and end_date>"'.$date.'" and location_id='.$location['location_id'];
		$result1 = $db->query($query1);
		$location1 = $result1->fetch_array(MYSQLI_NUM);
		
		$subquery = 'select * from exceptions where date_of>="'.$week_start.'" and date_of<="'.$week_end.'" and location_id='.$location['location_id'];
		//print $subquery;
		$subresult = $db->query($subquery);
		while($exception = $subresult->fetch_array()){
			$temp = (date("N", strtotime($exception['date_of']))-1);
			$location1[$temp*2+1]=$exception['open'];
			$location1[$temp*2+2]=$exception['close'];			
		}
		for($x=1; $x<15; $x++){
			if($location1[$x] == $location1[$x+1] && $location1[$x]=='00:00:00'){
				print '<td style="border-right:1px solid #000000; font-size:19px;">closed</td>';
				$x++;
			}
			else{
				$tms=strtotime($location1[$x++]);
				$tms1 = date('g', $tms);
				if(date('i', $tms)!="00"){
				$tms1 .= date(':i', $tms); 
				}
				if(date('a', $tms)=="am"){
				$tms1 .= "a";
				}else{
				$tms1.= "p";
				}
				
				
				$tme=strtotime($location1[$x]);
				$tme1 = date('g', $tme);
				if(date('i', $tme)!="00"){
				$tme1 .= date(':i', $tme); 
				}
				if(date('a', $tme)=="am"){
				$tme1 .= "a";
				}else{
				$tme1.= "p";
				}
				print '<td style="border-right:1px solid #000000; font-size:19px;">'.$tms1.'-'.$tme1.'</td>';
			}
		}
		print '</tr>';
	
	}
}
?>	
<tr>
	<td colspan="8" bgcolor="#999999" style="border-right:1px solid #000000;">DINING</td>
</tr>
<tr>
<?php
$query = 'select * from location where group_id=1 and subgroup="Dining" order by location_name';

$result= $db->query($query);

while($location = mysqli_fetch_assoc($result)){

if($i&1){
print '<tr bgcolor="#ffffff" align="center"><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].' </td>';
}
else{
print '<tr bgcolor="#dddddd" align="center"><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].' </td>';
}
$i++;

//print '<tr><td style="border-right:1px solid #000000;">'.$location['location_name'].' '.$location['phone'].'</td>';

$query1 = 'select * from hours join periods on hours.type=periods.type where start_date <= "'.$date.'" and end_date>"'.$date.'" and location_id='.$location['location_id'];
		$result1 = $db->query($query1);
		$location1 = $result1->fetch_array(MYSQLI_NUM);
		
		$subquery = 'select * from exceptions where date_of>="'.$week_start.'" and date_of<="'.$week_end.'" and location_id='.$location['location_id'];
		//print $subquery;
		$subresult = $db->query($subquery);
		while($exception = $subresult->fetch_array()){
			$temp = (date("N", strtotime($exception['date_of']))-1);
			$location1[$temp*2+1]=$exception['open'];
			$location1[$temp*2+2]=$exception['close'];			
		}
		for($x=1; $x<15; $x++){
			if($location1[$x] == $location1[$x+1] && $location1[$x]=='00:00:00'){
				print '<td style="border-right:1px solid #000000; font-size:19px;">closed</td>';
				$x++;
			}
			else{
				$tms=strtotime($location1[$x++]);
				$tms1 = date('g', $tms);
				if(date('i', $tms)!="00"){
				$tms1 .= date(':i', $tms); 
				}
				if(date('a', $tms)=="am"){
				$tms1 .= "a";
				}else{
				$tms1.= "p";
				}
				
				
				$tme=strtotime($location1[$x]);
				$tme1 = date('g', $tme);
				if(date('i', $tme)!="00"){
				$tme1 .= date(':i', $tme); 
				}
				if(date('a', $tme)=="am"){
				$tme1 .= "a";
				}else{
				$tme1.= "p";
				}
				print '<td style="border-right:1px solid #000000; font-size:19px;">'.$tms1.'-'.$tme1.'</td>';
			}
		}
		print '</tr>';
	
}

?>
<tr bgcolor="#999999"><td colspan="8" style="border-bottom:2px solid #000000; border-right:1px solid #000000;">&nbsp;</td><tr>	
</table>

</div>




























<div style="float:left; padding-left:67px;">
<table cellpadding="3px" cellspacing="0px" >
	<tr align="center" style="background-color:#999999;">
		<td rowspan="2" style="color:#FFFFFF; background-color:#000000; border-top: 2px solid #000000; width:385px;">PARK STUDENT UNION<br />&nbsp;&nbsp;Building Hours</td>
        <td style="border-top: 2px solid #000000; width:115px;">MON</td>
        <td style="border-top: 2px solid #000000; width:115px;">TUE</td>
        <td style="border-top: 2px solid #000000; width:115px;">WED</td>
        <td style="border-top: 2px solid #000000; width:115px;">THU</td>
        <td style="border-top: 2px solid #000000; width:115px;">FRI</td>
        <td style="border-top: 2px solid #000000; width:115px;">SAT</td>
        <td style="border-top: 2px solid #000000;  width:115px; border-right:1px solid #000000;">SUN</td>
	</tr>
    <!--
    <tr align="center">
    	<td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px; ">7a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px;">7a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px;">7a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px;">7a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px; ">7a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px; ">9a-10p</td>
        <td style=" border-right:1px solid #000000; border-top:2px solid #000000; font-size:19px;">9a-10p</td>
    </tr>
    <tr>
    	<td colspan="8" bgcolor="#999999" style="border-right:1px solid #000000;">SERVICES</td>
    </tr>
    -->
<?php

print '<tr align="center">';
		$query1 = 'select * from hours join periods on hours.type=periods.type where start_date <= "'.$date.'" and end_date>"'.$date.'" and location_id=59';
		$result1 = $db->query($query1);
		$location1 = $result1->fetch_array(MYSQLI_NUM);
		
		$subquery = 'select * from exceptions where date_of>="'.$week_start.'" and date_of<="'.$week_end.'" and location_id=59';
		//print $subquery;
		$subresult = $db->query($subquery);
		while($exception = $subresult->fetch_array()){
			$temp = (date("N", strtotime($exception['date_of']))-1);
			$location1[$temp*2+1]=$exception['open'];
			$location1[$temp*2+2]=$exception['close'];			
		}
		for($x=1; $x<15; $x++){
			if($location1[$x] == $location1[$x+1] && $location1[$x]=='00:00:00'){
				print '<td style="border-right:1px solid #000000; font-size:19px;">closed</td>';
				$x++;
			}
			else{
				$tms=strtotime($location1[$x++]);
				$tms1 = date('g', $tms);
				if(date('i', $tms)!="00"){
				$tms1 .= date(':i', $tms); 
				}
				if(date('a', $tms)=="am"){
				$tms1 .= "a";
				}else{
				$tms1.= "p";
				}
				
				
				$tme=strtotime($location1[$x]);
				$tme1 = date('g', $tme);
				if(date('i', $tme)!="00"){
				$tme1 .= date(':i', $tme); 
				}
				if(date('a', $tme)=="am"){
				$tme1 .= "a";
				}else{
				$tme1.= "p";
				}
				print '<td style="border-right:1px solid #000000; font-size:19px;">'.$tms1.'-'.$tme1.'</td>';
			}
		}
		print '</tr>';
	
print '<tr>'.
    	'<td colspan="8" bgcolor="#999999" style="border-right:1px solid #000000;">SERVICES</td>'.
    '</tr>';

$query = 'select * from location where group_id=2 and subgroup="Services" order by location_name';

$result=$db->query($query);

$i=0;

while($location = mysqli_fetch_assoc($result)){
if($i&1){
print '<tr bgcolor="#ffffff" align="center"><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].' </td>';
}
else{
print '<tr bgcolor="#dddddd" align="center"><td style="border-right:1px solid #000000;" align="left"> <span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].'</td>';
}
$i++;
$query1 = 'select * from hours join periods on hours.type=periods.type where start_date <= "'.$date.'" and end_date>"'.$date.'" and location_id='.$location['location_id'];
		$result1 = $db->query($query1);
		$location1 = $result1->fetch_array(MYSQLI_NUM);
		
		$subquery = 'select * from exceptions where date_of>="'.$week_start.'" and date_of<="'.$week_end.'" and location_id='.$location['location_id'];
		//print $subquery;
		$subresult = $db->query($subquery);
		while($exception = $subresult->fetch_array()){
			$temp = (date("N", strtotime($exception['date_of']))-1);
			$location1[$temp*2+1]=$exception['open'];
			$location1[$temp*2+2]=$exception['close'];			
		}
		for($x=1; $x<15; $x++){
			if($location1[$x] == $location1[$x+1] && $location1[$x]=='00:00:00'){
				print '<td style="border-right:1px solid #000000; font-size:19px;">closed</td>';
				$x++;
			}
			else{
				$tms=strtotime($location1[$x++]);
				$tms1 = date('g', $tms);
				if(date('i', $tms)!="00"){
				$tms1 .= date(':i', $tms); 
				}
				if(date('a', $tms)=="am"){
				$tms1 .= "a";
				}else{
				$tms1.= "p";
				}
				
				
				$tme=strtotime($location1[$x]);
				$tme1 = date('g', $tme);
				if(date('i', $tme)!="00"){
				$tme1 .= date(':i', $tme); 
				}
				if(date('a', $tme)=="am"){
				$tme1 .= "a";
				}else{
				$tme1.= "p";
				}
				print '<td style="border-right:1px solid #000000; font-size:19px;">'.$tms1.'-'.$tme1.'</td>';
			}
		}
		print '</tr>';
	
}	
?>	
<tr>
	<td colspan="8" bgcolor="#999999" style="border-right:1px solid #000000;">DINING</td>
</tr>
<tr>
<?php
$query = 'select * from location where group_id=2 and subgroup="Dining" order by location_name';

$result= $db->query($query);

while($location = mysqli_fetch_assoc($result)){

if($i&1){
print '<tr bgcolor="#ffffff" align="center"><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].' </td>';
}
else{
print '<tr bgcolor="#dddddd" align="center"><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].' </td>';
}
$i++;

//print '<tr><td style="border-right:1px solid #000000;">'.$location['location_name'].' '.$location['phone'].'</td>';

$query1 = 'select * from hours join periods on hours.type=periods.type where start_date <= "'.$date.'" and end_date>"'.$date.'" and location_id='.$location['location_id'];
		$result1 = $db->query($query1);
		$location1 = $result1->fetch_array(MYSQLI_NUM);
		
		$subquery = 'select * from exceptions where date_of>="'.$week_start.'" and date_of<="'.$week_end.'" and location_id='.$location['location_id'];
		//print $subquery;
		$subresult = $db->query($subquery);
		while($exception = $subresult->fetch_array()){
			$temp = (date("N", strtotime($exception['date_of']))-1);
			$location1[$temp*2+1]=$exception['open'];
			$location1[$temp*2+2]=$exception['close'];			
		}
		for($x=1; $x<15; $x++){
			if($location1[$x] == $location1[$x+1] && $location1[$x]=='00:00:00'){
				print '<td style="border-right:1px solid #000000; font-size:19px;">closed</td>';
				$x++;
			}
			else{
				$tms=strtotime($location1[$x++]);
				$tms1 = date('g', $tms);
				if(date('i', $tms)!="00"){
				$tms1 .= date(':i', $tms); 
				}
				if(date('a', $tms)=="am"){
				$tms1 .= "a";
				}else{
				$tms1.= "p";
				}
				
				
				$tme=strtotime($location1[$x]);
				$tme1 = date('g', $tme);
				if(date('i', $tme)!="00"){
				$tme1 .= date(':i', $tme); 
				}
				if(date('a', $tme)=="am"){
				$tme1 .= "a";
				}else{
				$tme1.= "p";
				}
				print '<td style="border-right:1px solid #000000; font-size:19px;">'.$tms1.'-'.$tme1.'</td>';
			}
		}
		print '</tr>';
	
}	
?>
<tr bgcolor="#999999"><td colspan="8" style="border-bottom:2px solid #000000; border-right:1px solid #000000;">&nbsp;</td><tr>	
</table><br />



<table cellpadding="3px" cellspacing="0px" >
	<tr align="center" style="background-color:#999999;">
		<td style="color:#FFFFFF; background-color:#000000; border-top: 2px solid #000000; width:385px;">UNION FOOD STOPS</td>
        <td style="border-top: 2px solid #000000; width:115px;">MON</td>
        <td style="border-top: 2px solid #000000; width:115px;">TUE</td>
        <td style="border-top: 2px solid #000000; width:115px;">WED</td>
        <td style="border-top: 2px solid #000000; width:115px;">THU</td>
        <td style="border-top: 2px solid #000000; width:115px;">FRI</td>
        <td style="border-top: 2px solid #000000; width:115px;">SAT</td>
        <td style="border-top: 2px solid #000000;  width:115px; border-right:1px solid #000000;">SUN</td>
	</tr>

<?php
$query = 'select * from location where group_id=3 order by location_name';

$result= $db->query($query);

$i=0;

while($location = mysqli_fetch_assoc($result)){
if($i&1){
print '<tr bgcolor="#ffffff" align="center"><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].' </td>';
}
else{
print '<tr bgcolor="#dddddd" align="center"><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].' </td>';
}
$i++;
$query1 = 'select * from hours join periods on hours.type=periods.type where start_date <= "'.$date.'" and end_date>"'.$date.'" and location_id='.$location['location_id'];
		$result1 = $db->query($query1);
		$location1 = $result1->fetch_array(MYSQLI_NUM);
		
		$subquery = 'select * from exceptions where date_of>="'.$week_start.'" and date_of<="'.$week_end.'" and location_id='.$location['location_id'];
		//print $subquery;
		$subresult = $db->query($subquery);
		while($exception = $subresult->fetch_array()){
			$temp = (date("N", strtotime($exception['date_of']))-1);
			$location1[$temp*2+1]=$exception['open'];
			$location1[$temp*2+2]=$exception['close'];			
		}
		for($x=1; $x<15; $x++){
			if($location1[$x] == $location1[$x+1] && $location1[$x]=='00:00:00'){
				print '<td style="border-right:1px solid #000000; font-size:19px;">closed</td>';
				$x++;
			}
			else{
				$tms=strtotime($location1[$x++]);
				$tms1 = date('g', $tms);
				if(date('i', $tms)!="00"){
				$tms1 .= date(':i', $tms); 
				}
				if(date('a', $tms)=="am"){
				$tms1 .= "a";
				}else{
				$tms1.= "p";
				}
				
				
				$tme=strtotime($location1[$x]);
				$tme1 = date('g', $tme);
				if(date('i', $tme)!="00"){
				$tme1 .= date(':i', $tme); 
				}
				if(date('a', $tme)=="am"){
				$tme1 .= "a";
				}else{
				$tme1.= "p";
				}
				print '<td style="border-right:1px solid #000000; font-size:19px;">'.$tms1.'-'.$tme1.'</td>';
			}
		}
		print '</tr>';
	
}

	
?>	

<tr bgcolor="#999999"><td colspan="8" style="border-bottom:2px solid #000000; border-right:1px solid #000000;">&nbsp;</td><tr>	
</table><br />

<table cellpadding="3px" cellspacing="0px" >
	<tr align="center" style="background-color:#999999;">
		<td style="color:#FFFFFF; background-color:#000000; border-top: 2px solid #000000; width:385px;">ADMINISTRATIVE</td>
        <td style="border-top: 2px solid #000000; width:115px;">MON</td>
        <td style="border-top: 2px solid #000000; width:115px;">TUE</td>
        <td style="border-top: 2px solid #000000; width:115px;">WED</td>
        <td style="border-top: 2px solid #000000; width:115px;">THU</td>
        <td style="border-top: 2px solid #000000; width:115px;">FRI</td>
        <td style="border-top: 2px solid #000000; width:115px;">SAT</td>
        <td style="border-top: 2px solid #000000;  width:115px; border-right:1px solid #000000;">SUN</td>
	</tr>

<?php
$query = 'select * from location where group_id=4 order by location_name';
$DBlink = (isset($DBlink) ? $DBlink : null);
$result=$db->query($query, $DBlink);

$i=0;

while($location = mysqli_fetch_assoc($result)){
if($i&1){
print '<tr bgcolor="#ffffff" align="center"><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].' </td>';
}
else{
print '<tr bgcolor="#dddddd" align="center"><td style="border-right:1px solid #000000;" align="left"><span style="float:right;">'.$location['phone'].'</span>'.$location['location_name'].' </td>';
}
$i++;
$query1 = 'select * from hours join periods on hours.type=periods.type where start_date <= "'.$date.'" and end_date>"'.$date.'" and location_id='.$location['location_id'];
		$result1 = $db->query($query1);
		$location1 = $result1->fetch_array(MYSQLI_NUM);
		
		$subquery = 'select * from exceptions where date_of>="'.$week_start.'" and date_of<="'.$week_end.'" and location_id='.$location['location_id'];
		//print $subquery;
		$subresult = $db->query($subquery);
		while($exception = $subresult->fetch_array()){
			$temp = (date("N", strtotime($exception['date_of']))-1);
			$location1[$temp*2+1]=$exception['open'];
			$location1[$temp*2+2]=$exception['close'];			
		}
		for($x=1; $x<15; $x++){
			if($location1[$x] == $location1[$x+1] && $location1[$x]=='00:00:00'){
				print '<td style="border-right:1px solid #000000; font-size:19px;">closed</td>';
				$x++;
			}
			else{
				$tms=strtotime($location1[$x++]);
				$tms1 = date('g', $tms);
				if(date('i', $tms)!="00"){
				$tms1 .= date(':i', $tms); 
				}
				if(date('a', $tms)=="am"){
				$tms1 .= "a";
				}else{
				$tms1.= "p";
				}
				
				
				$tme=strtotime($location1[$x]);
				$tme1 = date('g', $tme);
				if(date('i', $tme)!="00"){
				$tme1 .= date(':i', $tme); 
				}
				if(date('a', $tme)=="am"){
				$tme1 .= "a";
				}else{
				$tme1.= "p";
				}
				print '<td style="border-right:1px solid #000000; font-size:19px;">'.$tms1.'-'.$tme1.'</td>';
			}
		}
		print '</tr>';
	
}	
?>	

<tr bgcolor="#999999"><td colspan="8" style="border-bottom:2px solid #000000; border-right:1px solid #000000;">&nbsp;</td><tr>	
</table>

<img src="/template/images/su-logo.jpg" height="75px" style="float:left; padding-top:4px;"/><span style="float:left; font-size:16px; padding-top:9px; padding-left:5px;">NOTE: Hours are subject to change.<br />
For information call 621-7755.<br />
www.union.arizona.edu</span>
    	        
</div>

<div style="clear:both;"><br />
<div style=" background-color:#000000; padding-top:30px; height:30px;"></div>
</div>

</body>
</html>
