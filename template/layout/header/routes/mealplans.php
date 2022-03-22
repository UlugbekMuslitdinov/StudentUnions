<?php
$mealplans_route = [
    "login" => [
        "title"=> "Login",
        "url"=> "/mealplans/login.php",
        "target"=> "",
        "list"=>[
            [ "title"=> "Member Login", "url"=> "/mealplans/login.php?login_type=netID", "target"=> "" ],
            [ "title"=> "Guest Login", "url"=> "/mealplans/login.php?login_type=UAGuest", "target"=> "" ],
            [ "title"=> "Sign-up", "url"=> "/mealplans/login.php?login_type=netID", "target"=> "" ]
        ]
    ],
    "get" => [
        "title"=> "Get a Meal Plan",
        "url"=> "/mealplans",
        "target"=> "",
        "list"=>[
            [ "title"=> "Why Get a Meal Plan", "url"=> "/mealplans/why.php", "target"=> "" ],
            [ "title"=> "What Plans Are Available", "url"=> "/mealplans/plans.php", "target"=> "" ],
            [ "title"=> "Where Can I Eat", "url"=> "/mealplans/where.php", "target"=> "" ]
        ]
    ],
    "swipe" => [
        "title"=> "Swipe Plans",
        "url"=> "",
        "target"=> "",
        "list"=>[
            [ "title"=> "Honors Village Meal Plans flyer", "url"=> "/mealplans/template/resources/HonorsVillageMealPlans_Flyer.pdf", "target"=> "_blank" ],
            [ "title"=> "Swipe Meal Plans flyer", "url"=> "/mealplans/template/resources/SwipeMealPlans_Flyer.pdf", "target"=> "_blank" ]
        ]
    ],
    // "honor" => [
    //     "title"=> "Honors Village Meal Plans",
    //     "url"=> "/mealplans/template/resources/MealPlans_HonorsDorm.pdf",
    //     "target"=> "_blank",
    //     "list"=>[
    //         [ "title"=> "Download PDF", "url"=> "/mealplans/template/resources/MealPlans_HonorsDorm.pdf", "target"=> "_blank" ]
    //     ]
    // ],
    "flyer" => [
        "title"=> "Meal Plan Flyer",
        "url"=> "/mealplans/template/resources/mealplans.pdf",
        "target"=> "_blank",
        "list"=>[
            [ "title"=> "Download PDF", "url"=> "/mealplans/template/resources/mealplans.pdf", "target"=> "_blank" ]
        ]
    ]
];