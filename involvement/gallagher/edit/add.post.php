<?php
include_once('functions.php');

loginCheck();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	add($_POST);
	header("Location: edit.php");
	die();
}


function add($post){
	$data = getJson();
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
					$tempArr['start_date'] = $date->format('Y-m-d');
					break;

				case 'enddate':
					$date = new DateTime($value);
					$tempArr['end_date'] = $date->format('Y-m-d');
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
						$tempArr['name'] = $tempMovieNameArr;
						$tempArr['time'] = $tempMovieTimeArr;
						array_push($data, $tempArr);
						$tempArr = [];
						$tempMovieTimeArr = [];
					}
					break;
			}
		}
	}

	$data = sortByDate($data);

	$fp = fopen(getJsonFileName(), 'w');
	fwrite($fp, json_encode($data));
	fclose($fp);
}