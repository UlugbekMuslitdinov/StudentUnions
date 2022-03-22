<?php
// Breakfast
$GLOBALS['BREAKFAST_PRICE'] = 2.79;

// Beverages
$GLOBALS['SODA_PRICE'] = 1.99;
$GLOBALS['MINUTEMAID_PRICE'] = 1.99;
$GLOBALS['DASANI_PRICE'] = 1.69;
$GLOBALS['COFFEEBOX_PRICE'] = 15.99;

// Deli Trays
$GLOBALS['POWERHITTER_REGULAR_PRICE'] = 34.99;
$GLOBALS['POWERHITTER_LARGE_PRICE'] = 69.99;
$GLOBALS['PERFECTGAME_PRICE'] = 34.99;
$GLOBALS['TRIPLECROWN_PRICE'] = 69.99;
$GLOBALS['QUALITYSTART_PRICE'] = 49.99;
$GLOBALS['PLAYBALL_PRICE'] = 59.99;

// Salad Sides
$GLOBALS['REGULAR_SALAD_PRICE'] = 11.99;
$GLOBALS['LARGE_SALAD_PRICE'] = 21.99;
$GLOBALS['ASTAR_REGULAR_SALAD_PRICE'] = 14.99;
$GLOBALS['ASTAR_LARGE_SALAD_PRICE'] = 26.99;

// Salad Boxes
$GLOBALS['SALADBOX_PRICE'] = 10.99;

// Lunch Boxes
$GLOBALS['LUNCHBOX_PRICE'] = 9.99;

// Dessert
$GLOBALS['DESSERT_REGULAR_PRICE'] = 6.99;
$GLOBALS['DESSERT_LARGE_PRICE'] = 12.99;
$GLOBALS['BATTINGAVG_PRICE'] = 5.99;

// 18" Sub Sandwiches
$GLOBALS['SUBSANDWICH_PRICE'] = 19.99;

// Extra Chips
$GLOBALS['CHIPS_PRICE'] = 0.89;

