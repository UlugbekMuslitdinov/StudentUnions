<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'UA Alcohol Permit';
  	$page_options['header_image'] = '/template/images/banners/alcohol_banner.jpg';
  	$nav['UA Policy on Alcoholic Beverages']['link'] = 'http://policy.arizona.edu/alcohol';
  	
  	$nav['Applying for a UA Alcohol Permit']['link'] = '/template/resources/forms/AlcoholPermitInstruct.pdf'; 
	page_start($page_options);	
?>
<div class="col-md-12 wrap-banner-img">
	<img src="<?=$page_options['header_image']?>" />
</div>

<div class="col wrap-left-col">
	<div class="wrap-left-col-menu">
		<h2 class="left-col-menu-header" style="">Alcohol</h2>
		<ul>
			<?php
			foreach($nav as $key => $value){
				echo '<li><a href="' . $value['link'] . '" >' . $key . '</a></li>';
			}
			?>
		</ul>
	</div>
</div>
<div class="col">
	<div class="col-12 mt-4">

<style type="text/css">
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="/template/expand.css" />
<script  type="text/javascript" src="/template/expand.js"></script>
<script type="text/javascript">
	$(function() {
		// --- Using the default options:
		$("li.expand").toggler();
		// --- Other options:
		//$("h2.expand").toggler({method: "toggle", speed: 0});
		//$("h2.expand").toggler({method: "toggle"});
		//$("h2.expand").toggler({speed: "fast"});
		//$("h2.expand").toggler({method: "fadeToggle"});
		//$("h2.expand").toggler({method: "slideFadeToggle"});
		$("#content").expandAll({
			trigger : "li.expand",
			ref : "div.demo",
			localLinks : "p.top a"
		});
	}); 
