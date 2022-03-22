<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/template/global.inc');

function involv_start($page_options){ global $page_options;
	// if($_SESSION['mobile_browser']){
	// 	mobile_involv_start($page_options);
	// 	return true;
	// }
	$page_options['script_incs']= array('/commontools/jslib/jquery.js', '/commontools/jslib/shadowbox/shadowbox.js');
	$dining_options['scripts'] = 'Shadowbox.init();';
	
	$dining_options['ssheets'][] = '/commontools/jslib/shadowbox/shadowbox.css';
	
	$dining_options['ssheets'][] = '/involvement/template/involv.css';
	
	$dining_options['ad1'] = '<a href="http://www.youtube.com/embed/bLwPx_bsGto?autoplay=1" rel="shadowbox;width=560;height=347;"><img src="/involvement/template/images/NYR_SPFfilmStill.jpg" /></a>';
	
	$page_options = array_merge($dining_options, $page_options);

	############################################
	# required for all pages using DELIVERANCE #
	############################################
 
	// enables 'edit | view' options to appear for authorized users

	// connect to database
	require_once($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/inc_db_switch.php");

	// includes the display functions
	require_once($_SERVER['DOCUMENT_ROOT'] . "/commontools/deliverance/display_functions.php");

	################################
	# end DELIVERANCE requirements #
	################################

	// banner served by Deliverance
	ob_start();
	sequentialFeed(43);
	$header = ob_get_clean();

	// BEGIN added support for Deliverance based banner
	if($page_options['header_image']){
		$header = '<img id="dining-header-img" src="'.$page_options['header_image'].'" width="950"/>';
	}
	unset($page_options['header_image']);
	// END added support for Deliverance based banner
	
	page_start('Dining');
?>
	<!-- BEGIN added support for Deliverance based banner -->
	<div class="col-md-12 wrap-banner-img">
		<?=$header?>
	</div>
	<!-- END added support for Deliverance based banner -->	

	<!-- Left Col -->
	<div class="col wrap-left-col">
    <div id="left-col" class="wrap-left-col-menu">
		<h2 class="left-col-menu-header">Get Involved</h2>
	  <ul>
	    <li><a href="http://arizonaorgs.orgsync.com/" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" class="">Involvement Match Tool</a></li>
	    <li><a href="http://arizonagreek.orgsync.com/" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;"  >Fraternities &amp; Sororities</a></li>
	    <li><a href="http://asua.arizona.edu/ASUASite/ASUA.html" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" title="Associated Students of the University of Arizona" >ASUA</a></li>
      <li><a href="http://www.gpsc.arizona.edu/" 
      		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;"  title="Graduate &amp; Professional Student Council">GPSC</a></li>
      <li><a href="http://arizonaleadership.orgsync.com" 
      		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Leadership Programs</a></li>
      <li><a href="http://transfer.arizona.edu/" 
      		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Transfer Student Center</a></li>
       
      <li><a href="/involvement/activities/" class="">Wildcat Events Board</a>
      <?php if(isset($page_options['page']) && strpos($page_options['page'], 'uab') !== false){?>
        <ul>
          <li><a href="/involvement/activities/about.php" 
          	class="">About Us</a></li>
          <li><a href="/involvement/activities/committees.php" 
          	class="">Committees</a></li>
        </ul>
        <?php }?>
      </li>
       
      <li><a href="http://studentaffairs.arizona.edu/programs/vets/office/" 
      		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >VETS Student Center</a></li>
	  </ul>
	  <h2 class="left-col-menu-header">Events &amp; Entertainment</h2>
	  <ul>
	    
	    <li><a href="/involvement/gallagher/" 
	    		class="">Gallagher Theater</a>
        <?php if(isset($page_options['page']) && strpos($page_options['page'], 'gallagher') !== false){?>
        <ul>
          <li><a href="/involvement/gallagher/booking.php" 
          	class="">Booking Gallagher</a></li>
        </ul>
        <?php }?>
      </li>
      <li><a href="/involvement/gamesroom/" 
      	 	class="">Games Room</a>
            
            <!--
        <?php if(isset($page_options['page']) && strpos($page_options['page'], 'gamesroom') !== false){?>
        <ul>
          <li><a href="/involvement/gamesroom/tournaments.php" 
          	class="">Tournaments</a></li>
          <li><a href="/involvement/gamesroom/rates.php" 
          	class="">Rates & Rentals</a></li>
          
        </ul>
        <?php }?>
        -->
        
      </li>
      <li><a href="/involvement/galleries/" class="">Art Galleries</a>
        <?php if(isset($page_options['page']) && strpos($page_options['page'], 'galleries') !== false){?>
        <ul>
          <li><a href="/involvement/galleries/exhibiting.php" 
          	 class="">Exhibiting in Union Galleries</a></li>
          <!--
          <li><a href="/involvement/galleries/past.php" class="">Past Exhibitions</a></li>
          -->
        </ul>
        <?php }?>
      </li>
      <li><a href="http://familyweekend.arizona.edu" 
      		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Family Weekend</a></li>
      <!-- <li><a href="/involvement/vendorfairs.php" >Shopping in the Mall</a></li> -->
      <li><a href="http://springfling.asua.arizona.edu/Spring_Fling/Welcome.html" 
      		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Spring Fling</a></li>
      <li><a href="/events" >Calendar of Events</a></li>
	  </ul>
	  <h2 class="left-col-menu-header">Resources That Help</h2>
	  <ul>
	    <li><a href="http://offcampus.arizona.edu" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" title="Off-Campus Housing & Commuter Resources">Off-Campus Housing</a></li>
	    <li><a href="http://clubs.asua.arizona.edu/clubs/home.html" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Club Resource Center</a></li>
	    <li><a href="http://legal.asua.arizona.edu/Legal_Sevices/Home.html" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >ASUA Legal Services</a></li>
	    <li><a href="/csil/clubs/CorpSpons/" >Money for events!</a></li>
	    <li><a href="http://arizonaleadership.orgsync.com/org/atlas" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Leadership Training</a></li> 
	  </ul>
	  <!--
	  <span title="Center for Student Involvement and Leadership">About CSIL!</span>
	  <ul>
	    <li><a href="/csil/Accolades/index.php" 
	    		class="">Accolades Awards</a></li>
	    <li><a href="">Who, What, Where and Why we are</a></li> 
	  </ul>
		-->
		</div>
	</div>
	<div class="col mt-3">
	
<?php 
}

function involv_finish(){
?>
	</div>

	<!-- Right Col -->
	<div id="right-col" class="col">

		<?php
			if (isset($page_options['ad1'])){
				echo $page_options['ad1'];
			}

			//
			randomFeed(37);
			sequentialFeed(38);
		?>
		<a href="/events" ><img src="/dining/template/images/events_btn.jpg" alt="events" /></a>
		<a href="/about/marketing/ask.php" ><img src="/dining/template/images/feedback_btn.jpg" alt="contact" /></a>
		<a href="/tellus" ><img src="/dining/template/images/tellus_btn.jpg" alt="donate" /></a>
	</div>
<?php 
	page_finish();
}

function mobile_involv_start($page_options){ global $page_options;
	
			
	page_start();
	
	?>
	
	<?php
}
function mobile_involv_finish(){
	?>
	<!-- <div style="clear:both;"></div></div></div> -->
<?php
	page_finish();
}
 /*
function makeHeader($title = "", $back = false, $alt = "")
	{?>
		<div id="pageTitleBarContainer" >
			
			<div id="pageTitle"><?=$title?></div>
			<div id="pageTitleBar">
				
				<div id="altButton" style="display: <?= ($alt == "")?"none":"" ?>">
					<span><img src="/template/images/menu_button.png" height="90%"/></span>
				</div>
				<div id="pageTitleBreak" align="center" style="margin-top:3px;">
					<a href="/involvement"><img src="/template/images/involvement_icon.png" /></a>
					<a href="/shopping"><img src="/template/images/services_icon.png" style="margin:0px 10px;" /></a>
					<a href="http://m.union.arizona.edu/dining"><img src="/template/images/dining_icon.png" /></a>
				</div>
				<div id="backButton" style="display: <?= ($back)?"":"" ?>" onclick="window.location='/'">
					<span><img src="/template/images/home_button.png" height="90%" /></span>
				</div>
			</div>
			
		</div>
			
		
		
		<div id="loadingDiv"><div id="loadingPanel"><div id="loadingText">Loading...</div></div></div>
		
		<?php
	}
*/