function buildReceipt($data) {
    $data['customer_name'] = 'Amit';

    $res .= '<!doctype html><html> <head> <meta name="viewport" content="width=device-width" /> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <title>On Deck Deli Catering Order</title> <style> .table { margin-top: 20px; border: 1px solid; } .orangeheader { background-color:  #f59525; color: white; } tr { border-bottom: 1px solid; } .row-item { text-align: center; } /* ------------------------------------- GLOBAL RESETS ------------------------------------- */ /*All the styling goes here*/ img { border: none; -ms-interpolation-mode: bicubic; max-width: 100%; } body { background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; } table { border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; } table td { font-family: sans-serif; font-size: 14px; vertical-align: top; } /* ------------------------------------- BODY & CONTAINER ------------------------------------- */ .body { background-color: #f6f6f6; width: 100%; } /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */ .container { display: block; Margin: 0 auto !important; /* makes it centered */ max-width: 580px; padding: 10px; width: 580px; } /* This should also be a block element, so that it will fill 100% of the .container */ .content { box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; } /* ------------------------------------- HEADER, FOOTER, MAIN ------------------------------------- */ .main { background: #ffffff; border-radius: 3px; width: 100%; } .wrapper { box-sizing: border-box; padding: 20px; } .content-block { padding-bottom: 10px; padding-top: 10px; } .footer { clear: both; Margin-top: 10px; text-align: center; width: 100%; } .footer td, .footer p, .footer span, .footer a { color: #999999; font-size: 12px; text-align: center; } /* ------------------------------------- TYPOGRAPHY ------------------------------------- */ h1, h2, h3, h4 { color: #000000; font-family: sans-serif; font-weight: 400; line-height: 1.4; margin: 0; margin-bottom: 30px; } h1 { font-size: 35px; font-weight: 300; text-align: center; text-transform: capitalize; } p, ul, ol { font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; } p li, ul li, ol li { list-style-position: inside; margin-left: 5px; } a { color: #3498db; text-decoration: underline; } /* ------------------------------------- BUTTONS ------------------------------------- */ .btn { box-sizing: border-box; width: 100%; } .btn > tbody > tr > td { padding-bottom: 15px; } .btn table { width: auto; } .btn table td { background-color: #ffffff; border-radius: 5px; text-align: center; } .btn a { background-color: #ffffff; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; color: #3498db; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; } .btn-primary table td { background-color: #3498db; } .btn-primary a { background-color: #3498db; border-color: #3498db; color: #ffffff; } /* ------------------------------------- OTHER STYLES THAT MIGHT BE USEFUL ------------------------------------- */ .last { margin-bottom: 0; } .first { margin-top: 0; } .align-center { text-align: center; } .align-right { text-align: right; } .align-left { text-align: left; } .clear { clear: both; } .mt0 { margin-top: 0; } .mb0 { margin-bottom: 0; } .preheader { color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0; } .powered-by a { text-decoration: none; } hr { border: 0; border-bottom: 1px solid #f6f6f6; Margin: 20px 0; } /* ------------------------------------- RESPONSIVE AND MOBILE FRIENDLY STYLES ------------------------------------- */ @media only screen and (max-width: 620px) { table[class=body] h1 { font-size: 28px !important; margin-bottom: 10px !important; } table[class=body] p, table[class=body] ul, table[class=body] ol, table[class=body] td, table[class=body] span, table[class=body] a { font-size: 16px !important; } table[class=body] .wrapper, table[class=body] .article { padding: 10px !important; } table[class=body] .content { padding: 0 !important; } table[class=body] .container { padding: 0 !important; width: 100% !important; } table[class=body] .main { border-left-width: 0 !important; border-radius: 0 !important; border-right-width: 0 !important; } table[class=body] .btn table { width: 100% !important; } table[class=body] .btn a { width: 100% !important; } table[class=body] .img-responsive { height: auto !important; max-width: 100% !important; width: auto !important; } } /* ------------------------------------- PRESERVE THESE STYLES IN THE HEAD ------------------------------------- */ @media all { .ExternalClass { width: 100%; } .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; } .apple-link a { color: inherit !important; font-family: inherit !important; font-size: inherit !important; font-weight: inherit !important; line-height: inherit !important; text-decoration: none !important; } .btn-primary table td:hover { background-color: #34495e !important; } .btn-primary a:hover { background-color: #34495e !important; border-color: #34495e !important; } } </style> </head> <body class=""> <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body"> <tr> <td>&nbsp;</td> <td class="container"> <div class="content"> <!-- START CENTERED WHITE CONTAINER --> <span class="preheader">On Deck Deli Order</span> <table role="presentation" class="main"> <!-- START MAIN CONTENT AREA --> <tr> <td class="wrapper"> <table role="presentation" border="0" cellpadding="0" cellspacing="0"> <tr> <td>';
    $res .= '<p>Hi ' . $data['customer_name'] . ',</p> <p>Here is your On Deck Deli Order Receipt:</p> <table role="presentation" border="0" cellpadding="0" cellspacing="0"> <tbody> <tr> <td align="left"> <table role="presentation" border="0" cellpadding="0" cellspacing="0"> <tbody> <tr> <td> ';
    $res .= buildTable($data);
    $res .= ' </td> </tr> </tbody> </table> </td> </tr> </tbody> </table>';
    $res .= '<br /><p>Thank you for ordering from On Deck Deli!</p> </td> </tr> </table> </td> </tr> <!-- END MAIN CONTENT AREA --> </table> <!-- START FOOTER --> <div class="footer"> <table role="presentation" border="0" cellpadding="0" cellspacing="0"> <tr> <td class="content-block"> <span class="apple-link">On Deck Deli<br />1303 E University Blvd, Tucson AZ 85719</span> </td> </tr> </table> </div> <!-- END FOOTER --> <!-- END CENTERED WHITE CONTAINER --> </div> </td> <td>&nbsp;</td> </tr> </table> </body></html>';
    
    return $res;
}

