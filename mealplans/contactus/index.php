<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');

if(isset($_POST['submit'])) {
	$name = addslashes($_POST['name']);
	$email = addslashes($_POST['email']);
	$affiliation = addslashes($_POST['affiliation']);
	$area_of_concern = addslashes($_POST['area_of_concern']);
	$comment = addslashes($_POST['comment']);

	$query = "INSERT INTO feedback VALUES (DEFAULT, '" . $name . "', '" . $email . "', '" . $affiliation . "', '" . $area_of_concern . "', '" . $comment . "', NOW())";

	$result = $db->query($query);

	$body = "<p>";
	$body .= "<b>Name:</b> " . $name . "<br>";
	$body .= "<b>Email:</b> " . $email . "<br>";
	$body .= "<b>Affiliation:</b> " . $affiliation . "<br>";
	$body .= "<b>Area of Concern:</b> " . $area_of_concern . "<br>";
	$body .= "<b>Comments:</b><br>" . $comment . "<br>";

	send_mail("su-web@email.arizona.edu", "Feedback Form", $body);

	header("Location: ./?submit_success");
}

require_once( $_SERVER['DOCUMENT_ROOT'] . '/template/global.inc');

global $page_options;

$page_options['ssheets'] = array('/mealplans/template/mp.css', '/commontools/jslib/shadowbox/shadowbox.css');
// Customize Title for the Swipe Plan files.
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];
$page_options['title'] = 'Contact Us (MealPlans/CatCash)';

page_start($page_options);


function send_mail($email, $subject, $body) {
    $mail = new PHPMailer(true);

    $mail->From = "no-reply@email.arizona.edu";
    $mail->FromName = "Feedback form";
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    try {
        $mail->send();
        // echo "Message has been sent successfully";
    } catch (Exception $e) {
        // echo "Mailer Error: " . $mail->ErrorInfo;
    }
}

?>

<div class="col-12 page-img-banner wrap-banner-img">
	<img src="/template/images/banners/tellus.jpg" />
</div>

<?php

include $_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/mealplan_leftnav.php";
print_left_nav($mealplans_route, "Contact Us", ['other', 'other2']);

?>

<div id="contactus-content" class="col">
	<div><h2>Contact Us (MealPlans/CatCash)</h2></div>
	<p>If you just have a quick question or comment, feel free to drop it in the box.</p><br>
	<form method="POST">
		<div>
			<label style="font-weight: bold;">Name<span class="required-field"></span></label>
			<input type="text" name="name" style="max-width: 600px;" required>
		</div><br>
		<div>
			<label style="font-weight: bold;">Email<span class="required-field"></span></label>
			<input type="text" name="email" style="max-width: 600px;" required>
		</div><br>
		<div>
			<label style="font-weight: bold;">Your Affiliation<span class="required-field"></span></label><br>
			<select name="affiliation" required>
				<option value="" selected disabled hidden>----</option>
				<option>Student</option>
				<option>Faculty</option>
				<option>Staff</option>
				<option>Parent</option>
				<option>Visitor</option>
				<option>Other</option>
			</select>
		</div><br>
		<div>
			<label style="font-weight: bold;">Area of concern<span class="required-field"></span></label>
			<div>
				<input type="radio" name="area_of_concern" id="mealplan" value="MealPlan" required>
				<label for="mealplan">MealPlan</label>
			</div>
			<div>
				<input type="radio" name="area_of_concern" id="catcash" value="CatCash" required>
				<label for="catcash">CatCash</label>
			</div>
		</div><br>
		<div>
			<label style="font-weight: bold;">Your comment<span class="required-field"></span></label><br>
			<textarea name="comment" placeholder="Your question/ comment" style="resize: auto; margin: 0px; height: 200px; width: 600px;" required></textarea>
		</div><br>

		<?php
			if(isset($_GET['submit_success'])) {
				echo "<div><h4 style='color: red; font-weight: bold;'>Form submitted successfully!</h4></div>";
			}
		?>

		<div>
			<input type="submit" name="submit">
		</div>
	</form>
</div>

<?php

page_finish();

?>