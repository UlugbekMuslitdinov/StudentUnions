<?php

namespace App\Http\Controllers\Union\Instagram;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Union\Instagram\instagram_basic_display_api;
use App\Libraries\GoogleCalendar;
use App\Model\SU\InstagramCache;
use Google_Service_Calendar;

class InstagramController extends Controller 
{
	public function getLatestFeed(){
		$accessToken = 'IGQVJXQThxMjVHODlnYl9ZAYU9RT1A4QVBnV0tNMVFyNWx6al9WWklzVV9zRTlfNFFnMHpRS0ZAVWkswZATNqM1NteFFrclVhYmFLYmRONFlCWTlpXzVKNjAwR0ZAFOTN5NDQyTElRTHc3d0lYSEgyeDNFcQZDZD';
		$params = array(
		'get_code' => isset( $_GET['code'] ) ? $_GET['code'] : '',
		'access_token' => $accessToken,
		'user_id' => '17841401608150311'
		);

		$cache_data = InstagramCache::get_data();

		$current_date = date("Y-m-d");
		$final_date = $cache_data['refresh_date'];
		$difference = abs(strtotime($current_date) - strtotime($final_date));
		$days = $difference / (60 * 60 * 24);

		if($days >= 58) {
			$ret = InstagramController::refreshToken($accessToken);
			$final_date = $current_date;
		}

		$ig = new instagram_basic_display_api( $params );

		// $user = $ig->getUser();
		$user = array("id" => "17841401608150311", "username" => "uazunions", "media_count" => 601, "account_type" => "BUSINESS");

		$username = $user['username'];
		$user_id = $user['id'];

		$data = array();

		$usersMedia = $ig->getUsersMedia();

		if(isset($usersMedia['error'])) {
			array_push($data, $cache_data);
		}
		else {
			foreach ( $usersMedia['data'] as $post ) {
				array_push($data, $post);
			}
		}
		

		$profile_picture = InstagramController::getProfilePicture($username, $user_id);

		$return = [
			'success' => false,
			'feed' => []
		];

		if (count($data) != 0){
			$feed = $data[0];
			InstagramCache::set_id($feed['id'], $feed['caption'], $feed['permalink'], $feed['timestamp'], $feed['media_url'], $final_date);
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
				]
			];
		}

		return response()->json($return, 200);
	}

	public function refreshToken($token) {
		$url = "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=" . $token;
		$agent= 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36';

		// $json = file_get_contents($url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_URL,$url);
		$json=curl_exec($ch);

		return $json;
	}

	public function getProfilePicture($username, $user_id) {
		// $ch = curl_init();
		// $fetch_link = "https://www.instagram.com/".$username."/?__a=1";
		// curl_setopt($ch, CURLOPT_URL, $fetch_link);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		// $result = curl_exec($ch);
		// $json = json_decode($result);
		// return $json->graphql->user->profile_pic_url;
		return "https://pbs.twimg.com/profile_images/1164982788849725446/ZcyJHaNh_400x400.jpg";
	}
}