function buildTable($data) {
    $res = '';

    $res .= breakfast($data);
    $res .= beverages($data);
    $res .= deliTrays($data);
    $res .= freeSaladSides($data);
    $res .= saladSides($data);
    $res .= saladBoxes($data);
    $res .= lunchBoxes($data);
    $res .= desserts($data);
    $res .= subSandwiches($data);
    $res .= extraChips($data);

    $res .= '
        <hr style="height:3px;border:none;color:#333;background-color:#99C24D;" />
        <table><tr><td class="row-item"><h4>Total: ' . $data['orderTotal'] . '</h4></td></tr></table>
    ';
    
    return $res;
}

/**
 * Helper functions for each section
 */

function breakfast($data) {
    $res = '
    <table>
    <thead>
        <tr>
            <th colspan="4" class="orangeheader">Breakfast</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    ';

    $fastball = array(
        "name" => "Fastball",
        "price" => $GLOBALS['BREAKFAST_PRICE'],
        "quantity" => $data['fastball']
    );

    $changeUp = array(
        "name" => "Change-up",
        "price" => $GLOBALS['BREAKFAST_PRICE'],
        "quantity" => $data['changeUp']
    );
    

    $curveball = array(
        "name" => "Curveball",
        "price" => $GLOBALS['BREAKFAST_PRICE'],
        "quantity" => $data['curveBall']
    );

    $res .= $fastball > 0 ? rowItem($fastball) : '';
    $res .= $changeUp > 0 ? rowItem($changeUp) : '';
    $res .= $curveball > 0 ? rowItem($curveball) : '';

    $data['breakfastTotal'] = $GLOBALS['BREAKFAST_PRICE'] * ($fastball['quantity'] + $changeUp['quantity'] + $curveball['quantity']);

    $res .= '
        <tr>
            <td colspan=3 class="orangeheader"></td>
            <td class="orangeheader row-item">$' . $data['breakfastTotal'] . '</td>
        </tr>
    ';

    $res .= '
            </tbody>
        </table>
    ';

    return $data['breakfastTotal'] > 0 ? $res : '';
}

