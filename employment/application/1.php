<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/studentapp.inc');
session_start();
if (isset($_SESSION['employment_app']) && !is_object($_SESSION['employment_app'])) {
	header("Location: /employment/application/index.php");
	exit();
}
if (isset($_POST['stage'])) {
	$_SESSION['employment_app'] -> validate();
	$_SESSION['employment_app'] -> save();
}

// echo "<pre>"; print_r($_SESSION); echo "</pre>";
// echo "<pre>" . $_SESSION['employment_app']->stage . "</pre>";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

<?php ob_start(); ?>
	@import url("forms.css");
	input[type=text],input[type=tel],input[type=email],textarea{
		background:#FCF9D0;
	}
	.error{
		border:1px solid #f00;
	}
	p{
		font-size:13px;
		margin-top: 15px;
		margin-bottom: 0px;
		line-height:15px;
	}
	.cloud{
		float:left;
		margin-bottom:20px;
		display:block;
	}
	.active{
		cursor:pointer;
	}
	a:hover, a:link, a:visited{
		font-size:13px;
	}

	textarea{
		width:400px;
		height:57px;
	}
				
    
<?php 
	$page_options['styles'] = ob_get_clean(); 
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
 	$page_options['title'] = 'Arizona Student Union employee application:';
	$page_options['header_image'] = 'images/student_employment.png';
	page_start($page_options);
