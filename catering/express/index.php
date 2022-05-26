<?php
//header("Location: /index.php");
//die();

require_once($_SERVER['DOCUMENT_ROOT'] . '/catering/express/express.inc.php');
$page_options['title'] = 'Express Catering';
$page_options['page'] = 'Express Catering';
catering_start($page_options);
?>

<link rel="stylesheet" type="text/css" href="/catering/express/style.css">

<h1>EXPRESS CATERING</h1>

<div>
    <p>Student Unions Express Catering is easy! Order from your favorite on campus restaurant and have it delivered to your campus party, meeting or event.</p><br>
    <p>Give us 48-hour notice and we can arrange to have your event catered from one of our drop & go locations.</p>
</div>

<!-- Create restaurant cards -->
<div class="row mt-3">

    <!-- Chick-fil-A -->
    <div class="column">
        <div class="card">
            <img class="card-img-top" src="../images/chickfila.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">Chick-fil-A combos, fresh squeezed lemonade and desserts</p>
                <a href="/dining/template/resources/Chick-Fil-A_Catering_3.pdf" target="blank" class="btn">Check menu</a>
            </div>
        </div>
    </div>

    <!-- On Deck Deli -->
    <div class="column">
        <div class="card">
            <img class="card-img-top" src="../images/ondeckdeli.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text" style="margin-bottom: 20px;">Custom sandwiches and bagels</p>
                <a href="/catering/online_order/agreement.php?r=ondeck" target="blank" class="btn">Order now</a>
            </div>
        </div>
    </div>

    <!-- Highland Burrito -->
    <div class="column">
        <div class="card">
            <img class="card-img-top" src="../images/highlandburrito.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text" style="margin-bottom: 20px;">Your party. Our burritos</p>
                <a href="/catering/online_order/agreement.php" target="blank" class="btn">Order now</a>
            </div>
        </div>
    </div>

    <!-- Einstein Bros Bagels -->
    <div class="column">
        <div class="card">
            <img class="card-img-top" src="../images/einsteinbros.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text" style="margin-bottom: 21px;">Everything from bagels to sandwiches and more</p>
                <a href="/catering/online_order/agreement.php?r=einsteins" target="blank" class="btn">Order Now</a>
            </div>
        </div>
    </div>

    <!-- The Scoop -->
    <div class="column">
        <div class="card">
            <img class="card-img-top" src="../images/scoop.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">A Shamrock Farms Creamery: Ice Cream, Sundae Fundays, Ice cold from the Fridge, Speical tea</p>
                <a href="/dining/sumc/scoop" target="blank" class="btn">Check Menu</a>
            </div>
        </div>
    </div>

    <!-- Catalyst Cafe -->
    <div class="column">
        <div class="card">
            <img class="card-img-top" src="../images/catalyst.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text" style="">Catalyst Cafe is a unique concept create by the Arizona Student Unions and the UA Health Sciences.</p>
                <a href="/catering/online_order/agreement.php?r=catalyst" target="blank" class="btn">Order now</a>
            </div>
        </div>
    </div>

    <!-- Slot Canyon Cafe -->
    <div class="column">
        <div class="card">
            <img class="card-img-top" src="../images/slotcanyon.png" alt="Card image cap">
            <div class="card-body">
                <p class="card-text">More than a creamery. It's a great place to get together with friends and just hang out</p>
                <a href="/catering/online_order/agreement.php?r=slotcanyon" target="blank" class="btn">Order now</a>
            </div>
        </div>
    </div>
	
    <!-- IQ Fresh -->
    <div class="column">
        <div class="card">
            <img class="card-img-top" src="../images/iqfresh.jpg" alt="IQ Fresh">
            <div class="card-body">
                <p class="card-text">Show your Mensa-level mental capacity by picking up some IQ smoothies, fresh salads, acai bowls and wraps at IQ Fresh. </p>
                <a href="/catering/online_order/agreement.php?r=iq_fresh" target="blank" class="btn">Order now</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/catering/express/express.js"></script>

<?php 
catering_finish()
?>