<?php

namespace PHPMaker2022\mealplans;

// Page object
$BursarPaymentDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bursar_payment: currentTable } });
var currentForm, currentPageID;
var fbursar_paymentdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbursar_paymentdelete = new ew.Form("fbursar_paymentdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fbursar_paymentdelete;
    loadjs.done("fbursar_paymentdelete");
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
<form name="fbursar_paymentdelete" id="fbursar_paymentdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bursar_payment">
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
<?php if ($Page->bursar_id->Visible) { // bursar_id ?>
        <th class="<?= $Page->bursar_id->headerCellClass() ?>"><span id="elh_bursar_payment_bursar_id" class="bursar_payment_bursar_id"><?= $Page->bursar_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->emplid->Visible) { // emplid ?>
        <th class="<?= $Page->emplid->headerCellClass() ?>"><span id="elh_bursar_payment_emplid" class="bursar_payment_emplid"><?= $Page->emplid->caption() ?></span></th>
<?php } ?>
<?php if ($Page->subcode->Visible) { // subcode ?>
        <th class="<?= $Page->subcode->headerCellClass() ?>"><span id="elh_bursar_payment_subcode" class="bursar_payment_subcode"><?= $Page->subcode->caption() ?></span></th>
<?php } ?>
<?php if ($Page->term->Visible) { // term ?>
        <th class="<?= $Page->term->headerCellClass() ?>"><span id="elh_bursar_payment_term" class="bursar_payment_term"><?= $Page->term->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bursars_amount->Visible) { // bursars_amount ?>
        <th class="<?= $Page->bursars_amount->headerCellClass() ?>"><span id="elh_bursar_payment_bursars_amount" class="bursar_payment_bursars_amount"><?= $Page->bursars_amount->caption() ?></span></th>
<?php } ?>
<?php if ($Page->item_nbr->Visible) { // item_nbr ?>
        <th class="<?= $Page->item_nbr->headerCellClass() ?>"><span id="elh_bursar_payment_item_nbr" class="bursar_payment_item_nbr"><?= $Page->item_nbr->caption() ?></span></th>
<?php } ?>
<?php if ($Page->line_seq_no->Visible) { // line_seq_no ?>
        <th class="<?= $Page->line_seq_no->headerCellClass() ?>"><span id="elh_bursar_payment_line_seq_no" class="bursar_payment_line_seq_no"><?= $Page->line_seq_no->caption() ?></span></th>
<?php } ?>
<?php if ($Page->transaction_time->Visible) { // transaction_time ?>
        <th class="<?= $Page->transaction_time->headerCellClass() ?>"><span id="elh_bursar_payment_transaction_time" class="bursar_payment_transaction_time"><?= $Page->transaction_time->caption() ?></span></th>
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
<?php if ($Page->bursar_id->Visible) { // bursar_id ?>
        <td<?= $Page->bursar_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_bursar_id" class="el_bursar_payment_bursar_id">
<span<?= $Page->bursar_id->viewAttributes() ?>>
<?= $Page->bursar_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->emplid->Visible) { // emplid ?>
        <td<?= $Page->emplid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_emplid" class="el_bursar_payment_emplid">
<span<?= $Page->emplid->viewAttributes() ?>>
<?= $Page->emplid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->subcode->Visible) { // subcode ?>
        <td<?= $Page->subcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_subcode" class="el_bursar_payment_subcode">
<span<?= $Page->subcode->viewAttributes() ?>>
<?= $Page->subcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->term->Visible) { // term ?>
        <td<?= $Page->term->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_term" class="el_bursar_payment_term">
<span<?= $Page->term->viewAttributes() ?>>
<?= $Page->term->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bursars_amount->Visible) { // bursars_amount ?>
        <td<?= $Page->bursars_amount->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_bursars_amount" class="el_bursar_payment_bursars_amount">
<span<?= $Page->bursars_amount->viewAttributes() ?>>
<?= $Page->bursars_amount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->item_nbr->Visible) { // item_nbr ?>
        <td<?= $Page->item_nbr->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_item_nbr" class="el_bursar_payment_item_nbr">
<span<?= $Page->item_nbr->viewAttributes() ?>>
<?= $Page->item_nbr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->line_seq_no->Visible) { // line_seq_no ?>
        <td<?= $Page->line_seq_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_line_seq_no" class="el_bursar_payment_line_seq_no">
<span<?= $Page->line_seq_no->viewAttributes() ?>>
<?= $Page->line_seq_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->transaction_time->Visible) { // transaction_time ?>
        <td<?= $Page->transaction_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bursar_payment_transaction_time" class="el_bursar_payment_transaction_time">
<span<?= $Page->transaction_time->viewAttributes() ?>>
<?= $Page->transaction_time->getViewValue() ?></span>
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