function beverages($data) {

    $res = '
    <hr style="height:3px;border:none;color:#333;background-color:#99C24D;" />
    <table>
    <thead>
        <tr>
            <th colspan="4" class="orangeheader">Beverages</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    ';

    $apple = array(
        "name" => "Apple",
        "price" => $GLOBALS['MINUTEMAID_PRICE'],
        "quantity" => $data['apple']
    );

    $orange = array(
        "name" => "Orange",
        "price" => $GLOBALS['MINUTEMAID_PRICE'],
        "quantity" => $data['orange']
    );
    

    $cranberry = array(
        "name" => "Cranberry-Apple",
        "price" => $GLOBALS['MINUTEMAID_PRICE'],
        "quantity" => $data['cranberry']
    );
    
    $coke = array(
        "name" => "Coke",
        "price" => $GLOBALS['SODA_PRICE'],
        "quantity" => $data['coke']
    );
    
    $dietCoke = array(
        "name" => "Diet Coke",
        "price" => $GLOBALS['SODA_PRICE'],
        "quantity" => $data['dietCoke']
    );
    
    $sprite = array(
        "name" => "Sprite",
        "price" => $GLOBALS['SODA_PRICE'],
        "quantity" => $data['sprite']
    );
    
    $dasani = array(
        "name" => "Dasani",
        "price" => $GLOBALS['DASANI_PRICE'],
        "quantity" => $data['dasani']
    );

    $neighborhood = array(
        "name" => "Neighborhood",
        "price" => $GLOBALS['COFFEEBOX_PRICE'],
        "quantity" => $data['neighborhood']
    );
    
    $vanillaHazelnut = array(
        "name" => "Vanilla Hazelnut",
        "price" => $GLOBALS['COFFEEBOX_PRICE'],
        "quantity" => $data['vanillaHazelnut']
    );
    
    $decaf = array(
        "name" => "Decaf",
        "price" => $GLOBALS['COFFEEBOX_PRICE'],
        "quantity" => $data['decaf']
    );

    if(($apple['quantity'] + $orange['quantity'] + $cranberry['quantity']) > 0) {
        $res .= '
            <tr><th colspan=4 class="orangeheader">Minute Maid</th></tr>
        ';
        $res .= $apple['quantity'] > 0 ? rowItem($apple) : '';
        $res .= $orange['quantity'] > 0 ? rowItem($orange) : '';
        $res .= $cranberry['quantity'] > 0 ? rowItem($cranberry) : '';
        $data['beverageTotal'] += $GLOBALS['MINUTEMAID_PRICE'] * ($apple['quantity'] + $orange['quantity'] + $cranberry['quantity']);
    }

    if(($coke['quantity'] + $dietCoke['quantity'] + $sprite['quantity']) > 0) {
        $res .= '
            <tr><th colspan=4 class="orangeheader">Sodas</th></tr>
        ';
        $res .= $coke['quantity'] > 0 ? rowItem($coke) : '';
        $res .= $dietCoke['quantity'] > 0 ? rowItem($dietCoke) : '';
        $res .= $sprite['quantity'] > 0 ? rowItem($sprite) : '';
        $data['beverageTotal'] += $GLOBALS['SODA_PRICE'] * ($coke['quantity'] + $dietCoke['quantity'] + $sprite['quantity']);
    }

    
    if(($neighborhood['quantity'] + $vanillaHazelnut['quantity'] + $decaf['quantity']) > 0) {
        $res .= '
            <tr><th colspan=4 class="orangeheader">Einsteins 96oz. Coffee Box</th></tr>
        ';
        $res .= $neighborhood['quantity'] > 0 ? rowItem($neighborhood) : '';
        $res .= $vanillaHazelnut['quantity'] > 0 ? rowItem($vanillaHazelnut) : '';
        $res .= $decaf['quantity'] > 0 ? rowItem($decaf) : '';
        $data['beverageTotal'] += $GLOBALS['COFFEEBOX_PRICE'] * ($neighborhood['quantity'] + $vanillaHazelnut['quantity'] + $decaf['quantity']);
    }
    
    $res .= '
        <tr>
            <td colspan=3 class="orangeheader"></td>
            <td class="orangeheader row-item">$' . $data['beverageTotal'] . '</td>
        </tr>
    ';

    $res .= '    
            </tbody>
        </table>
    ';

    return $data['beverageTotal'] > 0 ? $res : '';
}


function deliTrays($data) {

    $res = '
    <hr style="height:3px;border:none;color:#333;background-color:#99C24D;" />
    <table>
    <thead>
        <tr>
            <th colspan="4" class="orangeheader">Deli Trays</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    ';

    $powerHitterRegular = array(
        "name" => "Power Hitter Regular",
        "price" => $GLOBALS['POWERHITTER_REGULAR_PRICE'],
        "quantity" => $data['powerHitterRegular']
    );
    
    $powerHitterLarge = array(
        "name" => "Power Hitter Large",
        "price" => $GLOBALS['POWERHITTER_LARGE_PRICE'],
        "quantity" => $data['powerHitterLarge']
    );
    
    $perfectGame = array(
        "name" => "Perfect Game",
        "price" => $GLOBALS['PERFECTGAME_PRICE'],
        "quantity" => $data['perfectGame']
    );
    
    $tripleCrown = array(
        "name" => "Triple Crown",
        "price" => $GLOBALS['TRIPLECROWN_PRICE'],
        "quantity" => $data['tripleCrown']
    );
    
    $qualityStart = array(
        "name" => "Quality Start",
        "price" => $GLOBALS['QUALITYSTART_PRICE'],
        "quantity" => $data['qualityStart']
    );
    
    $playBall = array(
        "name" => "Play Ball",
        "price" => $GLOBALS['PLAYBALL_PRICE'],
        "quantity" => $data['playBall']
    );
    
    if($powerHitterRegular['quantity'] + $powerHitterLarge['quantity'] > 0) {
        $res .= '
            <tr><th colspan=4 class="orangeheader">Meat and Cheese Tray</th></tr>
        ';
        $res .= $powerHitterRegular > 0 ? rowItem($powerHitterRegular) : '';
        $res .= $powerHitterLarge > 0 ? rowItem($powerHitterLarge) : '';
        $data['deliTrayTotal'] += ($powerHitterRegular['quantity'] * $powerHitterRegular['price'])  + ($powerHitterLarge['quantity'] * $powerHitterLarge['price']);
    }
    
    
    if($perfectGame['quantity'] + $tripleCrown['quantity'] > 0) {
        $res .= '
            <tr><th colspan=4 class="orangeheader">Antipasto Trays</th></tr>
        ';
        $res .= $perfectGame > 0 ? rowItem($perfectGame) : '';
        $res .= $tripleCrown > 0 ? rowItem($tripleCrown) : '';
        $data['deliTrayTotal'] += $perfectGame['price'] * ($tripleCrown['quantity'] * $perfectGame['quantity']);
    }
    
    
    if($qualityStart['quantity'] + $playBall['quantity'] > 0) {
        $res .= '
            <tr><th colspan=4 class="orangeheader">Sandwich Trays</th></tr>
        ';
        $res .= $qualityStart > 0 ? rowItem($qualityStart) : '';
        $res .= $playBall > 0 ? rowItem($playBall) : '';
        $data['deliTrayTotal'] += ($qualityStart['quantity'] * $qualityStart['price'])  + ($playBall['quantity'] * $playBall['price']);
    }
    
    $res .= '
        <tr>
            <td colspan=3 class="orangeheader"></td>
            <td class="orangeheader row-item">$' . $data['deliTrayTotal'] . '</td>
        </tr>
    ';

    $res .= '    
            </tbody>
        </table>
    ';

    return $data['deliTrayTotal'] > 0 ? $res : '';
}


