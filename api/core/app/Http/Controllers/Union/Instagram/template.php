<?php
	require_once( 'instagram_basic_display_api.php' );

	$accessToken = 'IGQVJYY3V5bkNHWUx6Nk9Jdk8tMFV6VllaOHgtM2xNOVFMN3RtVk5HTi1Lb1F5ZATNxWmdGWXJWM0oyRzNhZAlNiTlNpNU1UMXJkZAWl3WEpYRUhWbWlGWkhRMUg0NnRIZAjRxc2toblhfdTYwdkRyYXo3NQZDZD';

	$params = array(
		'get_code' => isset( $_GET['code'] ) ? $_GET['code'] : '',
		'access_token' => $accessToken,
		'user_id' => '17841432824741941'
	);

	$ig = new instagram_basic_display_api( $params );

	$user = $ig->getUser();
	$usersMedia = $ig->getUsersMedia();

	foreach ( $usersMedia['data'] as $post ) {
		// if ( 'IMAGE' == $post['media_type'] || 'CAROUSEL_ALBUM' == $post['media_type'])
		// $post['media_url'];
		// $post['caption'];
		// $post['id'];
	}

	// Next page
	//$usersMediaNext = $ig->getPaging( $usersMedia['paging']['next'] );
?>
