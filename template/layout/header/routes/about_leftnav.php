<?php
$aboutleft_route = [
    "about" => [
        "title" => "About Student Unions",
        "url" => "/about/",
        "target" => "",
        "list" => [
            [ "title" => "About Us", "url" => "/about/", "target" => "" ],
            // [ "title"=> "Director's page", "url"=> "/about/executive-team/todd-millay", "target"=> "" ],
            [ "title"=> "Executive Leadership Team", "url"=> "/about/executive-team/", "target"=> "",
              "child_id"=> "executive-members",
              "child"=> [
				[ "title"=> "Todd Millay", "url"=> "/about/executive-team/todd-millay", "target"=> "" ],
                [ "title"=> "Joel Burstein", "url"=> "/about/executive-team/joel-burstein", "target"=> "" ],
                [ "title"=> "Ricardo Carlos", "url"=> "/about/executive-team/ricardo-carlos", "target"=> "" ],
                [ "title"=> "Christine Carlson", "url"=> "/about/executive-team/christine-carlson", "target"=> "" ],
                [ "title"=> "Chelsea Ewer", "url"=> "/about/executive-team/chelsea-ewer", "target"=> "" ],
                [ "title"=> "Lupita Hollis", "url"=> "/about/executive-team/lupita-hollis", "target"=> "" ],
                [ "title"=> "Mari John", "url"=> "/about/executive-team/mari-john", "target"=> "" ],
                [ "title"=> "Eric Kay", "url"=> "/about/executive-team/eric-kay", "target"=> "" ],
                [ "title"=> "Michael Omo", "url"=> "/about/executive-team/michael-omo", "target"=> "" ],
                [ "title"=> "Rachelle Stone", "url"=> "/about/executive-team/rachelle-stone", "target"=> "" ],
              ]
            ],
            [ "title"=> "Staff Directory", "url"=> "/about/directory/", "target"=> "" ],
            [ "title"=> "Maps and Rooms", "url"=> "/infodesk/maps/index.php", "target"=> "" ],
            [ "title"=> "U.S.S Arizona Bell", "url"=> "/about/uss_arizona_bell.php", "target"=> "" ],
            // [ "title"=> "Feedback", "url"=> "/feedback/", "target"=> "" ],
            [ "title"=> "Job Fair", "url"=> "/about/jobfair/index.php", "target"=> "" ],
            [ "title"=> "Employment", "url"=> "/employment/", "target"=> "",
              "child_id"=> "",
              "child"=> [
                [ "title"=> "Student Employment", "url"=> "/employment/", "target"=> "" ],
                [ "title"=> "Leadership Program (AALP)", "url"=> "/about/aalp/", "target"=> "" ],
                [ "title"=> "FAQs", "url"=> "/employment/faq.php", "target"=> "" ]
              ]
            ],
            [ "title"=> "Mission Statement", "url"=> "/about/mission.php", "target"=> "" ],
            [ "title"=> "Factoids & Features", "url"=> "/about/morethan.php", "target"=> "" ],
            // [ "title"=> "Sustainability", "url"=> "/sustainability/index.php", "target"=> "",
            //   "child_id"=> "",
            //   "child"=> [
            //     [ "title"=> "Efforts", "url"=> "/sustainability/efforts.php", "target"=> "" ],
            //     // [ "title"=> "Committee", "url"=> "/sustainability/committee.php", "target"=> "" ],
            //     [ "title"=> "Links", "url"=> "/sustainability/links.php", "target"=> "" ],
            //     [ "title"=> "Take Action", "url"=> "/sustainability/action.php", "target"=> "" ],
            //   ]
            // ],
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
            [ "title"=> "Contact", "url"=> "/infodesk/index.php", "target"=> "" ],
            // [ "title"=> "Tell Us", "url"=> "/feedback/", "target"=> "" ]
        ]
                ],
    "hour" => [
        "title" => "Union Hours",
        "url" => "/infodesk/hours/",
        "target" => "",
        "list" => [
            [ "title"=> "Location", "url"=> "/infodesk/hours/index.php?cat=all", "target"=> "",
              "child_id"=> "union_hour_location",
              "child"=> [
                [ "title"=> "SUMC", "url"=> "/infodesk/hours/index.php?cat=sumc", "target"=> "" ],
                [ "title"=> "Global Center", "url"=> "/infodesk/hours/index.php?cat=psu", "target"=> "" ],
                [ "title"=> "Union Outlets", "url"=> "/infodesk/hours/index.php?cat=ufs", "target"=> "" ]
              ]
            ],
            [ "title"=> "Category", "url"=> "/infodesk/hours/index.php?cat=all", "target"=> "",
              "child_id"=> "union_hour_category",
              "child"=> [
                [ "title"=> "Dining", "url"=> "/infodesk/hours/index.php?cat=dining", "target"=> "" ],
                [ "title"=> "Administrative", "url"=> "/infodesk/hours/index.php?cat=admin", "target"=> "" ],
                [ "title"=> "Retail & Services", "url"=> "/infodesk/hours/index.php?cat=services", "target"=> "" ]
              ]
            ]   
        ]
    ]
];