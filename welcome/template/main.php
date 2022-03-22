<?php function page_start($page){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>UA Wildcat Welcome | August 18-29, 2010</title>
<link rel="StyleSheet" href="/welcome/template/main.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="https://studentaffairs.arizona.edu/marketing/weblib/safooter.css" />
<link rel="stylesheet" href="https://union.arizona.edu/commontools/cardtaker/cardtaker.css" type="text/css" />
<script src="https://studentaffairs.arizona.edu/marketing/weblib/safooter.js" type="text/javascript"></script>
<script type="text/javascript" src="https://union.arizona.edu/commontools/cardtaker/cardtaker.js" ></script>
<?php if($page == 'brunchbbq'){?>
<script type="text/javascript" src="template/main.js" ></script>
<?php }?>
</head>
<body>
<div id="top_shadow4">
<div id="top_shadow3">
<div id="top_shadow2">
<div id="top_shadow1">
<div id="page_header_container">
	<div id="UAbanner_div">
		<img src="/welcome/template/images/UAbanner-grey.gif" alt="the University of Arizona" />
    </div>
    <div id="SAheader_div">
        <div id="SAnav_div">
           <div id="SAnav_home_div" class="SAnav_subdiv"  onmouseover="this.childNodes[0].className='opaq_nav nav_hover'" onmouseout="this.childNodes[0].className='opaq_nav'" onmousedown="this.childNodes[0].className+=' nav_click'" onmouseup="this.childNodes[0].className='opaq_nav'"><div class="opaq_nav"></div>
                <h1 id="SAnav_home_h1">
                <a href="http://studentaffairs.arizona.edu/index.php" class="SAnav_a">
                    Home
                </a>
                </h1>
            </div>
            <div id="SAnav_Comm_div" class="SAnav_subdiv" onmouseover="this.childNodes[0].className='opaq_nav nav_hover'" onmouseout="this.childNodes[0].className='opaq_nav'" onmousedown="this.childNodes[0].className+=' nav_click'" onmouseup="this.childNodes[0].className='opaq_nav'"><div class="opaq_nav"></div>
                <div class="nav_wrap">
                <a href="http://studentaffairs.arizona.edu/comm.php" class="SAnav_a">
                    Communications
                </a>
                </div>
            </div>
            <div id="SAnav_pands_div" class="SAnav_subdiv" onmouseover="this.childNodes[0].className='opaq_nav nav_hover'" onmouseout="this.childNodes[0].className='opaq_nav'" onmousedown="this.childNodes[0].className+=' nav_click'" onmouseup="this.childNodes[0].className='opaq_nav'"><div class="opaq_nav"></div>
                <div class="nav_wrap">
                <a href="http://studentaffairs.arizona.edu/programs.php" class="SAnav_a">
                    Programs &amp; Services
                </a>
                </div>
            </div>
            <div id="SAnav_dept_div" class="SAnav_subdiv" onmouseover="this.childNodes[0].className='opaq_nav nav_hover'" onmouseout="this.childNodes[0].className='opaq_nav'" onmousedown="this.childNodes[0].className+=' nav_click'" onmouseup="this.childNodes[0].className='opaq_nav'"><div class="opaq_nav"></div>
                <div class="nav_wrap">
                <a href="http://studentaffairs.arizona.edu/depart.php" class="SAnav_a">
                    Departments
                </a>
                </div>
            </div>
            <div id="SAnav_gandf_div" class="SAnav_subdiv" onmouseover="this.childNodes[0].className='opaq_nav nav_hover'" onmouseout="this.childNodes[0].className='opaq_nav'" onmousedown="this.childNodes[0].className+=' nav_click'" onmouseup="this.childNodes[0].className='opaq_nav'"><div class="opaq_nav"></div>
                <div class="nav_wrap">
                <a href="http://studentaffairs.arizona.edu/grants.php" class="SAnav_a">
                    Grants &amp; Fees
                </a>
                </div>
            </div>
    	</div>
    </div>
    <div id="welcome_header_div">
    	<img src="/welcome/template/images/headers/<?php print $page; ?>.jpg" alt="wildcat welcome"/> 
    </div>
</div>
</div>
</div>
</div>
</div>
<div id="shadow1">
<div id="shadow2">
<div id="shadow3">
<div id="shadow4">
<div id="page_content_container" style="position:relative;">
    <div id="side_nav">
    	<div class="side_nav_elem" <?php if($page == 'home') print 'style="background-color:#EEEFEA;"';?>>
        	<a class="side_nav_a" href="/welcome">General Information</a>
        </div>
         <div class="side_nav_elem" <?php if($page == 'events') print 'style="background-color:#EEEFEA;"';?>>
        	<a class="side_nav_a" href="events.php">Event Schedule</a>
        </div>
         <div class="side_nav_elem" <?php if($page == 'brunchbbq') print 'style="background-color:#EEEFEA;"';?>>
        	<a class="side_nav_a" href="brunchbbq.php">Register for Brunch &amp; BBQ</a>
        </div>
        <div class="side_nav_elem" <?php if($page == 'sponsors') print 'style="background-color:#EEEFEA;"';?>>
        	<a class="side_nav_a" href="sponsors.php">Our Sponsors</a>
        </div>
        
        <!--
         <div class="side_nav_elem" <?php if($page == 'history') print 'style="background-color:#EEEFEA;"';?>>
        	<a class="side_nav_a" href="history.php"><h2>History of Wildcat Welcome</h2></a>
        </div>
        
        -->
        <div id="125logo" style="margin-top:75px;" align="center">
    	<a href="http://uanews.org/node/30341"><img src="template/images/125small.png" alt="125 years" border="0"/></a>
    	</div>
    </div>
    
    <div id="contact_info">
        	<p>
              	Wildcat Welcome<br />
				The University of Arizona<br />
				phone: 520.621.5755 <br />
				email: gfama@email.arizona.edu
        	</p>
        </div>
    <?php }?>
    
<?php function page_end(){ ?>
</div>
</div>
</div>
</div>
</div>

</body>
</html>
<? } ?>