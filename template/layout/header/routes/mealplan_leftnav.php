<?php
$mealplans_route = [
    "home" => [
        "title" => "Meal Plans",
        "url" => "",
        "target" => "",
        "list" => [
            [ "title" => "Meal Plans Home", "url" => "/mealplans/index.php", "target" => "" ],
            [ "title" => "Get a Meal Plan", "url" => "/mealplans/why.php", "target" => "",
                "child_id" => "",
                "child" => [
                    [ "title"=> "Swipe Plan Flyer", "url"=> "/mealplans/template/resources/SwipeMealPlans_Flyer.pdf", "target"=> "_blank" ],
                    [ "title"=> "Honors Meal Plan Flyer", "url"=> "/mealplans/template/resources/HonorsVillageMealPlans_Flyer.pdf", "target"=> "_blank" ],
                    [ "title"=> "Debit Meal Plan Flyer", "url"=> "/mealplans/template/resources/DebitMealPlans_Flyer.pdf", "target"=> "_blank" ],
					[ "title"=> "CatCash", "url"=> "/mealplans/template/resources/CatCash_Flyer.pdf", "target"=> "_blank" ]
                ]
            ],
            [ "title" => "Meal Plans Q&A's", "url" => "/mealplans/faq.php", "target" => "",
                "child_id" => "",
                "child" => [
                    [ "title"=> "Swipe Plan", "url"=> "/mealplans/template/resources/SwipeMealPlans_Q&A.pdf", "target"=> "_blank" ],
                    [ "title"=> "Honors Meal Plan", "url"=> "/mealplans/template/resources/HonorsVillageMealPlans_Q&A.pdf", "target"=> "_blank" ],
                    [ "title"=> "Debit Meal Plan", "url"=> "/mealplans/template/resources/DebitMealPlans_Q&A.pdf", "target"=> "_blank" ],
					[ "title"=> "CatCash", "url"=> "/mealplans/template/resources/CatCash_Q&A.pdf", "target"=> "_blank" ]
                ]
            ],
			[ "title"=> "General FAQs", "url"=> "/mealplans/faq.php", "target"=> "" ],
            [ "title"=> "Terms & Conditions", "url"=> "/mealplans/terms.php", "target"=> "" ],
            [ "title"=> "Contact Us", "url"=> "/mealplans/contactus", "target"=> "" ],
        ]
    ]
];