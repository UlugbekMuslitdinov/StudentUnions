<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('./fpdm/fpdm.php');
require_once $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";

$date = date("m/d/y");

if(isset($_POST['submit'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $parent_name = trim($_POST['parent_name']);
    $email = trim($_POST['email']);
    $user_name = $first_name . ' ' . $last_name;
    $filename = str_replace(' ', '_', $user_name) . '.pdf';

    $body = '<h2><b>' . $user_name . '  (' . $date . ')';

    if($parent_name == '') {
        $parent_name = ' ';
    }
    else {
        $body .= '<br>' . $parent_name . '  (' . $date . ')';
    }

    $body .= '</b></h2>';
    $body .= '<p>Esports Arena Staff,<br>';
    $body .= 'We have received on online form submission for our user agreement. Please download the attached PDF and save it into the corresponding folder in our Microsoft Teams files.</p>';

    $fields = array(
        'user_signature' => $user_name,
        'fullname'       => $user_name,
        'parent'         => $parent_name,
        'email'          => $email,
        'date'           => $date
    );

    $pdf = new FPDM('test.pdf');
    $pdf->Load($fields, false);
    $pdf->Merge();
    $attachment = $pdf->Output('S', 'out.pdf');
    // $attachment = $pdf->Output('out.pdf', 'S');

    $subject = "Esports User Agreement Form";

    // send_mail("SU-EsportsArena@email.arizona.edu", $subject, $body, $filename, $attachment);
    send_mail("su-web@email.arizona.edu", $subject, $body, $filename, $attachment);
    header("Location: ../?form_submitted");
}

function send_mail($email, $subject, $body, $filename, $attachment) {
    $mail = new PHPMailer(true);

    $mail->From = "no-reply@email.arizona.edu";
    $mail->FromName = "SU Esports Arena";
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->AddStringAttachment($attachment, $filename);
    $mail->Subject = $subject;
    $mail->Body = $body;
    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form test</title>
    <link rel="stylesheet" type="text/css" href="./index.css">
    <script type="text/javascript" src="./index.js"></script>
</head>
<body>
<center>
    <embed src="../pdf/agreement-form.pdf#toolbar=0&navpanes=0&scrollbar=0" width="845px" height="816px">
<!-- </center> -->
</center>
<div class="login-box">
<form method="POST">
    <!-- <h2>Signature</h2> -->
    <table style="width: 100%;">
        <tr>
            <td width="35%">
                <div class="user-box">
                  <input type="text" name="first_name" required="">
                  <label>First Name <span style="color: red;">*</span></label>
                </div>
            </td>
            <td width="35%">
                <div class="user-box">
                  <input type="text" name="last_name" required="">
                  <label>Last Name <span style="color: red;">*</span></label>
                </div>
            </td>
            <td width="10%"></td>
            <td>              
                <div class="user-box">
                  <input type="text" placeholder="Date" name="" value="<?php echo $date; ?>" required="" readonly>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="user-box">
                  <input type="text" name="parent_name">
                  <label>Parent/guardian <i>(if applicable)</i></label>
                </div>
            </td>
            <td></td>
            <td>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="user-box">
                  <input type="text" name="email" required="">
                  <label>Email for Metactix <span style="color: red;">*</span></label>
                </div>
            </td>
        </tr>
    </table>
    <input type="checkbox" name="" required><label style="color: white; font-size: .8rem;">I have read, understand, and agree to the rules of the Arizona Esports Arena.</label><br><br>
    <input class="submit" type="submit" name="submit">
</form>
</div>
</body>
</html>