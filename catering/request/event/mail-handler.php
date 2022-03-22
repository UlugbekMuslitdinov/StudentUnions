<?php
    // echo '<pre>';
    // var_dump($_POST);
    // exit();

    // if (isset($_POST['submit'])) {
        $to = $_POST['email']; // send to this email address (Sueventplanning@email.arizona.edu)
        // $from = 'SUEventplanning@email.arizona.edu'; // sender's email address
        $from = 'su-sueventplanning@email.arizona.edu';
        // $from = 'su-web@email.arizona.edu'; // sender's email address

        $department_organization = $_POST['department-organization'];
        $contact_name = $_POST['contact-name'];
        $phone_number = $_POST['phone'];
        $mobile_number = $_POST['mobile'];
        $email = $_POST['email'];

        $event_name = $_POST['event-name'];
        // $event_date = $_POST['event-date'];
        $event_date = date("m/d/Y", strtotime($_POST['event-date']));
        $event_start_time = date('h:i A', strtotime($_POST['event-start-time']));
        $event_end_time = date('h:i A', strtotime($_POST['event-end-time']));
        $number_of_attendees = $_POST['number-of-attendees'];
        $type_of_service = $_POST['type-of-service'];

        if ($type_of_service != 'Meeting Space Only') { // if catering...
            $catering_type = "";
            foreach($_POST['check_list'] as $check) { // get all checked values
                $catering_type .= $check . ', '; // 
            }
            $catering_type = rtrim($catering_type, ', '); // remove ending comma

            $catering_start_time = date('h:i A', strtotime($_POST['catering-start-time']));
            $catering_end_time = date('h:i A', strtotime($_POST['catering-end-time']));
            $serviceware = $_POST['servicewareRadio'];
            $catering_comments = $_POST['catering-comments'];
        }

        if ($type_of_service == 'Catering Only') {
            $catering_building = $_POST['building'];
            $catering_address = $_POST['address'];
            $catering_room = $_POST['room-number'];
            $catering_style = $_POST['setup-notes'];
        }

        if ($type_of_service != 'Catering Only') {
            $setup_style = $_POST['setup-style'];
            $setup_comments = $_POST['setup-comments'];
            $audiovisual = $_POST['audiovisualRadio'];
            if ($audiovisual == 'Yes') { // if audiovisual...
                $audiovisual_comments = $_POST['audiovisual-comments'];
            }
            $addional_comments = $_POST['additional-comments'];
        }

        $payment_method = $_POST['paymentRadio'];
        if ($payment_method == "account"){
            $payment_method = 'UA IDB Account Number <br />' .
                              '- Account Number: ' . $_POST['account-number'] . '<br/>' .
                              '- Sub Account Number: ' . $_POST['sub-account-number'];
        }

        

        $data = '';
        $data .= '<table rules="all" style="border-color: #666; border: 1px;" cellpadding="3">';
        $data .= "<tr style='background: #ac051f;'><td colspan='2'><h2 style='text-align: center; color: white; margin-bottom: 0em;'>Arizona Catering Co.<br/>Event Request</h2></td></tr>";
        $data .= "<tr style='background: #eee;'><td><strong>Department/Organization:</strong> </td><td>" . $department_organization . "</td></tr>";
        $data .= "<tr><td><strong>Contact Name:</strong> </td><td>" . $contact_name . "</td></tr>";
        $data .= "<tr style='background: #eee;'><td><strong>Phone Number:</strong> </td><td>" . $phone_number . "</td></tr>";
        $data .= "<tr><td><strong>Mobile Number:</strong> </td><td>" . $mobile_number . "</td></tr>";
        $data .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . $email . "</td></tr>";
        $data .= "<tr><td><strong>Event Name:</strong> </td><td>" . $event_name . "</td></tr>";
        $data .= "<tr style='background: #eee;'><td><strong>Event Date:</strong> </td><td>" . $event_date . "</td></tr>";
        $data .= "<tr><td><strong>Event Start Time:</strong> </td><td>" . $event_start_time . "</td></tr>";
        $data .= "<tr style='background: #eee;'><td><strong>Event End Time</strong> </td><td>" . $event_end_time . "</td></tr>";
        $data .= "<tr><td><strong>Number of Attendees:</strong> </td><td>" . $number_of_attendees . "</td></tr>";
        $data .= "<tr style='background: #eee;'><td><strong>Type of Service:</strong> </td><td>" . $type_of_service . "</td></tr>";
        if ($type_of_service != 'Meeting Space Only') { // if catering...
            $data .= "<tr><td><strong>Catering Type:</strong> </td><td>" . $catering_type . "</td></tr>";
            $data .= "<tr style='background: #eee;'><td><strong>Catering Start Time:</strong> </td><td>" . $catering_start_time . "</td></tr>";
            $data .= "<tr><td><strong>Catering End Time:</strong> </td><td>" . $catering_end_time . "</td></tr>";
            $data .= "<tr style='background: #eee;'><td><strong>Serviceware Selection:</strong> </td><td>" . $serviceware . "</td></tr>";
            $data .= "<tr><td><strong>Catering Comments:</strong> </td><td>" . $catering_comments . "</td></tr>";
        }
        if ($type_of_service == 'Catering only') {
            $data .= "<tr><td><strong>Building:</strong> </td><td>" . $catering_building . "</td></tr>";
            $data .= "<tr style='background: #eee;'><td><strong>Address:</strong> </td><td>" . $catering_address . "</td></tr>";
            $data .= "<tr><td><strong>Room Number/Name:</strong> </td><td>" . $catering_room . "</td></tr>";
            $data .= "<tr style='background: #eee;'><td><strong>Setup Style Note:</strong> </td><td>" . $catering_style . "</td></tr>";
        }
        if ($type_of_service != 'Catering Only') {
            $data .= "<tr><td><strong>Setup Style:</strong> </td><td>" . $setup_style . "</td></tr>";
            $data .= "<tr style='background: #eee;'><td><strong>Setup Comments:</strong> </td><td>" . $setup_comments . "</td></tr>";
            $data .= "<tr><td><strong>Audiovisual:</strong> </td><td>" . $audiovisual . "</td></tr>";
            if ($audiovisual == 'Yes') { // if audiovisual...
                $data .= "<tr style='background: #eee;'><td><strong>Audiovisual Comments:</strong> </td><td>" . $audiovisual_comments . "</td></tr>";
            }
            $data .= "<tr><td><strong>Additional Comments:</strong> </td><td>" . $addional_comments . "</td></tr>";
        }
        $data .= "<tr style='background: #eee;'><td><strong>Payment Method:</strong> </td><td>" . $payment_method . "</td></tr>";
        $data .= "</table>";
        // $msg .= "</body></html>";
        // $msg2 = "We've received your catering event request submission. Thank you.";


        // $headers = "From: " . $from;
        // $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html; charset=iso-8859-1" . "\r\n";
        // $headers .= 'From: su-sueventplanning@email.arizona.edu' . "\r\n";
        // $headers .= 'Reply-To:su-sueventplanning@email.arizona.edu' . "\r\n";
        // $headers .= "X-Mailer:PHP/" . PHP_VERSION . "\r\n";

        // $headers1 = $headers;
        // $headers2 = $headers;

        // $subject = "Catering Event Request Submission";
        // $subject2 = "Reply: Catering Event Request Submission";

        // Email To Customer
        $headers1 = "MIME-Version: 1.0" . "\r\n";
        $headers1 .= "Content-type:text/html; charset=UTF-8" . "\r\n";
        $headers1 .= 'From: SU-sueventplanning@email.arizona.edu' . "\r\n";
        $headers1 .= 'Reply-To:SU-sueventplanning@email.arizona.edu' . "\r\n";
        $headers1 .= "X-Mailer:PHP/" . PHP_VERSION . "\r\n";

        $subject1 = "Catering Event Request Submission";

        $msg = '<html><body>';
        $msg .= "<p style='margin-bottom: 20px;'>We've received your catering event request submission. Thank you.</p>";
        $msg .= $data;
        $msg .= "</body></html>";

        mail($to, $subject1, wordwrap($msg,70), $headers1);


        // Email to Manager
        $headers2 = "MIME-Version: 1.0" . "\r\n";
        $headers2 .= "Content-type:text/html; charset=UTF-8" . "\r\n";
        $headers2 .= 'From: SU-sueventplanning@email.arizona.edu' . "\r\n";
        $headers2 .= 'Reply-To:SU-sueventplanning@email.arizona.edu' . "\r\n";
        $headers2 .= "X-Mailer:PHP/" . PHP_VERSION . "\r\n";

        $subject2 = "Reply: Catering Event Request Submission";

        $msg2 = '<html><body>';
        $msg2 .= "<p style='margin-bottom: 20px;'>We've received new catering event request submission.</p>";
        $msg2 .= $data;
        $msg2 .= "</body></html>";
        
        mail('sueventplanning@email.arizona.edu', $subject2, wordwrap($msg2,70), $headers2); // reply     
        // mail('su-web@email.arizona.edu', $subject2, wordwrap($msg2,70), $headers2);
        
        
        $result = [
            'response' => true,
            // 'server_output' => $server_output,
            // 'curl error' => $error
        ];
        
        echo json_encode($result);
    // }
?>