<?php

namespace PHPMaker2022\mealplans;

// Page object
$CardInfoView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { card_info: currentTable } });
var currentForm, currentPageID;
var fcard_infoview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fcard_infoview = new ew.Form("fcard_infoview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fcard_infoview;
    loadjs.done("fcard_infoview");
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
<form name="fcard_infoview" id="fcard_infoview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="card_info">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->card_id->Visible) { // card_id ?>
    <tr id="r_card_id"<?= $Page->card_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_card_id"><?= $Page->card_id->caption() ?></span></td>
        <td data-name="card_id"<?= $Page->card_id->cellAttributes() ?>>
<span id="el_card_info_card_id">
<span<?= $Page->card_id->viewAttributes() ?>>
<?= $Page->card_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cust_id->Visible) { // cust_id ?>
    <tr id="r_cust_id"<?= $Page->cust_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_cust_id"><?= $Page->cust_id->caption() ?></span></td>
        <td data-name="cust_id"<?= $Page->cust_id->cellAttributes() ?>>
<span id="el_card_info_cust_id">
<span<?= $Page->cust_id->viewAttributes() ?>>
<?= $Page->cust_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->guest_id->Visible) { // guest_id ?>
    <tr id="r_guest_id"<?= $Page->guest_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_guest_id"><?= $Page->guest_id->caption() ?></span></td>
        <td data-name="guest_id"<?= $Page->guest_id->cellAttributes() ?>>
<span id="el_card_info_guest_id">
<span<?= $Page->guest_id->viewAttributes() ?>>
<?= $Page->guest_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
    <tr id="r_first_name"<?= $Page->first_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_first_name"><?= $Page->first_name->caption() ?></span></td>
        <td data-name="first_name"<?= $Page->first_name->cellAttributes() ?>>
<span id="el_card_info_first_name">
<span<?= $Page->first_name->viewAttributes() ?>>
<?= $Page->first_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
    <tr id="r_last_name"<?= $Page->last_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_last_name"><?= $Page->last_name->caption() ?></span></td>
        <td data-name="last_name"<?= $Page->last_name->cellAttributes() ?>>
<span id="el_card_info_last_name">
<span<?= $Page->last_name->viewAttributes() ?>>
<?= $Page->last_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <tr id="r_address"<?= $Page->address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_address"><?= $Page->address->caption() ?></span></td>
        <td data-name="address"<?= $Page->address->cellAttributes() ?>>
<span id="el_card_info_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
    <tr id="r_city"<?= $Page->city->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_city"><?= $Page->city->caption() ?></span></td>
        <td data-name="city"<?= $Page->city->cellAttributes() ?>>
<span id="el_card_info_city">
<span<?= $Page->city->viewAttributes() ?>>
<?= $Page->city->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
    <tr id="r_state"<?= $Page->state->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_state"><?= $Page->state->caption() ?></span></td>
        <td data-name="state"<?= $Page->state->cellAttributes() ?>>
<span id="el_card_info_state">
<span<?= $Page->state->viewAttributes() ?>>
<?= $Page->state->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->zipcode->Visible) { // zipcode ?>
    <tr id="r_zipcode"<?= $Page->zipcode->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_zipcode"><?= $Page->zipcode->caption() ?></span></td>
        <td data-name="zipcode"<?= $Page->zipcode->cellAttributes() ?>>
<span id="el_card_info_zipcode">
<span<?= $Page->zipcode->viewAttributes() ?>>
<?= $Page->zipcode->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->card_type->Visible) { // card_type ?>
    <tr id="r_card_type"<?= $Page->card_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_card_type"><?= $Page->card_type->caption() ?></span></td>
        <td data-name="card_type"<?= $Page->card_type->cellAttributes() ?>>
<span id="el_card_info_card_type">
<span<?= $Page->card_type->viewAttributes() ?>>
<?= $Page->card_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->account_number->Visible) { // account_number ?>
    <tr id="r_account_number"<?= $Page->account_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_account_number"><?= $Page->account_number->caption() ?></span></td>
        <td data-name="account_number"<?= $Page->account_number->cellAttributes() ?>>
<span id="el_card_info_account_number">
<span<?= $Page->account_number->viewAttributes() ?>>
<?= $Page->account_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->expiration_month->Visible) { // expiration_month ?>
    <tr id="r_expiration_month"<?= $Page->expiration_month->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_expiration_month"><?= $Page->expiration_month->caption() ?></span></td>
        <td data-name="expiration_month"<?= $Page->expiration_month->cellAttributes() ?>>
<span id="el_card_info_expiration_month">
<span<?= $Page->expiration_month->viewAttributes() ?>>
<?= $Page->expiration_month->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->expiration_year->Visible) { // expiration_year ?>
    <tr id="r_expiration_year"<?= $Page->expiration_year->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_expiration_year"><?= $Page->expiration_year->caption() ?></span></td>
        <td data-name="expiration_year"<?= $Page->expiration_year->cellAttributes() ?>>
<span id="el_card_info_expiration_year">
<span<?= $Page->expiration_year->viewAttributes() ?>>
<?= $Page->expiration_year->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el_card_info__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <tr id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_card_info_phone"><?= $Page->phone->caption() ?></span></td>
        <td data-name="phone"<?= $Page->phone->cellAttributes() ?>>
<span id="el_card_info_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
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
