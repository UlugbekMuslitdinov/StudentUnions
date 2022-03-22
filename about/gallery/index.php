<?php
	if (!isset ($_SESSION)) {
	session_start();
	}
	
	// this was added following a PCI scan vulnerability to not allow directory tree traversal
	if (isset($_GET["dir"]) && !(strpos($_GET["dir"], "../") === false)) {
		$_GET["dir"] = "";
	}
	
	require_once('../template/about.inc');
	$page_options['title'] = 'Arizona Student Unions Photo Gallery';
	$page_options['page'] = 'gallery';
	about_start($page_options);
	require_once ('includes/mysqli.inc');
	$_SESSION['picasaEmail'] = "azstudentunion@gmail.com";
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/phplib/phototool/albumFunctions.inc');
?>

<script type="text/javascript" src="/commontools/jslib/lightbox2/js/prototype.js"></script>
<script type="text/javascript" src="/commontools/jslib/lightbox2/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="/commontools/jslib/lightbox2/js/lightbox.js"></script>

<link rel="stylesheet" href="/commontools/jslib/lightbox2/css/lightbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/template/gallerylink.css" type="text/css" media="screen" />

<h1>Union Photo Gallery</h1>

<div class="gallerylink" style="margin-top:8px;">
<?php
makeLightboxFromAlbum(2,  "2009 Employee Awards Banquet"); 					print("<br/><br/>");
makeLightboxFromAlbum(19, "2008 SU Employee Recognition Banquet"); 			print("<br/>");
makeLightboxFromAlbum(3,  "2008 Starbucks Grand Opening"); 					print("<br/>");
makeLightboxFromAlbum(4,  "2008 Homecoming"); 								print("<br/><br/>");
makeLightboxFromAlbum(20, "2007 Expo"); 									print("<br/><br/>");
makeLightboxFromAlbum(22, "2006 Homecoming"); 								print("<br/>");
makeLightboxFromAlbum(23, "2006 Employee Awards Banquet"); 					print("<br/>");
makeLightboxFromAlbum(21, "2006 Catwalk"); 									print("<br/><br/>");
makeLightboxFromAlbum(15, "2005 Sugarland Concert"); 						print("<br/>");
makeLightboxFromAlbum(10, "2005 Park Student Union"); 						print("<br/>");
makeLightboxFromAlbum(8,  "2005 Pajama Party"); 							print("<br/>");
makeLightboxFromAlbum(16, "2005 NACAS West Conference"); 					print("<br/>");
makeLightboxFromAlbum(18, "2005 KidzKorner Dedication"); 					print("<br/>");
makeLightboxFromAlbum(17, "2005 Housing Fair"); 							print("<br/>");
makeLightboxFromAlbum(24, "2005 Homecoming"); 								print("<br/>");
makeLightboxFromAlbum(14, "2005 Highland Market Glassblowing"); 			print("<br/>");
makeLightboxFromAlbum(34, "2005 Brian Keintz Farewell"); 					print("<br/>");
makeLightboxFromAlbum(33, "2005 ACUI International Conference in Reno"); 	print("<br/><br/>");
makeLightboxFromAlbum(35, "2004 University Achievement Awards Luncheon"); 	print("<br/>");
makeLightboxFromAlbum(12, "2004 Student Union Birthday"); 					print("<br/>");
makeLightboxFromAlbum(13, "2004 State of the University Luncheon"); 		print("<br/>");
makeLightboxFromAlbum(9,  "2004 Homecoming"); 								print("<br/>");
makeLightboxFromAlbum(11, "2004 Highland Market Dedication"); 				print("<br/>");
makeLightboxFromAlbum(32, "2004 Halloween"); 								print("<br/>");
makeLightboxFromAlbum(6,  "2004 ACUI Construction Conference"); 			print("<br/><br/>");
makeLightboxFromAlbum(31, "2003 Joe Sottosanti Farewell"); 					print("<br/>");
makeLightboxFromAlbum(36, "2003 Homecoming"); 								print("<br/>");
makeLightboxFromAlbum(7,  "2003 Halloween"); 								print("<br/><br/>");
makeLightboxFromAlbum(38, "2002 Wildcat Football"); 						print("<br/>");
makeLightboxFromAlbum(37, "2002 Swinerton Ballroom Party"); 				print("<br/>");
makeLightboxFromAlbum(40, "2002 Sally McLean Retirement"); 					print("<br/>");
makeLightboxFromAlbum(39, "2002 Jason Wang Farewell"); 						print("<br/>");
makeLightboxFromAlbum(41, "2002 Employee Recognition Week"); 				print("<br/>");
makeLightboxFromAlbum(43, "2002 ACUI Conference"); 							print("<br/>");
makeLightboxFromAlbum(42, "2002 ACUI Albequerque"); 						print("<br/><br/>");
makeLightboxFromAlbum(46, "2001 Homecoming"); 								print("<br/>");
makeLightboxFromAlbum(44, "2001 Holiday Party"); 							print("<br/>");
makeLightboxFromAlbum(47, "2001 Halloween"); 								print("<br/>");
makeLightboxFromAlbum(48, "2001 Employee Recognition Week"); 				print("<br/>");
makeLightboxFromAlbum(49, "2001 ACUI Toronto"); 							print("<br/>");
makeLightboxFromAlbum(45, "2001 50th Birthday Party"); 						print("<br/><br/>");
makeLightboxFromAlbum(25, "2000 USS Arizona Bell Removal"); 				print("<br/>");
makeLightboxFromAlbum(29, "2000 Homecoming"); 								print("<br/>");
makeLightboxFromAlbum(27, "2000 Holiday Party"); 							print("<br/>");
makeLightboxFromAlbum(26, "2000 Halloween"); 								print("<br/>");
makeLightboxFromAlbum(30, "2000 Campaign Arizona Launch"); 					print("<br/>");
makeLightboxFromAlbum(28, "2000 ACUI Conference in New York City"); 		print("<br/>");
?>
</div>
<?php about_finish(); ?>