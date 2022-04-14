<?php

namespace App\Http\Controllers\Union\Instagram;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Union\Instagram\instagram_basic_display_api;
use App\Libraries\GoogleCalendar;
use Google_Service_Calendar;

class InstagramController extends Controller 
{
	public function getLatestFeed(){
		$accessToken = 'IGQVJVZAjd2QlZAoTGxCZAXN6bGtlYkRONmxqRzdMMFVoWXpVMEZAMNWhhZAEF2OGl3Y1pQMFRaZA3I4MDMyTDJvYkg3bVBMeDYtTFNGcTg2OTlWZAHlXZAWxJSHJZARHRPZAXVLSWVCbml0VTFJY3VNMzlfd1l1RgZDZD';
		$params = array(
		'get_code' => isset( $_GET['code'] ) ? $_GET['code'] : '',
		'access_token' => $accessToken,
		'user_id' => '17841401608150311'
		);

		$ig = new instagram_basic_display_api( $params );

		$user = $ig->getUser();

		$username = $user['username'];
		$user_id = $user['id'];

		$usersMedia = $ig->getUsersMedia();

		$data = array();

		foreach ( $usersMedia['data'] as $post ) {
			array_push($data, $post);
		// if ( 'IMAGE' == $post['media_type'] || 'CAROUSEL_ALBUM' == $post['media_type'])
		// $post['media_url'];
		// $post['caption'];
		// $post['id'];
		}

		$profile_picture = InstagramController::getProfilePicture($username, $user_id);

		//return $data[0];

		$return = [
			'success' => false,
			'feed' => []
		];

		if (count($data) != 0){
			$feed = $data[0];
			$return = [
				'success' => true,
				'feed' => [
					'user_img' => $profile_picture,
					'username' => $username,
					'created_time' => $feed['timestamp'],
					'text' => $feed['caption'],
					'tags' => '',
					'link' => $feed['permalink'],
					'image' => $feed['media_url'],
					'low_img' => $feed['media_url']
					// 'low_img' => $feed->images->low_resolution
				]
			];
		}

		return response()->json($return, 200);
	}

	public function getProfilePicture($username, $user_id) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://www.instagram.com/$username/?__a=1");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		$json = json_decode($result);
		return $json->graphql->user->profile_pic_url;
	}
}




// {
//     "access_token": "19957605.7b3c94c.cdd356321b464b249b5779ea82e13e8a",
//     "user": {
//         "id": "19957605",
//         "username": "arizonaunions",
//         "profile_picture": "https://scontent.cdninstagram.com/vp/a5c55814d746f66c2f06be38d71ee7a9/5D3FC6C6/t51.2885-19/s150x150/54512592_2257713911111639_2272108996041113600_n.jpg?_nc_ht=scontent.cdninstagram.com",
//         "full_name": "Arizona Student Unions",
//         "bio": "The living room of the #UniversityofArizona, where everyone can eat, play, connect, and get involved! #HealthierCampus \n#PlantEd\n#BearDown\n#Wildcats",
//         "website": "http://union.arizona.edu/dining/",
//         "is_business": true
//     }
// }