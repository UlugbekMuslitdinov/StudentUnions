<?php


    $to = $_POST['email']; // send to this email address (Sueventplanning@email.arizona.edu)
    // $from = 'su-retailcatering@email.arizona.edu'; // sender's email address
    $from = 'su-sueventplanning@email.arizona.edu';
    // $from = 'su-web@email.arizona.edu'; // sender's email address
    $event_name = $_POST['eventName'];
    $contact_name = $_POST['contactName'];
    $event_location = $_POST['eventLocation'];
    // $event_date = $_POST['eventDate'];
    $event_date = date("m/d/Y", strtotime($_POST['eventDate']));
    $event_time = date('h:i A', strtotime($_POST['eventTime']));
    $email = $_POST['email'];
    $phone_number = $_POST['phoneNumber'];
    $guest_count = $_POST['guestCount'];

    // Get selected radio button (Occasion)
    $occasion = isset($_POST['occasion']) ? $_POST['occasion'] : '';
    if ($occasion == "Other") {
        $occasion = 'Other: ' . $_POST['otherOccasion'];
    }

    // Get selected radio button (Type of Cake)
    $cake_type = isset($_POST['cake-type']) ? $_POST['cake-type'] : '';
    if ($cake_type == "Custom") {
        $cake_type = 'Custom: ' . $_POST['typeCustom'];
    }

    $filling = isset($_POST['cakeFilling']) ? $_POST['cakeFilling'] : '';
    $icing = isset($_POST['icing']) ? $_POST['icing'] : '';

    // Get selected radio button (Type and Price)
    // $price = $_POST['price'];
    $price = isset($_POST['price']) ? $_POST['price'] : '';

    // Get selected radio button (Show Stopper Cakes Themes)
    $theme = isset($_POST['theme']) ? $_POST['theme'] : '';
    if ($theme == "Custom"){
        $theme = 'Custom: ' . $_POST['themeCustom'];
    }

    // Get selected radio button (Specialty Designs)
    $specialty_radio = isset($_POST['specialty']) ? $_POST['specialty'] : '';
    if ($specialty_radio == "sugar") {
        $specialty = "Sugar Flowers";
    }
    else {
        $specialty = "Edible Fresh Flowers";
    }

    $decor = $_POST['decor'];
    $instruction = $_POST['instruction'];

    $data = '';
    $data .= '<table rules="all" style="border-color: #666; border: 1px;" cellpadding="3">';
    $data .= "<tr style='background: #ac051f;'><td colspan='2'><h2 style='text-align: center; color: white; margin-bottom: 0em;'>U of A Cake Order</h2></td></tr>";
    $data .= "<tr style='background: #eee;'><td><strong>Event Name:</strong> </td><td>" . $event_name . "</td></tr>";
    $data .= "<tr><td><strong>Contact Name:</strong> </td><td>" . $contact_name . "</td></tr>";
    $data .= "<tr style='background: #eee;'><td><strong>Event Location:</strong> </td><td>" . $event_location . "</td></tr>";
    $data .= "<tr><td><strong>Event Date:</strong> </td><td>" . $event_date . "</td></tr>";
    $data .= "<tr style='background: #eee;'><td><strong>Event Time:</strong> </td><td>" . $event_time . "</td></tr>";
    $data .= "<tr><td><strong>Email:</strong> </td><td>" . $email . "</td></tr>";
    $data .= "<tr style='background: #eee;'><td><strong>Phone Number:</strong> </td><td>" . $phone_number . "</td></tr>";
    $data .= "<tr><td><strong>Guest Count:</strong> </td><td>" . $guest_count . "</td></tr>";
    $data .= "<tr style='background: #eee;'><td><strong>Occasion:</strong> </td><td>" . $occasion . "</td></tr>";
    $data .= "<tr><td><strong>Type of Cake:</strong> </td><td>" . $cake_type . "</td></tr>";
    $data .= "<tr style='background: #eee;'><td><strong>Cake Filling:</strong> </td><td>" . $filling . "</td></tr>";
    $data .= "<tr><td><strong>Icing:</strong> </td><td>" . $icing . "</td></tr>";
    $data .= "<tr style='background: #eee;'><td><strong>Type and Price:</strong> </td><td>" . $price . "</td></tr>";
    $data .= "<tr><td><strong>Show Stopper Cakes Themes:</strong> </td><td>" . $theme . "</td></tr>";
    $data .= "<tr style='background: #eee;'><td><strong>Specialty Designs:</strong> </td><td>" . $specialty . "</td></tr>";
    $data .= "<tr><td><strong>Decor Reading:</strong> </td><td>" . $decor . "</td></tr>";
    $data .= "<tr style='background: #eee;'><td><strong>Special Instructions:</strong> </td><td>" . $instruction . "</td></tr>";
    $data .= "</table>";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
    $headers .= 'From: su-sueventplanning@email.arizona.edu' . "\r\n";
    $headers .= 'Reply-To: su-sueventplanning@email.arizona.edu' . "\r\n";
    $headers .= "X-Mailer: PHP/" . PHP_VERSION . "\r\n";

    $subject = $event_name . " - Cake Order Submission";

    $msg = '<html><body>';
    $msg .= "<p style='margin-bottom: 20px;'>We've received your catering event request submission. Thank you.</p>";
    $msg .= $data;
    $msg .= "</body></html>";

    mail($to, $subject, $msg, $headers);

    $msg2 = '<html><body>';
    $msg2 .= "<p style='margin-bottom: 20px;'>We've received new catering event request submission. Thank you.</p>";
    $msg2 .= $data;
    $msg2 .= "</body></html>";

    mail($from, $subject, $msg2, $headers);
    mail('sueventplanning@email.arizona.edu', $subject, $msg2, $headers);
    mail('su-web@email.arizona.edu', $subject, $msg2, $headers);

    $result = [
        'response' => true
    ];
    
    echo json_encode($result);

?>