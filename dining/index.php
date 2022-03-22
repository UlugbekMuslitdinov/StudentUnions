<!-- <link rel="StyleSheet" href="/template/global.css" type="text/css" /> -->
<!-- <link rel="StyleSheet" href="template/dining.css" type="text/css" /> -->
<?php
	require_once($_SERVER['DOCUMENT_ROOT'] .'/dining/template/dining.inc');
	include_once($_SERVER['DOCUMENT_ROOT'] . "/commontools/includes/mysqli.inc");
	$db = new db_mysqli('hours2');
	$page_options['page'] = 'Dining';
	//$page_options['header_image'] = '/dining/template/images/dining_header.png';
	$page_options['header_alt'] = 'Dining Services';
	$page_options['video_image'] = '/dining/template/images/video_placeholder.jpg';
	$page_options['video_alt'] = 'Dining Video';
	
	$page_options['styles'] = '';
	$page_options['styles'] .= 'h1 {margin-bottom:20px}';
	$page_options['styles'] .= '#center-col h2 { font-size:16px; color:#393939;}';
	$page_options['styles'] .= '#center-col h2 a:active, #center-col h2 a:link, #center-col h2 a:active, #center-col h2 a:visited{ font-size:16px; color:#D30033;}';
	$page_options['styles'] .= '#center-col h2 a:hover{ color:#FF1F57; }';
	$page_options['styles'] .= '#center-col p{font-size:12px; margin:0px; margin-bottom:8px; line-height:11px;}';
	$page_options['styles'] .= '#center-col p a:active, #center-col p a:link, #center-col p a:hover, #center-col p a:visited{ font-size:9px;}';
	$page_options['styles'] .= '.black-button { height:20px; width:118px; text-align:center; background-color:#393939; float:left; margin-right:12px;}';
	$page_options['styles'] .= '#center-col .black-button a:active, #center-col .black-button a:link, #center-col .black-button a:hover, #center-col .black-button a:visited{ color:#ffffff; line-height:20px; font-size:13px; font-weight:bold;}';
	$page_options['styles'] .= '#location-description p{font-size:12px; line-height:14px;}';
  	$page_options['styles'] .= '#location-description p a:active, #location-description p a:link, #location-description p a:hover, #location-description p a:visited{ font-size:12px;}';
	if(!empty($_GET['q'])){
		switch($_GET['q']){
			case 'sumc':
				$page_options['page'] = 'sumc';
				$place = 'Student Union';
				$title = 'Student Union Restaurants';
				$query = 'select location.location_id, location_name, location_url, short, short_name from location
							join location_descriptions on location.location_id=location_descriptions.location_id
							where group_id=1 and subgroup="Dining"
							order by location_name';
			break;
			case 'psu':
				$page_options['page'] = 'psu';
				// $page_options['header_image'] = '/template/images/banners/strawberry-web2-F.jpg';
				$place = 'Global Center';
				$title = 'Global Center Restaurants';
				$query = 'select location.location_id, location_name, location_url, short, short_name from location
							join location_descriptions on location.location_id=location_descriptions.location_id
							where group_id=2 and subgroup="Dining"
							order by location_name';
			break;
			case 'other':
				$page_options['page'] = 'other';
				$place = 'Around Campus';
				$title = 'More Dining Around Campus';
				$query = 'select location.location_id, location_name, location_url, short, short_name from location
							join location_descriptions on location.location_id=location_descriptions.location_id
							where group_id=3
							order by location_name';
			break;
			default:
				$page_options['page'] = 'sumc';
				$place = 'Student Union';
				$title = 'Student Union Restaurants';
				$query = 'select location.location_id, location_name, location_url, short, short_name from location
							join location_descriptions on location.location_id=location_descriptions.location_id
							where group_id=1 and subgroup="Dining"
							order by location_name';
			break;

		}

	}

	if(!empty($_GET['q']) && !empty($_GET['p'])){
		$place_short = $page_options['page'];
		$page_options['page'] = 'unit';
		$query = 'select * from location join location_descriptions on location.location_id = location_descriptions.location_id where short_name="'.substr($db->real_escape_string($_GET['p']), 0, 15).'"';
		$result = $db->query($query);
		if(mysqli_num_rows($result) == 0){
			// header("Location: /dining/".$place_short);
			echo "<script>location.href='/dining/".$place_short."';</script>";
			exit();
		}
		$location = mysqli_fetch_assoc($result);
		require_once('template/locations.inc');
		if(isset($l[$location['location_id']]['banner']) && $l[$location['location_id']]['banner'] != ''){
			// Assign the banner image for Scoop.
			if ($location['location_id'] ==22) {
			$page_options['header_image'] = '/dining/template/headers/scoop_header.jpg';	
			$page_options['ad'] = '<img src="/dining/template/images/scoop_right.jpg">';
			} else {
			$page_options['header_image'] = $l[$location['location_id']]['banner'];
			}
		}

		if(isset($l[$location['location_id']]) && isset($l[$location['location_id']]['ad']) ){

			$page_options['ad'] = $l[$location['location_id']]['ad'];

		}
	}


	$page_options['has_mobile_version'] = 1;

	//------------------------------------------------------------*
	// the $no_menu array uses the location id of locations that
	// either don't have menus or locations where we don't want
	// to show the menus.
	//------------------------------------------------------------*
	$no_menu = array(31, 2, 57, 29, 26, 36, 37, 47, 65, 66, 77, 79);


	$coming_soon = array(68);
	/* "Now Open" places get a "Now Open"
	 * indicator next to their name
	 */
	$now_open = array(45);
	
