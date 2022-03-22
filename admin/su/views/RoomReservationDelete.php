<?php

namespace PHPMaker2021\project1;

// Page object
$RoomReservationDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var froom_reservationdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    froom_reservationdelete = currentForm = new ew.Form("froom_reservationdelete", "delete");
    loadjs.done("froom_reservationdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="froom_reservationdelete" id="froom_reservationdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="room_reservation">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_room_reservation_id" class="room_reservation_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_org->Visible) { // contact_org ?>
        <th class="<?= $Page->contact_org->headerCellClass() ?>"><span id="elh_room_reservation_contact_org" class="room_reservation_contact_org"><?= $Page->contact_org->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_name->Visible) { // contact_name ?>
        <th class="<?= $Page->contact_name->headerCellClass() ?>"><span id="elh_room_reservation_contact_name" class="room_reservation_contact_name"><?= $Page->contact_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_email->Visible) { // contact_email ?>
        <th class="<?= $Page->contact_email->headerCellClass() ?>"><span id="elh_room_reservation_contact_email" class="room_reservation_contact_email"><?= $Page->contact_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_phone->Visible) { // contact_phone ?>
        <th class="<?= $Page->contact_phone->headerCellClass() ?>"><span id="elh_room_reservation_contact_phone" class="room_reservation_contact_phone"><?= $Page->contact_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_fax->Visible) { // contact_fax ?>
        <th class="<?= $Page->contact_fax->headerCellClass() ?>"><span id="elh_room_reservation_contact_fax" class="room_reservation_contact_fax"><?= $Page->contact_fax->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_address->Visible) { // contact_address ?>
        <th class="<?= $Page->contact_address->headerCellClass() ?>"><span id="elh_room_reservation_contact_address" class="room_reservation_contact_address"><?= $Page->contact_address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_city->Visible) { // contact_city ?>
        <th class="<?= $Page->contact_city->headerCellClass() ?>"><span id="elh_room_reservation_contact_city" class="room_reservation_contact_city"><?= $Page->contact_city->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_state->Visible) { // contact_state ?>
        <th class="<?= $Page->contact_state->headerCellClass() ?>"><span id="elh_room_reservation_contact_state" class="room_reservation_contact_state"><?= $Page->contact_state->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_zip->Visible) { // contact_zip ?>
        <th class="<?= $Page->contact_zip->headerCellClass() ?>"><span id="elh_room_reservation_contact_zip" class="room_reservation_contact_zip"><?= $Page->contact_zip->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_advisor->Visible) { // contact_advisor ?>
        <th class="<?= $Page->contact_advisor->headerCellClass() ?>"><span id="elh_room_reservation_contact_advisor" class="room_reservation_contact_advisor"><?= $Page->contact_advisor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_advisor_phone->Visible) { // contact_advisor_phone ?>
        <th class="<?= $Page->contact_advisor_phone->headerCellClass() ?>"><span id="elh_room_reservation_contact_advisor_phone" class="room_reservation_contact_advisor_phone"><?= $Page->contact_advisor_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_advisor_email->Visible) { // contact_advisor_email ?>
        <th class="<?= $Page->contact_advisor_email->headerCellClass() ?>"><span id="elh_room_reservation_contact_advisor_email" class="room_reservation_contact_advisor_email"><?= $Page->contact_advisor_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->billing_org->Visible) { // billing_org ?>
        <th class="<?= $Page->billing_org->headerCellClass() ?>"><span id="elh_room_reservation_billing_org" class="room_reservation_billing_org"><?= $Page->billing_org->caption() ?></span></th>
<?php } ?>
<?php if ($Page->billing_name->Visible) { // billing_name ?>
        <th class="<?= $Page->billing_name->headerCellClass() ?>"><span id="elh_room_reservation_billing_name" class="room_reservation_billing_name"><?= $Page->billing_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->billing_email->Visible) { // billing_email ?>
        <th class="<?= $Page->billing_email->headerCellClass() ?>"><span id="elh_room_reservation_billing_email" class="room_reservation_billing_email"><?= $Page->billing_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->billing_phone->Visible) { // billing_phone ?>
        <th class="<?= $Page->billing_phone->headerCellClass() ?>"><span id="elh_room_reservation_billing_phone" class="room_reservation_billing_phone"><?= $Page->billing_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->billing_fax->Visible) { // billing_fax ?>
        <th class="<?= $Page->billing_fax->headerCellClass() ?>"><span id="elh_room_reservation_billing_fax" class="room_reservation_billing_fax"><?= $Page->billing_fax->caption() ?></span></th>
<?php } ?>
<?php if ($Page->billing_address->Visible) { // billing_address ?>
        <th class="<?= $Page->billing_address->headerCellClass() ?>"><span id="elh_room_reservation_billing_address" class="room_reservation_billing_address"><?= $Page->billing_address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->billing_city->Visible) { // billing_city ?>
        <th class="<?= $Page->billing_city->headerCellClass() ?>"><span id="elh_room_reservation_billing_city" class="room_reservation_billing_city"><?= $Page->billing_city->caption() ?></span></th>
<?php } ?>
<?php if ($Page->billing_state->Visible) { // billing_state ?>
        <th class="<?= $Page->billing_state->headerCellClass() ?>"><span id="elh_room_reservation_billing_state" class="room_reservation_billing_state"><?= $Page->billing_state->caption() ?></span></th>
<?php } ?>
<?php if ($Page->billing_zip->Visible) { // billing_zip ?>
        <th class="<?= $Page->billing_zip->headerCellClass() ?>"><span id="elh_room_reservation_billing_zip" class="room_reservation_billing_zip"><?= $Page->billing_zip->caption() ?></span></th>
<?php } ?>
<?php if ($Page->billing_method->Visible) { // billing_method ?>
        <th class="<?= $Page->billing_method->headerCellClass() ?>"><span id="elh_room_reservation_billing_method" class="room_reservation_billing_method"><?= $Page->billing_method->caption() ?></span></th>
<?php } ?>
<?php if ($Page->billing_frs->Visible) { // billing_frs ?>
        <th class="<?= $Page->billing_frs->headerCellClass() ?>"><span id="elh_room_reservation_billing_frs" class="room_reservation_billing_frs"><?= $Page->billing_frs->caption() ?></span></th>
<?php } ?>
<?php if ($Page->event_title->Visible) { // event_title ?>
        <th class="<?= $Page->event_title->headerCellClass() ?>"><span id="elh_room_reservation_event_title" class="room_reservation_event_title"><?= $Page->event_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->event_type->Visible) { // event_type ?>
        <th class="<?= $Page->event_type->headerCellClass() ?>"><span id="elh_room_reservation_event_type" class="room_reservation_event_type"><?= $Page->event_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->event_date->Visible) { // event_date ?>
        <th class="<?= $Page->event_date->headerCellClass() ?>"><span id="elh_room_reservation_event_date" class="room_reservation_event_date"><?= $Page->event_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->event_time_start->Visible) { // event_time_start ?>
        <th class="<?= $Page->event_time_start->headerCellClass() ?>"><span id="elh_room_reservation_event_time_start" class="room_reservation_event_time_start"><?= $Page->event_time_start->caption() ?></span></th>
<?php } ?>
<?php if ($Page->event_time_end->Visible) { // event_time_end ?>
        <th class="<?= $Page->event_time_end->headerCellClass() ?>"><span id="elh_room_reservation_event_time_end" class="room_reservation_event_time_end"><?= $Page->event_time_end->caption() ?></span></th>
<?php } ?>
<?php if ($Page->event_num_people->Visible) { // event_num_people ?>
        <th class="<?= $Page->event_num_people->headerCellClass() ?>"><span id="elh_room_reservation_event_num_people" class="room_reservation_event_num_people"><?= $Page->event_num_people->caption() ?></span></th>
<?php } ?>
<?php if ($Page->event_room_preference->Visible) { // event_room_preference ?>
        <th class="<?= $Page->event_room_preference->headerCellClass() ?>"><span id="elh_room_reservation_event_room_preference" class="room_reservation_event_room_preference"><?= $Page->event_room_preference->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_jan->Visible) { // recurring_jan ?>
        <th class="<?= $Page->recurring_jan->headerCellClass() ?>"><span id="elh_room_reservation_recurring_jan" class="room_reservation_recurring_jan"><?= $Page->recurring_jan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_feb->Visible) { // recurring_feb ?>
        <th class="<?= $Page->recurring_feb->headerCellClass() ?>"><span id="elh_room_reservation_recurring_feb" class="room_reservation_recurring_feb"><?= $Page->recurring_feb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_mar->Visible) { // recurring_mar ?>
        <th class="<?= $Page->recurring_mar->headerCellClass() ?>"><span id="elh_room_reservation_recurring_mar" class="room_reservation_recurring_mar"><?= $Page->recurring_mar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_apr->Visible) { // recurring_apr ?>
        <th class="<?= $Page->recurring_apr->headerCellClass() ?>"><span id="elh_room_reservation_recurring_apr" class="room_reservation_recurring_apr"><?= $Page->recurring_apr->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_may->Visible) { // recurring_may ?>
        <th class="<?= $Page->recurring_may->headerCellClass() ?>"><span id="elh_room_reservation_recurring_may" class="room_reservation_recurring_may"><?= $Page->recurring_may->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_jun->Visible) { // recurring_jun ?>
        <th class="<?= $Page->recurring_jun->headerCellClass() ?>"><span id="elh_room_reservation_recurring_jun" class="room_reservation_recurring_jun"><?= $Page->recurring_jun->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_jul->Visible) { // recurring_jul ?>
        <th class="<?= $Page->recurring_jul->headerCellClass() ?>"><span id="elh_room_reservation_recurring_jul" class="room_reservation_recurring_jul"><?= $Page->recurring_jul->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_aug->Visible) { // recurring_aug ?>
        <th class="<?= $Page->recurring_aug->headerCellClass() ?>"><span id="elh_room_reservation_recurring_aug" class="room_reservation_recurring_aug"><?= $Page->recurring_aug->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_sep->Visible) { // recurring_sep ?>
        <th class="<?= $Page->recurring_sep->headerCellClass() ?>"><span id="elh_room_reservation_recurring_sep" class="room_reservation_recurring_sep"><?= $Page->recurring_sep->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_oct->Visible) { // recurring_oct ?>
        <th class="<?= $Page->recurring_oct->headerCellClass() ?>"><span id="elh_room_reservation_recurring_oct" class="room_reservation_recurring_oct"><?= $Page->recurring_oct->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_nov->Visible) { // recurring_nov ?>
        <th class="<?= $Page->recurring_nov->headerCellClass() ?>"><span id="elh_room_reservation_recurring_nov" class="room_reservation_recurring_nov"><?= $Page->recurring_nov->caption() ?></span></th>
<?php } ?>
<?php if ($Page->recurring_dec->Visible) { // recurring_dec ?>
        <th class="<?= $Page->recurring_dec->headerCellClass() ?>"><span id="elh_room_reservation_recurring_dec" class="room_reservation_recurring_dec"><?= $Page->recurring_dec->caption() ?></span></th>
<?php } ?>
<?php if ($Page->setup_shape->Visible) { // setup_shape ?>
        <th class="<?= $Page->setup_shape->headerCellClass() ?>"><span id="elh_room_reservation_setup_shape" class="room_reservation_setup_shape"><?= $Page->setup_shape->caption() ?></span></th>
<?php } ?>
<?php if ($Page->certification_name->Visible) { // certification_name ?>
        <th class="<?= $Page->certification_name->headerCellClass() ?>"><span id="elh_room_reservation_certification_name" class="room_reservation_certification_name"><?= $Page->certification_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->certification_date->Visible) { // certification_date ?>
        <th class="<?= $Page->certification_date->headerCellClass() ?>"><span id="elh_room_reservation_certification_date" class="room_reservation_certification_date"><?= $Page->certification_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_room_reservation_timestamp" class="room_reservation_timestamp"><?= $Page->timestamp->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_id" class="room_reservation_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_org->Visible) { // contact_org ?>
        <td <?= $Page->contact_org->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_org" class="room_reservation_contact_org">
<span<?= $Page->contact_org->viewAttributes() ?>>
<?= $Page->contact_org->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_name->Visible) { // contact_name ?>
        <td <?= $Page->contact_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_name" class="room_reservation_contact_name">
<span<?= $Page->contact_name->viewAttributes() ?>>
<?= $Page->contact_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_email->Visible) { // contact_email ?>
        <td <?= $Page->contact_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_email" class="room_reservation_contact_email">
<span<?= $Page->contact_email->viewAttributes() ?>>
<?= $Page->contact_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_phone->Visible) { // contact_phone ?>
        <td <?= $Page->contact_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_phone" class="room_reservation_contact_phone">
<span<?= $Page->contact_phone->viewAttributes() ?>>
<?= $Page->contact_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_fax->Visible) { // contact_fax ?>
        <td <?= $Page->contact_fax->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_fax" class="room_reservation_contact_fax">
<span<?= $Page->contact_fax->viewAttributes() ?>>
<?= $Page->contact_fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_address->Visible) { // contact_address ?>
        <td <?= $Page->contact_address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_address" class="room_reservation_contact_address">
<span<?= $Page->contact_address->viewAttributes() ?>>
<?= $Page->contact_address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_city->Visible) { // contact_city ?>
        <td <?= $Page->contact_city->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_city" class="room_reservation_contact_city">
<span<?= $Page->contact_city->viewAttributes() ?>>
<?= $Page->contact_city->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_state->Visible) { // contact_state ?>
        <td <?= $Page->contact_state->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_state" class="room_reservation_contact_state">
<span<?= $Page->contact_state->viewAttributes() ?>>
<?= $Page->contact_state->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_zip->Visible) { // contact_zip ?>
        <td <?= $Page->contact_zip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_zip" class="room_reservation_contact_zip">
<span<?= $Page->contact_zip->viewAttributes() ?>>
<?= $Page->contact_zip->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_advisor->Visible) { // contact_advisor ?>
        <td <?= $Page->contact_advisor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_advisor" class="room_reservation_contact_advisor">
<span<?= $Page->contact_advisor->viewAttributes() ?>>
<?= $Page->contact_advisor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_advisor_phone->Visible) { // contact_advisor_phone ?>
        <td <?= $Page->contact_advisor_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_advisor_phone" class="room_reservation_contact_advisor_phone">
<span<?= $Page->contact_advisor_phone->viewAttributes() ?>>
<?= $Page->contact_advisor_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_advisor_email->Visible) { // contact_advisor_email ?>
        <td <?= $Page->contact_advisor_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_contact_advisor_email" class="room_reservation_contact_advisor_email">
<span<?= $Page->contact_advisor_email->viewAttributes() ?>>
<?= $Page->contact_advisor_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->billing_org->Visible) { // billing_org ?>
        <td <?= $Page->billing_org->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_org" class="room_reservation_billing_org">
<span<?= $Page->billing_org->viewAttributes() ?>>
<?= $Page->billing_org->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->billing_name->Visible) { // billing_name ?>
        <td <?= $Page->billing_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_name" class="room_reservation_billing_name">
<span<?= $Page->billing_name->viewAttributes() ?>>
<?= $Page->billing_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->billing_email->Visible) { // billing_email ?>
        <td <?= $Page->billing_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_email" class="room_reservation_billing_email">
<span<?= $Page->billing_email->viewAttributes() ?>>
<?= $Page->billing_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->billing_phone->Visible) { // billing_phone ?>
        <td <?= $Page->billing_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_phone" class="room_reservation_billing_phone">
<span<?= $Page->billing_phone->viewAttributes() ?>>
<?= $Page->billing_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->billing_fax->Visible) { // billing_fax ?>
        <td <?= $Page->billing_fax->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_fax" class="room_reservation_billing_fax">
<span<?= $Page->billing_fax->viewAttributes() ?>>
<?= $Page->billing_fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->billing_address->Visible) { // billing_address ?>
        <td <?= $Page->billing_address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_address" class="room_reservation_billing_address">
<span<?= $Page->billing_address->viewAttributes() ?>>
<?= $Page->billing_address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->billing_city->Visible) { // billing_city ?>
        <td <?= $Page->billing_city->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_city" class="room_reservation_billing_city">
<span<?= $Page->billing_city->viewAttributes() ?>>
<?= $Page->billing_city->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->billing_state->Visible) { // billing_state ?>
        <td <?= $Page->billing_state->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_state" class="room_reservation_billing_state">
<span<?= $Page->billing_state->viewAttributes() ?>>
<?= $Page->billing_state->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->billing_zip->Visible) { // billing_zip ?>
        <td <?= $Page->billing_zip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_zip" class="room_reservation_billing_zip">
<span<?= $Page->billing_zip->viewAttributes() ?>>
<?= $Page->billing_zip->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->billing_method->Visible) { // billing_method ?>
        <td <?= $Page->billing_method->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_method" class="room_reservation_billing_method">
<span<?= $Page->billing_method->viewAttributes() ?>>
<?= $Page->billing_method->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->billing_frs->Visible) { // billing_frs ?>
        <td <?= $Page->billing_frs->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_billing_frs" class="room_reservation_billing_frs">
<span<?= $Page->billing_frs->viewAttributes() ?>>
<?= $Page->billing_frs->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->event_title->Visible) { // event_title ?>
        <td <?= $Page->event_title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_title" class="room_reservation_event_title">
<span<?= $Page->event_title->viewAttributes() ?>>
<?= $Page->event_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->event_type->Visible) { // event_type ?>
        <td <?= $Page->event_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_type" class="room_reservation_event_type">
<span<?= $Page->event_type->viewAttributes() ?>>
<?= $Page->event_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->event_date->Visible) { // event_date ?>
        <td <?= $Page->event_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_date" class="room_reservation_event_date">
<span<?= $Page->event_date->viewAttributes() ?>>
<?= $Page->event_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->event_time_start->Visible) { // event_time_start ?>
        <td <?= $Page->event_time_start->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_time_start" class="room_reservation_event_time_start">
<span<?= $Page->event_time_start->viewAttributes() ?>>
<?= $Page->event_time_start->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->event_time_end->Visible) { // event_time_end ?>
        <td <?= $Page->event_time_end->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_time_end" class="room_reservation_event_time_end">
<span<?= $Page->event_time_end->viewAttributes() ?>>
<?= $Page->event_time_end->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->event_num_people->Visible) { // event_num_people ?>
        <td <?= $Page->event_num_people->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_num_people" class="room_reservation_event_num_people">
<span<?= $Page->event_num_people->viewAttributes() ?>>
<?= $Page->event_num_people->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->event_room_preference->Visible) { // event_room_preference ?>
        <td <?= $Page->event_room_preference->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_event_room_preference" class="room_reservation_event_room_preference">
<span<?= $Page->event_room_preference->viewAttributes() ?>>
<?= $Page->event_room_preference->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_jan->Visible) { // recurring_jan ?>
        <td <?= $Page->recurring_jan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_jan" class="room_reservation_recurring_jan">
<span<?= $Page->recurring_jan->viewAttributes() ?>>
<?= $Page->recurring_jan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_feb->Visible) { // recurring_feb ?>
        <td <?= $Page->recurring_feb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_feb" class="room_reservation_recurring_feb">
<span<?= $Page->recurring_feb->viewAttributes() ?>>
<?= $Page->recurring_feb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_mar->Visible) { // recurring_mar ?>
        <td <?= $Page->recurring_mar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_mar" class="room_reservation_recurring_mar">
<span<?= $Page->recurring_mar->viewAttributes() ?>>
<?= $Page->recurring_mar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_apr->Visible) { // recurring_apr ?>
        <td <?= $Page->recurring_apr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_apr" class="room_reservation_recurring_apr">
<span<?= $Page->recurring_apr->viewAttributes() ?>>
<?= $Page->recurring_apr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_may->Visible) { // recurring_may ?>
        <td <?= $Page->recurring_may->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_may" class="room_reservation_recurring_may">
<span<?= $Page->recurring_may->viewAttributes() ?>>
<?= $Page->recurring_may->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_jun->Visible) { // recurring_jun ?>
        <td <?= $Page->recurring_jun->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_jun" class="room_reservation_recurring_jun">
<span<?= $Page->recurring_jun->viewAttributes() ?>>
<?= $Page->recurring_jun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_jul->Visible) { // recurring_jul ?>
        <td <?= $Page->recurring_jul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_jul" class="room_reservation_recurring_jul">
<span<?= $Page->recurring_jul->viewAttributes() ?>>
<?= $Page->recurring_jul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_aug->Visible) { // recurring_aug ?>
        <td <?= $Page->recurring_aug->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_aug" class="room_reservation_recurring_aug">
<span<?= $Page->recurring_aug->viewAttributes() ?>>
<?= $Page->recurring_aug->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_sep->Visible) { // recurring_sep ?>
        <td <?= $Page->recurring_sep->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_sep" class="room_reservation_recurring_sep">
<span<?= $Page->recurring_sep->viewAttributes() ?>>
<?= $Page->recurring_sep->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_oct->Visible) { // recurring_oct ?>
        <td <?= $Page->recurring_oct->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_oct" class="room_reservation_recurring_oct">
<span<?= $Page->recurring_oct->viewAttributes() ?>>
<?= $Page->recurring_oct->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_nov->Visible) { // recurring_nov ?>
        <td <?= $Page->recurring_nov->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_nov" class="room_reservation_recurring_nov">
<span<?= $Page->recurring_nov->viewAttributes() ?>>
<?= $Page->recurring_nov->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->recurring_dec->Visible) { // recurring_dec ?>
        <td <?= $Page->recurring_dec->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_recurring_dec" class="room_reservation_recurring_dec">
<span<?= $Page->recurring_dec->viewAttributes() ?>>
<?= $Page->recurring_dec->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->setup_shape->Visible) { // setup_shape ?>
        <td <?= $Page->setup_shape->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_setup_shape" class="room_reservation_setup_shape">
<span<?= $Page->setup_shape->viewAttributes() ?>>
<?= $Page->setup_shape->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->certification_name->Visible) { // certification_name ?>
        <td <?= $Page->certification_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_certification_name" class="room_reservation_certification_name">
<span<?= $Page->certification_name->viewAttributes() ?>>
<?= $Page->certification_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->certification_date->Visible) { // certification_date ?>
        <td <?= $Page->certification_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_certification_date" class="room_reservation_certification_date">
<span<?= $Page->certification_date->viewAttributes() ?>>
<?= $Page->certification_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_room_reservation_timestamp" class="room_reservation_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
