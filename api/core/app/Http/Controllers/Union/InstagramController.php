<?php
namespace App\Http\Controllers\Union;

use App\Http\Controllers\Controller;
use App\Libraries\GoogleCalendar;
use Google_Service_Calendar;

class InstagramController extends Controller 
{
	private $access_token = "19957605.7b3c94c.cdd356321b464b249b5779ea82e13e8a";

	public function __construct()
    {
        $this->middleware('suapi');
	}

	public function getLatestFeed(){

		$url = 'https://api.instagram.com/v1/users/self/media/recent?access_token='.$this->access_token;

		// Get feeds from Instagram
		$ch = curl_init();

		curl_setopt_array($ch, array(
		    CURLOPT_URL => $url,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_ENCODING => "",
		    CURLOPT_TIMEOUT => 30000,
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_CUSTOMREQUEST => "GET",
		    CURLOPT_HTTPHEADER => array(
		        'Content-Type: application/json',
		    ),
		));

		$output = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($output);

		$return = [
			'success' => false,
			'feed' => []
		];
		if (count((array)$response->data) != 0){
			$feed = $response->data[0];
			$return = [
				'success' => true,
				'feed' => [
					'user_img' => $feed->user->profile_picture,
					'username' => $feed->user->username,
					'created_time' => $feed->created_time,
					'text' => $feed->caption->text,
					'tags' => $feed->tags,
					'link' => $feed->link,
					'image' => $feed->images->standard_resolution,
					'low_img' => $feed->images->standard_resolution
					// 'low_img' => $feed->images->low_resolution
				]
			];
		}

		return response()->json($return, 200);
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