?>
<div style="padding-left:0px; width:100%; z-index:1000; position:relative; top:-10;">
		
        <div style="margin-top:15px; width:950px;">
        	<div style="float:left; width:75px;">
				<?php
				switch($_SESSION['employment_app']->stage){
					default:
				?>
	    			<img class="cloud active" src="images/1_red.gif" onclick="window.location='./1.php'";/>
	                <img class="cloud" src="images/2_grey.gif" />
	                <img class="cloud" src="images/3_grey.gif" />
	                <img class="cloud" src="images/4_grey.gif" />
	                <img class="cloud" src="images/5_grey.gif" />
			    <?php
					break;
					
			        case 2:
				?>
	    			<img class="cloud active" src="images/1_red.gif" onclick="window.location='./1.php'";/>
	                <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
	                <img class="cloud" src="images/3_grey.gif" />
	                <img class="cloud" src="images/4_grey.gif" />
	                <img class="cloud" src="images/5_grey.gif" />
			    <?php
					break;    
					
					case 3:
				?>
	    			<img class="cloud active" src="images/1_red.gif" onclick="window.location='./1.php'";/>
	                <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
	                <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
	                <img class="cloud" src="images/4_grey.gif" />
	                <img class="cloud" src="images/5_grey.gif" />
			    <?php
					break;  
					
					case 4:
				?>
	    			<img class="cloud active" src="images/1_red.gif" onclick="window.location='./1.php'";/>
	                <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
	                <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
	                <img class="cloud active" src="images/4_green.gif" onclick="window.location='./4.php'"/>
	                <img class="cloud" src="images/5_grey.gif" />
			    <?php
					break;  
					
					case 5:
				?>
	    			<img class="cloud active" src="images/1_red.gif" onclick="window.location='./1.php'";/>
	                <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
	                <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
	                <img class="cloud active" src="images/4_green.gif" onclick="window.location='./4.php'"/>
	                <img class="cloud active" src="images/5_green.gif" onclick="window.location='./5.php'"/>
			    <?php
					break;			
				}			
				?>
			</div>
			<div style="float:left; margin-left:30px; width:800px;">
				<div>
            		<img src="images/personal_info.gif" /><span style="color:#C01525; font-size:11px; top:-10px; left:10px; position:relative;">(all fields required)</span>
                </div>
                <div style="background-color:#D2E5CA; padding: 1px 0px 15px 15px;">
    				<?php 
    					echo '<span class="error_message">';
    					echo (isset($_SESSION['error_msg1']) ? $_SESSION['error_msg1'] : '');
    					echo '</span>'; 
    				?>

					<?php $_SESSION['employment_app'] -> form_start(1);
					print '<p class="error-msg reg14 left20">' . $_SESSION['employment_app']->error_messages . '</p>';
					?>

					<p>
						<label for="firstName">First Name:</label>
						<?php $_SESSION['employment_app'] -> text('firstName', 50, $_SESSION['employment_app']->application->application_values['firstName']); ?>
						<label for="lastName">Last Name:</label>
						<?php $_SESSION['employment_app'] -> text('lastName', 50, $_SESSION['employment_app']->application->application_values['lastName']); ?>
					</p>
					<p>
						<label for="phoneNumber">Phone Number:</label>
						<?php $_SESSION['employment_app'] -> input('tel','phoneNumber', 15, $_SESSION['employment_app']->application->application_values['phoneNumber'],'required'); ?>
					</p>
					<p>
						<label for="email">Email:</label>
						<?php $_SESSION['employment_app'] -> input('email','email', 50, $_SESSION['employment_app']->application->application_values['email'],'required'); ?>
					</p>
					<p>
						<label for="address">Present Address:</label>
						<?php $_SESSION['employment_app'] -> long_text('address', 50, $_SESSION['employment_app']->application->application_values['address']); ?>
					</p>
					<p>
						<label for="city">City:</label>
						<?php $_SESSION['employment_app'] -> text('city', 50, $_SESSION['employment_app']->application->application_values['city']); ?>
						<label for="state">State:</label>
						<?php $_SESSION['employment_app'] -> dropdown('state', array('AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'DC' => 'Dist of Columbia', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming'), $_SESSION['employment_app'] -> application -> application_values['state']); ?>
						<label for="zip">Zip:</label>
						<?php $_SESSION['employment_app'] -> text('zip', 10, $_SESSION['employment_app']->application->application_values['zip']); ?>
					</p>
					<p>
						<label for="studentType">I am a</label>
						<?php $_SESSION['employment_app']->dropdown('studentType', array('UA_student'=>'U of A student', 'high_school_student'=>'High school student'), $_SESSION['employment_app']->application->application_values['studentType']); ?>
						<label for="classStanding">Year:</label>
						<?php $_SESSION['employment_app'] -> dropdown('classStanding', array('Freshman' => 'Freshman', 'Sophomore' => 'Sophomore', 'Junior' => 'Junior', 'Senior' => 'Senior', 'Grad Student' => 'Grad Student'), $_SESSION['employment_app'] -> application -> application_values['classStanding']); ?>
					</p>
					<p>
						<label for="hearAbout">How did you find out about Student Union jobs?</label>
						<?php $_SESSION['employment_app'] -> dropdown('hearAbout', array('Brochure/Handout' => 'Brochure/Handout', 'Expo/Orientation' => 'Expo/Orientation', 'Friends' => 'Friends', 'Joblink' => 'Joblink', 'Signs' => 'Signs', 'Website' => 'Website', 'Other' => 'Other'), $_SESSION['employment_app'] -> application -> application_values['hearAbout']); ?>
					</p>
					<p>
						<label for="workStudy">Are you eligible for <a href="https://financialaid.arizona.edu/WorkStudy/default.aspx" target="_blank">work-study</a>?</label>
						<?php $_SESSION['employment_app'] -> radio('workStudy', 1, $_SESSION['employment_app']->application->application_values['workStudy']); ?>
						<span class="left10 right5">YES</span>
						<?php $_SESSION['employment_app'] -> radio('workStudy', 0, $_SESSION['employment_app']->application->application_values['workStudy']); ?>
						<span class="left10 right5">NO</span>
					</p>
					<p>
						<label for="previousWorked">Have you ever worked for the Unions?</label>
						<?php $_SESSION['employment_app'] -> radio('previouslyWorked', 1, $_SESSION['employment_app']->application->application_values['previouslyWorked']); ?>
						<span class="left10 right5">YES</span>
						<?php $_SESSION['employment_app'] -> radio('previouslyWorked', 0, $_SESSION['employment_app']->application->application_values['previouslyWorked']); ?>
						<span class="left10 right5">NO</span>
					</p>

					<p>
						<label for="crime">Have you ever been convicted of a crime other than a minor traffic violation?</label>
						<?php $_SESSION['employment_app'] -> radio('crime', 1, $_SESSION['employment_app']->application->application_values['crime']); ?><span class="left10 right5">YES</span>
						<?php $_SESSION['employment_app'] -> radio('crime', 0, $_SESSION['employment_app']->application->application_values['crime']); ?><span class="left10 right5">NO</span>
					</p>
					<p style="clear:both;">
						<label for="crimeInfo" style="vertical-align: top;font-size: 13px;">If yes, please explain:</label>
						<?php $_SESSION['employment_app']->textArea('crimeInfo', $_SESSION['employment_app']->application->application_values['crimeInfo']); ?>
						<span style="display:block;clear:both;"></span>
						<span style="display:block;font-size:11px;width:400px;margin-left: 134px;font-weight:400;">
                            The existence of a criminal record will not automatically disqualify your application. Do not answer "yes" if your "official" conviction record has been annulled, expunged, or sealed.
                        </span>
					</p>
					<p>
						<?php $_SESSION['employment_app'] -> submit('Save and Continue'); ?> 
					</p>
					<?php $_SESSION['employment_app'] -> form_finish(1); ?>
				</div>
			</div>
		</div>
</div>

<?php  page_finish(); ?> 
