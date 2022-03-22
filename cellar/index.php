<?php
	require('sectioninfo.inc');
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$title = 'the cellar';
	page_start($title);
?>

<script type="text/javascript" >
		// just go to the gamesroom page, because this
		// page is no longer valid.
		location.href="/involvement/gamesroom/index.php"; 
	
</script>

<h4>the cellar</h4>

<p style="font-size:12px">Located in the SUMC Lower Level, The Cellar offers food, fun, and entertainment. Whether you're looking for a competitive game of billiards or just to relax between classes, come see what we have to offer!</font></p>



<table border="0" cellpadding="0" cellspacing="10">
	<tr>
	  <td valign="top" width="120px" align="center"><p><a href="/cellar/gamesroom/index.php"><img src="/cellar/gamesrmweb.jpg" alt="" height="65" width="120" border="0"></a></td>
      <td>
		<b><a href="/cellar/gamesroom/index.php">Games Room</a><br>
		</b>Brand new billiard tables, snooker table, table tennis, and tons of  video games! Weekly tournaments and daily specials. Oh, and did we mention that you can rent it all out for exciting events? Why spend your late nights bored in your room? Call 621-1450 or  <a href="mailto:uagames@email.arizona.edu">email uagames@email.arizona.edu</a><br /></td>
	</tr>
	<tr>
	  <td valign="top" align="center"><p><a href="/dining/sumc/cellar/index.php"><img src="/cellar/cellar_shake120.jpg" alt="" height="62" width="120" border="0"></a></p></td>
      <td><h4></h4>
						<b><a href="/dining/sumc/cellar/index.php">Cellar Bistro</a></b><br />
						Enjoy great food, late night breakfasts, classic burgers, salads, coffees, and more. Across from the Games Room, the Cellar Bistro &amp; Lounge satisfies your appetite while the big game shows on the big screen or live music, poetry slams, or comedy plays live on stage.						</p>	</td>
  </tr>
  	<tr>
	  <td valign="top"><p><img src="TVlounge.gif" alt="TV Lounge" height="65" width="120" border="0"></td>
      <td>
			<b>TV Lounge</b><br />
			Find a couch, relax and watch your favorite TV show</td>
  </tr>
  	<tr>
	  <td valign="top"><p><img src="/cellar/computerlabweb.jpg" alt="WU Computer Lab" height="65" width="120" border="0"></td>
      <td>
      		<b>Computer Lab</b><br />
			Do your homework or browse the web on these brand new PCs.</td>
  </tr>
</table>
<!-- <p><?php include('http://union.arizona.edu/cgi-bin/WebObjects/EventsCalendar.woa/wa/singleCategoryView?key=wilburs') ?></p> -->
<!-- <p><?php printLocationHours(8) ?></p> -->
<?php page_finish(); ?>
