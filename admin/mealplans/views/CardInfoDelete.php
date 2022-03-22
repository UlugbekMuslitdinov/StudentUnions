<?php

namespace PHPMaker2022\mealplans;

// Page object
$CardInfoDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { card_info: currentTable } });
var currentForm, currentPageID;
var fcard_infodelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcard_infodelete = new ew.Form("fcard_infodelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fcard_infodelete;
    loadjs.done("fcard_infodelete");
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
<form name="fcard_infodelete" id="fcard_infodelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="card_info">
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
<?php if ($Page->card_id->Visible) { // card_id ?>
        <th class="<?= $Page->card_id->headerCellClass() ?>"><span id="elh_card_info_card_id" class="card_info_card_id"><?= $Page->card_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cust_id->Visible) { // cust_id ?>
        <th class="<?= $Page->cust_id->headerCellClass() ?>"><span id="elh_card_info_cust_id" class="card_info_cust_id"><?= $Page->cust_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->guest_id->Visible) { // guest_id ?>
        <th class="<?= $Page->guest_id->headerCellClass() ?>"><span id="elh_card_info_guest_id" class="card_info_guest_id"><?= $Page->guest_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
        <th class="<?= $Page->first_name->headerCellClass() ?>"><span id="elh_card_info_first_name" class="card_info_first_name"><?= $Page->first_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
        <th class="<?= $Page->last_name->headerCellClass() ?>"><span id="elh_card_info_last_name" class="card_info_last_name"><?= $Page->last_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <th class="<?= $Page->address->headerCellClass() ?>"><span id="elh_card_info_address" class="card_info_address"><?= $Page->address->caption() ?></span></th>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
        <th class="<?= $Page->city->headerCellClass() ?>"><span id="elh_card_info_city" class="card_info_city"><?= $Page->city->caption() ?></span></th>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
        <th class="<?= $Page->state->headerCellClass() ?>"><span id="elh_card_info_state" class="card_info_state"><?= $Page->state->caption() ?></span></th>
<?php } ?>
<?php if ($Page->zipcode->Visible) { // zipcode ?>
        <th class="<?= $Page->zipcode->headerCellClass() ?>"><span id="elh_card_info_zipcode" class="card_info_zipcode"><?= $Page->zipcode->caption() ?></span></th>
<?php } ?>
<?php if ($Page->card_type->Visible) { // card_type ?>
        <th class="<?= $Page->card_type->headerCellClass() ?>"><span id="elh_card_info_card_type" class="card_info_card_type"><?= $Page->card_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->account_number->Visible) { // account_number ?>
        <th class="<?= $Page->account_number->headerCellClass() ?>"><span id="elh_card_info_account_number" class="card_info_account_number"><?= $Page->account_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->expiration_month->Visible) { // expiration_month ?>
        <th class="<?= $Page->expiration_month->headerCellClass() ?>"><span id="elh_card_info_expiration_month" class="card_info_expiration_month"><?= $Page->expiration_month->caption() ?></span></th>
<?php } ?>
<?php if ($Page->expiration_year->Visible) { // expiration_year ?>
        <th class="<?= $Page->expiration_year->headerCellClass() ?>"><span id="elh_card_info_expiration_year" class="card_info_expiration_year"><?= $Page->expiration_year->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_card_info__email" class="card_info__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th class="<?= $Page->phone->headerCellClass() ?>"><span id="elh_card_info_phone" class="card_info_phone"><?= $Page->phone->caption() ?></span></th>
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
<?php if ($Page->card_id->Visible) { // card_id ?>
        <td<?= $Page->card_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_card_id" class="el_card_info_card_id">
<span<?= $Page->card_id->viewAttributes() ?>>
<?= $Page->card_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->cust_id->Visible) { // cust_id ?>
        <td<?= $Page->cust_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_cust_id" class="el_card_info_cust_id">
<span<?= $Page->cust_id->viewAttributes() ?>>
<?= $Page->cust_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->guest_id->Visible) { // guest_id ?>
        <td<?= $Page->guest_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_guest_id" class="el_card_info_guest_id">
<span<?= $Page->guest_id->viewAttributes() ?>>
<?= $Page->guest_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
        <td<?= $Page->first_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_first_name" class="el_card_info_first_name">
<span<?= $Page->first_name->viewAttributes() ?>>
<?= $Page->first_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
        <td<?= $Page->last_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_last_name" class="el_card_info_last_name">
<span<?= $Page->last_name->viewAttributes() ?>>
<?= $Page->last_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
        <td<?= $Page->address->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_address" class="el_card_info_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
        <td<?= $Page->city->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_city" class="el_card_info_city">
<span<?= $Page->city->viewAttributes() ?>>
<?= $Page->city->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
        <td<?= $Page->state->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_state" class="el_card_info_state">
<span<?= $Page->state->viewAttributes() ?>>
<?= $Page->state->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->zipcode->Visible) { // zipcode ?>
        <td<?= $Page->zipcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_zipcode" class="el_card_info_zipcode">
<span<?= $Page->zipcode->viewAttributes() ?>>
<?= $Page->zipcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->card_type->Visible) { // card_type ?>
        <td<?= $Page->card_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_card_type" class="el_card_info_card_type">
<span<?= $Page->card_type->viewAttributes() ?>>
<?= $Page->card_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->account_number->Visible) { // account_number ?>
        <td<?= $Page->account_number->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_account_number" class="el_card_info_account_number">
<span<?= $Page->account_number->viewAttributes() ?>>
<?= $Page->account_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->expiration_month->Visible) { // expiration_month ?>
        <td<?= $Page->expiration_month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_expiration_month" class="el_card_info_expiration_month">
<span<?= $Page->expiration_month->viewAttributes() ?>>
<?= $Page->expiration_month->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->expiration_year->Visible) { // expiration_year ?>
        <td<?= $Page->expiration_year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_expiration_year" class="el_card_info_expiration_year">
<span<?= $Page->expiration_year->viewAttributes() ?>>
<?= $Page->expiration_year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info__email" class="el_card_info__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <td<?= $Page->phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_card_info_phone" class="el_card_info_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
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
