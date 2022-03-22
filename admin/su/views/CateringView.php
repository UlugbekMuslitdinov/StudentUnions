<?php

namespace PHPMaker2021\project1;

// Page object
$CateringView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcateringview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fcateringview = currentForm = new ew.Form("fcateringview", "view");
    loadjs.done("fcateringview");
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
<form name="fcateringview" id="fcateringview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="catering">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_catering_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <tr id="r_location">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_location"><?= $Page->location->caption() ?></span></td>
        <td data-name="location" <?= $Page->location->cellAttributes() ?>>
<span id="el_catering_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->method->Visible) { // method ?>
    <tr id="r_method">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_method"><?= $Page->method->caption() ?></span></td>
        <td data-name="method" <?= $Page->method->cellAttributes() ?>>
<span id="el_catering_method">
<span<?= $Page->method->viewAttributes() ?>>
<?= $Page->method->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->delivery_date->Visible) { // delivery_date ?>
    <tr id="r_delivery_date">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_delivery_date"><?= $Page->delivery_date->caption() ?></span></td>
        <td data-name="delivery_date" <?= $Page->delivery_date->cellAttributes() ?>>
<span id="el_catering_delivery_date">
<span<?= $Page->delivery_date->viewAttributes() ?>>
<?= $Page->delivery_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->delivery_time->Visible) { // delivery_time ?>
    <tr id="r_delivery_time">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_delivery_time"><?= $Page->delivery_time->caption() ?></span></td>
        <td data-name="delivery_time" <?= $Page->delivery_time->cellAttributes() ?>>
<span id="el_catering_delivery_time">
<span<?= $Page->delivery_time->viewAttributes() ?>>
<?= $Page->delivery_time->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->delivery_building->Visible) { // delivery_building ?>
    <tr id="r_delivery_building">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_delivery_building"><?= $Page->delivery_building->caption() ?></span></td>
        <td data-name="delivery_building" <?= $Page->delivery_building->cellAttributes() ?>>
<span id="el_catering_delivery_building">
<span<?= $Page->delivery_building->viewAttributes() ?>>
<?= $Page->delivery_building->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->delivery_room->Visible) { // delivery_room ?>
    <tr id="r_delivery_room">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_delivery_room"><?= $Page->delivery_room->caption() ?></span></td>
        <td data-name="delivery_room" <?= $Page->delivery_room->cellAttributes() ?>>
<span id="el_catering_delivery_room">
<span<?= $Page->delivery_room->viewAttributes() ?>>
<?= $Page->delivery_room->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->delivery_notes->Visible) { // delivery_notes ?>
    <tr id="r_delivery_notes">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_delivery_notes"><?= $Page->delivery_notes->caption() ?></span></td>
        <td data-name="delivery_notes" <?= $Page->delivery_notes->cellAttributes() ?>>
<span id="el_catering_delivery_notes">
<span<?= $Page->delivery_notes->viewAttributes() ?>>
<?= $Page->delivery_notes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->onsite_name->Visible) { // onsite_name ?>
    <tr id="r_onsite_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_onsite_name"><?= $Page->onsite_name->caption() ?></span></td>
        <td data-name="onsite_name" <?= $Page->onsite_name->cellAttributes() ?>>
<span id="el_catering_onsite_name">
<span<?= $Page->onsite_name->viewAttributes() ?>>
<?= $Page->onsite_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->onsite_email->Visible) { // onsite_email ?>
    <tr id="r_onsite_email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_onsite_email"><?= $Page->onsite_email->caption() ?></span></td>
        <td data-name="onsite_email" <?= $Page->onsite_email->cellAttributes() ?>>
<span id="el_catering_onsite_email">
<span<?= $Page->onsite_email->viewAttributes() ?>>
<?= $Page->onsite_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->onsite_phone->Visible) { // onsite_phone ?>
    <tr id="r_onsite_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_onsite_phone"><?= $Page->onsite_phone->caption() ?></span></td>
        <td data-name="onsite_phone" <?= $Page->onsite_phone->cellAttributes() ?>>
<span id="el_catering_onsite_phone">
<span<?= $Page->onsite_phone->viewAttributes() ?>>
<?= $Page->onsite_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->customer_name->Visible) { // customer_name ?>
    <tr id="r_customer_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_customer_name"><?= $Page->customer_name->caption() ?></span></td>
        <td data-name="customer_name" <?= $Page->customer_name->cellAttributes() ?>>
<span id="el_catering_customer_name">
<span<?= $Page->customer_name->viewAttributes() ?>>
<?= $Page->customer_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->customer_phone->Visible) { // customer_phone ?>
    <tr id="r_customer_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_customer_phone"><?= $Page->customer_phone->caption() ?></span></td>
        <td data-name="customer_phone" <?= $Page->customer_phone->cellAttributes() ?>>
<span id="el_catering_customer_phone">
<span<?= $Page->customer_phone->viewAttributes() ?>>
<?= $Page->customer_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->customer_email->Visible) { // customer_email ?>
    <tr id="r_customer_email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_customer_email"><?= $Page->customer_email->caption() ?></span></td>
        <td data-name="customer_email" <?= $Page->customer_email->cellAttributes() ?>>
<span id="el_catering_customer_email">
<span<?= $Page->customer_email->viewAttributes() ?>>
<?= $Page->customer_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
    <tr id="r_payment_method">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_payment_method"><?= $Page->payment_method->caption() ?></span></td>
        <td data-name="payment_method" <?= $Page->payment_method->cellAttributes() ?>>
<span id="el_catering_payment_method">
<span<?= $Page->payment_method->viewAttributes() ?>>
<?= $Page->payment_method->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->account_num->Visible) { // account_num ?>
    <tr id="r_account_num">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_account_num"><?= $Page->account_num->caption() ?></span></td>
        <td data-name="account_num" <?= $Page->account_num->cellAttributes() ?>>
<span id="el_catering_account_num">
<span<?= $Page->account_num->viewAttributes() ?>>
<?= $Page->account_num->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sub_code->Visible) { // sub_code ?>
    <tr id="r_sub_code">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_sub_code"><?= $Page->sub_code->caption() ?></span></td>
        <td data-name="sub_code" <?= $Page->sub_code->cellAttributes() ?>>
<span id="el_catering_sub_code">
<span<?= $Page->sub_code->viewAttributes() ?>>
<?= $Page->sub_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el_catering_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->order->Visible) { // order ?>
    <tr id="r_order">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_order"><?= $Page->order->caption() ?></span></td>
        <td data-name="order" <?= $Page->order->cellAttributes() ?>>
<span id="el_catering_order">
<span<?= $Page->order->viewAttributes() ?>>
<?= $Page->order->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_catering_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_catering_timestamp">
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