</script>

		<h1 style="width: 800px; margin-bottom: 15px;">Instructions on Filling Out Permit<br />to Serve Alcoholic Beverages on Campus Form</h1>
	
		<p>
			This UA Alcohol Permit Application must be submitted for all events where alcoholic beverages will be served on University of Arizona 
			property. Please complete all blanks unless otherwise instructed. If section does not apply, please indicate N/A. Failure to provide 
			all required information, or complete the form properly and legibly, may result in delay or rejection of this application. <i>NOTE: 
			This form is not required for off-campus events in private homes, restaurants, or establishments with liquor licenses.</i>
		</p>
		
		<p>
			<strong>Application Date:</strong> Indicate the date you are filling out the form. The form must be emailed to <u><a href="mailto:su-alcoholpermit@email.arizona.edu">su-alcoholpermit@email.arizona.edu</a></u>,  <u>10 business days prior to the event</u>.
		</p>
		<p>
			<strong>Application Fee:</strong> AN APPLICATION FEE OF $15 MUST BE SUBMITTED WITH THIS FORM TO BEGIN PROCESSING. 
    		</p>
		<p>	
    			Please submit either a check or cash.
    		</p>
	
  		<ul style="list-style-type: none;" >
            	<li><a href="/template/resources/forms/alcoholpermit.pdf" target="_blank">Alcohol Permit Application</a> (.pdf Adobe Reader)</li>
			<!--<li><a href="/template/resources/forms/alcoholpermit.doc">Alcohol Permit Application</a> (.doc MS Word)</li>-->
			<li><a href="/template/resources/forms/AlcoholPermitInstruct.pdf" target="_blank">Download instructions below for UA alcohol permit</a> (.pdf Adobe Reader)</li>
			<!--<li><a href="/template/resources/forms/AlcoholPermitInstruct.doc">Download instructions below for UA alcohol permit</a> (.doc MS Word)</li>-->
        </ul>   
        
        <p style="margin-top: 20px; margin-bottom: -5px;">Click on the topics to display the content.</p>

		<a name="top"></a>

		<div id="content">
		<ol style="margin-top: 20px;">
			<li class="expand" ><strong>Applicant Information:</strong></li>
			<div class="collapse">
            		<ol style="list-style-type: upper-alpha;">
					<li>
					<strong>Name of University College or Department Hosting Event:</strong>
					Fill in the name of the college or department. This must be a UA department or college, e.g., the College of Fine Arts, 
					the Athletics Department, etc. There must be a University department/unit hosting the event in order for alcohol to be served.
					</li>
					<ol style="list-style-type: lower-roman;">
						<li><strong>College/Department Applicant:</strong> Clearly print the name of the individual applying for the permit. This must be a College or Department Dean or Director. The applicant must have the authority to make such application on behalf of the University, College or Department. Include the applicant's phone and fax numbers. An original signature of the applicant is required</li>
						<li><strong>Responsible UA Employee in Attendance at Event: </strong>A responsible adult from the hosting department must be in attendance at the entire event. This doesn't necessarily have to be the same person as the applicant. Contact information is required.</li>
						<li><strong>Purpose Related to University Mission: </strong>According the UA guidelines, "The event must serve a University purpose," if alcohol will be served. Indicate how the event is related to the mission of the University. Some examples might be fundraising, donor relations, advisory board meeting, visiting scholar lecture/reception, community outreach event.</li>
					</ol> 	
					<li>
						<b>Name of Third-Party Sponsor Organization co-Hosting Event (if any):</b>
						<p>
						This is where you will fill in the name of any outside organization/entity co-hosting the event, e.g. Raytheon, Bank of America, etc. 
						(Do not use this space for the name of University applicant.) An authorized representative of the Third-Party co-host must sign the form, 
						binding the Third-Party <u>to each of the provisions of the Permit, including the indemnification provisions of Paragraph 11 and the 
						University's Alcohol Policy.</u> Include the third-party sponsor's address and phone, and explain its affiliation with the University. 
						Do not fax the forms to/from the Third-Party co-host. Have the original form filled out, signed and returned to you for completion.
						</p>
					</li>
					<ol style="list-style-type: lower-roman;">
						<li><strong>Indemnification by Third-Party Sponsor organization: </strong>This section explains the indemnification responsibilities that Third-Party Sponsors must agree to provide.</li>
					</ol>
           		</ol>
           		<p class="top">
				<a href="#top" style="color: #C00">&#9650 TOP</a>
				</p>
				<hr  class="clear" />
				<br />
			</div>
        		<li class="expand" ><strong>Alcohol Information:</strong></li>
        		<div class="collapse">
		 		<ol style="list-style-type: upper-alpha;">
					<li>
						<strong>Check all of the following that apply to the event:</strong>
					</li>
					<li>
						<b>There are five questions under #2A.</b> 
						<p>
						If you check any item(s) "Yes", service will be limited to two drinks per person under 
						the Public Facilities Exemption; unless a Special Event Liquor License is obtained from the
						Arizona Department of Liquor (requires special permission from the University President). These rules are for compliance 
						with the State Liquor law prohibitions on the sale of alcohol and related Arizona Department of Liquor regulations.
						</p> 
					</li>
					<li>
						<strong>Will the college organization apply for a Special Event Liquor License?</strong>
						<p>
						Check yes or no. Be advised that obtaining a Special Event Liquor License requires special permission from the University 
						President, and then applying for the license through the City of Tucson and the Arizona Department of Liquor Licenses and 
						Control. It is an involved process and not all organizations will qualify. Most University organizations choose to comply 
						with the rules set forth in the UA application for a permit to serve alcohol rather than applying for a Special Event Liquor 
						License. Alcohol may be served without a license at events on campus where there is no sale.
						</p> 	  
					</li>
					<li>
						<strong>Type of Alcohol to be served?</strong>
						<p>
						Check all that apply: beer, wine, and/ or hard liquor. UA prohibits the service of spirituous liquor such as whiskey, gin, rum. 
						Special permission is needed in order to serve spirituous liquors in addition to a Special Event Liquor License.
						</p>
					</li>
                    <li>
                         <b>Please check what applies</b>
                    </li>
                    <li>
                         <b>Please check what applies</b>
                    </li>
                    <li>
						<strong>Name of approved bartender or alcohol service contractor:</strong>
						<p>
						Alcoholic beverages must be served by a contractor who has a certificate of insurance on file with the University and agrees to be 
						bound by the provisions of the Permit. The University does not recommend bartenders, but we can tell you who has approved insurance 
						certificates on file with us.
						</p>
						<p>
						Note: The bartending service must read and complete the information providing a signature. All bartending signatures and initials 
						must be original. DO NOT fax the form to the bartender for signature and have them fax it back. All forms not having original 
						signatures where required will be returned to the applicant for re-processing which may delay the review process.
						</p>
						<p>
						Bartenders Initial & Date: Bartenders must manage alcohol service, control alcohol consumption and ensure compliance with the Arizona 
						Liquor Laws and Regulations. Bartenders must read the information and sign. An original signature is required for this acknowledgement.
						</p>
					</li>
				</ol>
				<p class="top">
				<a href="#top" style="color: #C00">&#9650 TOP</a>
				</p>
				<hr  class="clear" />
				<br />
			</div>
			<li class="expand" >	
				<strong>Event Information:</strong>
            </li>
            <div class="collapse">   
            		<ol style="list-style-type: upper-alpha;">
                		<li> 
						<strong>Event Name and Date:</strong>
						<p>
						The name - XYZ Reception - and the date the event will be held.
						</p>
					</li> 
					<li> 
						<strong>Event Description & Attendance: </strong>
						<p>
						Describe the event such as Reception, Dinner, Awards Ceremony. If several phases of the event take place such as an Awards Dinner 
						with reception please indicate. Provide the number of people you expect to attend.
						</p>
					</li> 
					<li>
						<strong>Exact location:</strong>
						<p>
						The name of the room, hall and building or area where the event will be held. For example McClelland Atrium, Room 203 of McClelland Hall. 
						If in any area outside on University grounds provide a general location using existing landmarks. <strong>Time:</strong> The beginning 
						and ending time of the event. Do not include set up or breakdown time. This time is when the event officially begins and ends.
						</p> 
					</li> 
					<li><b>Describe all public exits/entrances for event location.</b></li>
					<li>
						<strong>Alcohol Service Time:</strong>
						<p>
						Provide the times at which alcohol will be served within the start and end time of the entire event as indicated above. If service occurs 
						during the entire event indicate the same time as above.
						</p>
					</li> 	
					<li>
						<strong>List all persons and entities that will receive the gross proceeds from the event:</strong>
						<p>
						Gross proceeds include all monies collected from admission fees, and the sale of food and beverages.
						</p>
					</li> 
					<li>
						<strong>Will the majority of attendees be University employees?</strong>
						<p>
						Check yes or no. Consideration should be given to the hours an event is being held where alcohol is being served if the majority of 
						attendees will be University employees not during work hours. Generally, the majority of persons at events with alcohol should be 
						non-University attendees.
						</p>
					</li> 
					<li>
						<strong>Name of the person or entity donating alcohol for the event, if any:</strong>
						<p>
						This may be an individual or group.
						</p>
						<p>
						PLEASE NOTE: No University funds may be used to purchase alcohol and no donations of liquor may be received from a liquor wholesaler 
						without a Special Event License.
						</p>
					</li> 
				</ol>
				<p class="top">
				<a href="#top" style="color: #C00">&#9650 TOP</a>
				</p>
				<hr  class="clear" />
				<br />
			</div>
			<li class="expand" >
				<strong>Food Information:</strong>
			</li>
			<div class="collapse">
				<p>
				<b>PLEASE NOTE:</b> Alcohol cannot be the main focus of the event. The presence of alcohol requires the accompaniment of food as outlined by 
				the UA catering policy.	
				</p>	
				<ol style="list-style-type: upper-alpha;">
					 <li>
						<strong>University approved food/beverage caterer will be:</strong>
						<p>
						Under the University Catering Policy, events with food costs of $750 or more must use Student Union Dining Services. 
						Departments at AHSC have the option of using the UMC food service. Events costing less than $750 have the option of using 
						a University approved outside caterer. A list of approved outside caterers can be found at: 
						<a href="http://pacs.arizona.edu/contract/Catering_List.pdf">http://pacs.arizona.edu/contract/Catering_List.pdf</a>. 
						Applicant must provide name of UA approved caterer and initial having read and agreeing to the University Catering Policy.
						</p>	
					</li>
					<li>
						<b>Approximate cost per person for this event</b>
					</li>
				</ol>
				<p class="top">
				<a href="#top" style="color: #C00">&#9650 TOP</a>
				</p>
				<hr  class="clear" />
				<br />
			</div>
			<li class="expand" >	
				<strong>Security Information:</strong>
            </li>
            <div class="collapse">
				<ol style="list-style-type: upper-alpha;">
					<li>
						<strong>Will any attendees be under the age of 21?</strong>
						<p>
						Check yes or no. If the answer is yes, you should provide an explanation on how those under aged people will be prevented 
						from loitering in and around the area in which the alcohol is being served. For example, the bartending service will place 
						soft barricades or post signs, and the bartending service will take steps to determine the ages of persons requesting alcohol.
						</p>
					</li>
					<li>
						<strong>Boundaries, fencing, barriers and staff to control liquor consumption:</strong>
						<p>
						In order to serve alcohol at events on campus, there must be defined boundaries to the areas where individuals may consume alcohol. 
						Be clear in describing the boundaries, e.g. "limited to McClelland atrium." Also include any steps that will be taken to control 
						attendees from leaving the area with alcohol such as security staff etc. If a two drink maximum is in effect, then you must outline 
						how the two drink maximum will be monitored such as drink tickets etc.
						</p>
					</li>  	
					<li>
                        <b>Answer as it applies to your location</b>
                    </li>      
					<li>
                        <b>Answer as it applies to your location</b>
                    </li>
                    <li>
						<strong>Will there be security? </strong>
						<p>
						Check yes or no. If yes, indicate who is providing security. Remember that staff may serve this function to a limited extent. 
						The hiring of outside security, other than UAPD employees, (police aides or police officers) must meet current UA Purchasing 
						and Contracting guidelines. UAPD will review this closely to determine any conflicts or make recommendations pending prior 
						approval by UA Campus Life.
						</p>
					</li>
				</ol>
				<p class="top">
				<a href="#top" style="color: #C00">&#9650 TOP</a>
				</p>
				<hr  class="clear" />
				<br />
			</div>
			<li class="expand" >
            		<strong>Submit Application:</strong>
                
            </li>
            <div class="collapse"> 
            		<p>
                		When completed, send Alcohol Permit Application to:<br /><br />
					<strong>
						EVENT PLANNING OFFICE<br />
                        Room 348 SUMC<br />
                        P.O. Box 210017<br />
                        Tucson, Arizona, 85721-0017 
					</strong><br /><br />
                    Phone: 520-621-9463<br /><br />
                    <strong>PLEASE NOTE: Application fee of $15 must be submitted with this application to begin processing. The application fee is 
                    	non-refundable and payment of fee does not guarantee approval of alcohol permit.</strong>
				</p>    
                <ol style="list-style-type: upper-alpha;">	  
			 	<li>
					<strong><span class="main">Initial Review:</span></strong> 
					<p>
					The completed original form with all required information must be forwarded to the Event Services Office for initial review. This 
					review will be conducted by a designated person in the Event planning Office located in the Student Union Memorial Center. Forwarding 
					of the application may be accomplished via campus mail, US Mail or in person. NO faxes will be accepted.
					</p>
					<p>
					If the application does not meet certain administrative requirements or if information is left out the form may be returned to the 
					applicant and require re-submittal once all corrections or information has been provided.
					</p>
					<p>
					When the review is completed by the Event Services Office and the application meets alcohol policy administrative requirements, it will 
					be forwarded by the Event Services Office to UAPD for review by the Office of the Chief of Police.
					</p>
				</li>
				<li>
					<strong><span class="main">UAPD Review:</span></strong>
					<p>
					When received from the Event Services Office, the Chief of Police or designee will review the application and make recommendations if needed. 
					This review is done in order to maximize safety of the event and review compliance with any Arizona State Liquor laws that may be applicable. 
					UAPD may send the application back to the Event Services Office for further action regarding recommendations made. The Event Services Office 
					may deny the event pending compliance with any UAPD recommendations.
					</p>
				</li>
				<li>
					<strong><span class="main">Final Approval by President's Designee:</span></strong>
					<p>
					Final approval of the event will be indicated here and the applicant notified. If approval is made with additional recommendations, 
					such approval is made after applicant has agreed to implement any recommendations made by Campus Life and/or UAPD.
					</p>
					<p>
					If event is denied a reason will be provided. Applicant may inquire why event was denied and inquire if additional actions on applicant's 
					part can be taken in order for the event to be approved.
					</p>
					<p>
					<strong>A copy of the APPROVED permit must be posted on-site of the event where the alcohol is being served at all times.</strong>
					</p>
				</li>
			</ol>
			<p class="top">
			<a href="#top" style="color: #C00">&#9650 TOP</a>
			</p>
			<hr  class="clear" />
			<br />
		</div>	
	</ol>
	</div>
<br /><br />
			</div>
		</div>
<?php page_finish(); ?>