function freeSaladSides($data) {
    if(count($data['freeSalads']) < 0) {
        return '';
    }

    $res = '
    <hr style="height:3px;border:none;color:#333;background-color:#99C24D;" />
    <table>
    <thead>
        <tr>
            <th colspan="4" class="orangeheader">Free Large Salad Sides</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    ';

    $salads['Potato Salad'] = 0;
    $salads['Pasta Salad'] = 0;
    $salads['Macaroni Salad'] = 0;
    $salads['Romaine & Kale Salad'] = 0;
    $salads['Black Bean Salad'] = 0;

    $flag = false;

    foreach ($data['freeSalads'] as $salad) {
        $salads[$salad]++;
        $flag = true;
    }

    foreach($salads as $salad => $val) {
        $obj = array(
            "name" => $salad,
            "price" => 0,
            "quantity" => $val
        );
        $res .= $val > 0 ? rowItem($obj) : '';
    }
    
    $res .= '
        <tr>
            <td colspan=3 class="orangeheader"></td>
            <td class="orangeheader row-item">FREE</td>
        </tr>
    ';

    $res .= '
            </tbody>
        </table>
    ';

    return $flag ? $res : '';
}


function saladSides($data) {

    $res = '
    <hr style="height:3px;border:none;color:#333;background-color:#99C24D;" />
    <table>
    <thead>
        <tr>
            <th colspan="4" class="orangeheader">Salad Sides</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    ';

    $keys = array(
        "potatoSalad" => "Potato Salad",
        "pastaSalad" => "Pasta Salad",
        "macaroniSalad" => "Macaroni Salad",
        "romaineSalad" => "Romaine & Kale Salad",
        "blackBeanSalad" => "Black Bean Salad",
        "ancientGrainSalad" => "Ancient Grain Salad",
        "fruitSalad" => "Fruit Salad",
        "greekSalad" => "Greek Salad",
        "chickpeaSalad" => "Chickpea Salad",
        "asianSalad" => "Asian Salad"
    );

    $data['saladSidesTotal'] = 0;

    foreach ($keys as $key => $name) {
        $salad = $data[$key];

        if($salad['size'] == "Regular") {
            if($salad['astar']) {
                $salad['price'] = $GLOBALS['ASTAR_REGULAR_SALAD_PRICE'];
            } else {
                $salad['price'] = $GLOBALS['REGULAR_SALAD_PRICE'];
            }
        } else {
            if($salad['astar']) {
                $salad['price'] = $GLOBALS['ASTAR_LARGE_SALAD_PRICE'];
            } else {
                $salad['price'] = $GLOBALS['LARGE_SALAD_PRICE'];
            }
        }

        $obj = array(
            "name" => $name,
            "price" => $salad['price'],
            "quantity" => $salad['quantity']
        );

        $res .= $salad['quantity']  > 0 ? rowItem($obj) : '';
        $data['saladSidesTotal'] += $obj['price'] * $obj['quantity'];
    }

    $res .= '
        <tr>
            <td colspan=3 class="orangeheader"></td>
            <td class="orangeheader row-item">$' . $data['saladSidesTotal'] . '</td>
        </tr>
    ';

    $res .= '
            </tbody>
        </table>
    ';

    return $data['saladSidesTotal'] > 0 ? $res : '';
}