if($page_options['page'] == 'Dining')
	// $page_options['ad'] = '<img src="/dining/template/images/scoop_right.jpg">';
    $page_options['ad'] = '<a href="http://www.youtube.com/embed/oG7sMjd1t54?autoplay=1" rel="shadowbox;width=560;height=347;"><img src="/dining/healthy/images/Healthy_video_still.jpg"></a>';
	page_start($page_options);
if($page_options['page'] == 'Dining'){
?>
<section id="dining_home" style="display: unset; width: 100%;"></section></div>
<?php
	// include_once $_SERVER['DOCUMENT_ROOT'] . '/dining/template/main.php';
} elseif($page_options['page'] == 'sumc') {
	// include_once $_SERVER['DOCUMENT_ROOT'] . '/dining/template/sumc.php';
?>
<section id="dining_list" style="display: unset; width: 100%;"></section>
<?php
} elseif($page_options['page'] == 'psu') {
	// Including "Park Student Union Restarants" as a static page.
	// include 'psu_included.php';
?>
<section id="dining_list" style="display: unset; width: 100%;"></section>
<?php
} elseif($page_options['page'] == 'other') {
	// Including "More Places to Eat" as a static page.
	// include 'other_included.php';
?>
<section id="dining_list" style="display: unset; width: 100%;"></section>
<?php
} elseif($page_options['page'] == 'around') {
?>
<section id="dining_list" style="display: unset; width: 100%;"></section>
<?php
}else {
	// include $_SERVER['DOCUMENT_ROOT'] . '/dining/template/restaurant_detail.php';
?>
<section id="dining" style="display: unset; width: 100%;"></section>
<?php
}

page_finish();

include_once $_SERVER['DOCUMENT_ROOT'] . '/dining/template/common.function.php';
?>

<link href="/dining/template/static/css/2.05928467.chunk.css" rel="stylesheet">
<link href="/dining/template/static/css/main.ecab7d38.chunk.css" rel="stylesheet">
<link href="/dining/template/dining.css" rel="stylesheet">

<script>!function(f){function e(e){for(var r,t,n=e[0],o=e[1],u=e[2],i=0,l=[];i<n.length;i++)t=n[i],p[t]&&l.push(p[t][0]),p[t]=0;for(r in o)Object.prototype.hasOwnProperty.call(o,r)&&(f[r]=o[r]);for(s&&s(e);l.length;)l.shift()();return c.push.apply(c,u||[]),a()}function a(){for(var e,r=0;r<c.length;r++){for(var t=c[r],n=!0,o=1;o<t.length;o++){var u=t[o];0!==p[u]&&(n=!1)}n&&(c.splice(r--,1),e=i(i.s=t[0]))}return e}var t={},p={1:0},c=[];function i(e){if(t[e])return t[e].exports;var r=t[e]={i:e,l:!1,exports:{}};return f[e].call(r.exports,r,r.exports,i),r.l=!0,r.exports}i.m=f,i.c=t,i.d=function(e,r,t){i.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:t})},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(r,e){if(1&e&&(r=i(r)),8&e)return r;if(4&e&&"object"==typeof r&&r&&r.__esModule)return r;var t=Object.create(null);if(i.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:r}),2&e&&"string"!=typeof r)for(var n in r)i.d(t,n,function(e){return r[e]}.bind(null,n));return t},i.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(r,"a",r),r},i.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},i.p="/dining/template/";var r=window.webpackJsonp=window.webpackJsonp||[],n=r.push.bind(r);r.push=e,r=r.slice();for(var o=0;o<r.length;o++)e(r[o]);var s=n;a()}([])</script>

<script src="/dining/template/static/js/2.3c8d3fd4.chunk.js"></script>
<script src="/dining/template/static/js/main.9a70ba1a.chunk.js"></script>
