<script>
	$(document).ready(function() {
		// Collapse everything
		$(".VerColMenu > li > a").find("+ ul").slideUp(1);
		// Expand or collapse:
		$(".VerColMenu > li > a").click(function() {
			$(this).find("+ ul").slideToggle("fast");
			$(this).toggleClass("bold");
			$(this).toggleClass("expanded").toggleClass("collapsed");
		});
	});
</script>
<style>
	.VerColMenu a.expanded {
 	    background: url('/template/images/arrow-up.gif');
 	    background-repeat:no-repeat;
        background-position: 98% 50%;
 	}
 	.VerColMenu a.collapsed {
 	    background-image:url(/template/images/arrow-down.gif);
        background-repeat:no-repeat;
        background-position: 98% 50%;
 	}
</style>
<div id="left-col" style="margin-left:  -.75em; padding-left:  10px;" >
	<ul style="list-style-type: none; line-height: 1em; margin-left: .25em; margin-bottom:0;" >
		<li>
			<a href="/catering/index.php" >Home</a>
		</li>
		<!--
		<li>
			<a href="/template/resources/menus/Arizona_Catering_Company_Menu_7_18RVSD.pdf" onclick="window.open(this.href); return false;" onkeypress="window.open(this.href); return false;">Menu</a>
		</li>
		-->
	</ul>
    
    <!-- Removing Menu button to Old Links
	<ul class="VerColMenu">
		<li>
			<a title="Click to open or close this section" class="collapsed" href="#" style="list-style-type: none; line-height: 1em; margin-left: .5em;margin-top:0; margin-bottom: .1em;" >Menu</a>
			<ul style="list-style-type: none; line-height: 1em; margin-left: 1.25em;margin-top:.25em;" >
				
				<li>
					<a href="/template/resources/menus/Arizona_Catering_Company_Menu_Breakfast.pdf"
						onclick="window.open(this.href); return false;"
						onkeypress="window.open(this.href); return false;" >Breakfast</a>
				</li>
				<li>
					<a href="/template/resources/menus/Arizona_Catering_Company_Menu_Lunch.pdf"
						onclick="window.open(this.href); return false;"
						onkeypress="window.open(this.href); return false;" >Lunch</a>
				</li>
				<li>
					<a href="/template/resources/menus/Arizona_Catering_Company_Menu_Dinner.pdf"
						onclick="window.open(this.href); return false;"
						onkeypress="window.open(this.href); return false;" >Dinner</a>
				</li>
				
				<li>
					<a href="/template/resources/menus/Arizona_Catering_Company_Menu_Bakery.pdf"
						onclick="window.open(this.href); return false;"
						onkeypress="window.open(this.href); return false;" >From The Bakery</a>
				</li>
				<li>
					<a href="/template/resources/menus/Arizona_Catering_Company_Menu_Reception_Packages.pdf"
						onclick="window.open(this.href); return false;"
						onkeypress="window.open(this.href); return false;" >Reception Packages</a>
				</li>
			</ul>
		</li>
	</ul>
    -->
    
    
	<ul class="VerColMenu">
		<li>
			<a title="Click to open or close this section" class="collapsed" href="#" style="list-style-type: none; line-height: 1em; margin-left: .5em;margin-top:.1em; margin-bottom: .1em;" >Policies</a>
			<ul style="list-style-type: none; line-height: 1em; margin-left: 1.25em;margin-top:.25em;" >
				<li>
					<a href="/template/resources/menus/Arizona_Catering_Company_Policies_2016.pdf" onclick="window.open(this.href); return false;"
				onkeypress="window.open(this.href); return false;">Catering Policies</a>
				</li>
               <!-- Removing the button linked to an Error page.
				<li>
					<a href="http://policy.arizona.edu/catering-policy"
						onclick="window.open(this.href); return false;"
						onkeypress="window.open(this.href); return false;">Food Policy</a>
				</li>
                -->
				<li>
					<a href="/alcohol/" >Alcohol Permit</a>
				</li>
			</ul>
		</li>
	</ul>
	<ul style="list-style-type: none; line-height: 1em; margin-left: .25em;margin-top:.1em;" >
		<li>
			<a href="/rooms/reserving.php">Meeting Room Request</a>
		</li>
		<li>
			<a href="/catering/catering_event_inquiry_1.php" >Catering/Event Inquiry</a>
		</li>
		<li>
			<a href="/catering/catering_waiver.php" >Catering Waiver</a>
		</li>
		<li>
			<a href="/catering/contact_us.php" >Contact Us</a>
		</li>
		<li>
			<a href="/catering/team.php" >The Team</a>
		</li>
		<!--<li>
			<a href="/catering/gallery.php" >Gallery</a>
		</li>-->
        
        <!--- Remove button to the Error page
		<li>
			<a href="/infodesk/maps/SUMCMapHandout.pdf"
				onclick="window.open(this.href); return false;"
				onkeypress="window.open(this.href); return false;" >Venues</a>
		</li>
        --->

	</ul>
	<!--
	<ul class="VerColMenu">
		<li>

			<a title="Click to open or close this section" class="collapsed" href="#" style="list-style-type: none; line-height: 1em; margin-left: .5em;margin-top:0; margin-bottom: .1em;" >Weddings</a>
			<ul style="list-style-type: none; line-height: 1em; margin-left: 1.25em;margin-top:.25em;" >
				<li>
					<a href="/catering/weddings.php" >Weddings at UA</a>
				</li>
				<li>
					<a href="wedding_request_information_1.php" >Request Information</a>
				</li>
				<li>
					<a href="#" >Wedding Menus</a>
				</li>
			</ul>
		</li>
	</ul>
	-->
</div>
