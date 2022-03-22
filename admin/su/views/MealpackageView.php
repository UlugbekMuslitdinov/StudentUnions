<?php

namespace PHPMaker2021\project1;

// Page object
$MealpackageView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fmealpackageview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fmealpackageview = currentForm = new ew.Form("fmealpackageview", "view");
    loadjs.done("fmealpackageview");
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
<form name="fmealpackageview" id="fmealpackageview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="mealpackage">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_mealpackage_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
    <tr id="r_netid">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_netid"><?= $Page->netid->caption() ?></span></td>
        <td data-name="netid" <?= $Page->netid->cellAttributes() ?>>
<span id="el_mealpackage_netid">
<span<?= $Page->netid->viewAttributes() ?>>
<?= $Page->netid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sid->Visible) { // sid ?>
    <tr id="r_sid">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_sid"><?= $Page->sid->caption() ?></span></td>
        <td data-name="sid" <?= $Page->sid->cellAttributes() ?>>
<span id="el_mealpackage_sid">
<span<?= $Page->sid->viewAttributes() ?>>
<?= $Page->sid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email" <?= $Page->_email->cellAttributes() ?>>
<span id="el_mealpackage__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->firstname->Visible) { // firstname ?>
    <tr id="r_firstname">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_firstname"><?= $Page->firstname->caption() ?></span></td>
        <td data-name="firstname" <?= $Page->firstname->cellAttributes() ?>>
<span id="el_mealpackage_firstname">
<span<?= $Page->firstname->viewAttributes() ?>>
<?= $Page->firstname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lastname->Visible) { // lastname ?>
    <tr id="r_lastname">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_lastname"><?= $Page->lastname->caption() ?></span></td>
        <td data-name="lastname" <?= $Page->lastname->cellAttributes() ?>>
<span id="el_mealpackage_lastname">
<span<?= $Page->lastname->viewAttributes() ?>>
<?= $Page->lastname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <tr id="r_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_phone"><?= $Page->phone->caption() ?></span></td>
        <td data-name="phone" <?= $Page->phone->cellAttributes() ?>>
<span id="el_mealpackage_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dorm->Visible) { // dorm ?>
    <tr id="r_dorm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_dorm"><?= $Page->dorm->caption() ?></span></td>
        <td data-name="dorm" <?= $Page->dorm->cellAttributes() ?>>
<span id="el_mealpackage_dorm">
<span<?= $Page->dorm->viewAttributes() ?>>
<?= $Page->dorm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->meal->Visible) { // meal ?>
    <tr id="r_meal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_meal"><?= $Page->meal->caption() ?></span></td>
        <td data-name="meal" <?= $Page->meal->cellAttributes() ?>>
<span id="el_mealpackage_meal">
<span<?= $Page->meal->viewAttributes() ?>>
<?= $Page->meal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->refrigerator->Visible) { // refrigerator ?>
    <tr id="r_refrigerator">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_refrigerator"><?= $Page->refrigerator->caption() ?></span></td>
        <td data-name="refrigerator" <?= $Page->refrigerator->cellAttributes() ?>>
<span id="el_mealpackage_refrigerator">
<span<?= $Page->refrigerator->viewAttributes() ?>>
<?= $Page->refrigerator->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->microwave->Visible) { // microwave ?>
    <tr id="r_microwave">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_microwave"><?= $Page->microwave->caption() ?></span></td>
        <td data-name="microwave" <?= $Page->microwave->cellAttributes() ?>>
<span id="el_mealpackage_microwave">
<span<?= $Page->microwave->viewAttributes() ?>>
<?= $Page->microwave->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->water->Visible) { // water ?>
    <tr id="r_water">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_water"><?= $Page->water->caption() ?></span></td>
        <td data-name="water" <?= $Page->water->cellAttributes() ?>>
<span id="el_mealpackage_water">
<span<?= $Page->water->viewAttributes() ?>>
<div class="custom-control custom-checkbox d-inline-block">
    <input type="checkbox" id="x_water_<?= $Page->RowCount ?>" class="custom-control-input" value="<?= $Page->water->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->water->CurrentValue)) { ?> checked<?php } ?>>
    <label class="custom-control-label" for="x_water_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->requests->Visible) { // requests ?>
    <tr id="r_requests">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_requests"><?= $Page->requests->caption() ?></span></td>
        <td data-name="requests" <?= $Page->requests->cellAttributes() ?>>
<span id="el_mealpackage_requests">
<span<?= $Page->requests->viewAttributes() ?>>
<?= $Page->requests->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->room_number->Visible) { // room_number ?>
    <tr id="r_room_number">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_room_number"><?= $Page->room_number->caption() ?></span></td>
        <td data-name="room_number" <?= $Page->room_number->cellAttributes() ?>>
<span id="el_mealpackage_room_number">
<span<?= $Page->room_number->viewAttributes() ?>>
<?= $Page->room_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
    <tr id="r_amount">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_amount"><?= $Page->amount->caption() ?></span></td>
        <td data-name="amount" <?= $Page->amount->cellAttributes() ?>>
<span id="el_mealpackage_amount">
<span<?= $Page->amount->viewAttributes() ?>>
<?= $Page->amount->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->payment->Visible) { // payment ?>
    <tr id="r_payment">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_payment"><?= $Page->payment->caption() ?></span></td>
        <td data-name="payment" <?= $Page->payment->cellAttributes() ?>>
<span id="el_mealpackage_payment">
<span<?= $Page->payment->viewAttributes() ?>>
<?= $Page->payment->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el_mealpackage_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_mealpackage_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <tr id="r_type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_mealpackage_type"><?= $Page->type->caption() ?></span></td>
        <td data-name="type" <?= $Page->type->cellAttributes() ?>>
<span id="el_mealpackage_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
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
