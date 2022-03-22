<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/catering/online/function/post.function.php');

postSetup('menu');

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

// Need to check if POST value is empty
$check = [];
checkPost($check);

// echo "Test";
//var_dump($_POST);
/*
* 
*  Store in Database
*
*/
$arr = [
		"pack12_quantity"  => $_POST['pack12_quantity'],
		"pack8_quantity"   => $_POST['pack8_quantity'],
		"pack12" => [],
		"pack8"  => [],
		"extra_chips"  => $_POST['extra_chips'],
		//"extra_salsa"  => $_POST['extra_salsa'],
		//"extra_sourcream"  => $_POST['extra_sourcream'],
		//"extra_guacamole"  => $_POST['extra_guacamole'],

		// "party_pack_upgrade"  => $_POST['party_pack_upgrade'],
		
		"party_upgrade" => $_POST['party_upgrade'],

		"coke" => $_POST['coke'],
		"diet_coke" => $_POST['diet_coke'],
		"sprite" => $_POST['sprite'],
		"fanta" => $_POST['fanta'],
		"water" => $_POST['water'],

		// "coke_zero" => $_POST['coke_zero'],
		// "dr_pepper" => $_POST['dr_pepper'],
		// "diet_dr_pepper" => $_POST['diet_dr_pepper'],
		// "print_burrito" => '',
	];

	

// Update status in catering table
$db = New CateringDB('su');
$db_insertId = $db->table('catering')->where('id','=',$_SESSION['catering_id'])->update(['status' => 'menu']);

// echo DB::getCon()->affected_rows;

// Store pack 12
if (isset($_POST['pack12'])){
	$arr['pack12'] = $_POST['pack12'];
	insertPack($arr['pack12'],12);
}

// Store pack 8
if (isset($_POST['pack8'])){
	$arr['pack8'] = $_POST['pack8'];
	insertPack($arr['pack8'],8);
}

$upgrade = 0;

if($_POST['party_upgrade'] == "twelve_sodas"){
	$upgrade = 12;
} elseif ($_POST['party_upgrade'] == "eight_sodas") {
	$upgrade = 8;
}

// Insert into catering_highland table
$db = new CateringDB();
$db_insert = $db->table('catering_highland')->insert([
					'catering_id' => $_SESSION['catering_id'],
					'burrito_12' => count($arr['pack12']),
					'burrito_8' => count($arr['pack8']),
					'extra_chips' => $arr['extra_chips'],
					//'extra_salsa' => $arr['extra_salsa'],
					//'extra_sourcream' => $arr['extra_sourcream'],
					//'extra_guacamole' => $arr['extra_guacamole'],
					'upgrade' => $upgrade,
					//'party_upgrade' => $arr['party_upgrade'],
					
					'coke' => $arr['coke'],
					'diet_coke' => $arr['diet_coke'],
					'sprite' => $arr['sprite'],
					'fanta' => $arr['fanta'],
					'water' => $arr['water'],
				]);



// Need to check database error


// Update session
$_SESSION['status'] = '';
$_SESSION['catering_status']['menu'] = true;

// Sent user to review page
// if (success)
$_SESSION['catering_post']['menu'] = true;
header("Location: ../review.php");
die();


function insertPack($arr,$packNum){
	$db = New CateringDB('su');
	foreach ($arr as $packId => $pack) {

		for ($burrId=1; $burrId <= $packNum; $burrId++) { 
			$insert = [];
			$insert['pack'] = $packNum;
			$insert['pack_num'] = $packId;
			$insert['burrito_num'] = $burrId;
			$burrito = $pack[$burrId];

			if (array_key_exists('meat', $burrito)){
				$ingredient = $burrito['meat'];
				for ($j=0; $j < 4; $j++) { 
					if (array_key_exists($j, $ingredient)) {
						$col = 'meat_'.($j+1);
						// $db_burrito->into($col,$ingredient[$j]);
						$insert[$col] = $ingredient[$j];
					}else{
						$col = 'meat_'.($j+1);
						// $db_burrito->into($col,null);
						$insert[$col] = null;
					}
				}
				
			}else {
				for ($j=0; $j < 4; $j++) { 
					$col = 'meat_'.($j+1);
					// $db_burrito->into($col,null);
					$insert[$col] = null;
				}
			}

			if (array_key_exists('vegi', $burrito)){
				$ingredient = $burrito['vegi'];
				for ($j=0; $j < 4; $j++) { 
					if (array_key_exists($j, $ingredient)) {
						$col = 'vege_'.($j+1);
						// $db_burrito->into($col,$ingredient[$j]);
						$insert[$col] = $ingredient[$j];
					}else{
						$col = 'vege_'.($j+1);
						// $db_burrito->into($col,null);
						$insert[$col] = null;
					}
				}

			}else {
				for ($j=0; $j < 4; $j++) { 
					$col = 'vege_'.($j+1);
					// $db_burrito->into($col,null);
					$insert[$col] = null;
				}
			}
			
			// End row
			// $db_burrito->into('catering_id',$_SESSION['catering_id'],'end');
			$insert['catering_id'] = $_SESSION['catering_id'];
			$db_insertId = $db->table('catering_highland_burrito')->insertGetId($insert);
		}

		// Store in database
		// echo $db_burrito->save();
	}
}
?>