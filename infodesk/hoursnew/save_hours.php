<?php print var_dump(explode(',', $_POST['data'])); ?>
<?php print var_dump(explode(',', $_POST['data2'])); ?>
<?php print var_dump(explode(',', $_POST['data3'])); ?>
<?php print var_dump(explode(',', $_POST['data4'])); ?>
<?php

	$data = explode(',', $_POST['data']);
	$data2 = explode(',', $_POST['data2']);
	$data3 = $_POST['data3'];
	$data4 = explode(',', $_POST['data4']);
	$data5 = $_POST['data5'];


require('hours_db.inc');

if($data5 == 0){


		$query = 'insert into hours set location_id='.$data3.', type=0, openu="'.$data[0].'", closeu="'.$data2[0].'", openm="'.$data[1].'", closem="'.$data2[1].'", opent="'.$data[2].'", closet="'.$data2[2].'", openw="'.$data[3].'", closew="'.$data2[3].'", openr="'.$data[4].'", closer="'.$data2[4].'", openf="'.$data[5].'", closef="'.$data2[5].'", opens="'.$data[6].'", closes="'.$data2[6].'" on duplicate key update openu="'.$data[0].'", closeu="'.$data2[0].'", openm="'.$data[1].'", closem="'.$data2[1].'", opent="'.$data[2].'", closet="'.$data2[2].'", openw="'.$data[3].'", closew="'.$data2[3].'", openr="'.$data[4].'", closer="'.$data2[4].'", openf="'.$data[5].'", closef="'.$data2[5].'", opens="'.$data[6].'", closes="'.$data2[6].'"';
		//print $query;
		$db->query($query);
		//print mysql_error($DBlink);


}


if($data5 == 1){


		$query = 'insert into hours set location_id='.$data3.', type=1, openu="'.$data[0].'", closeu="'.$data2[0].'", openm="'.$data[1].'", closem="'.$data2[1].'", opent="'.$data[2].'", closet="'.$data2[2].'", openw="'.$data[3].'", closew="'.$data2[3].'", openr="'.$data[4].'", closer="'.$data2[4].'", openf="'.$data[5].'", closef="'.$data2[5].'", opens="'.$data[6].'", closes="'.$data2[6].'" on duplicate key update openu="'.$data[0].'", closeu="'.$data2[0].'", openm="'.$data[1].'", closem="'.$data2[1].'", opent="'.$data[2].'", closet="'.$data2[2].'", openw="'.$data[3].'", closew="'.$data2[3].'", openr="'.$data[4].'", closer="'.$data2[4].'", openf="'.$data[5].'", closef="'.$data2[5].'", opens="'.$data[6].'", closes="'.$data2[6].'"';
		//print $query;
		$db->query($query);
		//print mysql_error($DBlink);


}



if($data5 == 2){

	for($i=0; $i < sizeof($data); $i++){
		$query = 'insert into exceptions set location_id='.$data3.', date_of="'.$data4[$i].'", open="'.$data[$i].'", close="'.$data2[$i].'" on duplicate key update open="'.$data[$i].'", close="'.$data2[$i].'"';
		//echo $query;
		//print $query;
		// KMB - Seriously... this was really coded to insert bad values unless they're caught by this conditional? Why not just eliminate the bad values in the first place???
		if(strlen($data4[$i]) >= 8)
			$db->query($query);
		//print mysql_error($DBlink);

	}
}

// include mobile hours script to update table for feeds whenever a change is made
include('mobile_hours.php');

	?>
