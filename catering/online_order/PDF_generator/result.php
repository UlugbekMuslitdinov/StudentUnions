<?php

require_once dirname(FILE).'/vendor/autoload.php';
require_once(dirname( FILE ).'/vendor/spipu/html2pdf/html2pdf.class.php');




$html2pdf = new html2pdf('P', 'A4', 'en');
$str = '
<style>
    td {
        padding: 5px;
    }
    th {
        font-size:16pt;
        padding: 10px;
        padding-left: 5px;
    }
</style>
<h1 align="center" class="page-header">Catering Order</h1>
<hr>
<div class="container">
    <div class="jumbotron">
        <table style="margin-left:20px;">
            <tr>
                <th>
                    Customer Information
                </th>
            </tr>
            <tr>
                <td><b>Order Number</b> : ' . $_SESSION['catering_id'] . '</td>
            </tr>
            <tr>
                <td><b>Delivery Method</b> : ' . $order_info['method'] . '</td>
            </tr>
            <tr>
                <td><b>Delivery Date</b> : ' . $order_info['delivery_date'] . '</td>
                <td><b>Delivery Time</b> : ' . $order_info['delivery_time'] . '</td>
            </tr>
            <tr>
                <td><b>Customer Name</b> : ' . $order_info['customer_name'] . '</td>
            </tr>
            <tr>
                <td><b>Customer Phone</b> : ' . $order_info['customer_phone'] . '</td>    
            </tr>
            <tr>
                <td><b>Customer Email</b> : ' . $order_info['customer_email'] . '</td>
            </tr>
            <tr>
                <td><b>Payment Method</b> : ' . $order_info['payment_method'] . '</td>
            ';


            if($order_info['payment_method'] == 'IDB'){
                $str .='
                         <td><b>Account Number</b> : ' . $order_info['account_num'] . '</td>
                ';

                if($order_info['sub_code']){
                    $str .='
                         <td><b>Sub Code</b> : ' . $order_info['sub_code'] . '</td>
                ';
                }
            }

$str .='    </tr>
        </table>
    </div>
</div>
';




$running_total = 0;





if($numberOf12Packs >= 1){
$total_extra_meat = 0;
    for ($packNum = 1; $packNum <= $numberOf12Packs; $packNum++) {
        $str .= '<br><hr>
        <div class="container">
            <div class="jumbotron">
                <table align="center">
                    <tr>
                        <th colspan=9 align="center">12 Pack #' . $packNum . '</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th colspan=4>Meats</th>
                        <th colspan=4>Vegetables</th>
                    </tr>';
                    $i = 1;
                    while($row = $twelve_pack_result->fetch_assoc()) {
                       $str .= '
                        <tr>
                            <td><b>Burrito #' . $i . '</b></td>
                            <td>' . $row['meat_1'] . '</td>
                            <td>' . $row['meat_2'] . '</td>
                            <td>' . $row['meat_3'] . '</td>
                            <td>' . $row['meat_4'] . '</td>
                            <td>' . $row['vege_1'] . '</td>
                            <td>' . $row['vege_2'] . '</td>
                            <td>' . $row['vege_3'] . '</td>
                            <td>' . $row['vege_4'] . '</td>
                        </tr>
                    ';
                    $i++;

                    $extra_meat_count = -1;
                    for($j=1; $j<5; $j++) {
                        if($row['meat_' . $j] != ""){
                            // $str .= '<h1>meat_' . $j . '</h1>';
                            $extra_meat_count++;
                        }
                    }
                    if($extra_meat_count == -1)
                        $extra_meat_count =0;
                    $total_extra_meat += $extra_meat_count;
                }

                $pack_cost = 110 + ($total_extra_meat*2); // to get the actual price

                $str .= '<tr>
                <th colspan=9 align="right" style="font-size: 12pt;">Pack Subtotal: $' . $pack_cost . '</th>
                </tr>
            ';
            $running_total += $pack_cost;
        }

        $str .='</table></div></div>';
} // end of 12 packs


