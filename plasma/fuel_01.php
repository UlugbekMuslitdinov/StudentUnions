<?php 

	###########################################
	# required for all pages using DELIVERANCE #
	############################################
	
	// enables 'edit | view' options to appear for authorized users
	session_start();
	
	// includes the display functions
	include($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/display_functions.php");
	
	// connect to database
	include($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/inc_db_switch.php");
	
	################################
	# end DELIVERANCE requirements #
	################################
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="./plasma.js"></script>
<script type="text/javascript" >

// this global variable 
// is distinct to each page.
delivPage="get_deliv_block_fuel_01.php";

</script>
<style type="text/css">
* {cursor: none;}
</style>
<title>
Fuel Display 1
</title>

</head>

	<body style="overflow:hidden;background-color:#000;">
			<!-- we start out with image_1 having opacity:1, meaning that it is completely visible.
				 image_2 starts out with opacity:0, which means that it is completely invisible.
				 they are the same size and absolutely positioned at the same place. the idea 
				 is decrease the opacity of one image, while increasing the opacity of the other 
				 to make the one that was visible fade out and the one that invisible fade in.			 
			-->
			<div id="image_1" style="opacity:1; width:1920px; height:1080px; position:absolute; top:0; left:0; overflow:hidden;" ><?php randomFeed(29); ?></div>
		
			<div id="image_2" style="opacity:0; width:1920px; height:1080px; position:absolute; top:0; left:0; overflow:hidden;" >
			<script type="text/javascript">
			  firstLoad();
			</script>
			</div>
	</body>	
	
</html>
