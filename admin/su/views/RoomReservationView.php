<?php

namespace PHPMaker2021\project1;

// Page object
$RoomReservationView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var froom_reservationview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    froom_reservationview = currentForm = new ew.Form("froom_reservationview", "view");
    loadjs.done("froom_reservationview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="froom_reservationview" id="froom_reservationview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="room_reservation">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_room_reservation_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_org->Visible) { // contact_org ?>
    <tr id="r_contact_org">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_org"><?= $Page->contact_org->caption() ?></span></td>
        <td data-name="contact_org" <?= $Page->contact_org->cellAttributes() ?>>
<span id="el_room_reservation_contact_org">
<span<?= $Page->contact_org->viewAttributes() ?>>
<?= $Page->contact_org->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_name->Visible) { // contact_name ?>
    <tr id="r_contact_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_name"><?= $Page->contact_name->caption() ?></span></td>
        <td data-name="contact_name" <?= $Page->contact_name->cellAttributes() ?>>
<span id="el_room_reservation_contact_name">
<span<?= $Page->contact_name->viewAttributes() ?>>
<?= $Page->contact_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_email->Visible) { // contact_email ?>
    <tr id="r_contact_email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_email"><?= $Page->contact_email->caption() ?></span></td>
        <td data-name="contact_email" <?= $Page->contact_email->cellAttributes() ?>>
<span id="el_room_reservation_contact_email">
<span<?= $Page->contact_email->viewAttributes() ?>>
<?= $Page->contact_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_phone->Visible) { // contact_phone ?>
    <tr id="r_contact_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_phone"><?= $Page->contact_phone->caption() ?></span></td>
        <td data-name="contact_phone" <?= $Page->contact_phone->cellAttributes() ?>>
<span id="el_room_reservation_contact_phone">
<span<?= $Page->contact_phone->viewAttributes() ?>>
<?= $Page->contact_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_fax->Visible) { // contact_fax ?>
    <tr id="r_contact_fax">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_fax"><?= $Page->contact_fax->caption() ?></span></td>
        <td data-name="contact_fax" <?= $Page->contact_fax->cellAttributes() ?>>
<span id="el_room_reservation_contact_fax">
<span<?= $Page->contact_fax->viewAttributes() ?>>
<?= $Page->contact_fax->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_address->Visible) { // contact_address ?>
    <tr id="r_contact_address">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_address"><?= $Page->contact_address->caption() ?></span></td>
        <td data-name="contact_address" <?= $Page->contact_address->cellAttributes() ?>>
<span id="el_room_reservation_contact_address">
<span<?= $Page->contact_address->viewAttributes() ?>>
<?= $Page->contact_address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_city->Visible) { // contact_city ?>
    <tr id="r_contact_city">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_city"><?= $Page->contact_city->caption() ?></span></td>
        <td data-name="contact_city" <?= $Page->contact_city->cellAttributes() ?>>
<span id="el_room_reservation_contact_city">
<span<?= $Page->contact_city->viewAttributes() ?>>
<?= $Page->contact_city->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_state->Visible) { // contact_state ?>
    <tr id="r_contact_state">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_state"><?= $Page->contact_state->caption() ?></span></td>
        <td data-name="contact_state" <?= $Page->contact_state->cellAttributes() ?>>
<span id="el_room_reservation_contact_state">
<span<?= $Page->contact_state->viewAttributes() ?>>
<?= $Page->contact_state->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_zip->Visible) { // contact_zip ?>
    <tr id="r_contact_zip">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_zip"><?= $Page->contact_zip->caption() ?></span></td>
        <td data-name="contact_zip" <?= $Page->contact_zip->cellAttributes() ?>>
<span id="el_room_reservation_contact_zip">
<span<?= $Page->contact_zip->viewAttributes() ?>>
<?= $Page->contact_zip->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_advisor->Visible) { // contact_advisor ?>
    <tr id="r_contact_advisor">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_advisor"><?= $Page->contact_advisor->caption() ?></span></td>
        <td data-name="contact_advisor" <?= $Page->contact_advisor->cellAttributes() ?>>
<span id="el_room_reservation_contact_advisor">
<span<?= $Page->contact_advisor->viewAttributes() ?>>
<?= $Page->contact_advisor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_advisor_phone->Visible) { // contact_advisor_phone ?>
    <tr id="r_contact_advisor_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_advisor_phone"><?= $Page->contact_advisor_phone->caption() ?></span></td>
        <td data-name="contact_advisor_phone" <?= $Page->contact_advisor_phone->cellAttributes() ?>>
<span id="el_room_reservation_contact_advisor_phone">
<span<?= $Page->contact_advisor_phone->viewAttributes() ?>>
<?= $Page->contact_advisor_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_advisor_email->Visible) { // contact_advisor_email ?>
    <tr id="r_contact_advisor_email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_contact_advisor_email"><?= $Page->contact_advisor_email->caption() ?></span></td>
        <td data-name="contact_advisor_email" <?= $Page->contact_advisor_email->cellAttributes() ?>>
<span id="el_room_reservation_contact_advisor_email">
<span<?= $Page->contact_advisor_email->viewAttributes() ?>>
<?= $Page->contact_advisor_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->billing_org->Visible) { // billing_org ?>
    <tr id="r_billing_org">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_billing_org"><?= $Page->billing_org->caption() ?></span></td>
        <td data-name="billing_org" <?= $Page->billing_org->cellAttributes() ?>>
<span id="el_room_reservation_billing_org">
<span<?= $Page->billing_org->viewAttributes() ?>>
<?= $Page->billing_org->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->billing_name->Visible) { // billing_name ?>
    <tr id="r_billing_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_billing_name"><?= $Page->billing_name->caption() ?></span></td>
        <td data-name="billing_name" <?= $Page->billing_name->cellAttributes() ?>>
<span id="el_room_reservation_billing_name">
<span<?= $Page->billing_name->viewAttributes() ?>>
<?= $Page->billing_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->billing_email->Visible) { // billing_email ?>
    <tr id="r_billing_email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_billing_email"><?= $Page->billing_email->caption() ?></span></td>
        <td data-name="billing_email" <?= $Page->billing_email->cellAttributes() ?>>
<span id="el_room_reservation_billing_email">
<span<?= $Page->billing_email->viewAttributes() ?>>
<?= $Page->billing_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->billing_phone->Visible) { // billing_phone ?>
    <tr id="r_billing_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_billing_phone"><?= $Page->billing_phone->caption() ?></span></td>
        <td data-name="billing_phone" <?= $Page->billing_phone->cellAttributes() ?>>
<span id="el_room_reservation_billing_phone">
<span<?= $Page->billing_phone->viewAttributes() ?>>
<?= $Page->billing_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->billing_fax->Visible) { // billing_fax ?>
    <tr id="r_billing_fax">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_billing_fax"><?= $Page->billing_fax->caption() ?></span></td>
        <td data-name="billing_fax" <?= $Page->billing_fax->cellAttributes() ?>>
<span id="el_room_reservation_billing_fax">
<span<?= $Page->billing_fax->viewAttributes() ?>>
<?= $Page->billing_fax->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->billing_address->Visible) { // billing_address ?>
    <tr id="r_billing_address">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_billing_address"><?= $Page->billing_address->caption() ?></span></td>
        <td data-name="billing_address" <?= $Page->billing_address->cellAttributes() ?>>
<span id="el_room_reservation_billing_address">
<span<?= $Page->billing_address->viewAttributes() ?>>
<?= $Page->billing_address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->billing_city->Visible) { // billing_city ?>
    <tr id="r_billing_city">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_billing_city"><?= $Page->billing_city->caption() ?></span></td>
        <td data-name="billing_city" <?= $Page->billing_city->cellAttributes() ?>>
<span id="el_room_reservation_billing_city">
<span<?= $Page->billing_city->viewAttributes() ?>>
<?= $Page->billing_city->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->billing_state->Visible) { // billing_state ?>
    <tr id="r_billing_state">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_billing_state"><?= $Page->billing_state->caption() ?></span></td>
        <td data-name="billing_state" <?= $Page->billing_state->cellAttributes() ?>>
<span id="el_room_reservation_billing_state">
<span<?= $Page->billing_state->viewAttributes() ?>>
<?= $Page->billing_state->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->billing_zip->Visible) { // billing_zip ?>
    <tr id="r_billing_zip">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_billing_zip"><?= $Page->billing_zip->caption() ?></span></td>
        <td data-name="billing_zip" <?= $Page->billing_zip->cellAttributes() ?>>
<span id="el_room_reservation_billing_zip">
<span<?= $Page->billing_zip->viewAttributes() ?>>
<?= $Page->billing_zip->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->billing_method->Visible) { // billing_method ?>
    <tr id="r_billing_method">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_billing_method"><?= $Page->billing_method->caption() ?></span></td>
        <td data-name="billing_method" <?= $Page->billing_method->cellAttributes() ?>>
<span id="el_room_reservation_billing_method">
<span<?= $Page->billing_method->viewAttributes() ?>>
<?= $Page->billing_method->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->billing_frs->Visible) { // billing_frs ?>
    <tr id="r_billing_frs">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_billing_frs"><?= $Page->billing_frs->caption() ?></span></td>
        <td data-name="billing_frs" <?= $Page->billing_frs->cellAttributes() ?>>
<span id="el_room_reservation_billing_frs">
<span<?= $Page->billing_frs->viewAttributes() ?>>
<?= $Page->billing_frs->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_title->Visible) { // event_title ?>
    <tr id="r_event_title">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_event_title"><?= $Page->event_title->caption() ?></span></td>
        <td data-name="event_title" <?= $Page->event_title->cellAttributes() ?>>
<span id="el_room_reservation_event_title">
<span<?= $Page->event_title->viewAttributes() ?>>
<?= $Page->event_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_type->Visible) { // event_type ?>
    <tr id="r_event_type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_event_type"><?= $Page->event_type->caption() ?></span></td>
        <td data-name="event_type" <?= $Page->event_type->cellAttributes() ?>>
<span id="el_room_reservation_event_type">
<span<?= $Page->event_type->viewAttributes() ?>>
<?= $Page->event_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_date->Visible) { // event_date ?>
    <tr id="r_event_date">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_event_date"><?= $Page->event_date->caption() ?></span></td>
        <td data-name="event_date" <?= $Page->event_date->cellAttributes() ?>>
<span id="el_room_reservation_event_date">
<span<?= $Page->event_date->viewAttributes() ?>>
<?= $Page->event_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_time_start->Visible) { // event_time_start ?>
    <tr id="r_event_time_start">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_event_time_start"><?= $Page->event_time_start->caption() ?></span></td>
        <td data-name="event_time_start" <?= $Page->event_time_start->cellAttributes() ?>>
<span id="el_room_reservation_event_time_start">
<span<?= $Page->event_time_start->viewAttributes() ?>>
<?= $Page->event_time_start->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_time_end->Visible) { // event_time_end ?>
    <tr id="r_event_time_end">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_event_time_end"><?= $Page->event_time_end->caption() ?></span></td>
        <td data-name="event_time_end" <?= $Page->event_time_end->cellAttributes() ?>>
<span id="el_room_reservation_event_time_end">
<span<?= $Page->event_time_end->viewAttributes() ?>>
<?= $Page->event_time_end->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_num_people->Visible) { // event_num_people ?>
    <tr id="r_event_num_people">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_event_num_people"><?= $Page->event_num_people->caption() ?></span></td>
        <td data-name="event_num_people" <?= $Page->event_num_people->cellAttributes() ?>>
<span id="el_room_reservation_event_num_people">
<span<?= $Page->event_num_people->viewAttributes() ?>>
<?= $Page->event_num_people->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->event_room_preference->Visible) { // event_room_preference ?>
    <tr id="r_event_room_preference">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_event_room_preference"><?= $Page->event_room_preference->caption() ?></span></td>
        <td data-name="event_room_preference" <?= $Page->event_room_preference->cellAttributes() ?>>
<span id="el_room_reservation_event_room_preference">
<span<?= $Page->event_room_preference->viewAttributes() ?>>
<?= $Page->event_room_preference->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_jan->Visible) { // recurring_jan ?>
    <tr id="r_recurring_jan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_jan"><?= $Page->recurring_jan->caption() ?></span></td>
        <td data-name="recurring_jan" <?= $Page->recurring_jan->cellAttributes() ?>>
<span id="el_room_reservation_recurring_jan">
<span<?= $Page->recurring_jan->viewAttributes() ?>>
<?= $Page->recurring_jan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_feb->Visible) { // recurring_feb ?>
    <tr id="r_recurring_feb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_feb"><?= $Page->recurring_feb->caption() ?></span></td>
        <td data-name="recurring_feb" <?= $Page->recurring_feb->cellAttributes() ?>>
<span id="el_room_reservation_recurring_feb">
<span<?= $Page->recurring_feb->viewAttributes() ?>>
<?= $Page->recurring_feb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_mar->Visible) { // recurring_mar ?>
    <tr id="r_recurring_mar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_mar"><?= $Page->recurring_mar->caption() ?></span></td>
        <td data-name="recurring_mar" <?= $Page->recurring_mar->cellAttributes() ?>>
<span id="el_room_reservation_recurring_mar">
<span<?= $Page->recurring_mar->viewAttributes() ?>>
<?= $Page->recurring_mar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_apr->Visible) { // recurring_apr ?>
    <tr id="r_recurring_apr">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_apr"><?= $Page->recurring_apr->caption() ?></span></td>
        <td data-name="recurring_apr" <?= $Page->recurring_apr->cellAttributes() ?>>
<span id="el_room_reservation_recurring_apr">
<span<?= $Page->recurring_apr->viewAttributes() ?>>
<?= $Page->recurring_apr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_may->Visible) { // recurring_may ?>
    <tr id="r_recurring_may">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_may"><?= $Page->recurring_may->caption() ?></span></td>
        <td data-name="recurring_may" <?= $Page->recurring_may->cellAttributes() ?>>
<span id="el_room_reservation_recurring_may">
<span<?= $Page->recurring_may->viewAttributes() ?>>
<?= $Page->recurring_may->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_jun->Visible) { // recurring_jun ?>
    <tr id="r_recurring_jun">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_jun"><?= $Page->recurring_jun->caption() ?></span></td>
        <td data-name="recurring_jun" <?= $Page->recurring_jun->cellAttributes() ?>>
<span id="el_room_reservation_recurring_jun">
<span<?= $Page->recurring_jun->viewAttributes() ?>>
<?= $Page->recurring_jun->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_jul->Visible) { // recurring_jul ?>
    <tr id="r_recurring_jul">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_jul"><?= $Page->recurring_jul->caption() ?></span></td>
        <td data-name="recurring_jul" <?= $Page->recurring_jul->cellAttributes() ?>>
<span id="el_room_reservation_recurring_jul">
<span<?= $Page->recurring_jul->viewAttributes() ?>>
<?= $Page->recurring_jul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_aug->Visible) { // recurring_aug ?>
    <tr id="r_recurring_aug">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_aug"><?= $Page->recurring_aug->caption() ?></span></td>
        <td data-name="recurring_aug" <?= $Page->recurring_aug->cellAttributes() ?>>
<span id="el_room_reservation_recurring_aug">
<span<?= $Page->recurring_aug->viewAttributes() ?>>
<?= $Page->recurring_aug->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_sep->Visible) { // recurring_sep ?>
    <tr id="r_recurring_sep">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_sep"><?= $Page->recurring_sep->caption() ?></span></td>
        <td data-name="recurring_sep" <?= $Page->recurring_sep->cellAttributes() ?>>
<span id="el_room_reservation_recurring_sep">
<span<?= $Page->recurring_sep->viewAttributes() ?>>
<?= $Page->recurring_sep->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_oct->Visible) { // recurring_oct ?>
    <tr id="r_recurring_oct">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_oct"><?= $Page->recurring_oct->caption() ?></span></td>
        <td data-name="recurring_oct" <?= $Page->recurring_oct->cellAttributes() ?>>
<span id="el_room_reservation_recurring_oct">
<span<?= $Page->recurring_oct->viewAttributes() ?>>
<?= $Page->recurring_oct->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_nov->Visible) { // recurring_nov ?>
    <tr id="r_recurring_nov">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_nov"><?= $Page->recurring_nov->caption() ?></span></td>
        <td data-name="recurring_nov" <?= $Page->recurring_nov->cellAttributes() ?>>
<span id="el_room_reservation_recurring_nov">
<span<?= $Page->recurring_nov->viewAttributes() ?>>
<?= $Page->recurring_nov->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recurring_dec->Visible) { // recurring_dec ?>
    <tr id="r_recurring_dec">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_recurring_dec"><?= $Page->recurring_dec->caption() ?></span></td>
        <td data-name="recurring_dec" <?= $Page->recurring_dec->cellAttributes() ?>>
<span id="el_room_reservation_recurring_dec">
<span<?= $Page->recurring_dec->viewAttributes() ?>>
<?= $Page->recurring_dec->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->setup_shape->Visible) { // setup_shape ?>
    <tr id="r_setup_shape">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_setup_shape"><?= $Page->setup_shape->caption() ?></span></td>
        <td data-name="setup_shape" <?= $Page->setup_shape->cellAttributes() ?>>
<span id="el_room_reservation_setup_shape">
<span<?= $Page->setup_shape->viewAttributes() ?>>
<?= $Page->setup_shape->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->certification_name->Visible) { // certification_name ?>
    <tr id="r_certification_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_certification_name"><?= $Page->certification_name->caption() ?></span></td>
        <td data-name="certification_name" <?= $Page->certification_name->cellAttributes() ?>>
<span id="el_room_reservation_certification_name">
<span<?= $Page->certification_name->viewAttributes() ?>>
<?= $Page->certification_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->certification_date->Visible) { // certification_date ?>
    <tr id="r_certification_date">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_certification_date"><?= $Page->certification_date->caption() ?></span></td>
        <td data-name="certification_date" <?= $Page->certification_date->cellAttributes() ?>>
<span id="el_room_reservation_certification_date">
<span<?= $Page->certification_date->viewAttributes() ?>>
<?= $Page->certification_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_room_reservation_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_room_reservation_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
