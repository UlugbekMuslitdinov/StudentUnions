<?php
############################################
# required for all pages using DELIVERANCE #
############################################

// enables 'edit | view' options to appear for authorized users
session_start();

// includes the display functions
// include("/Library/WebServer/commontools/deliverance/display_functions.php");
include($_SERVER['DOCUMENT_ROOT']."/commontools/deliverance/display_functions.php");

// connect to database
include($_SERVER['DOCUMENT_ROOT']."/commontools/deliverance/inc_db_switch.php");

################################
# end DELIVERANCE requirements #
################################
	// require($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	// require($_SERVER['DOCUMENT_ROOT'] . '/sustainability/sustainability.inc.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/about/template/about.inc');
	include_once('tipsarray.php');
	$page_options['title'] = 'unions sustainability';
	$page_options['page'] = 'Recycling';
	$page_options['header_image'] = '/template/images/banners/sustainability_banner.jpg';
	$page_options['script_incs']= array('/commontools/jslib/jquery.js', '/commontools/jslib/shadowbox/shadowbox.js');
	$page_options['scripts'] = 'Shadowbox.init();';
	$dining_options['ssheets'][] = '/commontools/jslib/shadowbox/shadowbox.css';
	about_start($page_options);
	
	//determine 10 random tips
	for ($i = 0; $i < 10; $i++) {
		$arrayVal = rand(1,59);
		$useTip[$i] = isset($greenTips[$arrayVal]) ? $greenTips[$arrayVal] : '';
		
		for ($j=0; $j<$i-1; $j++) {
			if ($useTip[$i] == $useTip[$j]) {
				//print $i;
				//print $j;
				//print "<br>";
				$i--;
			}
		}
	}
	
?>

<!--[if lt IE 7]>
        <script type="text/javascript" src="unitpngfix.js"></script>
<![endif]-->

<script type="text/javascript">
/*****

Image Cross Fade Redux
Version 1.0
Last revision: 02.15.2006
steve@slayeroffice.com

Please leave this notice intact. 

Rewrite of old code found here: http://slayeroffice.com/code/imageCrossFade/index.html


*****/

/*function spanVisibility() {
for (i=1; i < 6; i++) {
			spanid = i
			showSpan(spanid)
				
			for (i=1; i < 6; i++) {
				if (spanid != i){
				hideSpan(i)
					}
				}
			setTimeout(spanVisibility,200);
		if (i == 5) {
		i = 1;
		}
	}
}
 


function hideSpan(i) { 
if (document.getElementById) {  // DOM3 = IE5, NS6 
document.getElementById("span" + i).style.display = 'none'; 
} else {
document.poppedLayer =   
        eval('document.layers["span"+i]');
  document.poppedLayer.style.display = "none";
  }

}

function showSpan(i) { 
if (document.getElementById) { // DOM3 = IE5, NS6 
document.getElementById("span"+i).style.display = 'block'; 
} else {
document.poppedLayer =   
        eval('document.layers["span"+i]');
  document.poppedLayer.style.display = "block";
  }


}*/






/*
function showSpan(i) { 
if (document.getElementById) { // DOM3 = IE5, NS6 
alert('start');
document.getElementById('span'+i).style.display = 'block'; 
alert('done');
} else {
document.poppedLayer =   
        eval('document.layers["span"+i]');
  document.poppedLayer.style.display = "block";
  }

}
*/


tipsUse = new Array();

tipsUse[0] = "<?php print $useTip[0]; ?>";
tipsUse[1] = "<?php print $useTip[1]; ?>";
tipsUse[2] = "<?php print $useTip[2]; ?>";
tipsUse[3] = "<?php print $useTip[3]; ?>";
tipsUse[4] = "<?php print $useTip[4]; ?>";
tipsUse[5] = "<?php print $useTip[5]; ?>";
tipsUse[6] = "<?php print $useTip[6]; ?>";
tipsUse[7] = "<?php print $useTip[7]; ?>";
tipsUse[8] = "<?php print $useTip[8]; ?>";
tipsUse[9] = "<?php print $useTip[9]; ?>";


function tipRotate(num){

	//alert(num + " this is num");

	el = document.getElementById('tips');
	//alert(el);
	
	el.innerHTML = tipsUse[num];

	setTimeout("tipRotate(Math.floor(Math.random()* 9))",8001);

}

// Attempt to make rotating tips


	
</script>

<style>

.linkbreak {
color:#59ad40;
margin-top:-5px;
}

.top_links a {
text-decoration:none;
color:#000000;
/* font-size:11px; */

}

.top_links a:visited {
/* font-size:11px; */
}

p{
  margin:10px 0px;
}

#right-col img{
  margin-bottom: 5px;
}
</style>
<?php

?>


<div class="col" style=" min-height:700px; padding-left:24px; padding-top:20px;">

<h1 class="mb-2">Sustainability at The Unions</h1>
  
	<div class="top_links" style="display:none;">
		<h4 style="line-height:8px; margin-bottom:10px; font-size:22px;">sustainability at the unions</h4>
		<a href="index.php">home</a> <span class="linkbreak">|</span> 
		<a href="efforts.php">efforts</a> <span class="linkbreak">|</span> 
		<a href="committee.php">committee</a> <span class="linkbreak">|</span> 
		<a href="links.php">links</a> <span class="linkbreak">|</span> 
		<a href="action.php">take action</a>
	</div>
	
<div>
