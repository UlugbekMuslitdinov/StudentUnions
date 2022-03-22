<?php

namespace PHPMaker2021\project1;

// Page object
$CateringDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fcateringdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fcateringdelete = currentForm = new ew.Form("fcateringdelete", "delete");
    loadjs.done("fcateringdelete");
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
<form name="fcateringdelete" id="fcateringdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_catering_id" class="catering_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th class="<?= $Page->location->headerCellClass() ?>"><span id="elh_catering_location" class="catering_location"><?= $Page->location->caption() ?></span></th>
<?php } ?>
<?php if ($Page->method->Visible) { // method ?>
        <th class="<?= $Page->method->headerCellClass() ?>"><span id="elh_catering_method" class="catering_method"><?= $Page->method->caption() ?></span></th>
<?php } ?>
<?php if ($Page->delivery_date->Visible) { // delivery_date ?>
        <th class="<?= $Page->delivery_date->headerCellClass() ?>"><span id="elh_catering_delivery_date" class="catering_delivery_date"><?= $Page->delivery_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->delivery_time->Visible) { // delivery_time ?>
        <th class="<?= $Page->delivery_time->headerCellClass() ?>"><span id="elh_catering_delivery_time" class="catering_delivery_time"><?= $Page->delivery_time->caption() ?></span></th>
<?php } ?>
<?php if ($Page->delivery_building->Visible) { // delivery_building ?>
        <th class="<?= $Page->delivery_building->headerCellClass() ?>"><span id="elh_catering_delivery_building" class="catering_delivery_building"><?= $Page->delivery_building->caption() ?></span></th>
<?php } ?>
<?php if ($Page->delivery_room->Visible) { // delivery_room ?>
        <th class="<?= $Page->delivery_room->headerCellClass() ?>"><span id="elh_catering_delivery_room" class="catering_delivery_room"><?= $Page->delivery_room->caption() ?></span></th>
<?php } ?>
<?php if ($Page->onsite_name->Visible) { // onsite_name ?>
        <th class="<?= $Page->onsite_name->headerCellClass() ?>"><span id="elh_catering_onsite_name" class="catering_onsite_name"><?= $Page->onsite_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->onsite_email->Visible) { // onsite_email ?>
        <th class="<?= $Page->onsite_email->headerCellClass() ?>"><span id="elh_catering_onsite_email" class="catering_onsite_email"><?= $Page->onsite_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->onsite_phone->Visible) { // onsite_phone ?>
        <th class="<?= $Page->onsite_phone->headerCellClass() ?>"><span id="elh_catering_onsite_phone" class="catering_onsite_phone"><?= $Page->onsite_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->customer_name->Visible) { // customer_name ?>
        <th class="<?= $Page->customer_name->headerCellClass() ?>"><span id="elh_catering_customer_name" class="catering_customer_name"><?= $Page->customer_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->customer_phone->Visible) { // customer_phone ?>
        <th class="<?= $Page->customer_phone->headerCellClass() ?>"><span id="elh_catering_customer_phone" class="catering_customer_phone"><?= $Page->customer_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->customer_email->Visible) { // customer_email ?>
        <th class="<?= $Page->customer_email->headerCellClass() ?>"><span id="elh_catering_customer_email" class="catering_customer_email"><?= $Page->customer_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
        <th class="<?= $Page->payment_method->headerCellClass() ?>"><span id="elh_catering_payment_method" class="catering_payment_method"><?= $Page->payment_method->caption() ?></span></th>
<?php } ?>
<?php if ($Page->account_num->Visible) { // account_num ?>
        <th class="<?= $Page->account_num->headerCellClass() ?>"><span id="elh_catering_account_num" class="catering_account_num"><?= $Page->account_num->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sub_code->Visible) { // sub_code ?>
        <th class="<?= $Page->sub_code->headerCellClass() ?>"><span id="elh_catering_sub_code" class="catering_sub_code"><?= $Page->sub_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_catering_status" class="catering_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_catering_timestamp" class="catering_timestamp"><?= $Page->timestamp->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_catering_id" class="catering_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <td <?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_location" class="catering_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->method->Visible) { // method ?>
        <td <?= $Page->method->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_method" class="catering_method">
<span<?= $Page->method->viewAttributes() ?>>
<?= $Page->method->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->delivery_date->Visible) { // delivery_date ?>
        <td <?= $Page->delivery_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_delivery_date" class="catering_delivery_date">
<span<?= $Page->delivery_date->viewAttributes() ?>>
<?= $Page->delivery_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->delivery_time->Visible) { // delivery_time ?>
        <td <?= $Page->delivery_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_delivery_time" class="catering_delivery_time">
<span<?= $Page->delivery_time->viewAttributes() ?>>
<?= $Page->delivery_time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->delivery_building->Visible) { // delivery_building ?>
        <td <?= $Page->delivery_building->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_delivery_building" class="catering_delivery_building">
<span<?= $Page->delivery_building->viewAttributes() ?>>
<?= $Page->delivery_building->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->delivery_room->Visible) { // delivery_room ?>
        <td <?= $Page->delivery_room->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_delivery_room" class="catering_delivery_room">
<span<?= $Page->delivery_room->viewAttributes() ?>>
<?= $Page->delivery_room->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->onsite_name->Visible) { // onsite_name ?>
        <td <?= $Page->onsite_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_onsite_name" class="catering_onsite_name">
<span<?= $Page->onsite_name->viewAttributes() ?>>
<?= $Page->onsite_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->onsite_email->Visible) { // onsite_email ?>
        <td <?= $Page->onsite_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_onsite_email" class="catering_onsite_email">
<span<?= $Page->onsite_email->viewAttributes() ?>>
<?= $Page->onsite_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->onsite_phone->Visible) { // onsite_phone ?>
        <td <?= $Page->onsite_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_onsite_phone" class="catering_onsite_phone">
<span<?= $Page->onsite_phone->viewAttributes() ?>>
<?= $Page->onsite_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->customer_name->Visible) { // customer_name ?>
        <td <?= $Page->customer_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_customer_name" class="catering_customer_name">
<span<?= $Page->customer_name->viewAttributes() ?>>
<?= $Page->customer_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->customer_phone->Visible) { // customer_phone ?>
        <td <?= $Page->customer_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_customer_phone" class="catering_customer_phone">
<span<?= $Page->customer_phone->viewAttributes() ?>>
<?= $Page->customer_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->customer_email->Visible) { // customer_email ?>
        <td <?= $Page->customer_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_customer_email" class="catering_customer_email">
<span<?= $Page->customer_email->viewAttributes() ?>>
<?= $Page->customer_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
        <td <?= $Page->payment_method->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_payment_method" class="catering_payment_method">
<span<?= $Page->payment_method->viewAttributes() ?>>
<?= $Page->payment_method->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->account_num->Visible) { // account_num ?>
        <td <?= $Page->account_num->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_account_num" class="catering_account_num">
<span<?= $Page->account_num->viewAttributes() ?>>
<?= $Page->account_num->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sub_code->Visible) { // sub_code ?>
        <td <?= $Page->sub_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_sub_code" class="catering_sub_code">
<span<?= $Page->sub_code->viewAttributes() ?>>
<?= $Page->sub_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_status" class="catering_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_catering_timestamp" class="catering_timestamp">
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