if($numberOf8Packs >= 1){
$total_extra_meat = 0;
    for ($packNum = 1; $packNum <= $numberOf8Packs; $packNum++) {
        $str .= '<br><hr><div class="container">
        <div class="jumbotron">
            <table align="center">
                <tr>
                    <th colspan=9 align="center">8 Pack #' . $packNum . '</th>
                </tr>
                <tr>
                    <th></th>
                    <th colspan=4>Meats</th>
                    <th colspan=4>Vegetables</th>
                </tr>';
                $i = 1;

                while($row = $eight_pack_result->fetch_assoc()) {

                    

                    $str .= '
                    <tr>
                        <td><b>Burrito #' . $i . '</b></td>
                        <td>' . $row['meat_1'] . '</td>
                        <td>' . $row['meat_2'] . '</td>
                        <td>' . $row['meat_3'] . '</td>
                        <td>' . $row['meat_4'] . '</td>
                        <td>' . $row['vege_1'] . '</td>
                        <td>' . $row['vege_2'] . '</td>
                        <td>' . $row['vege_3'] . '</td>
                        <td>' . $row['vege_4'] . '</td>
                    </tr>
                    ';
                    $i++;
                    $extra_meat_count = -1;
                    for($j=1; $j<5; $j++) {
                        if($row['meat_' . $j] != ""){
                            // $str .= '<h1>meat_' . $j . '</h1>';
                            $extra_meat_count++;
                        }
                    }
                    if($extra_meat_count == -1)
                        $extra_meat_count =0;
                    $total_extra_meat += $extra_meat_count;
                }

                $pack_cost = 85 + ($total_extra_meat*2); // to get the actual price
                
                $running_total += $pack_cost;

                $str .= '
                <tr>
                    <th colspan=9 align="right" style="font-size: 12pt;">Pack Subtotal: $' . $pack_cost . '</th>
                </tr>
            ';
        }

        $str .='</table></div></div><hr>';
} // end of 8 packs







$extra_salsa_cost = $food_info['extra_salsa'] * 5.99;
$extra_sourcream_cost = $food_info['extra_sourcream'] * 5.99;
$extra_guacamole_cost = $food_info['extra_guacamole'] * 5.99;
$party_pack_upgrade = $food_info['upgrade'] * 6;
$extra_subtotal = $extra_salsa_cost + $extra_sourcream_cost + $extra_guacamole_cost + $party_pack_upgrade;

$running_total += $extra_subtotal;

$str .= '
<div class="container">
    <div class="jumbotron">
        <table align="center">
            <tr>
                <th colspan=3 align="center">Extra</th>
            </tr>
            <tr>
                <td>Extra Salsa</td>
                <td>' . $food_info['extra_salsa'] . '</td>
                <td>' . $extra_salsa_cost . '</td>
            </tr>
            <tr>
                <td>Extra Sour Cream</td>
                <td>' . $food_info['extra_sourcream'] . '</td>
                <td>' . $extra_sourcream_cost . '</td>
            </tr>
            <tr style="border-bottom: solid 1px black;">
                <td>Extra Guacamole</td>
                <td>' . $food_info['extra_guacamole'] . '</td>
                <td>' . $extra_guacamole_cost . '</td>
            </tr>';


            if($food_info['coke'] > 0)
                $str .= '<tr>
                            <td>Coke</td>
                            <td>' . $food_info['coke'] . '</td>
                        </tr>

            ';

            if($food_info['diet_coke'] > 0)
                $str .= '<tr>
                            <td>Diet Coke</td>
                            <td>' . $food_info['diet_coke'] . '</td>
                        </tr>

            ';

            if($food_info['sprite'] > 0)
                $str .= '<tr>
                            <td>Sprite</td>
                            <td>' . $food_info['sprite'] . '</td>
                        </tr>

            ';

            if($food_info['coke_zero'] > 0)
                $str .= '<tr>
                            <td>Coke Zero</td>
                            <td>' . $food_info['coke_zero'] . '</td>
                        </tr>

            ';

            if($food_info['dr_pepper'] > 0)
                $str .= '<tr>
                            <td>Dr Pepper</td>
                            <td>' . $food_info['dr_pepper'] . '</td>
                        </tr>

            ';

            if($food_info['diet_dr_pepper'] > 0)
                $str .= '<tr>
                            <td>Diet Dr Pepper</td>
                            <td>' . $food_info['diet_dr_pepper'] . '</td>
                        </tr>

            ';


            $str .= '<tr>
                <th colspan=9 align="right" style="font-size: 12pt;">Extra Subtotal: ' . $extra_subtotal . '</th>
            </tr>
            ';

            $str .='</table></div></div><hr>';



            $str .= '<h1 align="center">Total: $' . $running_total . '</h1>';









            $html2pdf->writeHTML($str);

// $html2pdf->writeHTML('</div>');
            $html2pdf->output();
            ?>