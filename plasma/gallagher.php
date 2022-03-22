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

<script src="/commontools/jslib/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./plasma_jquery.js"></script>
<script type="text/javascript" >

// this global variable 
// is distinct to each page.
delivPage="get_deliv_block_gallagher.php";

</script>

<title>
Gallagher
</title>
<style type="text/css">
* {cursor: none;}
</style>
</head>

	<body style="overflow:hidden;background-color:#000;">
			<!-- we start out with image_1 having opacity:1, meaning that it is completely visible.
				 image_2 starts out with opacity:0, which means that it is completely invisible.
				 they are the same size and absolutely positioned at the same place. the idea 
				 is decrease the opacity of one image, while increasing the opacity of the other 
				 to make the one that was visible fade out and the one that invisible fade in.			 
			-->
			<div id="image_1" style="width:1600px; height:900px; position:absolute; top:0; left:0; overflow:hidden;" ><?php randomFeed(36); ?></div>
		
			<div id="image_2" style="width:1600px; height:900px; position:absolute; top:0; left:0; overflow:hidden;" >
			<script type="text/javascript">
			  firstLoad();
			</script>
			</div>
	</body>	
	
</html>
