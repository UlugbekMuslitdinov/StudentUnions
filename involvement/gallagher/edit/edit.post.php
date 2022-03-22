<?php
include_once('functions.php');
loginCheck();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	if ($_POST['action']=='edit') {
		edit($_POST);
		header("Location: edit.php");
		die();
	}else if ($_POST['action']=='delete'){
		delete($_POST);
		header("Location: edit.php");
		die();
	}
}


function edit($post){

	$id = $post['id'];

	$data = getJson();

	// Temp variables before storing $data arr
	$tempArr = [];
	$tempMovieNameArr = [];
	$countMovieName = 0;
	$tempMovieTimeArr = [];
	$countMovieTime = 0;

	foreach ($post as $key => $value) {
		$trimKey = preg_replace('/[0-9]+|[_]+/','',$key);
		
		if ($trimKey != ''){
			switch ($trimKey) {
				case 'date':
					$date = new DateTime($value);
					$data[$id]['start_date'] = $date->format('Y-m-d');
					break;

				case 'enddate':
					$date = new DateTime($value);
					$data[$id]['end_date'] = $date->format('Y-m-d');
					break;

				case 'timeCount':
					$countMovieTime = $value;
					break;
				
				case 'time':
					array_push($tempMovieTimeArr,$value);
					$countMovieTime--;
					break;

				case 'nameCount':
					$countMovieName = $value;
					break;
				
				case 'name':
					array_push($tempMovieNameArr,$value);
					$countMovieName--;
					if ($countMovieName == 0){
						$data[$id]['name'] = $tempMovieNameArr;
						$data[$id]['time'] = $tempMovieTimeArr;
					}
					break;
			}
		}
	}

	// Sort
	$data = sortByDate($data);

	$data = json_encode($data);
	file_put_contents(getJsonFileName(), $data);
}


function delete($post){
	$id = $post['id'];

	$data = getJson();
	// Remove row
	unset($data[$id]);
	$data = array_values($data);

	// Update
	$data = json_encode($data);
	file_put_contents(getJsonFileName(), $data);
}