function saladBoxes($data) {
    $res = '
    <hr style="height:3px;border:none;color:#333;background-color:#99C24D;" />
    <table>
    <thead>
        <tr>
            <th colspan="4" class="orangeheader">Salad Boxes</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    ';

    
    $keys = array(
        "cobSalad" => "Cob Salad",
        "chefSalad" => "Chef Salad",
        "caesarSalad" => "Caesar Salad",
        "veggieSalad" => "Veggie Salad"
    );

    $data['saladBoxTotal'] = 0;

    foreach ($keys as $key => $name) {
        $qty = $data[$key];

        $obj = array(
            "name" => $name,
            "price" => $GLOBALS['SALADBOX_PRICE'],
            "quantity" => $qty
        );

        $res .= $qty  > 0 ? rowItem($obj) : '';
        $data['saladBoxTotal'] += $obj['price'] * $obj['quantity'];
    }

    $res .= '
        <tr>
            <td colspan=3 class="orangeheader"></td>
            <td class="orangeheader row-item">$' . $data['saladBoxTotal'] . '</td>
        </tr>
    ';

    $res .= '
            </tbody>
        </table>
    ';

    return $data['saladBoxTotal'] > 0 ? $res : '';
}

function lunchBoxes($data) {
    $res = '
    <hr style="height:3px;border:none;color:#333;background-color:#99C24D;" />
    <table>
    <thead>
        <tr>
            <th colspan="4" class="orangeheader">Lunch Boxes</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    ';

    
    $keys = array(
        "batterUp" => "Batter Up",
        "infieldFly" => "Infield Fly",
        "safeCall" => "Safe Call",
        "fairBall" => "Fair Ball",
        "outfielder" => "Outfielder",
        "groundRule" => "Ground Rule",
    );

    $data['lunchBoxTotal'] = 0;

    foreach ($keys as $key => $name) {
        $qty = $data[$key];

        $obj = array(
            "name" => $name,
            "price" => $GLOBALS['LUNCHBOX_PRICE'],
            "quantity" => $qty
        );

        $res .= $qty  > 0 ? rowItem($obj) : '';
        $data['lunchBoxTotal'] += $obj['price'] * $obj['quantity'];
    }

    $res .= '
        <tr>
            <td colspan=3 class="orangeheader"></td>
            <td class="orangeheader row-item">$' . $data['lunchBoxTotal'] . '</td>
        </tr>
    ';

    $res .= '
            </tbody>
        </table>
    ';

    return $data['lunchBoxTotal'] > 0 ? $res : '';
}


