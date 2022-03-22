<?php

namespace PHPMaker2022\mealplans;

// Page object
$ChargePaymentDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { charge_payment: currentTable } });
var currentForm, currentPageID;
var fcharge_paymentdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcharge_paymentdelete = new ew.Form("fcharge_paymentdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fcharge_paymentdelete;
    loadjs.done("fcharge_paymentdelete");
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
<form name="fcharge_paymentdelete" id="fcharge_paymentdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="charge_payment">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->charge_id->Visible) { // charge_id ?>
        <th class="<?= $Page->charge_id->headerCellClass() ?>"><span id="elh_charge_payment_charge_id" class="charge_payment_charge_id"><?= $Page->charge_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ch_first_name->Visible) { // ch_first_name ?>
        <th class="<?= $Page->ch_first_name->headerCellClass() ?>"><span id="elh_charge_payment_ch_first_name" class="charge_payment_ch_first_name"><?= $Page->ch_first_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ch_last_name->Visible) { // ch_last_name ?>
        <th class="<?= $Page->ch_last_name->headerCellClass() ?>"><span id="elh_charge_payment_ch_last_name" class="charge_payment_ch_last_name"><?= $Page->ch_last_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <th class="<?= $Page->address->headerCellClass() ?>"><span id="elh_charge_payment_address" class="charge_payment_address"><?= $Page->address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
        <th class="<?= $Page->city->headerCellClass() ?>"><span id="elh_charge_payment_city" class="charge_payment_city"><?= $Page->city->caption() ?></span></th>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
        <th class="<?= $Page->state->headerCellClass() ?>"><span id="elh_charge_payment_state" class="charge_payment_state"><?= $Page->state->caption() ?></span></th>
<?php } ?>
<?php if ($Page->zipcode->Visible) { // zipcode ?>
        <th class="<?= $Page->zipcode->headerCellClass() ?>"><span id="elh_charge_payment_zipcode" class="charge_payment_zipcode"><?= $Page->zipcode->caption() ?></span></th>
<?php } ?>
<?php if ($Page->card_type->Visible) { // card_type ?>
        <th class="<?= $Page->card_type->headerCellClass() ?>"><span id="elh_charge_payment_card_type" class="charge_payment_card_type"><?= $Page->card_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->expiration_month->Visible) { // expiration_month ?>
        <th class="<?= $Page->expiration_month->headerCellClass() ?>"><span id="elh_charge_payment_expiration_month" class="charge_payment_expiration_month"><?= $Page->expiration_month->caption() ?></span></th>
<?php } ?>
<?php if ($Page->expiration_year->Visible) { // expiration_year ?>
        <th class="<?= $Page->expiration_year->headerCellClass() ?>"><span id="elh_charge_payment_expiration_year" class="charge_payment_expiration_year"><?= $Page->expiration_year->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cv_reply->Visible) { // cv_reply ?>
        <th class="<?= $Page->cv_reply->headerCellClass() ?>"><span id="elh_charge_payment_cv_reply" class="charge_payment_cv_reply"><?= $Page->cv_reply->caption() ?></span></th>
<?php } ?>
<?php if ($Page->charge_amount->Visible) { // charge_amount ?>
        <th class="<?= $Page->charge_amount->headerCellClass() ?>"><span id="elh_charge_payment_charge_amount" class="charge_payment_charge_amount"><?= $Page->charge_amount->caption() ?></span></th>
<?php } ?>
<?php if ($Page->order_number->Visible) { // order_number ?>
        <th class="<?= $Page->order_number->headerCellClass() ?>"><span id="elh_charge_payment_order_number" class="charge_payment_order_number"><?= $Page->order_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->account_number->Visible) { // account_number ?>
        <th class="<?= $Page->account_number->headerCellClass() ?>"><span id="elh_charge_payment_account_number" class="charge_payment_account_number"><?= $Page->account_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->decision->Visible) { // decision ?>
        <th class="<?= $Page->decision->headerCellClass() ?>"><span id="elh_charge_payment_decision" class="charge_payment_decision"><?= $Page->decision->caption() ?></span></th>
<?php } ?>
<?php if ($Page->reason_code->Visible) { // reason_code ?>
        <th class="<?= $Page->reason_code->headerCellClass() ?>"><span id="elh_charge_payment_reason_code" class="charge_payment_reason_code"><?= $Page->reason_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->transaction_time->Visible) { // transaction_time ?>
        <th class="<?= $Page->transaction_time->headerCellClass() ?>"><span id="elh_charge_payment_transaction_time" class="charge_payment_transaction_time"><?= $Page->transaction_time->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ch_email->Visible) { // ch_email ?>
        <th class="<?= $Page->ch_email->headerCellClass() ?>"><span id="elh_charge_payment_ch_email" class="charge_payment_ch_email"><?= $Page->ch_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ch_phone->Visible) { // ch_phone ?>
        <th class="<?= $Page->ch_phone->headerCellClass() ?>"><span id="elh_charge_payment_ch_phone" class="charge_payment_ch_phone"><?= $Page->ch_phone->caption() ?></span></th>
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
<?php if ($Page->charge_id->Visible) { // charge_id ?>
        <td<?= $Page->charge_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_charge_id" class="el_charge_payment_charge_id">
<span<?= $Page->charge_id->viewAttributes() ?>>
<?= $Page->charge_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ch_first_name->Visible) { // ch_first_name ?>
        <td<?= $Page->ch_first_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_ch_first_name" class="el_charge_payment_ch_first_name">
<span<?= $Page->ch_first_name->viewAttributes() ?>>
<?= $Page->ch_first_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ch_last_name->Visible) { // ch_last_name ?>
        <td<?= $Page->ch_last_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_ch_last_name" class="el_charge_payment_ch_last_name">
<span<?= $Page->ch_last_name->viewAttributes() ?>>
<?= $Page->ch_last_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <td<?= $Page->address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_address" class="el_charge_payment_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
        <td<?= $Page->city->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_city" class="el_charge_payment_city">
<span<?= $Page->city->viewAttributes() ?>>
<?= $Page->city->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
        <td<?= $Page->state->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_state" class="el_charge_payment_state">
<span<?= $Page->state->viewAttributes() ?>>
<?= $Page->state->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->zipcode->Visible) { // zipcode ?>
        <td<?= $Page->zipcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_zipcode" class="el_charge_payment_zipcode">
<span<?= $Page->zipcode->viewAttributes() ?>>
<?= $Page->zipcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->card_type->Visible) { // card_type ?>
        <td<?= $Page->card_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_card_type" class="el_charge_payment_card_type">
<span<?= $Page->card_type->viewAttributes() ?>>
<?= $Page->card_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->expiration_month->Visible) { // expiration_month ?>
        <td<?= $Page->expiration_month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_expiration_month" class="el_charge_payment_expiration_month">
<span<?= $Page->expiration_month->viewAttributes() ?>>
<?= $Page->expiration_month->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->expiration_year->Visible) { // expiration_year ?>
        <td<?= $Page->expiration_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_expiration_year" class="el_charge_payment_expiration_year">
<span<?= $Page->expiration_year->viewAttributes() ?>>
<?= $Page->expiration_year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->cv_reply->Visible) { // cv_reply ?>
        <td<?= $Page->cv_reply->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_cv_reply" class="el_charge_payment_cv_reply">
<span<?= $Page->cv_reply->viewAttributes() ?>>
<?= $Page->cv_reply->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->charge_amount->Visible) { // charge_amount ?>
        <td<?= $Page->charge_amount->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_charge_amount" class="el_charge_payment_charge_amount">
<span<?= $Page->charge_amount->viewAttributes() ?>>
<?= $Page->charge_amount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->order_number->Visible) { // order_number ?>
        <td<?= $Page->order_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_order_number" class="el_charge_payment_order_number">
<span<?= $Page->order_number->viewAttributes() ?>>
<?= $Page->order_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->account_number->Visible) { // account_number ?>
        <td<?= $Page->account_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_account_number" class="el_charge_payment_account_number">
<span<?= $Page->account_number->viewAttributes() ?>>
<?= $Page->account_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->decision->Visible) { // decision ?>
        <td<?= $Page->decision->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_decision" class="el_charge_payment_decision">
<span<?= $Page->decision->viewAttributes() ?>>
<?= $Page->decision->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->reason_code->Visible) { // reason_code ?>
        <td<?= $Page->reason_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_reason_code" class="el_charge_payment_reason_code">
<span<?= $Page->reason_code->viewAttributes() ?>>
<?= $Page->reason_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->transaction_time->Visible) { // transaction_time ?>
        <td<?= $Page->transaction_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_transaction_time" class="el_charge_payment_transaction_time">
<span<?= $Page->transaction_time->viewAttributes() ?>>
<?= $Page->transaction_time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ch_email->Visible) { // ch_email ?>
        <td<?= $Page->ch_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_ch_email" class="el_charge_payment_ch_email">
<span<?= $Page->ch_email->viewAttributes() ?>>
<?= $Page->ch_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ch_phone->Visible) { // ch_phone ?>
        <td<?= $Page->ch_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_charge_payment_ch_phone" class="el_charge_payment_ch_phone">
<span<?= $Page->ch_phone->viewAttributes() ?>>
<?= $Page->ch_phone->getViewValue() ?></span>
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
