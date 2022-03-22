<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');

function catering_start($page_options){

    $page_options['title'] = isset($page_options['title']) ? $page_options['title'] : 'Catering';

    if (!isset($page_options['header_image'])){
        $page_options['header_image'] = '/template/images/banners/maps_banner.jpg';
    }
    page_start($page_options);
?>
<style>
    /* .c_header {
        height: 300px !important;
        overflow: hidden !important;
    }
    .c_header > img {
        position: relative !important;
        top: -8px !important;
    }
    .wrap_catering {
        width: 100% !important;
    } */
</style>
<link rel="stylesheet" type="text/css" href="/catering/catering_main_style.css">

<!-- <div class="wrap_catering" style="margin-top: 5px;"> -->
	
	<div class="col-md-12 wrap-banner-img">
		<img src="/catering/template/Banner_Catering_Form.png" style="bottom: -50px;">
    </div>
    
    <div class="col wrap-left-col">
        <div id="left-col" class="wrap-left-col-menu">

            <h2 class="left-col-menu-header"></h2>
            <ul>
                <li><a href="/catering/resources/Retail_catering_policies.pdf" target="blank">Express Catering Policies</a></li>
                <li><a href="/dining/template/resources/Catalyst_Cafe_Catering_Menu.pdf" target="blank">Cataylst Caf&#xE9;</a></li>
                <li><a href="/dining/template/resources/Chick-Fil-A_Catering.pdf" target="blank">Chick-Fil-A</a></li>
                <li><a href="/dining/template/resources/EBB_Catering.pdf" target="blank">Einstein Bros. Bagels</a></li>
                <li><a href="/catering/online_order/agreement.php" target="blank">Highland Market</a></li>
                <!-- <li><a href="/catering/online_order/agreement.php?r=ondeck" target="blank">On Deck Deli</a></li> -->
                <li><a href="/dining/template/resources/OnDeckCatering.pdf" target="blank">On Deck Deli</a></li>
                <li><a href="/dining/template/resources/Slot_Canyon_Catering_Brochure_Menu_web_only.pdf" target="blank">Slot Canyon Caf&#xE9;</a></li>
                <li><a href="/dining/template/resources/Scoop_Catering_Coffee.pdf" target="blank">The Scoop - Coffee</a></li>
                <li><a href="/dining/template/resources/Scoop_Catering_IceCream.pdf" target="blank">The Scoop - Ice Cream</a></li>
            </ul>

        </div>
    </div>
    
    <div class="col">
      <div class="col-12 mt-4">

<?php
}
?>            
        
<?php
function catering_finish(){
?>
    </div></div>
<?php
    page_finish();
}