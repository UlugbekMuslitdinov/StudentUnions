<?php

namespace PHPMaker2022\mealplans;

// Page object
$BursarPaymentView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bursar_payment: currentTable } });
var currentForm, currentPageID;
var fbursar_paymentview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbursar_paymentview = new ew.Form("fbursar_paymentview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fbursar_paymentview;
    loadjs.done("fbursar_paymentview");
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
<form name="fbursar_paymentview" id="fbursar_paymentview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bursar_payment">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->bursar_id->Visible) { // bursar_id ?>
    <tr id="r_bursar_id"<?= $Page->bursar_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bursar_payment_bursar_id"><?= $Page->bursar_id->caption() ?></span></td>
        <td data-name="bursar_id"<?= $Page->bursar_id->cellAttributes() ?>>
<span id="el_bursar_payment_bursar_id">
<span<?= $Page->bursar_id->viewAttributes() ?>>
<?= $Page->bursar_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->emplid->Visible) { // emplid ?>
    <tr id="r_emplid"<?= $Page->emplid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bursar_payment_emplid"><?= $Page->emplid->caption() ?></span></td>
        <td data-name="emplid"<?= $Page->emplid->cellAttributes() ?>>
<span id="el_bursar_payment_emplid">
<span<?= $Page->emplid->viewAttributes() ?>>
<?= $Page->emplid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->subcode->Visible) { // subcode ?>
    <tr id="r_subcode"<?= $Page->subcode->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bursar_payment_subcode"><?= $Page->subcode->caption() ?></span></td>
        <td data-name="subcode"<?= $Page->subcode->cellAttributes() ?>>
<span id="el_bursar_payment_subcode">
<span<?= $Page->subcode->viewAttributes() ?>>
<?= $Page->subcode->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->term->Visible) { // term ?>
    <tr id="r_term"<?= $Page->term->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bursar_payment_term"><?= $Page->term->caption() ?></span></td>
        <td data-name="term"<?= $Page->term->cellAttributes() ?>>
<span id="el_bursar_payment_term">
<span<?= $Page->term->viewAttributes() ?>>
<?= $Page->term->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bursars_amount->Visible) { // bursars_amount ?>
    <tr id="r_bursars_amount"<?= $Page->bursars_amount->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bursar_payment_bursars_amount"><?= $Page->bursars_amount->caption() ?></span></td>
        <td data-name="bursars_amount"<?= $Page->bursars_amount->cellAttributes() ?>>
<span id="el_bursar_payment_bursars_amount">
<span<?= $Page->bursars_amount->viewAttributes() ?>>
<?= $Page->bursars_amount->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_response->Visible) { // response ?>
    <tr id="r__response"<?= $Page->_response->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bursar_payment__response"><?= $Page->_response->caption() ?></span></td>
        <td data-name="_response"<?= $Page->_response->cellAttributes() ?>>
<span id="el_bursar_payment__response">
<span<?= $Page->_response->viewAttributes() ?>>
<?= $Page->_response->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->item_nbr->Visible) { // item_nbr ?>
    <tr id="r_item_nbr"<?= $Page->item_nbr->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bursar_payment_item_nbr"><?= $Page->item_nbr->caption() ?></span></td>
        <td data-name="item_nbr"<?= $Page->item_nbr->cellAttributes() ?>>
<span id="el_bursar_payment_item_nbr">
<span<?= $Page->item_nbr->viewAttributes() ?>>
<?= $Page->item_nbr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->line_seq_no->Visible) { // line_seq_no ?>
    <tr id="r_line_seq_no"<?= $Page->line_seq_no->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bursar_payment_line_seq_no"><?= $Page->line_seq_no->caption() ?></span></td>
        <td data-name="line_seq_no"<?= $Page->line_seq_no->cellAttributes() ?>>
<span id="el_bursar_payment_line_seq_no">
<span<?= $Page->line_seq_no->viewAttributes() ?>>
<?= $Page->line_seq_no->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->transaction_time->Visible) { // transaction_time ?>
    <tr id="r_transaction_time"<?= $Page->transaction_time->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bursar_payment_transaction_time"><?= $Page->transaction_time->caption() ?></span></td>
        <td data-name="transaction_time"<?= $Page->transaction_time->cellAttributes() ?>>
<span id="el_bursar_payment_transaction_time">
<span<?= $Page->transaction_time->viewAttributes() ?>>
<?= $Page->transaction_time->getViewValue() ?></span>
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
