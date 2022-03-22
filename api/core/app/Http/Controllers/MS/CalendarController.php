<?php
namespace App\Http\Controllers\MS;

use App\Http\Controllers\Controller;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class CalendarController extends Controller
{
    public function calendar()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $tokenCache = new \App\TokenStore\TokenCache;

        $graph = new Graph();
        $graph->setAccessToken($tokenCache->getAccessToken());

        // $user = $graph->createRequest('GET', '/me')
        //         ->setReturnType(Model\User::class)
        //         ->execute();

        // $eventsQueryParams = array (
        //     // // Only return Subject, Start, and End fields
        //     "\$select" => "subject,start,end",
        //     // Sort by Start, oldest first
        //     "\$orderby" => "Start/DateTime",
        //     // Return at most 10 results
        //     "\$top" => "10"
        // );

        // $getEventsUrl = '/me/events?'.http_build_query($eventsQueryParams);
        // $events = $graph->createRequest('GET', $getEventsUrl)
        //                 ->setReturnType(Model\Event::class)
        //                 ->execute();

        $new_event = [
            "Subject" => "Discuss the Calendar REST API",
            "Body" => [
                "ContentType" => "HTML",
                "Content" => "Testing Calendar API"
            ],
            "Start" => [
                "DateTime" => "2019-11-20T18:00:00",
                "TimeZone" => "Pacific Standard Time"
            ],
            "End" => [
                "DateTime" => "2019-11-20T19:00:00",
                "TimeZone" => "Pacific Standard Time"
            ],
            "Categories" => ["Pending"]
            // "Attendees" => [
            //     [
            //     "EmailAddress" => [
            //         "Address" => "yontaek@email.arizona.edu",
            //         "Name" => "Yontaek Choi"
            //     ],
            //         "Type" => "Required"
            //     ]
            // ]
        ];

        $event = $graph->createRequest('POST', "/me/events")
                        ->attachBody($new_event)
                        ->setReturnType(Model\Event::class)
                        ->execute();

        var_dump($event);
    }

    public function calendarList()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $tokenCache = new \App\TokenStore\TokenCache;

        $graph = new Graph();
        $graph->setAccessToken($tokenCache->getAccessToken());

        // $user = $graph->createRequest('GET', '/me')
        //         ->setReturnType(Model\User::class)
        //         ->execute();

        // $eventsQueryParams = array (
        //     // // Only return Subject, Start, and End fields
        //     "\$select" => "subject,start,end",
        //     // Sort by Start, oldest first
        //     "\$orderby" => "Start/DateTime",
        //     // Return at most 10 results
        //     "\$top" => "10"
        // );

        // $getEventsUrl = '/me/events?'.http_build_query($eventsQueryParams);
        // $events = $graph->createRequest('GET', $getEventsUrl)
        //                 ->setReturnType(Model\Event::class)
        //                 ->execute();

        $new_event = [
            "Subject" => "Discuss the Calendar REST API",
            "Body" => [
                "ContentType" => "HTML",
                "Content" => "Testing Calendar API"
            ],
            "Start" => [
                "DateTime" => "2019-10-31T18:00:00",
                "TimeZone" => "Pacific Standard Time"
            ],
            "End" => [
                "DateTime" => "2019-10-31T19:00:00",
                "TimeZone" => "Pacific Standard Time"
            ],
            "Categories" => ["Pending"],
            "Attendees" => [
                [
                "EmailAddress" => [
                    "Address" => "su-web@email.arizona.edu",
                    "Name" => "SU Web"
                ],
                    "Type" => "Required"
                ]
            ]
        ];

        $event = $graph->createRequest('POST', "/me/events")
                        ->attachBody($new_event)
                        ->setReturnType(Model\Event::class)
                        ->execute();

        var_dump($event);
    }

    public function getCalendars() {
        $tokenCache = new \App\TokenStore\TokenCache;

        $graph = new Graph();
        $graph->setAccessToken($tokenCache->getAccessToken());

        $calendars = $graph->createRequest('GET', "/me/calendargroups")
                        // ->attachBody()
                        ->setReturnType(Model\Calendar::class)
                        ->execute();

        echo "<pre>";
        var_dump($calendars);
    }

    public function createEvent () {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $tokenCache = new \App\TokenStore\TokenCache;

        $graph = new Graph();
        $graph->setAccessToken($tokenCache->getAccessToken());

        $new_event = [
            "Subject" => "Test the Calendar REST API",
            "Body" => [
                "ContentType" => "HTML",
                "Content" => "Testing Calendar API"
            ],
            "Start" => [
                "DateTime" => "2019-11-20T18:00:00",
                "TimeZone" => "Pacific Standard Time"
            ],
            "End" => [
                "DateTime" => "2019-11-20T19:00:00",
                "TimeZone" => "Pacific Standard Time"
            ],
            "Categories" => ["Pending Event"],
            "Attendees" => [
                [
                "EmailAddress" => [
                    "Address" => "su-web@email.arizona.edu",
                    "Name" => "SU Web"
                ],
                    "Type" => "Required"
                ]
            ]
        ];

        $event = $graph->createRequest('POST', "/me/events")
                        ->attachBody($new_event)
                        ->setReturnType(Model\Event::class)
                        ->execute();

        echo '<pre>';
        var_dump($event);
        echo '<br/>';
        echo $event->getID();

        // return 
    }

    public function updateEvent () {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $tokenCache = new \App\TokenStore\TokenCache;

        $graph = new Graph();
        $graph->setAccessToken($tokenCache->getAccessToken());

        $update_event = [
            "Categories" => ["Scheduled"]
        ];

        $id = "AAMkAGU2ZmNiY2Y5LWE4NmYtNDU4OS1hNDM3LTEwNzhkYzc1MzI5MABGAAAAAAAdWyjZpq50TKi3P5MIlbToBwCipXMW70k7RrMQdHSRew9TAAAAAAENAACipXMW70k7RrMQdHSRew9TAAGYxrTQAAA=";

        $event = $graph->createRequest('PATCH', "/me/events/".$id)
                        ->attachBody($update_event)
                        ->setReturnType(Model\Event::class)
                        ->execute();

        var_dump($event);
    }
}