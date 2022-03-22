<?php

namespace PHPMaker2021\project1;

// Page object
$MealpackageDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fmealpackagedelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fmealpackagedelete = currentForm = new ew.Form("fmealpackagedelete", "delete");
    loadjs.done("fmealpackagedelete");
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
<form name="fmealpackagedelete" id="fmealpackagedelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="mealpackage">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_mealpackage_id" class="mealpackage_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
        <th class="<?= $Page->netid->headerCellClass() ?>"><span id="elh_mealpackage_netid" class="mealpackage_netid"><?= $Page->netid->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sid->Visible) { // sid ?>
        <th class="<?= $Page->sid->headerCellClass() ?>"><span id="elh_mealpackage_sid" class="mealpackage_sid"><?= $Page->sid->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_mealpackage__email" class="mealpackage__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
        <th class="<?= $Page->firstname->headerCellClass() ?>"><span id="elh_mealpackage_firstname" class="mealpackage_firstname"><?= $Page->firstname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
        <th class="<?= $Page->lastname->headerCellClass() ?>"><span id="elh_mealpackage_lastname" class="mealpackage_lastname"><?= $Page->lastname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th class="<?= $Page->phone->headerCellClass() ?>"><span id="elh_mealpackage_phone" class="mealpackage_phone"><?= $Page->phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dorm->Visible) { // dorm ?>
        <th class="<?= $Page->dorm->headerCellClass() ?>"><span id="elh_mealpackage_dorm" class="mealpackage_dorm"><?= $Page->dorm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->meal->Visible) { // meal ?>
        <th class="<?= $Page->meal->headerCellClass() ?>"><span id="elh_mealpackage_meal" class="mealpackage_meal"><?= $Page->meal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->refrigerator->Visible) { // refrigerator ?>
        <th class="<?= $Page->refrigerator->headerCellClass() ?>"><span id="elh_mealpackage_refrigerator" class="mealpackage_refrigerator"><?= $Page->refrigerator->caption() ?></span></th>
<?php } ?>
<?php if ($Page->microwave->Visible) { // microwave ?>
        <th class="<?= $Page->microwave->headerCellClass() ?>"><span id="elh_mealpackage_microwave" class="mealpackage_microwave"><?= $Page->microwave->caption() ?></span></th>
<?php } ?>
<?php if ($Page->water->Visible) { // water ?>
        <th class="<?= $Page->water->headerCellClass() ?>"><span id="elh_mealpackage_water" class="mealpackage_water"><?= $Page->water->caption() ?></span></th>
<?php } ?>
<?php if ($Page->room_number->Visible) { // room_number ?>
        <th class="<?= $Page->room_number->headerCellClass() ?>"><span id="elh_mealpackage_room_number" class="mealpackage_room_number"><?= $Page->room_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
        <th class="<?= $Page->amount->headerCellClass() ?>"><span id="elh_mealpackage_amount" class="mealpackage_amount"><?= $Page->amount->caption() ?></span></th>
<?php } ?>
<?php if ($Page->payment->Visible) { // payment ?>
        <th class="<?= $Page->payment->headerCellClass() ?>"><span id="elh_mealpackage_payment" class="mealpackage_payment"><?= $Page->payment->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_mealpackage_status" class="mealpackage_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_mealpackage_timestamp" class="mealpackage_timestamp"><?= $Page->timestamp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th class="<?= $Page->type->headerCellClass() ?>"><span id="elh_mealpackage_type" class="mealpackage_type"><?= $Page->type->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_mealpackage_id" class="mealpackage_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
        <td <?= $Page->netid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_netid" class="mealpackage_netid">
<span<?= $Page->netid->viewAttributes() ?>>
<?= $Page->netid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sid->Visible) { // sid ?>
        <td <?= $Page->sid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_sid" class="mealpackage_sid">
<span<?= $Page->sid->viewAttributes() ?>>
<?= $Page->sid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td <?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage__email" class="mealpackage__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
        <td <?= $Page->firstname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_firstname" class="mealpackage_firstname">
<span<?= $Page->firstname->viewAttributes() ?>>
<?= $Page->firstname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
        <td <?= $Page->lastname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_lastname" class="mealpackage_lastname">
<span<?= $Page->lastname->viewAttributes() ?>>
<?= $Page->lastname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <td <?= $Page->phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_phone" class="mealpackage_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dorm->Visible) { // dorm ?>
        <td <?= $Page->dorm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_dorm" class="mealpackage_dorm">
<span<?= $Page->dorm->viewAttributes() ?>>
<?= $Page->dorm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->meal->Visible) { // meal ?>
        <td <?= $Page->meal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_meal" class="mealpackage_meal">
<span<?= $Page->meal->viewAttributes() ?>>
<?= $Page->meal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->refrigerator->Visible) { // refrigerator ?>
        <td <?= $Page->refrigerator->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_refrigerator" class="mealpackage_refrigerator">
<span<?= $Page->refrigerator->viewAttributes() ?>>
<?= $Page->refrigerator->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->microwave->Visible) { // microwave ?>
        <td <?= $Page->microwave->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_microwave" class="mealpackage_microwave">
<span<?= $Page->microwave->viewAttributes() ?>>
<?= $Page->microwave->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->water->Visible) { // water ?>
        <td <?= $Page->water->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_water" class="mealpackage_water">
<span<?= $Page->water->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_water_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->water->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->water->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_water_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->room_number->Visible) { // room_number ?>
        <td <?= $Page->room_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_room_number" class="mealpackage_room_number">
<span<?= $Page->room_number->viewAttributes() ?>>
<?= $Page->room_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
        <td <?= $Page->amount->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_amount" class="mealpackage_amount">
<span<?= $Page->amount->viewAttributes() ?>>
<?= $Page->amount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->payment->Visible) { // payment ?>
        <td <?= $Page->payment->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_payment" class="mealpackage_payment">
<span<?= $Page->payment->viewAttributes() ?>>
<?= $Page->payment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_status" class="mealpackage_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_timestamp" class="mealpackage_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <td <?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_mealpackage_type" class="mealpackage_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
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
