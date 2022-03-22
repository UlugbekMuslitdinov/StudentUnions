<?php
namespace App\Http\Controllers\Catering;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SU\Accounts;
use App\Model\SU\AccountEvent;
use App\Model\SU\CateringEventRequest;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use DateTime;
// use App\Http\Controllers\MS\CalendarController;
use App\Mail\EventEmail;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller 
{

	public function __construct()
    {
        // $this->middleware('suapi');
    }

    public function newRequest (Request $request) {
        // Send Email Confirmations
        $emailData = new \stdClass();
        $emailData->form = (object) $_POST;

        // To Customer
        $emailData->subject = 'Catering Event Request Submission';
        $emailData->title = 'Thank you.';
        $emailData->msg = 'We\'ve received your catering event request submission.';

        $emailData->line1 = 'Hello ' . $_POST['contact-name'] . ',';
        $emailData->line2 = 'Thank you for choosing SUMC Arizona Catering and Events Co. for your next event. We have received your request and will be in touch within 48 hours to learn more about your gathering. This is an automated response and does not guarantee your event.';
        $emailData->line3 = 'If your request is for an event occurring within the next 7 days, please call 520-621-1414 for immediate assistance.';
        $emailData->line4 = 'Have a great day,';
        $emailData->line5 = 'SUMC Catering and Events Team';
        $emailData->line6 = 'Student Union Memorial Center, 441';
        $emailData->line7 = '1303 E. University Blvd | Tucson, AZ 85719';
        $emailData->line8 = 'Office: 520-621-1414';
        $emailData->line9 = 'su-sueventplanning@email.arizona.edu';
        $emailData->line10 = 'https://union.arizona.edu';

        $EventEmail = new EventEmail($emailData);
        $result = Mail::to($_POST['email'])->send($EventEmail);

        // To Catering Office
        $emailData->subject = 'Reply: Catering Event Request Submission';
        $emailData->title = '';
        $emailData->msg = '';

        $emailData->line1 = 'New event request.';
        $emailData->line2 = 'We\'ve received new catering event request submission.';
        $emailData->line3 = '';
        $emailData->line4 = '';
        $emailData->line5 = 'SUMC Catering and Events Team';
        $emailData->line6 = 'Student Union Memorial Center, 441';
        $emailData->line7 = '1303 E. University Blvd | Tucson, AZ 85719';
        $emailData->line8 = 'Office: 520-621-1414';
        $emailData->line9 = 'su-sueventplanning@email.arizona.edu';
        $emailData->line10 = 'https://union.arizona.edu';

        $EventEmail = new EventEmail($emailData);
        // $mail_result = Mail::to('sueventplanning@email.arizona.edu')->send($EventEmail);
	$mail_result = Mail::to('su-web@email.arizona.edu')->send($EventEmail);


        $tokenCache = new \App\TokenStore\TokenCache;

        // $graph = new Graph();
        // $graph->setAccessToken($tokenCache->getAccessToken());

        // var_dump(date_format(new DateTime($request['event-date'] . ' ' . $request['event-start-time']), DateTime::ATOM));
        // var_dump($request['event-date'] . ' ' . $request['event-start-time']);
        // exit();

        date_default_timezone_set('America/Phoenix');


        $emailData->title = '';
        $emailData->msg = '';
        $emailData->line1 = '';
        $emailData->line2 = '';
        $emailData->line3 = '';
        $emailData->line4 = '';
        $emailData->line5 = '';
        $emailData->line6 = '';
        $emailData->line7 = '';
        $emailData->line8 = '';
        $emailData->line9 = '';
        $emailData->line10 = '';
        $new_event = [
            "Subject" => $request['event-name'],
            "Body" => [
                "ContentType" => "HTML",
                "Content" => view('catering.mail.event.main', ['data' => $emailData])->render()
            ],
            "Start" => [
                "DateTime" => date_format(new DateTime($request['event-date'] . ' ' . $request['event-start-time']), DateTime::ATOM),
                "TimeZone" => "Mountain Standard Time"
            ],
            "End" => [
                "DateTime" => date_format(new DateTime($request['event-date'] . ' ' . $request['event-end-time']), DateTime::ATOM),
                "TimeZone" => "Mountain Standard Time"
            ],
            "Categories" => ["Pending Event"],
            "Attendees" => [
                    [
                    "EmailAddress" => [
                        "Address" => "",
                        "Name" => ""
						// "Address" => "su-web@email.arizona.edu",
                        // "Name" => "SU Web"
                    ],
                    // "Type" => "Required"
                ]
            ]
        ];

        // $event = $graph->createRequest('POST', "/me/events")
        //                 ->attachBody($new_event)
        //                 ->setReturnType(Model\Event::class)
        //                 ->execute();

        
        $newEvent = New CateringEventRequest;
        // $newEvent->outlook_event_id = $event->getID();
        $newEvent->outlook_event_id = 'N/A';
        $newEvent->data = json_encode($_POST);
        $newEvent->status = 'submitted';
        $newEvent->save();

        // Get Account ID
        $Accounts = New Accounts;
        $account_id = $Accounts->get_id_with_email($_POST['email'], $_POST['contact-name'], $_POST['department-organization']);

        // Create Relationship between Account and Event
        $insertAccountEvent = AccountEvent::insert([
            'account_id' => $account_id,
            'event_id' => $newEvent->id
        ]);

        return response()->json([
            'success' => true,
            // "start" => date_format(new DateTime($request['event-date'] . ' ' . $request['event-start-time']), DateTime::ATOM),
            // "end" => date_format(new DateTime($request['event-date'] . ' ' . $request['event-end-time']), DateTime::ATOM),
        ], 200);
    }

    public function confirmation (Request $request){  
        return response()->json([
            'success' => true,
        ], 200);
    }
}