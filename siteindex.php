<?php
	require($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Site Index';
  $page_options['styles'] = '#page-content-container ul{ margin-left:20px;}';
  page_start($page_options);
?>
<center>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#333333" style="margin-top:20px;">
?>
<table border="0" cellpadding="1" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td>
			<table border="0" cellpadding="16" cellspacing="0" width="100%">
				<tr>
					<td bgcolor="white">
						<p></p>
						<p><img src="/common/images/findit.gif" width="203" height="21" border="0" alt="find what you want..."></p>
						<p><img src="/common/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b>www.union.arizona.edu Site Search</b></p>
						<p>This search will allow you to search the contents of the pages on the local site.</p>
						<p></p>
						<form method="get" action="http://www.union.arizona.edu/cgi-bin/search.cgi">
							Search: <input type="text" size="30" name="q"> <input type="submit" value="Search">
						</form>
						<p></p>
						<p><img src="/common/images/foursquares_white.gif" width="62" height="30"></p>
						<p><img src="/common/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<a href="http://www.arizona.edu/index"><b>Click here to go to the UAInfo search page to search the entire arizona.edu domain.</b></a></p>
						<p><img src="/common/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<a href="http://www.union.arizona.edu/clubs/list"><b>Looking for a club? Click to search for clubs on campus.</b></a></p>
						<p><img src="/common/images/foursquares_white.gif" width="62" height="30"></p>
						<p><img src="/common/images/arrow.gif" width="4" height="7" alt="" border="0">&nbsp;<b>www.union.arizona.edu Brief Site Index</b></p>
						<ul>
							<li><a href="about/index.php">About the Union</a>
							<li><a href="/catering/index.php">Catering</a>
							<li><a href="construction/index.php">Construction</a>
							<li><a href="/csil/index.php">Center for Student Involvement and Leadership</a>
							<li><a href="/dining/index.php">Dining</a>
							<li><a href="/rooms/index.php">Events</a>
							<li><a href="/feedback/index.php">Feedback</a>
							<li><a href="/infodesk/index.php">Infodesk</a>
							<li><a href="mall/index.php">Campus Use & Mall Scheduling</a>
							<li><a href="/mealplans/index.php">Meal Plans</a>
							<li><a href="/operations/index.php">Operations</a>
							<li><a href="/shopping/index.php">Retail</a>
							<li><a href="/traditions/index.php">Traditions</a>
						</ul>
						<p><img src="/common/images/foursquares_white.gif" width="62" height="30"></p>
						<ul>
							<li><a href="/about/index.php"><b>About the Unions</b></a>
							<ul>
								<li><a href="/about/mission.php">Mission Statement</a>
								<li><a href="/about/morethan.php">We Are More Than You Think!</a>
								<li><a href="/about/recycling.php">Recycling</a>
								<li><a href="/about/directory/index.php">Staff Directory</a>
								<li><a href="/about/employment.php">Student Employment Opportunities</a>
								<li><a href="/about/gallery/index.php">Photo Gallery</a>
								<li><a href="/about/newz/index.php">Union NewZ</a>
							</ul>
							<li><a href="/catering/index.php"><b>Catering</b></a>
							<ul>
								<li><a href="/catering/ordering.php">Ordering</a>
								<li><a href="/catering/gallery/index.php">Photo Gallery</a>
							</ul>
                            <li><a href="/cellar/index.php">The Cellar</a>
							<li><a href="/csil/index.php"><b>Center for Student Involvement and Leadership</b></a>
							<ul>
								<li><a href="/csil/bluechip/index.php">Arizona Blue Chip Program</a>
								<ul>
									<li><a href="/csil/bluechip/application.php">Online Application</a>
									<li><a href="/csil/bluechip/faq.php">FAQ</a>
									<li><a href="/csil/bluechip/features.php">Features</a>
									<li><a href="/csil/bluechip/history.php">History</a>
									<li><a href="/csil/bluechip/newsletter.php">Newsletter</a>
									<li><a href="/csil/bluechip/preview.php">Program Preview</a>
									<li><a href="/csil/bluechip/stars/stars.php">Rising Stars</a>
								</ul>
								<li><a href="/csil/clubs/index.php">Clubs &amp; Organizations</a>
								<ul>
									<li><a href="/csil/clubs/handbook.php">Organization Handbook</a>
									<li><a href="/csil/clubs/howto.php">How-To</a>
									<li><a href="http://www.union.arizona.edu/cgi-bin/WebObjects/Clubs">Club Listing</a>
								</ul>
								<li><a href="/csil/OCH/index.php">Commuter Student Affairs</a>
								<ul>
									<li><a href="/csil/OCH/gettinginvolved.php">Get Involved</a>
									<li><a href="/csil/csa/newsletter/index.php">Commuter Newsletter</a>
									<li><a href="/csil/csa/newtraditional.php">New Traditional Students</a>
									<li><a href="/csil/OCH/offcampus/index.php">Off-Campus Housing</a>
									<ul>
										<li><a href="/csil/csa/tucsonlodging.php">Hotel Accommodations</a>
										<li><a href="/csil/OCH/housingguide/index.php">Renter's Guide</a>
										<li><a href="/csil/OCH/request.php">Housing Info Request</a>
									</ul>
									<li><a href="/csil/OCH/services.php">Services</a>
								</ul>
								<li><a href="/csil/greek/index.php">Greek Life Programs</a>
								<ul>
									<li><a href="/csil/greek/awards.php">Greek Award Winners</a>
									<li><a href="/csil/greek/calendar.php">Calendar</a>
									<li><a href="/csil/greek/chapters/index.php">Chapters</a>
									<li><a href="/csil/greek/ifc.php">IFC</a>
									<li><a href="/csil/greek/npc.php">NPC</a>
									<li><a href="/csil/greek/nphc.php">NPHC</a>
									<li><a href="/csil/greek/gogreek/index.php">Go Greek</a>
									<li><a href="/csil/greek/policies/index.php">Policies</a>
									<li><a href="/csil/greek/programs.php">Programs</a>
									<li><a href="/csil/greek/registration/index.php">Rush Information</a>
									<li><a href="/csil/greek/staff.php">Staff</a>
								</ul>
								<li><a href="/csil/haze/index.php">Hazing</a>
								<ul>
									<li><a href="/csil/haze/policy.php">Policy</a>
								</ul>
								<li><a href="/csil/leadership/index.php">Leadership Opportunities</a>
								<ul>
									<li><a href="/csil/leadership/awards/index.php">All-Campus Leadership Awards</a>
								</ul>
								<li><a href="/csil/uab/index.php">University Activities Board</a>
								<ul>
									<li><a href="/csil/uab/arts/index.php">Arts</a>
									<li><a href="/csil/uab/comedycorner/index.php">Comedy Corner</a>
									<li><a href="/csil/uab/committees.php">Committees</a>
									<li><a href="/csil/uab/concerts/index.php">Concerts</a>
									<li><a href="/csil/uab/diversity/index.php">Diversity Initiatives</a>
									<li><a href="/csil/uab/events.php">Events</a>
									<li><a href="/csil/uab/familyweekend/index.php">Family Weekend</a>
									<li><a href="/csil/uab/films/index.php">Films</a>
									<li><a href="/csil/uab/specialevents/index.php">Special Events</a>
									<li><a href="/csil/uab/staff.php">Staff</a>
									<li><a href="/csil/uab/volunteer/index.php">Project Volunteer</a>
								</ul>
								<li><a href="/welcome/index.php">Wildcat Welcome</a>
							</ul>
                            							<li><a href="/construction/index.php"><b>Construction</b></a>
							<ul>
								<li><a href="/construction/features.php">Features</a>
								<li><a href="/construction/gallery/index.php">Photo Gallery</a>
								<li><a href="/construction/views/index.php">Views of the New Union</a>
								<li><a href="/construction/virtualtour/index.php">Virtual Tour</a>
							</ul>
							<li><b><a href="/dining/index.php">Dining</a></b>
							<ul>
								<li><a href="/dining/sumc/index.php">Student Union Memorial Center</a>
								<li><a href="/dining/psu/index.php">Park Student Union</a>
								<li><a href="/dining/ufs/index.php">Union Food Stops</a>
							</ul>
							<li><a href="/rooms/index.php"><b>Event Services &amp; Room Scheduling</b></a>
							<li><b><a href="/feedback/index.php">Feedback</a></b>
							<li><b><a href="/infodesk/index.php">Infodesk</a></b>
							<ul>
								<li><a href="/infodesk/hours/index.php">Building Hours</a>
								<li><a href="/infodesk/maps/index.php">Maps</a>
							</ul>
							<li><a href="/mall/index.php"><b>Campus Use & Mall Scheduling</b></a>
							<ul>
								<li><a href="/mall/info.php">Information</a>
								<li><a href="/mall/maps.php">Mall Maps</a>
								<li><a href="/mall/guidelines.php">Important Guidelines</a>
								<li><a href="/mall/request_form.php">Request Form</a>
							</ul>
							<li><a href="/mealplans/index.php"><b>University Meal Plans</b></a>
							<li><b><a href="/operations/index.php">Operations</a></b>
							<li><b><a href="/shopping/index.php">Retail</a></b>
							<ul>
								<li><a href="/fastcopy/index.php">Fast Copy</a>
								<li><a href="/shopping/usps/index.php">US Post Office</a>
							</ul>
							<li><a href="/traditions/index.php"><b>Traditions</b></a>
							<ul>
								<li><a href="/traditions/scrapbook/index.php">Student Unions Scrapbook</a>
							</ul>
						</ul>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php page_finish() ?>
