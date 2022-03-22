<?php
// require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
require_once 'template/catering.inc.php';
$page_options['title'] = 'Arizona Catering Company';
require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/deliverance.inc.php');

$page_options['page'] = 'Contact Us';
catering_start($page_options);
require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/contact_us.inc.php');
?>
<style>
    /* .c_header {
        height: 300px;
        overflow: hidden;
    }
    .c_header > img {
        position: relative;
        top: -8px;
    }*/
    /* .wrap_catering {
        width: 100%
    }  */
    .cc_top > img { 
        vertical-align: top;
        width: 100%; 
    }
    .c_content {
        height: initial;
    }
    .su-main-content h1 {
        margin: 0px;
        margin-top: 20px !important;
        margin-bottom: 10px !important;
        width: 100%;
        /* text-align: center; */
    }
    .col-10 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .cc_right {
        margin-top: 90px;
    }
    .ccr_nav {
        height: initial;
    }
    #root {
        padding-left: 20px;
    }
</style>

<!-- <div id="catering_page" > -->
<!-- <div class="col-md-12 wrap-banner-img">
	<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/catering_slider.inc.php'); ?>
</div> -->

<?php
// require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/catering_left_col.inc.php');
?>

<!-- <div class="col wrap-left-col">
	<div id="left-col" class="wrap-left-col-menu">
		<h2 class="left-col-menu-header">Arizona Catering Co.</h2>
		
		<ul>
			<li class="">
				<a href="/template/resources/forms/Student_Union_Catering_Online_Form.pdf">Home</a>
			</li>

			<li class="wrap-left-nav-child">
				<a>Policies<i class="fas fa-caret-down"></i></a>
				
				<ul class=" ">
					<li class=""><a href="/template/resources/menus/Arizona_Catering_Company_Policies_2016.pdf">Catering Policies</a></li>
					<li class=""><a href="/alcohol/">Alcohol Permit</a></li>
				</ul>
			</li>
			
			<li class="">
				<a href="/template/resources/forms/Student_Union_Catering_Online_Form.pdf">Student Union Catering Request</a>
			</li>

			<li class="">
				<a href="/template/resources/forms/CateringInquiryForm.pdf">Campus Catering Request</a>
			</li>

			<li class="">
				<a href="/rooms/reserving.php">Meeting Room Request</a>
			</li>

			<li class="">
				<a href="/catering/catering_event_inquiry_1.php" >Catering/Event Inquiry</a>
			</li>

			<li class="">
				<a href="/catering/catering_waiver.php" >Catering Waiver</a>
			</li>

			<li class="">
				<a href="/catering/contact_us.php" >Contact Us</a>
			</li>

			<li class="">
				<a href="/catering/team.php" >The Team</a>
			</li>
			
		</ul>  

	</div>
</div> -->

<!-- <script language="JavaScript" type="text/javascript" src="/template/contact_us.js" ></script> -->
<link rel="StyleSheet" href="/template/catering.css" type="text/css" media="screen" />

