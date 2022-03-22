<?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/mall/template/mall.inc');
  $page_options['title'] = 'Important Information';
  $page_options['header_image'] = '/template/images/banners/ua_mall_banner.jpg';
  $page_options['page'] = 'Important Information';
  mall_start($page_options);
?>

<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="/template/expand.css" />
<script  type="text/javascript" src="/template/expand.js"></script>
<script type="text/javascript">
	$(function() {
		// --- Using the default options:
		$("h3.expand").toggler();
		// --- Other options:
		//$("h2.expand").toggler({method: "toggle", speed: 0});
		//$("h2.expand").toggler({method: "toggle"});
		//$("h2.expand").toggler({speed: "fast"});
		//$("h2.expand").toggler({method: "fadeToggle"});
		//$("h2.expand").toggler({method: "slideFadeToggle"});
		$("#content").expandAll({
			trigger : "h3.expand",
			ref : "div.demo",
			localLinks : "p.top a"
		});
	}); 
</script>
<style>
	h1 {
		font-family: Helvetica,Arial,sans-serif !important; 
		font-size:30px !important; 
		line-height:32px !important;
		margin-top:0!important;
	}
	h3 {margin-top: 10px !important; font-size: 1rem;}
	ul, ol { line-height: 1.25em !important;}
	hr{ width: 530px !important;}
</style>
<h1>Important Information</h1>

<p style="margin-top: 15px;"><b>Click on the topics to display the content.</b></p>

<a name="top"></a>

