<?php

namespace PHPMaker2022\mealplans;

// Page object
$ChargePaymentView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { charge_payment: currentTable } });
var currentForm, currentPageID;
var fcharge_paymentview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcharge_paymentview = new ew.Form("fcharge_paymentview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fcharge_paymentview;
    loadjs.done("fcharge_paymentview");
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
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fcharge_paymentview" id="fcharge_paymentview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="charge_payment">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->charge_id->Visible) { // charge_id ?>
    <tr id="r_charge_id"<?= $Page->charge_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_charge_id"><?= $Page->charge_id->caption() ?></span></td>
        <td data-name="charge_id"<?= $Page->charge_id->cellAttributes() ?>>
<span id="el_charge_payment_charge_id">
<span<?= $Page->charge_id->viewAttributes() ?>>
<?= $Page->charge_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ch_first_name->Visible) { // ch_first_name ?>
    <tr id="r_ch_first_name"<?= $Page->ch_first_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_ch_first_name"><?= $Page->ch_first_name->caption() ?></span></td>
        <td data-name="ch_first_name"<?= $Page->ch_first_name->cellAttributes() ?>>
<span id="el_charge_payment_ch_first_name">
<span<?= $Page->ch_first_name->viewAttributes() ?>>
<?= $Page->ch_first_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ch_last_name->Visible) { // ch_last_name ?>
    <tr id="r_ch_last_name"<?= $Page->ch_last_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_ch_last_name"><?= $Page->ch_last_name->caption() ?></span></td>
        <td data-name="ch_last_name"<?= $Page->ch_last_name->cellAttributes() ?>>
<span id="el_charge_payment_ch_last_name">
<span<?= $Page->ch_last_name->viewAttributes() ?>>
<?= $Page->ch_last_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <tr id="r_address"<?= $Page->address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_address"><?= $Page->address->caption() ?></span></td>
        <td data-name="address"<?= $Page->address->cellAttributes() ?>>
<span id="el_charge_payment_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
    <tr id="r_city"<?= $Page->city->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_city"><?= $Page->city->caption() ?></span></td>
        <td data-name="city"<?= $Page->city->cellAttributes() ?>>
<span id="el_charge_payment_city">
<span<?= $Page->city->viewAttributes() ?>>
<?= $Page->city->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
    <tr id="r_state"<?= $Page->state->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_state"><?= $Page->state->caption() ?></span></td>
        <td data-name="state"<?= $Page->state->cellAttributes() ?>>
<span id="el_charge_payment_state">
<span<?= $Page->state->viewAttributes() ?>>
<?= $Page->state->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->zipcode->Visible) { // zipcode ?>
    <tr id="r_zipcode"<?= $Page->zipcode->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_zipcode"><?= $Page->zipcode->caption() ?></span></td>
        <td data-name="zipcode"<?= $Page->zipcode->cellAttributes() ?>>
<span id="el_charge_payment_zipcode">
<span<?= $Page->zipcode->viewAttributes() ?>>
<?= $Page->zipcode->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->card_type->Visible) { // card_type ?>
    <tr id="r_card_type"<?= $Page->card_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_card_type"><?= $Page->card_type->caption() ?></span></td>
        <td data-name="card_type"<?= $Page->card_type->cellAttributes() ?>>
<span id="el_charge_payment_card_type">
<span<?= $Page->card_type->viewAttributes() ?>>
<?= $Page->card_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->expiration_month->Visible) { // expiration_month ?>
    <tr id="r_expiration_month"<?= $Page->expiration_month->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_expiration_month"><?= $Page->expiration_month->caption() ?></span></td>
        <td data-name="expiration_month"<?= $Page->expiration_month->cellAttributes() ?>>
<span id="el_charge_payment_expiration_month">
<span<?= $Page->expiration_month->viewAttributes() ?>>
<?= $Page->expiration_month->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->expiration_year->Visible) { // expiration_year ?>
    <tr id="r_expiration_year"<?= $Page->expiration_year->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_expiration_year"><?= $Page->expiration_year->caption() ?></span></td>
        <td data-name="expiration_year"<?= $Page->expiration_year->cellAttributes() ?>>
<span id="el_charge_payment_expiration_year">
<span<?= $Page->expiration_year->viewAttributes() ?>>
<?= $Page->expiration_year->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cv_reply->Visible) { // cv_reply ?>
    <tr id="r_cv_reply"<?= $Page->cv_reply->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_cv_reply"><?= $Page->cv_reply->caption() ?></span></td>
        <td data-name="cv_reply"<?= $Page->cv_reply->cellAttributes() ?>>
<span id="el_charge_payment_cv_reply">
<span<?= $Page->cv_reply->viewAttributes() ?>>
<?= $Page->cv_reply->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->charge_amount->Visible) { // charge_amount ?>
    <tr id="r_charge_amount"<?= $Page->charge_amount->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_charge_amount"><?= $Page->charge_amount->caption() ?></span></td>
        <td data-name="charge_amount"<?= $Page->charge_amount->cellAttributes() ?>>
<span id="el_charge_payment_charge_amount">
<span<?= $Page->charge_amount->viewAttributes() ?>>
<?= $Page->charge_amount->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->order_number->Visible) { // order_number ?>
    <tr id="r_order_number"<?= $Page->order_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_order_number"><?= $Page->order_number->caption() ?></span></td>
        <td data-name="order_number"<?= $Page->order_number->cellAttributes() ?>>
<span id="el_charge_payment_order_number">
<span<?= $Page->order_number->viewAttributes() ?>>
<?= $Page->order_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->account_number->Visible) { // account_number ?>
    <tr id="r_account_number"<?= $Page->account_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_account_number"><?= $Page->account_number->caption() ?></span></td>
        <td data-name="account_number"<?= $Page->account_number->cellAttributes() ?>>
<span id="el_charge_payment_account_number">
<span<?= $Page->account_number->viewAttributes() ?>>
<?= $Page->account_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->decision->Visible) { // decision ?>
    <tr id="r_decision"<?= $Page->decision->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_decision"><?= $Page->decision->caption() ?></span></td>
        <td data-name="decision"<?= $Page->decision->cellAttributes() ?>>
<span id="el_charge_payment_decision">
<span<?= $Page->decision->viewAttributes() ?>>
<?= $Page->decision->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->reason_code->Visible) { // reason_code ?>
    <tr id="r_reason_code"<?= $Page->reason_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_reason_code"><?= $Page->reason_code->caption() ?></span></td>
        <td data-name="reason_code"<?= $Page->reason_code->cellAttributes() ?>>
<span id="el_charge_payment_reason_code">
<span<?= $Page->reason_code->viewAttributes() ?>>
<?= $Page->reason_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->transaction_time->Visible) { // transaction_time ?>
    <tr id="r_transaction_time"<?= $Page->transaction_time->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_transaction_time"><?= $Page->transaction_time->caption() ?></span></td>
        <td data-name="transaction_time"<?= $Page->transaction_time->cellAttributes() ?>>
<span id="el_charge_payment_transaction_time">
<span<?= $Page->transaction_time->viewAttributes() ?>>
<?= $Page->transaction_time->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ch_email->Visible) { // ch_email ?>
    <tr id="r_ch_email"<?= $Page->ch_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_ch_email"><?= $Page->ch_email->caption() ?></span></td>
        <td data-name="ch_email"<?= $Page->ch_email->cellAttributes() ?>>
<span id="el_charge_payment_ch_email">
<span<?= $Page->ch_email->viewAttributes() ?>>
<?= $Page->ch_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ch_phone->Visible) { // ch_phone ?>
    <tr id="r_ch_phone"<?= $Page->ch_phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_charge_payment_ch_phone"><?= $Page->ch_phone->caption() ?></span></td>
        <td data-name="ch_phone"<?= $Page->ch_phone->cellAttributes() ?>>
<span id="el_charge_payment_ch_phone">
<span<?= $Page->ch_phone->viewAttributes() ?>>
<?= $Page->ch_phone->getViewValue() ?></span>
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
