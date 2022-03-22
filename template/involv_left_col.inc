	<div id="left-col">
	  <span>Get Involved</span>
	  <ul>
	    <li><a href="http://arizonaorgs.orgsync.com/" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" class="<?=$page_options['page'] == 'accolades' ? 'active' : '' ?>">Involvement Match Tool</a></li>
	    <li><a href="http://arizonagreek.orgsync.com/" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;"  >Fraternities &amp; Sororities</a></li>
	    <li><a href="https://asuatoday.arizona.edu" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" title="Associated Students of the University of Arizona" >ASUA</a></li>
      <li><a href="http://www.gpsc.arizona.edu/" 
      		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;"  title="Graduate &amp; Professional Student Council">GPSC</a></li>
      <li><a href="http://leadership.arizona.edu" 
      		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Leadership Programs</a></li>
      <li><a href="http://transfer.arizona.edu/" 
      		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Transfer Student Center</a></li>
       
      <li><a href="/involvement/activities/" 
      		class="<?=strpos($page_options['page'], 'uab') !== false ? 'active' : '' ?>">Wildcat Events Board</a>
      <?php if(strpos($page_options['page'], 'uab') !== false){?>
        <ul>
          <li><a href="/involvement/activities/about.php" 
          	class="<?=$page_options['page'] == 'uab-about' ? 'active' : '' ?>">About Us</a></li>
          <li><a href="/involvement/activities/committees.php" 
          	class="<?=$page_options['page'] == 'uab-committees' ? 'active' : '' ?>">Committees</a></li>
        </ul>
        <?php } ?>
      </li>
	  </ul>
	  <span>Events &amp; Entertainment</span>
	  <ul>
	    
	    <li><a href="/involvement/gallagher/" 
	    		class="<?=strpos($page_options['page'], 'gallagher') !== false ? 'active' : '' ?>">Gallagher Theater</a>
        <?php if(strpos($page_options['page'], 'gallagher') !== false){?>
        <ul>
          <li><a href="/involvement/gallagher/booking.php" 
          	class="<?=$page_options['page'] == 'gallagher-booking' ? 'active' : '' ?>">Booking Gallagher</a></li>
        </ul>
        <?php } ?>
      </li>
      <li><a href="/involvement/gamesroom/" 
      	 	class="<?=strpos($page_options['page'], 'gamesroom') !== false ? 'active' : '' ?>">Games Room</a>
		 <!-- Remove Gamesroom/Tournament and Rates.--> 
		<!--	
        <?php if(strpos($page_options['page'], 'gamesroom') !== false){?>
        <ul>
          <li><a href="/involvement/gamesroom/tournaments.php" 
          	class="<?=$page_options['page'] == 'gamesroom-tournament' ? 'active' : '' ?>">Tournaments</a></li>
          <li><a href="/involvement/gamesroom/rates.php" 
          	class="<?=$page_options['page'] == 'gamesroom-rates' ? 'active' : '' ?>">Rates & Rentals</a></li>
        </ul>
        <?php } ?>
		-->
      </li>
	  <!--
      <li><a href="/involvement/galleries/" 
      	 class="<?=strpos($page_options['page'], 'galleries') !== false ? 'active' : '' ?>">Art Galleries</a>
        <?php if(strpos($page_options['page'], 'galleries') !== false){?>
        <ul>
          <li><a href="/involvement/galleries/exhibiting.php" 
          	 class="<?=$page_options['page'] == 'galleries-exhibiting' ? 'active' : '' ?>">Exhibiting in Union Galleries</a></li>
          <li><a href="/involvement/galleries/past.php" class="<?=$page_options['page'] == 'galleries-past' ? 'active' : '' ?>">Past Exhibitions</a></li>
        </ul>
        <?php } ?>
      </li>
	  -->
	  <li><a href="/involvement/live/" >Live @ 5</a></li>
      <li><a href="http://familyweekend.arizona.edu" 
      		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Family Weekend</a></li>
      <!-- <li><a href="/involvement/vendorfairs.php" >Shopping in the Mall</a></li> -->
      <li><a href="http://springfling.arizona.edu/" 
      		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Spring Fling</a></li>
      <li><a href="/events" >Calendar of Events</a></li>
	  </ul>
	  <span>Resources That Help</span>
	  <ul>
	    <!--
	    <li><a href="http://offcampus.arizona.edu" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" title="Off-Campus Housing & Commuter Resources">Off-Campus Housing</a></li>
      	-->
	    <li><a href="http://arizonaorgs.orgsync.com/" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Club Resource Center</a></li>
	    
      	<li><a href="http://wrc.arizona.edu/" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >Women's Resource Center</a></li> 
      	<li><a href="http://deanofstudents.arizona.edu/lgbtqaffairs/" 
	    		onclick="window.open(this.href); return false;"
      		onkeypress="window.open(this.href); return false;" >LGBTQ</a></li> 
	  </ul>
	  <!--
	  <span title="Center for Student Involvement and Leadership">About CSIL!</span>
	  <ul>
	    <li><a href="/csil/Accolades/index.php" 
	    		class="<?=$page_options['page'] == 'accolades' ? 'active' : '' ?>">Accolades Awards</a></li>
	    <li><a href="">Who, What, Where and Why we are</a></li> 
	  </ul>
	  --> 
	</div>
	