<div id="content">
<!--	
	<h3 class="expand" >Facilities Management:</h3>
	<div class="collapse">
		<ul>
			<li>1200 N Mountain</li>	
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>-->

	<h3 class="expand" >Permanent Stage:</h3>
	<div class="collapse">
		<ul>
			<li>Has holes to hold poles for a 20' x 30' tent; tent must be rented from an off-campus vendor</li>
			<li>Power and amplification hook up at the back of stage (west side), there are also ample power sources at Park Student Union stage</li>
			<li>Water connections on north and south side</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h3 class="expand" >Power:</h3>
	<div class="collapse">
		<ul>
			<li>Electrical outlets at the stage</li>
			<li>For other power sources, help, information, etc. call (520) 621-7559</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h3 class="expand" >Facilities Management Equipment/Services:</h3>
	<div class="collapse">
		<ul>
			<li>Contact 621-7559</li>
			<li>Minimum 2 week notice required</li>
			<li>Equipment includes: tables, chairs, stage, podium, easels, trash cans, irrigation</li>
			<li>A group can pick up equipment by working with Steven Natale (621-4701); no fee</li>
			<li>Equipment is stored at the NE corner of McKale at ground level just W of the pool</li>
			<li>Campus Use Coordinator can sign off on Campus Use Activity Reqest if there is no equipment request, no blue staking needed, nothing else required of Fac. Mgmt.</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h3 class="expand" >Banners:</h3>
	<div class="collapse">
		<ul>
			<li><a href="http://union.arizona.edu/rooms/banner_policies.php">http://union.arizona.edu/rooms/banner_policies.php</a></li>
			<li>To hang banners on the Student Union Memorial Center, call 621-1989</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h3 class="expand" >Audio Visual:</h3>
	<div class="collapse">
		<ul>
			<li>621-3852, located at Univ. Teaching Center on Mountain</li>
			<li>5 days notice</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h3 class="expand" >Tents:</h3>
	<div class="collapse">
		<ul>
			<li>Permanent stage on mall has pole holes for a 20' x 30' tent</li>
			<li>Tents may be left up overnight (refer to detailed instructions on the Mall Use & Scheduling Guideline link)</li>
			<li>Outside vendors include:</li>
			<ul>
				<li>Parties Plus 792-8368</li>
				<li>Party Express 322-9405</li>
				<li>AZ Party Rental 327-6678</li>
				<li>Pro Em 750-0550</li>
			</ul>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h3 class="expand" >University Trademarked Items:</h3>
	<div class="collapse">
		<ul>
			<li>Alexi Holcomb, McKale, 626-3077</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h3 class="expand" >Risk Management:</h3>
	<div class="collapse">
		<ul>
			<li>Herb Wagner, 220 W. 6h St., 621-7691</li>
			<ol>
				<li>
					Campus Use Coordinator can sign for Risk Mgmt. for any low-risk events (low risk to the University, examples include sales of jewelry, trinkets, and the like; by contrast - high risk includes rock drilling, large festival rallies, events drawing large crowds, runs and bike events)
				</li>
				<li>
					Campus Use Coordinator will obtain insurance certificates from all when necessary (if low risk, then ins. cert. not required). All certificates will be sent to Herb Wagner. He will then email the Campus Use Coordinator with his (dis)approval and/or comments.
				</li>
			</ol>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h3 class="expand" >Parking &amp; Transportation:</h3>
	<div class="collapse">
		<ul>
			<li>Mike Wallace, 1117 E. 6th St., 621-3710</li>
			<li>Arrangements and approval required 5 business days prior to event.</li>
			<li>Payment for services (gate fee and/or parking fee) required by 12:00 noon on the day before, no exceptions.</li>
			<li>Ten (10) minute grace period allowed with each gate opening.</li>
			<li>Access prohibited on central mall roadway between 9:00am - 4:00pm.</li>
			<li>Rescheduling or cancellations required in advance or Mall Access privileges will be forfeited without refund.</li>
			<li>Vehicles parking on the grass, require further authorization from Kathi Hart, 621-2630.</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h3 class="expand" >Campus Use Committee:</h3>
	<div class="collapse">
		<ul>
			<li>Annually reviews guidelines for mall use and assists Dean of Students Office in events approval as needed</li>
			<li>Comprised of: Dean of Students, , Campus Use Coordinator, Risk Management, UAPD, Facilities Management, ASUA, Parking and Transportation, Grounds, Disability Resource Center, Athletics, Campus Recreation, Student Union Operations, Housing and Residence Life, and External Relations.</li>
			<li>University sponsored events (including Homecoming, Spring Fling, etc.) shall present their agendas, specific info, etc. to Campus Use Committee well in advance of the event; also, other large events, demonstrations, protests, and unusual out-of-the-ordinary events should go before the committee or at the least (due to time constraints) before Dr. Sylvester Gaskin, Assistant Dean of Students, 621-2872.</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h3 class="expand" >UAPD:</h3>
	<div class="collapse">
		<ul>
			<li>Campus Police at 626-6728.</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>	
	
	<h3 class="expand" >City Licensing:</h3>
	<div class="collapse">
		<ul>
			<li>(520)791-4566; 255 W. Alameda, 1st Floor</li>
			<li>Depends on what's being sold, where, when and for how long</li>
			<li>A peddler's license is a city license</li>
			<li>Vendors should call for specific information</li>
			<li>A copy must be submitted with completed mall form</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>		
	
	<h3 class="expand" >State Licensing:</h3>
	<div class="collapse">
		<ul>
			<li>800-634-6494; 400 W. Congress, 1st Floor, South bldg.</li>
			<li>There is a fee for licensing</li>
			<li>License required by State to sell anything other than a service</li>
			<li>A copy must be submitted with completed mall form</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>			
	
	<h3 class="expand" >Health Department:</h3>
	<div class="collapse">
		<ul>
			<li>(520)740-2760; 150 W. Congress</li>
			<li>ANY food or drink on the mall, regardless of event or fee or group, for sale or free samples, MUST have a health permit</li>
			<li>There is no charge for a health permit if items are homebaked, individually wrapped goodies and/or canned soda</li>
			<li>There is a fee for a temporary permit (up to 2 weeks - same event, same time period, consecutive dates; otherwise a separate permit will be issued for each event)</li>
			<li>No blanket permits are issued ex: Spring Fling - each booth must have their own permit</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>				

	<h3 class="expand" >Dean of Students:</h3>
	<div class="collapse">
		<ul>
			<li>1st Amendment issues are regulated/delegated to Dr. Sylvester Gaskin, 621-2872</li>
			<li>Dr. Sylvester Gaskin approves overnight structures and is the last signature required for the Campus Use Activity Request Form. She will not approve until Risk Management approves, if deemed necessary.</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>		

	<h3 class="expand" >Disability Access:</h3>
	<div class="collapse">
		<ul>
			<li>Contact the Disability Resource Center, 626-5490</li>
			<li><a href="http://drc.arizona.edu/sites/drc.arizona.edu/files/documents/2018_DRC_EventAccess_PrintReady_FINAL%20%28Accessible%29.pdf">Event Planner's Checklist</a></li>
			<li>Tables, booths, etc. should be 6' from the sidewalks, curbs and curb cut</li>
			<li>Spaces between tables, booths, etc. should be at least 36&quot; apart</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>		
<!--
	<h3 class="expand" >Contracts:</h3>
	<div class="collapse">
		<ul>
			<li>Arizona Student Unions, McKale, Alumni Association, Bookstore and Centennial Hall have contracted vendors - these are the exception to some of the mall policies regarding commercial activity</li>
			<li>Vendors beyond 12' of city street curb are considered to be on UA property</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>		-->

	<h3 class="expand" >Building Monitors:</h3>
	<div class="collapse">
		<ul>
			<li>For information, call Fac. Mgmt. at 621-7559<br>
			<li>Building monitors have authority over anything that occurs within 15' of the particular building on the outside</li>
			<li>Nugent, Old Chemistry, Student Union Memorial Center and the Arizona State Museum have given that authority to the Campus Use Coordinator</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>		

	<!--<h3 class="expand" >FYI'S:</h3>
	<div class="collapse">
		<ul>
			<li>If vendor's business is interrupted or interfered with by an individual the vendor can ask the individual to move or UAPD can be called; if asking the individual to move is based solely on religion, ethnic background, etc. then the vendor is in the wrong and the individual becomes the victim.</li>
		</ul>
		<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>		-->

</div>

<p>Last update: <?php print date('D M j Y', filemtime($_SERVER['SCRIPT_FILENAME'])); ?></p>
<?php mall_finish() ?>