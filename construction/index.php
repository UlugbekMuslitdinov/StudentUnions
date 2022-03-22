<?php
	if (!isset ($_SESSION)) {
	session_start();
}

	require_once($_SERVER['DOCUMENT_ROOT'] . '/template/about.inc');
	$page_options['title'] = 'Arizona Student Unions Photo Gallery';
    $page_options['page'] = 'gallery';
	about_start($page_options);
	$_SESSION['picasaEmail'] = "azstudentunion@gmail.com";
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/phplib/phototool/albumFunctions.inc');
?>

<script type="text/javascript" src="/commontools/jslib/lightbox2/js/prototype.js"></script>
<script type="text/javascript" src="/commontools/jslib/lightbox2/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="/commontools/jslib/lightbox2/js/lightbox.js"></script>

<link rel="stylesheet" href="/commontools/jslib/lightbox2/css/lightbox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/template/gallerylink.css" type="text/css" media="screen" />

<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
<script type="text/javascript">jQuery.noConflict();</script>


<h1>Student Union Memorial Center and Park Student Union Construction</h1>
<br/>
Construction of the Student Union Memorial Center began in 1999 and concluded early in 2003. <!-- February 17-22, 2003 --><br/>
The PSU closed December 21, 2002 for renovation and reopened in late Fall of 2003.<br/><br/>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" bgcolor="white">
        <tbody>
        	<tr>
                <td width="400px" valign="top">
                <div style="padding: 6px;"><b>Videos</b><br />
                <a href="/construction/timelapse/index.php">Construction Timelapse</a><br/>
                <a href="/construction/webcam/111599.mov" target="_blank">Demolition of the Gallagher Roof Structure</a> 2.8mb<br>
				<a href="/construction/news/010814-tower/tower_demolition.mov" target="_blank">Demolition of the Clock Tower</a> 3.6mb<br>
				<a href="/construction/webcam/020711_grass.mov" target="_blank">Grass Seeding on the Mall</a> (Jul 11, 2002) 13.2mb
                </div>
                <br/>
                <div style="position: relative">
                <div class="collapse" style="height: 12px; overflow: hidden; position: absolute; padding: 5px; background-color: white; border-style: solid; border-width: 1px; width: 370px;">
                    <a href="#"><b>Articles</b></a>
                    <p><a href="http://uanews.org/node/7336">Student Union Creates Time Capsule</a><br>Jan 3, 2003</p>
                    <p><a href="http://uanews.org/node/7319">Wells Fargo New Banking Partner</a><br>Dec 13, 2002</p>
                    <p><a href="http://uanews.org/node/7300">1,511 Dog Tags Installed in USS Arizona Sculpture on Pearl Harbor Day</a><br>Dec 6, 2002</p>
                    <p><a href="http://uanews.org/node/7054">Student Union Plans Grand Opening Celebration</a><br>Oct 17, 2002</p>
                    <p><a href="http://uanews.org/node/6773">Student Union in Final Phase of Construction</a><br>Aug 16, 2002</p>
                    <p><a href="http://uanews.org/node/6772">Bell from USS Arizona to New Home</a><br>Aug 16, 2002</p>
                    <p><a href="http://uanews.org/node/6761">Arizona Bell To Hang In Union</a><br>Aug 15, 2002</p>
                    <p><a href="http://uanews.org/node/5131">Notes on the Old Student Union</a><br>Aug 7, 2001</p>
                    <p><a href="http://uanews.org/node/5001">Fast Copy in New Location</a><br>Jun 26, 2001</p>
                    <p><a href="http://uanews.org/node/4705">UA Bookstore Celebrates Opening</a><br>Apr 16, 2001</p>
                    <p><a href="http://uanews.org/node/4702">UofA Bookstore, Student Union Invite Community to Grand Opening</a><br>Apr 13, 2001</p>
                    <p><a href="http://uanews.org/node/4553">Students, Bookstore Move Into Newly Constructed Space</a><br>Mar 16, 2001</p>
                    <hr />
                    <p><a href="/construction/news/020101-news/index.php"><b>Phase I Complete</b></a></p>
                    <p><a href="/construction/news/020124-dome/index.php"><b>Dome Steel Installed</b></a><br>
                        Jan 24, 2002</p>
                    <p><b><a href="/construction/news/010814-tower/index.php">Clock Tower Demolition</a></b><br>
                        Aug 14, 2001</p>
                    <p><a href="/construction/newname.php" ><b>Student Union Memorial Center Chosen For New Name</b></a></p>
                </div>
                </div>
                </td>
            	<td><img src="/construction/timelapse/timelapse_image.jpg" alt="" height="121" width="150" border="0"></td>
            </tr>
        </tbody>
        </table>
        <br/>
        <table>
        <tbody>
        	<tr>
                <td valign="top" style="width: 270px;">
                	<b>Photo Galleries</b>
                    <div class="gallerylink" style="margin-top:8px; padding-left: 5px">
                    <?php
                    	makeLightboxFromAlbum(50,  "Construction 1999 (Part 1)"); 			print("<br/>");
						makeLightboxFromAlbum(51,  "Construction 1999 (Part 2)"); 			print("<br/>");
						makeLightboxFromAlbum(52,  "Construction 2000 (Part 1)"); 			print("<br/>");
						makeLightboxFromAlbum(53,  "Construction 2000 (Part 2)"); 			print("<br/>");
						makeLightboxFromAlbum(54,  "Construction 2001 (Part 1)"); 			print("<br/>");
						makeLightboxFromAlbum(55,  "Construction 2001 (Part 2)"); 			print("<br/>");
						makeLightboxFromAlbum(56,  "Construction 2001 (Part 3)"); 			print("<br/>");
						makeLightboxFromAlbum(57,  "Construction 2001 (Part 4)"); 			print("<br/>");
						makeLightboxFromAlbum(58,  "Construction 2001 (Part 5)"); 			print("<br/>");
						makeLightboxFromAlbum(59,  "Construction 2001 (Part 6)"); 			print("<br/>");
						makeLightboxFromAlbum(60,  "Construction 2001 (Part 7)"); 			print("<br/>");
						makeLightboxFromAlbum(61,  "Construction 2001 (Part 8)"); 			print("<br/>");
						makeLightboxFromAlbum(62,  "Construction 2002 (Part 1)"); 			print("<br/>");
						makeLightboxFromAlbum(63,  "Construction 2002 (Part 2)"); 			print("<br/>");
						makeLightboxFromAlbum(64,  "Construction 2002 (Part 3)"); 			print("<br/>");
						makeLightboxFromAlbum(65,  "Construction 2002 (Part 4)"); 			print("<br/>");
						makeLightboxFromAlbum(66,  "Construction 2002 (Part 5)"); 			print("<br/>");
						makeLightboxFromAlbum(67,  "Construction 2002 (Part 6)"); 			print("<br/>");
						makeLightboxFromAlbum(68,  "Construction 2002 (Part 7)"); 			print("<br/>");
						makeLightboxFromAlbum(69,  "Construction 2002 (Part 8)"); 			print("<br/>");
						makeLightboxFromAlbum(70,  "Construction 2003"); 					print("<br/>");
						makeLightboxFromAlbum(71,  "Construction Timeline (Part 1)"); 		print("<br/>");
						makeLightboxFromAlbum(72,  "Construction Timeline (Part 2)"); 		print("<br/>");
						makeLightboxFromAlbum(73,  "Construction Timeline (Part 3)"); 		print("<br/>");
                    ?>
                    </div>
				</td>
            	<td valign="top">
                	<br/>
                	<b>Student Union Memorial Center Facts</b>
                    <p><b style="font-size:10px">Steel Used:</b></p>
                    <table width="100%" border="0" cellspacing="2" cellpadding="0">
                        <tr>
                            <td style="font-size:10px">Re-Bar</td><td style="font-size:10px">1540 Tons</td><td style="font-size:10px">3,080,000 lbs.</td>
                        </tr>
                        <tr>
                            <td style="font-size:10px">Structural Steel</td><td style="font-size:10px">1980 Tons</td><td style="font-size:10px">3,960,000 lbs.</td>
                        </tr>
                        <tr>
                            <td style="font-size:10px">Misc.</td><td style="font-size:10px">580 Tons</td><td style="font-size:10px">1,160,000 lbs.</td>
                        </tr>
                        <tr>
                            <td><b style="font-size:10px">Total</b></td><td></td><td><b style="font-size:10px">8,200,000 lbs.</b></td>
                        </tr>
                    </table>
                    <p style="font-size:10px">Square Footage of the flooring is 440,000 sq. ft.</p>
                    <p><b style="font-size:10px">Cubic Yards of Concrete Used:</b></p>
                    <table width="100%" border="0" cellspacing="2" cellpadding="0">
                        <tr>
                            <td style="font-size:10px">Footings</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td style="font-size:10px">6,500 Cu. Yds.</td>
                        </tr>
                        <tr>
                            <td style="font-size:10px">Slabs/Decks</td><td></td><td style="font-size:10px">7,200 Cu. Yds.</td>
                        </tr>
                        <tr>
                            <td style="font-size:10px">Walls</td><td></td><td style="font-size:10px">4,300 Cu. Yds.</td>
                        </tr>
                        <tr>
                            <td><b style="font-size:10px">Total</b></td><td></td><td><b style="font-size:10px">18,000 Cu. Yds.</b></td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td style="font-size:10px">Excavation</td><td></td><td style="font-size:10px">1,460,000 Cu. Yds.</td>
                        </tr>
                    </table>
                    <br/>
                    <img src="aerial.jpg" width="250px" height="auto"/>
                </td>
			</tr>
		</table>
            
<script type="text/javascript">
	var moving = 0;
	var collapseNeeded = 0;
	jQuery(".collapse").hover(
			function()
			{
				if(!moving)
				{
					moving = 1;
					jQuery(this).animate({"height": "150px"}, 300, function(){
																	   jQuery(this).css("overflow", "auto");
																	   moving = 0;
																	   if(collapseNeeded)
																	   	jQuery(this).animate({"height": "12px"}, 300, function(){jQuery(this).css("overflow", "hidden"); jQuery(this).scrollTop(0); collapseNeeded = 0;});
																	   });
				}
			},
			function()
			{
				if(!moving)
				{
					moving = 1;
					jQuery(this).animate({"height": "12px"}, 300, function(){jQuery(this).css("overflow", "hidden"); jQuery(this).scrollTop(0); moving = 0;});
				}
				else collapseNeeded = 1;
			}
		);
</script>
            
<? about_finish(); ?>