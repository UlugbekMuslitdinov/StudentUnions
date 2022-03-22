<?php
$involvement_route = [
    'involvement' => [
        "title" => "Services",
        "url" => "/involvement/",
        "target" => "",
        "list" => [
            [ "title" => "Gallagher Theater", "url" => "/involvement/gallagher/", "target" => "",
              "child_id" => "gallagher",
              "child" => [
                    [ "title" => "Booking Gallagher", "url" => "/involvement/gallagher/booking.php", "target" => "" ]
                ]   
            ],
            [ "title" => "Arizona Esports Arena", "url" => "/involvement/arizonaesportsarena/index.php", "target" => "", "child_id" => "" ],
			[ "title" => "CatCard Office", "url" => "https://catcard.arizona.edu/", "target" => "_blank", "child_id" => "" ],
            [ "title" => "CatCa&dollar;h", "url" => "https://catcash.arizona.edu/", "target" => "_blank",
              "child_id" => "catcash",
              "child" => [
                  [ "title" => "Catprints", "url" => "https://catcash.arizona.edu/catprints.php", "target" => "" ],
                  [ "title" => "Login/Deposits", "url" => "/catcash/index.php", "target" => "" ]
              ]
            ],
            [ "title" => "Fast Copy & Design", "url" => "http://union.arizona.edu/fastcopy/", "target" => "_blank", "child_id" => "" ],
            // [ "title" => "HOMH Sleeping Pod", "url" => "https://hohm.life/book/book", "target" => "_blank", "child_id" => "" ],
        ]
    ],
    "involvement2"  => [
        "title" => "",
        "url" => "",
        "target" => "",
        "list" =>[
			[ "title" => "Digital Ad Platforms", "url" => "/involvement/digitalads/", "target" => "", "child_id" => "" ],
            [ "title" => "Events", "url" => "/rooms/event_types.php", "target" => "",
                "child_id" => "",
                "child" => [
                    [ "title" => "Types of Events", "url" => "/rooms/event_types.php", "target" => "" ],
                    [ "title" => "Special Events Policies", "url" => "/rooms/catering_policies.php", "target" => "" ],
                    [ "title" => "Conference Services", "url" => "/rooms/services.php", "target" => "" ],
                    [ "title" => "Equipment Rental Pricing", "url" => "/rooms/audiovisual.php", "target" => "" ],
                    [ "title" => "Banner Hanging", "url" => "/rooms/banner_policies.php", "target" => "" ]
                ]
            ],
            [ "title" => "Reserve a Room", "url" => "/rooms/reserving.php", "target" => "",
                "child_id" => "",
                "child" => [
                    [ "title" => "Reservation Form", "url" => "/catering/request/event/", "target" => "" ],
                    [ "title" => "Reservation Procedures", "url" => "/rooms/procedures.php", "target" => ""],
                    [ "title" => "S.M.A.R.T. Plan", "url" => "/catering/resources/Arizona_Catering_S.M.A.R.T_POP.pdf", "target" => "_blank" ],
                    [ "title" => "Room Use Policies", "url" => "/rooms/policies.php", "target" => "" ],
                    [ "title" => "Student Clubs and Organizations", "url" => "/rooms/procedures_studentorg.php", "target" => "" ],
                    // [ "title" => "University Offices or Departments", "url" => "/rooms/procedures_university.php", "target" => "" ],
                    [ "title" => "Cancellation/No-Show Policy", "url" => "/rooms/procedures.php#cancellation", "target" => "" ],
                    [ "title" => "Non-University Groups", "url" => "/rooms/procedures_other.php", "target" => "" ]
                ]
            ],
            [ "title" => "Reserve the UA Mall", "url" => "/mall/", "target" => "",
                "child_id" => "",
                "child" => [
                    [ "title" => "Available Space Maps", "url" => "/mall/maps.php", "target" => "" ],
                    // [ "title" => "Banner Policy", "url" => "/mall/banner_policy.php", "target" => "" ],
                    [ "title" => "Campus Use/Mall Activity Request Form", "url" => "/mall/request_form.php", "target" => "" ],
                    [ "title" => "Campus Use/Mall Activity Fees", "url" => "/mall/template/resources/SUMallFees.pdf", "target" => "_blank" ],
                    // [ "title" => "Credit Card Privacy Agreement ", "url" => "/mall/template/resources/VendorPrivacyAgreement.pdf", "target" => "_blank" ],
                    [ "title" => "DRC Guidelines", "url" => "/mall/template/resources/DRC_PlanningAccessibleInclusiveEvents.pdf", "target" => "_blank" ],
                    [ "title" => "Important Information", "url" => "/mall/info.php", "target" => "" ],
                    [ "title" => "Mall Guidelines", "url" => "/mall/guidelines.php", "target" => "" ],
                    [ "title" => "Unapproved Mall Vendors", "url" => "/mall/unapprovedvendors.php", "target" => "" ],
                ]
            ],
            [ "title" => "Banner Hanging", "url" => "/rooms/banner_policies.php", "target" => "", "no_left" => true, "child_id" => "" ],
            [ "title" => "Union Policies", "url" => "/operations/policies/index.php", "target" => "",
                "child_id" => "",
                "child" => [
                    [ "title" => "Banner Hanging Policy", "url" => "/rooms/banner_policies.php", "target" => "" ],
                    [ "title" => "Computer Lab Policy", "url" => "https://oscr.arizona.edu/", "target" => "_blank" ],
                    [ "title" => "Conflict of Interest Policy", "url" => "/operations/policies/conflictofinterest.php", "target" => "" ],
                    [ "title" => "Dance Policy", "url" => "/operations/policies/dances.php", "target" => "" ],
                    [ "title" => "Dock Access Policy", "url" => "/operations/policies/dockaccess.php", "target" => "" ],
                    [ "title" => "Flyers & Bulletin Boards Policy", "url" => "/operations/policies/bulletinboards.php", "target" => "" ],
                    [ "title" => "Keyless Access Policy", "url" => "/operations/policies/keylessaccess.php", "target" => "" ],
                    [ "title" => "Loitering & Solicitation Policy", "url" => "/operations/policies/loitering.php", "target" => "" ],
                    [ "title" => "Lost & Found Policy", "url" => "/operations/policies/lostandfound.php", "target" => "" ],
                    [ "title" => "Smoking Policy", "url" => "/operations/policies/smoking.php", "target" => "" ],
                    [ "title" => "Space Occupancy Policy", "url" => "/operations/policies/spaceoccupancy.php", "target" => "" ],
                    [ "title" => "Facility Checklist", "url" => "/operations/policies/template/resources/facchecklist.pdf", "target" => "_blank" ],
                    [ "title" => "UA Catering Waiver", "url" => "/catering/resources/CateringWaiver.pdf", "target" => "_blank" ]
                ]
            ],
            // [ "title" => "US Post Office", "url" => "/shopping/usps/index.php", "target" => "", "child_id" => "" ],
            [ "title" => "AZ Primary Eye Care Center", "url" => "http://arizonaprimaryeyecare.com/locations/ua", "target" => "_blank", "child_id" => "" ],
        ]
    ],
    "other"  => [
        "title" => "Involvement",
        "url" => "",
        "target" => "",
        "list" =>[
            [ "title" => "ASUA", "url" => "https://asuatoday.arizona.edu/", "target" => "_blank", "child_id" => "" ],
            [ "title" => "BookStores", "url" => "https://shop.arizona.edu", "target" => "_blank", "child_id" => "" ],
            [ "title" => "Family Weekend", "url" => "https://familyweekend.arizona.edu/", "target" => "_blank", "child_id" => "" ],
            [ "title" => "Fraternity and Sorority Programs", "url" => "https://greek.arizona.edu/welcome-fraternity-sorority-programs", "target" => "_blank", "child_id" => "" ],
            [ "title" => "GPSC", "url" => "http://www.gpsc.arizona.edu/", "target" => "_blank", "child_id" => "" ],
            [ "title" => "Leadership Program", "url" => "http://leadership.arizona.edu/", "target" => "_blank", "child_id" => "" ],
            [ "title" => "LGBTQ", "url" => "https://lgbtq.arizona.edu/", "target" => "_blank", "child_id" => "" ]
        ]
    ],
    "other2"  => [
        "title" => "",
        "list" => [
            // [ "title" => "Live @ 5", "url" => "/involvement/live/", "target" => "" ],
            [ "title" => "Transfer Student Center", "url" => "https://transfer.arizona.edu/", "target" => "_blank", "child_id" => "" ],
            [ "title" => "VETS Student Center", "url" => "https://vets.arizona.edu", "target" => "_blank", "child_id" => "" ],
            [ "title" => "Wildcat Event Board", "url" => "https://www.uawildcateventsboard.com/", "target" => "_blank",
              "child_id" => "eventboard",
              "child" => [
                [ "title" => "About Us", "url" => "/involvement/activities/about.php", "target" => "" ],
                [ "title" => "Committees", "url" => "/involvement/activities/committees.php", "target" => "" ]
              ]
            ],
            [ "title" => "Women & Gender Resource Center", "url" => "https://wrc.arizona.edu/", "target" => "_blank", "child_id" => "" ]
        ]
    ]
];