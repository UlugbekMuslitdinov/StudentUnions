<?php

namespace PHPMaker2021\project1;

// Page object
$BoxOrderDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbox_orderdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fbox_orderdelete = currentForm = new ew.Form("fbox_orderdelete", "delete");
    loadjs.done("fbox_orderdelete");
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
<form name="fbox_orderdelete" id="fbox_orderdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="box_order">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_box_order_id" class="box_order_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
        <th class="<?= $Page->first_name->headerCellClass() ?>"><span id="elh_box_order_first_name" class="box_order_first_name"><?= $Page->first_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
        <th class="<?= $Page->last_name->headerCellClass() ?>"><span id="elh_box_order_last_name" class="box_order_last_name"><?= $Page->last_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_box_order__email" class="box_order__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th class="<?= $Page->phone->headerCellClass() ?>"><span id="elh_box_order_phone" class="box_order_phone"><?= $Page->phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <th class="<?= $Page->location->headerCellClass() ?>"><span id="elh_box_order_location" class="box_order_location"><?= $Page->location->caption() ?></span></th>
<?php } ?>
<?php if ($Page->payment->Visible) { // payment ?>
        <th class="<?= $Page->payment->headerCellClass() ?>"><span id="elh_box_order_payment" class="box_order_payment"><?= $Page->payment->caption() ?></span></th>
<?php } ?>
<?php if ($Page->payment_idb->Visible) { // payment_idb ?>
        <th class="<?= $Page->payment_idb->headerCellClass() ?>"><span id="elh_box_order_payment_idb" class="box_order_payment_idb"><?= $Page->payment_idb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->amount_swipe->Visible) { // amount_swipe ?>
        <th class="<?= $Page->amount_swipe->headerCellClass() ?>"><span id="elh_box_order_amount_swipe" class="box_order_amount_swipe"><?= $Page->amount_swipe->caption() ?></span></th>
<?php } ?>
<?php if ($Page->amount_total->Visible) { // amount_total ?>
        <th class="<?= $Page->amount_total->headerCellClass() ?>"><span id="elh_box_order_amount_total" class="box_order_amount_total"><?= $Page->amount_total->caption() ?></span></th>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <th class="<?= $Page->timestamp->headerCellClass() ?>"><span id="elh_box_order_timestamp" class="box_order_timestamp"><?= $Page->timestamp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_box_order_status" class="box_order_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
        <th class="<?= $Page->netid->headerCellClass() ?>"><span id="elh_box_order_netid" class="box_order_netid"><?= $Page->netid->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sid->Visible) { // sid ?>
        <th class="<?= $Page->sid->headerCellClass() ?>"><span id="elh_box_order_sid" class="box_order_sid"><?= $Page->sid->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_box_order_id" class="box_order_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->first_name->Visible) { // first_name ?>
        <td <?= $Page->first_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_first_name" class="box_order_first_name">
<span<?= $Page->first_name->viewAttributes() ?>>
<?= $Page->first_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->last_name->Visible) { // last_name ?>
        <td <?= $Page->last_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_last_name" class="box_order_last_name">
<span<?= $Page->last_name->viewAttributes() ?>>
<?= $Page->last_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td <?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order__email" class="box_order__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <td <?= $Page->phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_phone" class="box_order_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
        <td <?= $Page->location->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_location" class="box_order_location">
<span<?= $Page->location->viewAttributes() ?>>
<?= $Page->location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->payment->Visible) { // payment ?>
        <td <?= $Page->payment->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_payment" class="box_order_payment">
<span<?= $Page->payment->viewAttributes() ?>>
<?= $Page->payment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->payment_idb->Visible) { // payment_idb ?>
        <td <?= $Page->payment_idb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_payment_idb" class="box_order_payment_idb">
<span<?= $Page->payment_idb->viewAttributes() ?>>
<?= $Page->payment_idb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->amount_swipe->Visible) { // amount_swipe ?>
        <td <?= $Page->amount_swipe->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_amount_swipe" class="box_order_amount_swipe">
<span<?= $Page->amount_swipe->viewAttributes() ?>>
<?= $Page->amount_swipe->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->amount_total->Visible) { // amount_total ?>
        <td <?= $Page->amount_total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_amount_total" class="box_order_amount_total">
<span<?= $Page->amount_total->viewAttributes() ?>>
<?= $Page->amount_total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
        <td <?= $Page->timestamp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_timestamp" class="box_order_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_status" class="box_order_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->netid->Visible) { // netid ?>
        <td <?= $Page->netid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_netid" class="box_order_netid">
<span<?= $Page->netid->viewAttributes() ?>>
<?= $Page->netid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sid->Visible) { // sid ?>
        <td <?= $Page->sid->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_box_order_sid" class="box_order_sid">
<span<?= $Page->sid->viewAttributes() ?>>
<?= $Page->sid->getViewValue() ?></span>
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
