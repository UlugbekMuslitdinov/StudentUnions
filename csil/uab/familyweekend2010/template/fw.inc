<?php

//make sure session is always active
session_start();

/**
 * Start a page with family weekend template
 * 
 * @param $page name of the page to start. Mostly used when set active item in nav bar( see nav_bar.inc and nav_bar_reg.inc)
 * @param $non_registration should be set to 0 when on a registration page
 * @return void
 */

function fw_start($page, $non_registration = 1){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Family Weekend 2010 | The University of Arizona</title>
	<link rel="stylesheet" href="/commontools/cardtaker/cardtaker.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="template/fw.css" />
<?php if($non_registration){?>	
	<script type="text/javascript" src="template/fw.js"></script>
<?php }?>		
	<script type="text/javascript" src="/commontools/cardtaker/cardtaker.js" ></script>
</head>
<body>

<div id="UA_banner">
<a href="http://www.arizona.edu" title="The University of Arizona"><img border="0" src="template/images/UAlogo_grey.gif" alt="The University of Arizona" /></a>
</div>

<div id="main" align="center">
	<div id="centered_content">

		<div id="FW_top_bar">
			<!--  this div provides spacing at the top  -->			
    	</div>
<?php 

	if($non_registration){
?>
		<div id="image_div">
			<div id="imageContainer">
            <!--When you add an image to the rotation you have to make sure there is a matching img_div_content array in the Java Script-->
			<img class="xfade_imgs" src="template/images/fw10-1.jpg" alt="Family Weekend 2010" />
			<img class="xfade_imgs" src="template/images/fw10-2.jpg" alt="Family Weekend 2010" />
            <img class="xfade_imgs" src="template/images/fw10-3.jpg" alt="Family Weekend 2010" />
			</div>
		
			<div id="bird">
			</div>

        
	
		</div>
<?php 
		require 'template/nav_bar.inc'; 
	}
	else{
		require 'template/nav_bar_reg.inc';	
	}
?>


		<div id="text_section" style="line-height:20px;">

<?php 
}

/**
 * Fnish a page with family weekend template
 * 
 * @return void
 */
function fw_finish(){

?>

		</div> <!-- End of "text_section" div -->

    </div>  <!-- End of "centered_content" div -->
</div>  <!-- End of "main" div -->

<div id="bottom_bar" align="center">

	<div style="width:800px;">
    
    	<!--<div class="bar_item">
			<a href="http://www.union.arizona.edu/csil/uab" target="_blank"><img border="0" src="images/sponsors/boardweb.gif" alt="The Board"></a>
    	</div>-->
        
        <div class="bar_item" style="padding-top:8px;">
    		Family Weekend at The University of Arizona<br /> 
	    	is brought to you by ASUA.<br />
			520-621-2782 | uabfamw@email.arizona.edu
    	</div>
    
   		<div class="bar_item">
    		<a href="http://www.union.arizona.edu/csil" target="_blank"><img border="0" src="template/images/CSILlogo_FW.gif" alt="Center for Student Involvement and Leadership" /></a>
    	</div>
        
        <div class="bar_item">
    		<a href="http://www.asua.arizona.edu" target="_blank"><img border="0" src="template/images/sponsors/asua.gif" alt="ASUA" style="padding-top:5px;" /></a>
    	</div>
        
    	<div class="bar_item">
    		<a href="http://www.uafamily.arizona.edu" target="_blank"><img border="0" src="template/images/sponsors/parentweb.gif" alt="UA Parents" /></a>
    	</div>
    
    	<div class="bar_item">
    		<a href="http://www.union.arizona.edu" target="_blank"><img border="0" src="template/images/sponsors/sulogo.gif" alt="Student Union Memorial Center" /></a>
    	</div>
        
    	<div class="bar_item" style="padding-top:18px; font-size:12px;">
    		<a href="mailto:uabfamw@email.arizona.edu">Add an Event | Request a Refund</a>
    	</div>
        
    	<div style="clear:left; line-height:0px;">&nbsp;</div>
    </div>
    
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-2336720-8");
pageTracker._initData();
pageTracker._trackPageview();
</script>

    
</body>

</html>
<?php 
}
?>