function desserts($data) {
    $res = '
    <hr style="height:3px;border:none;color:#333;background-color:#99C24D;" />
    <table>
    <thead>
        <tr>
            <th colspan="5" class="orangeheader">Dessert</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    ';

    
    $keys = array(
        "crispyTreat" => "Crispy Treat",
        "fruityPebble" => "Fruity Pebble",
        "pbChocolate" => "Peanut Butter Chocolate",
        "chocolateChunkCookie" => "Chocolate Chunk Cookie",
        "sugarCookie" => "Sugar Cookie",
        "cranberryRaisin" => "Cranberry Raisin",
        "battingAverageCupcake" => "Batting Avg. Cupcake"
    );

    $data['dessertTotal'] = 0;

    foreach ($keys as $key => $name) {
        $dessert = $data[$key];
        
        $obj = array(
            "name" => $name,
            "quantity" => $dessert['quantity']
        );

        // determine price
        if($key == 'battingAverageCupcake') {
            $obj['price'] = $GLOBALS['BATTINGAVG_PRICE'];
            $obj['size'] = '';
        }
        else if($dessert['size'] == 'Regular') {
            $obj['price'] = $GLOBALS['DESSERT_REGULAR_PRICE'];
            $obj['size'] = $dessert['size'];
        } else {
            $obj['price'] = $GLOBALS['DESSERT_LARGE_PRICE'];
            $obj['size'] = $dessert['size'];
        }

        $res .= $dessert['quantity']  > 0 ? rowItem($obj) : '';
        $data['dessertTotal'] += $obj['price'] * $obj['quantity'];
    }

    $res .= '
        <tr>
            <td colspan=4 class="orangeheader"></td>
            <td class="orangeheader row-item">$' . $data['dessertTotal'] . '</td>
        </tr>
    ';

    $res .= '
            </tbody>
        </table>
    ';

    return $data['dessertTotal'] > 0 ? $res : '';
}


function subSandwiches($data) {
    $res = '
    <hr style="height:3px;border:none;color:#333;background-color:#99C24D;" />
    <table>
    <thead>
        <tr>
            <th colspan="4" class="orangeheader">18" Sub Sandwiches</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    ';
    
    $keys = array(
        "leadOff" => "Lead Off",
        "onDeck" => "On Deck",
        "inTheHole" => "In The Hole"
    );

    $data['subSandwichesTotal'] = 0;

    foreach ($keys as $key => $name) {
        $qty = $data[$key];

        $obj = array(
            "name" => $name,
            "price" => $GLOBALS['SUBSANDWICH_PRICE'],
            "quantity" => $qty
        );

        $res .= $qty  > 0 ? rowItem($obj) : '';
        $data['subSandwichesTotal'] += $obj['price'] * $obj['quantity'];
    }

    $res .= '
        <tr>
            <td colspan=3 class="orangeheader"></td>
            <td class="orangeheader row-item">$' . $data['subSandwichesTotal'] . '</td>
        </tr>
    ';

    $res .= '
            </tbody>
        </table>
    ';

    return $data['subSandwichesTotal'] > 0 ? $res : '';
}


function extraChips($data) {
    $res = '
    <hr style="height:3px;border:none;color:#333;background-color:#99C24D;" />
    <table>
    <thead>
        <tr>
            <th colspan="4" class="orangeheader">Extra Chips</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    ';

    $extraChips = $data['extraChips'];
    
    $obj = array(
        "name" => 'Extra Chips',
        "price" => $GLOBALS['CHIPS_PRICE'],
        "quantity" => $extraChips['qty']
    );

    $res .= $extraChips['qty']  > 0 ? rowItem($obj) : '';

    $data['extraChipsTotal'] = $GLOBALS['CHIPS_PRICE'] * $extraChips['qty'];

    $res .= '
        <tr>
            <td colspan=3 class="orangeheader"></td>
            <td class="orangeheader row-item">$' . $data['extraChipsTotal'] . '</td>
        </tr>
    ';

    $res .= '
            </tbody>
        </table>
    ';

    return $data['extraChipsTotal'] > 0 ? $res : '';
}

/**
 * Helper functions
 */

function rowItem($item) {
    if($item['quantity'] == 0) {
        return '';
    }

    $total = $item['price'] * $item['quantity'];

    $res = '        
        <tr>
            <td class="row-item">' . $item['name'] . '</td>
            <td class="row-item">' . $item['price'] . '</td>
    ';

    if(array_key_exists('size', $item)) {
        $res .= '
            <td class="row-item">' . $item['size'] . '</td>
        ';
    }

    $res .= '
            <td class="row-item">' . $item['quantity'] . '</td>
            <td class="row-item">$' . $total . '</td>
        </tr>
    ';

    return $res;
}



?>