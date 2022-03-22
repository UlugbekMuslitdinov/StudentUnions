<?php
$about_route = [
    "about" => [
        "title"=> "About Student Unions",
        "url"=> "/about/",
        "target"=> "",
        "list"=>[
            [ "title"=> "About Us", "url"=> "/about/", "target"=> "" ],
            // [ "title"=> "Director's page", "url"=> "/about/executive-team/todd-millay", "target"=> "" ],
            [ "title"=> "Staff Directory", "url"=> "/about/directory/", "target"=> "" ],
            [ "title"=> "Executive Leadership Team", "url"=> "/about/executive-team/", "target"=> "",
              "child_id"=> "executive-members",
              "child"=> [
                [ "title"=> "Joel Burstein", "url"=> "/about/executive-team/joel-burstein", "target"=> "" ],
                [ "title"=> "Ricardo Carlos", "url"=> "/about/executive-team/ricardo-carlos", "target"=> "" ],
                [ "title"=> "Christine Carlson", "url"=> "/about/executive-team/christine-carlson", "target"=> "" ],
                [ "title"=> "Chelsea Ewer", "url"=> "/about/executive-team/chelsea-ewer", "target"=> "" ],
                [ "title"=> "Lupita Hollis", "url"=> "/about/executive-team/lupita-hollis", "target"=> "" ],
                [ "title"=> "Mari John", "url"=> "/about/executive-team/mari-john", "target"=> "" ],
                [ "title"=> "Todd Millay", "url"=> "/about/executive-team/todd-millay", "target"=> "" ],
                [ "title"=> "Michael Omo", "url"=> "/about/executive-team/michael-omo", "target"=> "" ],
                [ "title"=> "Rachelle Stone", "url"=> "/about/executive-team/rachelle-stone", "target"=> "" ]
              ]
            ],
            // [ "title"=> "Sustainability", "url"=> "/sustainability/index.php", "target"=> "",
            //   "child_id"=> "sustainability",
            //   "child"=> [
            //     [ "title"=> "Efforts", "url"=> "/sustainability/efforts.php", "target"=> "" ],
            //     // [ "title"=> "Committee", "url"=> "/sustainability/committee.php", "target"=> "" ],
            //     [ "title"=> "Links", "url"=> "/sustainability/links.php", "target"=> "" ],
            //     [ "title"=> "Take Action", "url"=> "/sustainability/action.php", "target"=> "" ],
            //   ]
            // ],
        ]
    ],
    "about2" => [
        "title"=> "",
        "url"=> "",
        "target"=> "",
        "list"=>[
            [ "title"=> "Maps and Rooms", "url"=> "/infodesk/maps/index.php", "target"=> "" ],
            [ "title"=> "U.S.S Arizona Bell", "url"=> "/about/uss_arizona_bell.php", "target"=> "" ],
            // [ "title"=> "Feedback", "url"=> "", "target"=> "" ],
            [ "title"=> "Job Fair", "url"=> "/about/jobfair/index.php", "target"=> "" ],
            [ "title"=> "Employment", "url"=> "/employment/", "target"=> "",
              "child_id"=> "student_job",
              "child"=> [
                [ "title"=> "Student Employment", "url"=> "/employment/", "target"=> "" ],
                [ "title"=> "Leadership Program (AALP)", "url"=> "/about/aalp/", "target"=> "" ],
                [ "title"=> "FAQs", "url"=> "/employment/faq.php", "target"=> "" ]
              ]
            ],
            [ "title"=> "Contact", "url"=> "/infodesk/index.php", "target"=> "" ],
        ]
    ],
    "about3" => [
        "title"=> "Union Hours",
        "url"=> "/infodesk/hours/",
        "target"=> "",
        "list"=>[
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
            ],
        ]
  ],
  "announcement" => [
    "title"=> "Announcement",
    "url"=> "",
    "target"=> "",
    "list"=>[
      [ "title"=> "Coronavirus", "url"=> "/coronavirus/index.php", "target"=> "" ],
      // [ "title"=> "Order Boxes", "url"=> "/dining/boxorder", "target"=> "" ],
    ]
]
];