<div id="center-col" class="col" >

	<div class="sub-nav-left-col">
		<?php
		// if the submit button was clicked.
		if (isset($_POST['submit'])) {
			// if there were no errors and the email was sent,
			// display a confirmation messge.
			if ($xcomment == "") {
				echo "<h4 class='error-msg' >Invalid entry. Message was  not sent.</h4><br />";
				// echo "<script>document.getElementById('form1').reset();</script>";
			} else if ($result) {
				echo "<p class='success-msg' >Thank you for your submission. <br />We will get back to you as soon as possible.</p>";
				// echo "<script>document.getElementById('form1').reset();</script>";
			} else {
				// if there were errors, display them.
				echo "<h4 class='error-msg' >There was a problem sending your message.</h4><br />";
				echo "<p class='error-msg' > $response </p>";
			}
		}
		?>
		<h1>Arizona Catering Co.</h1>
		<h3>Contact Us</h3>
		<p>
			Thank you for your interest in the Arizona Catering Company. If you have any questions or comments, please
			feel free to use our contact form below to send us a quick message. You may also email us directly at
			<a href="mailto:SUEventplanning@email.arizona.edu" >su-sueventplanning@email.arizona.edu</a>.
		</p>

		<p style="margin-bottom: 1.5em;">
			<em>* Fields marked with an asterisk are required.</em>
		</p>

		<!-- the $_SERVER['PHP_SELF'] in the action field always posts back to the same form. -->
		<form name="form1" id="form1" id="frm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

			<p>
				Name: <span class="req" >*</span>
				<br />
				<input name="name" type="text" id="name" size="50" maxlength="70" value="<?php echo (isset($_POST['name'])) ?  (($result) ? "" : $_POST['name']) : ""; ?>" >
			</p>

			<p>
				Your Email: <span class="req" >*</span>
				<br />
				<input name="email" type="text" id="email" size="50" maxlength="50" value="<?php echo (isset($_POST['email'])) ?  (($result) ? "" : $_POST['email']) : ""; ?>" >
			</p>

			<p style="margin-top: 1em; margin-bottom: .1em; ">
				I would like to submit:<span class="req" >*</span>
			</p>

			<ul style="list-style-type: none; margin-left:-.5em; margin-top: .1em; margin-bottom: 1em; line-height: 1.5em;">
				<li>
					<input type="radio" name="feedback" value="No"  <?php
					if (isset($_POST['feedback'])) {
						if ($_POST['feedback'] == "No") { echo "checked=\"checked\"";
						}
					} ?> >
					A general inquiry or comment
				</li>
				<li>
					<input type="radio" name="feedback" value="Yes" <?php
					if (isset($_POST['feedback'])) {
						if ($_POST['feedback'] == "Yes") { echo "checked=\"checked\"";
						}
					} ?> >
					Comment about an event or service
				</li>
			</ul>

			<div id="iam">
				<br />
				I am a: <span class="req" >*</span>
				<br />
				<ul style="list-style-type: none; margin-left:-.5em; margin-top: 1em; margin-bottom: 1em; line-height: 1.5em;">
					<li>
						<input type="radio" name="identity" value="Planner"  <?php
						if (isset($_POST['identity'])) {
							if ($_POST['identity'] == "Planner") { echo "checked=\"checked\"";
							}
						} ?> >
						Meeting Planner / Coordinator
					</li>
					<li>
						<input type="radio" name="identity" value="Attendee"  <?php
						if (isset($_POST['identity'])) {
							if ($_POST['identity'] == "Attendee") { echo "checked=\"checked\"";
							}
						} ?> >
						Event Attendee
					</li>
					<li>
						<input type="radio" name="identity" value="Prospective"  <?php
						if (isset($_POST['identity'])) {
							if ($_POST['identity'] == "Prospective") { echo "checked=\"checked\"";
							}
						} ?> >
						Prospective Client
					</li>
					<li>
						<input type="radio" name="identity" value="Other"  <?php
						if (isset($_POST['identity'])) {
							if ($_POST['identity'] == "Other") { echo "checked=\"checked\"";
							}
						} ?> >
						Other
						<input name="other" type="text" id="other" size="10" maxlength="50" value="<?php echo (isset($_POST['other'])) ?  (($result) ? "" : $_POST['other']) : ""; ?>" >
					</li>
				</ul>
			</div>

			<div id="re">
				<br />
				This feedback: <span class="req" >*</span>
				<br />
				<ul style="list-style-type: none; margin-left:-.5em; margin-top: 1em; margin-bottom: 1em; line-height: 1.5em;">
					<li>
						<input type="radio" name="subject" value="Event"  <?php
						if (isset($_POST['subject'])) {
							if ($_POST['subject'] == "Event") { echo "checked=\"checked\"";
							}
						} ?> >
						Relates to a recent event supported by the Arizona Catering Company
					</li>
					<li>
						<input type="radio" name="subject" value="Other"  <?php
						if (isset($_POST['subject'])) {
							if ($_POST['subject'] == "Other") { echo "checked=\"checked\"";
							}
						} ?> >
						Is not related to a specific event
					</li>
				</ul>
			</div>

			<!-- this textarea initially shows 50 columns and 4 rows, but it will grow if the user keeps typing. -->
			<p id="comment_block" >
				<br />
				Your Comments: <span class="req" >*</span>
				<br />
				<textarea name="comment" cols="50" rows="4" id="comment" maxlength="500" ><?php echo (isset($_POST['comment'])) ? (($result) ? "" : $_POST['comment']) : ""; ?></textarea>
			</p>

			<div id="contactyou">
				<br />
				Would you like to be contacted regarding your feedback?
				<ul style="list-style-type: none; margin-left:-.5em; margin-top: 1em; margin-bottom: 1em; line-height: 1.5em;">
					<li>
						<input type="radio" name="contact" value="Yes"  <?php
						if (isset($_POST['contact'])) {
							if ($_POST['contact'] == "Yes") { echo "checked=\"checked\"";
							}
						} ?> >
						Yes
					</li>
					<li>
						<input type="radio" name="contact" value="No"  <?php
						if (isset($_POST['contact'])) {
							if ($_POST['contact'] == "No") { echo "checked=\"checked\"";
							}
						} ?> >
						No
					</li>
				</ul>
			</div>

			<p id="xcomment" >
				Your Extended Comments/Suggestions: <span class="req" >*</span>
				<br />
				<textarea name="xcomment" cols="50" rows="4" id="xcomment" maxlength="500" ><?php echo (isset($_POST['xcomment'])) ? (($result) ? "" : $_POST['xcomment']) : ""; ?></textarea>
			</p>

			<br />
			<!-- the input with type submit, automatically posts the form to the server. -->
			<input type="submit" name="submit" value="submit">
			<br />
			<br />

		</form>
		<br />
		<br />
		<br />
		<br />
	</div>

</div>

<?php
// require_once ('catering_right_col.inc.php');
?>
<!-- </div> -->
<!-- <div style="clear:both;">
	<br /><br />
</div> -->

<?php catering_finish(); ?>
<script language="JavaScript" type="text/javascript" src="/template/contact_us.js" ></script>